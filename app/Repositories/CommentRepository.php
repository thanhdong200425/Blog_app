<?php

namespace App\Repositories;

use App\Contract\CommentRepositoryInterface;
use App\Models\Article;
use App\Models\Comment;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function __construct(Comment $comment)
    {
        parent::__construct($comment);
    }
    public function create(array $attributes)
    {
        $attributes['path'] = $this->generateCommentPath($attributes['parent_id'] ?? null);
        Article::where('id', $attributes['article_id'])->increment('comment_quantity');
        return Comment::create($attributes)->load('author');
    }
    public function delete($attributes)
    {
        $quantityDeletedComment = DB::table('comments')
            ->where('id', $attributes['id'])
            ->orWhere('parent_id', $attributes['id'])->count();
        Article::where('id', $attributes['articleId'])->decrement('comment_quantity', $quantityDeletedComment);
        DB::table('comments')
            ->where('id', $attributes['id'])
            ->orWhere('parent_id', $attributes['id'])->delete();
        return $quantityDeletedComment;
    }
    public function generateCommentPath($id)
    {
        try {
            if ($id === null) {
                return sprintf('%04d', Comment::count() + 1);
            }
            $comment = Comment::findOrFail($id);
            $parentPath = $comment->path ?? sprintf('%04d', $comment->id);
            $childQuantity = Comment::where('parent_id', $id)
                ->where('path', 'like', "{$parentPath}%")
                ->count();
            return sprintf('%s.%04d', $parentPath, $childQuantity + 1);
        } catch (Exception $e) {
            throw $e;
        }
    }
}