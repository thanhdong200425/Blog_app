<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['email', 'name', 'hashed_password', 'first_name', 'last_name', 'date_of_birth', 'image_url', 'created_at', 'updated_at'];

    public function getAuthPassword()
    {
        return $this->hashed_password;
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}