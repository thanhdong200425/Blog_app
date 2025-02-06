<?php

namespace App\Repositories;

use App\Contract\ArticleRepositoryInterface;
use App\Models\Article;

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
        return $this->model->with([
            'author',
            'comments' => function ($query) {
                $query->orderBy('path', 'asc');
            },
            'comments.author'
        ])->where('slug', $slug)->first();
    }
}