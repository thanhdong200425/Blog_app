<?php

namespace App\Contract;

interface ArticleRepositoryInterface extends GeneralRepositoryInterface
{
    public function getAllBySort($column, $type);
    public function getAllPaginated($perPage);
    public function getBySlug($slug);
}