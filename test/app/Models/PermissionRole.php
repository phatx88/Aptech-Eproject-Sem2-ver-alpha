<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCompositePrimaryKey;

class PermissionRole extends Model
{
    use HasFactory;
    use HasCompositePrimaryKey;

    protected $table = 'permission_role';
    protected $primaryKey = ['permission_id', 'role_id'];
    public $incrementing = false;
    public $timestamps = false;

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
