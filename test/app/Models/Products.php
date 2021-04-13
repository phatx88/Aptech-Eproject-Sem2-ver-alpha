<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'product';

    public $timestamps = false;
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
