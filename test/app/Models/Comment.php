<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'Comment';
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }


}
