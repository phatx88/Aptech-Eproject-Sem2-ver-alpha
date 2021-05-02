<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PostTag extends Model
{
    use HasFactory;
    protected $table = 'post_tag';
    public $timestamps = false;

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tagId');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'postId');
    }
}
