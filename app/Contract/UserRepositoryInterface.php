<?php

namespace App\Contract;

use App\Models\User;

interface UserRepositoryInterface extends GeneralRepositoryInterface
{
    public function getAllArticles(User $user);
}