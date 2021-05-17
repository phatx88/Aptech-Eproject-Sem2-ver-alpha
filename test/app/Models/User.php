<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'users';
    protected $primaryKey = "id";

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'email_verified_at',
        'last_login_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'is_staff',
        'provider',
        'provider_id',
        'last_login_at',
        'housenumber_street',
        'ward_id',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //separated user and staff
    public function role() {
        $role = [0 => "user", 1 => "staff"];
        return $role[$this->is_staff];
    }

    //to connect to roles and permissions
    public function roles() {
        return $this->belongsToMany(Role::class, 'staff', 'user_id' , 'role_id');
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return false;
    }


    public function assignRole($role)
    {
        return Staff::create([
            'user_id' => $this->id,
            'role_id' => $role,
        ]);
    }

    public function hasPermission($permission = null)
    {
        if (is_null($permission)) {
            return $this->getPermissions()->count();
        }

        if (is_string($permission)) {
            return $this->getPermissions()->contains('name', $permission);
        }

        return false;
    }

    private function getPermissions()
    {
        $role = $this->roles->first();
        if ($role) {
            if (! $role->relationLoaded('permissions')) {
                $this->roles->load('permissions');
                
            }
            $this->permissionList = $this->roles->pluck('permissions')->flatten();
        }
        

        return $this->permissionList ?? collect();
    }

    /**
     * Get the staff associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function staff(): HasOne
    {
        return $this->hasOne(Staff::class, 'user_id', 'id');
    }


    /**
     * Get all of the order for the User
     *
     * 
     */
    public function ward(){
        return $this->belongsTo(Ward::class, 'ward_id' , 'id');
    }

    /**
     * Get all of the order for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order(): HasMany
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function post(): HasMany
    {
        return $this->hasMany(Post::class, 'authorId', 'id');
    }

   

    public function postcomment()
    {
        return $this->hasMany(PostComment::class, 'user_id', 'id');
    }

    public function isAdministrator()
    {
        $user = Auth::user();
        if ($user->email == env('Admin_email')) {
            return true;
        }
        return false;
    }


}
