<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_item';
    public $timestamps = false;
<<<<<<< Updated upstream
    // protected $fillable = [
    //     'product_id', 'order_id', 'qty', 'unit_price', 'total_price'
    // ];
    public function product(){
        return $this->belongsTo(Product::class , 'product_id');
=======

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
>>>>>>> Stashed changes
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

}
