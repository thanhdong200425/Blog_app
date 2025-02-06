<?php

namespace App\Repositories;

use App\Contract\CommentRepositoryInterface;
use App\Models\Comment;
use Exception;
use Illuminate\Database\Eloquent\Model;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function __construct(Comment $comment)
    {
        parent::__construct($comment);
    }
    public function create(array $attributes)
    {
        $attributes['path'] = $this->generateCommentPath($attributes['parent_id'] ?? null);
        return Comment::create($attributes)->load('author');
    }
    public function generateCommentPath($id)
    {
        try {
            if ($id === null)
                return (string) (Comment::whereNull('parent_id')->count() + 1);
            $parentPath = Comment::findOrFail($id)->path;
            $childQuantity = Comment::where('parent_id', $id)->where('path', 'like', $parentPath)->count();
            return "{$parentPath}." . ($childQuantity + 1);
        } catch (Exception $e) {
            throw $e;
        }
    }
}