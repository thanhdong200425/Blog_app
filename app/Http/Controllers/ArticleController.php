<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function show()
    {
        $articles = Article::with('author')->paginate(10);
        $latestPosts = Article::with('author')->orderBy('created_at', 'desc')->take(5)->get();
        $user = Auth::user();
        return view('main.post.list-post', ['articles' => $articles, 'latestPosts' => $latestPosts, 'avatarSrc' => $user->image_url]);
    }
}