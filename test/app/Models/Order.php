<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    public $timestamps = false;
    protected $fillable = [
        'customer_id', 'shipping_fullname', 'shipping_email', 'shipping_mobile', 'payment_method','coupon_id','shipping_housenumber_street','shipping_ward_id','shipping_fee'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'customer_id' , 'id');
    }

    public function status(){
        return $this->belongsTo(ShippingStatus::class, 'order_status_id');
    }

    public function ward(){
        return $this->belongsTo(Ward::class, 'shipping_ward_id' , 'id');
    }

    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class , 'order_item' , 'order_id' , 'product_id');
    }

    // public function orderItem() {
    //     return $this->hasMany(OrderItem::class , 'product_id', 'order_id');
    // }

}
