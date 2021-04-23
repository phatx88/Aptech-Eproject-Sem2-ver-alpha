<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Traits\HasCompositePrimaryKey;

class OrderItem extends Model
{
    use HasFactory;
    use HasCompositePrimaryKey;

    protected $table = 'order_item';
    protected $primaryKey = ['order_id', 'product_id'];
    public $incrementing = false;
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    
}
