<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
class WishList extends Model
{
    use HasFactory;
    protected $table = 'wishlist';

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function wishlistitem(){
        return $this->hasMany(WishListItem::class, 'wish_list_id', 'id');
    }
}
