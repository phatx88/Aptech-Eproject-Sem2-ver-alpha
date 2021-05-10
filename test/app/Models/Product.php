<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'view_product';

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function order(): BelongsToMany
    {
        return $this->belongsToMany(Order::class , 'order_item' , 'product_id' , 'order_id');
    }

    public function wishlist(){
        return $this->belongsTo(WishList::class, 'wishlist_item', 'wish_list_id', 'product_id');
    }
}
