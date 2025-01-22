<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('author')->paginate(10);
        $latestPosts = Article::with('author')->orderBy('created_at', 'desc')->take(5)->get();
        return view('main.post.list-article', ['articles' => $articles, 'latestPosts' => $latestPosts]);
    }

    public function show($id)
    {
        return view('main.post.article', ['id' => $id]);
    }
}