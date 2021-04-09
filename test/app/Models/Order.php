<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    public $timestamps = false;

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function status(){
        return $this->belongsTo(ShippingStatus::class, 'order_status_id');
    }

    public function OrderItem(){
        return $this->hasMany(OrderItem::class, 'order_id','product_id');
    }

}
