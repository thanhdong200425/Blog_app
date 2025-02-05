<?php

namespace App\Repositories;

use App\Contract\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        return User::all();
    }
    public function getById($id)
    {
        return User::find($id);
    }
    public function create(array $attributes)
    {
        return User::create($attributes);
    }
    public function update($id, array $attributes)
    {
        $user = User::findOrFail($id);
        $user->update($attributes);
        return $user;
    }
    public function delete($id)
    {
        return DB::table('users')->where('id', $id)->delete();
    }
    public function getAllArticles(User $user)
    {
        return $user->articles;
    }
}