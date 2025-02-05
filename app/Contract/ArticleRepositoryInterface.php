<?php

namespace App\Contract;

interface ArticleRepositoryInterface extends GeneralRepositoryInterface
{
    public function getAllBySort($column, $type);
}