<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Tag extends Model
{
    use HasFactory;
    protected $table = 'tag';
    public $timestamps = false;

    public function tag(): BelongsToMany
    {
        return $this->belongsToMany(Post::class , 'post_tag' , 'postId' , 'tagId');
    }
}
