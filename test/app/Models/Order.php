<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'order';
    public $timestamps = false;
    protected $fillable = [
        'customer_id', 'shipping_fullname', 'shipping_email', 'shipping_mobile', 'payment_method','coupon_id','shipping_housenumber_street','shipping_ward_id','shipping_fee'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'customer_id' , 'id');
    }

    public function staff(){
        return $this->belongsTo(Staff::class, 'staff_id' , 'id');
    }

    public function status(){
        return $this->belongsTo(ShippingStatus::class, 'order_status_id');
    }

    public function ward(){
        return $this->belongsTo(Ward::class, 'shipping_ward_id' , 'id');
    }

    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class , 'order_item' , 'order_id' , 'product_id')->withPivot('qty' , 'unit_price' , 'total_price');
    }

    public function coupon(){
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }

    public function orderItem() {
        return $this->hasMany(OrderItem::class , 'order_id');
    }

    public function getShippingStatus() {
        $order_status = [
            1 => "ordered",
            2 => "confirmed", 
            3 => "packaged",
            4 => "shipping",
            5 => "delivered",
            6 => "canceled",
        ];
        return $order_status[$this->order_status_id];
    }

    public function getPayment() {
        $paymentMethod = [
            0 => "COD",
            1 => "BANK", 
        ];
        return $paymentMethod[$this->payment_method];
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_date' => 'datetime:Y-m-d H:i:s',
    ];



}
