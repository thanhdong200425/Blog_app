<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'entity');
    }

    public function likeQuantity(): MorphOne
    {
        return $this->morphOne(LikeQuantity::class, 'likeQuantity');
    }

    protected $fillable = ['user_id', 'article_id', 'content'];
}
