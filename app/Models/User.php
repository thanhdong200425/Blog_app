<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['username', 'name', 'hashed_password', 'first_name', 'last_name', 'date_of_birth', 'image_url'];

    public function getAuthPassword()
    {
        return $this->hashed_password;
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}