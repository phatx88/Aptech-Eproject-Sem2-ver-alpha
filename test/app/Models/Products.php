<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Products extends Model
{
    use HasFactory;

    protected $table = 'product';

    public $timestamps = false;

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

}
