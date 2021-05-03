<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory;
    protected $table = 'post';
    public $timestamps = false;

    public function posttag() {
        return $this->hasMany(PostTag::class , 'postId');
    }

    public function user(){
        return $this->belongsTo(User::class, 'authorId' , 'id');
    }

    public function categoryblog(){
        return $this->belongsTo(CategoryBlog::class, 'categoryId');
    }
}
