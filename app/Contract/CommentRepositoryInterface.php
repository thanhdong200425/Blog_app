<?php

namespace App\Contract;

interface CommentRepositoryInterface extends GeneralRepositoryInterface
{
    public function generateCommentPath($id);
}