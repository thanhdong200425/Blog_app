<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('author')->paginate(10);
        $latestPosts = Article::with('author')->orderBy('created_at', 'desc')->take(5)->get();
        return view('main.post.list-article', ['articles' => $articles, 'latestPosts' => $latestPosts]);
    }

    public function show($slug, $id)
    {
        $article = Article::with('author')->where('id', $id)->first();
        return view('main.post.article', ['article' => $article]);
    }
}