<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageItem extends Model
{
    use HasFactory;
    protected $table = 'image_item';
    public $timestamps = false;
    public function Product(){
        return $this->belongsTo(Product::class,'product_id');
    }


}
