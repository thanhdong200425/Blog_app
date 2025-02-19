<?php

namespace App\Models;

use Carbon\Carbon;
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
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, "parent_id")->orderBy('path');
    }

    public function getParentPath()
    {
        return $this->where('path', substr($this->path, 0, strrpos($this->path, '.')));
    }

    public function getChildrenPath()
    {
        return $this->where('path', 'LIKE', "{$this->path}.%");
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Asia/Ho_Chi_Minh');
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    protected $fillable = ['user_id', 'article_id', 'content', 'path', 'parent_id', 'like_quantity', 'child_comment_quantity'];
}
