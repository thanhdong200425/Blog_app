<?php

namespace App\Repositories;

use App\Contract\ArticleRepositoryInterface;
use App\Models\Article;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleRepository extends BaseRepository implements ArticleRepositoryInterface
{
    public function __construct(Article $article)
    {
        parent::__construct($article);
    }
    public function getAllBySort($column, $type)
    {
        return $this->model->orderBy($column, $type)->get();
    }
    public function getAllPaginated($perPage)
    {
        return $this->model->paginate($perPage);
    }
    public function getBySlug($slug)
    {
        $userId = Auth::id();
        $article = $this->getArticleBySlug($slug, $userId);

        if (! $article)
            return null;
        $this->extractProperties($article, [
            'author' => [
                'id' => 'user_id',
                'email' => 'email',
                'first_name' => 'first_name',
                'last_name' => 'last_name',
                'image_url' => 'author_image'
            ]
        ]);
        $article->comments = $this->getArticleComments($article, $userId);
        return $article;
    }

    private function extractProperties(&$object, array $mappings)
    {
        foreach ($mappings as $newProperties => $newProperty) {
            $subObject = (object) [];
            foreach ($newProperty as $key => $originalKey) {
                $subObject->{$key} = $object->$originalKey ?? null;
                unset($object->{$originalKey});
            }
            $object->{$newProperties} = $subObject;
        }
    }

    private function getArticleBySlug($slug, $userId)
    {
        return DB::table('articles')
            ->select([
                'articles.*',
                'authors.email',
                'authors.first_name',
                'authors.last_name',
                'authors.image_url as author_image',
                'likes_quantity.quantity as likes_quantity',
            ])
            ->selectRaw("EXISTS(
            SELECT 1 FROM likes
            WHERE entity_id = articles.id
            AND entity_type LIKE '%Article'
            AND user_id = ?
        ) AS liked", [$userId])
            ->leftJoin('users as authors', 'authors.id', '=', 'articles.user_id')
            ->leftJoin('comments', 'comments.article_id', '=', 'articles.id')
            ->leftJoin('likes_quantity', 'likes_quantity.entity_id', '=', 'articles.id')
            ->where('articles.slug', $slug)
            ->first();
    }

    private function getArticleComments($article, $userId)
    {
        return DB::table('comments')
            ->select(
                'comments.*',
                'comment_authors.id as author_id',
                'comment_authors.email as author_email',
                'comment_authors.first_name as author_first_name',
                'comment_authors.last_name as author_last_name',
                'comment_authors.image_url as author_image_url',
                'likes_quantity.quantity as quantity'
            )
            ->selectRaw('EXISTS(SELECT 1 FROM likes WHERE entity_id = comments.id AND entity_type LIKE "%Comment" AND user_id = ?) AS liked', [$userId])
            ->orderBy('path', 'asc')
            ->leftJoin('users as comment_authors', 'comment_authors.id', '=', 'comments.user_id')
            ->leftJoin('likes_quantity', function (JoinClause $join) {
                $join->on('likes_quantity.entity_id', '=', 'comments.id')->where('likes_quantity.entity_type', 'like', '%Comment');
            })
            ->where('comments.article_id', '=', $article->id)
            ->get()
            ->map(function ($comment) {
                $comment->author = (object) [
                    'id' => $comment->author_id,
                    'email' => $comment->author_email,
                    'first_name' => $comment->author_first_name,
                    'last_name' => $comment->author_last_name,
                    'image_url' => $comment->author_image_url
                ];
                unset($comment->author_id, $comment->author_email, $comment->author_first_name, $comment->author_last_name, $comment->author_image_url);
                return $comment;
            });
    }
}