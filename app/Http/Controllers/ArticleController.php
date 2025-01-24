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
        $latestArticles = Article::with('author')->orderBy('created_at', 'desc')->take(5)->get();
        return view('main.post.list-article', ['articles' => $articles, 'latestArticles' => $latestArticles]);
    }

    public function show($slug, $id)
    {
        $article = Article::with('author')->where('id', $id)->first();
        return view('main.post.article', ['article' => $article]);
    }

    public function showAskingPage()
    {
        return view('main.asking-page');
    }

    public function create(Request $request)
    {

        $validateData = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $title = $validateData['title'];
        $content = $validateData['content'];
        $user = Auth::user();

        if (!$user)
            return redirect()->back()->withErrors(['error', 'OOps, Sorry, we have some problem!']);

        $newArticle = Article::create([
            'title' => $title,
            'content' => $content,
            'user_id' => $user->id
        ]);

        return redirect()->route('main')->with('success', 'Added post successfully');
    }

    public function delete(Request $request)
    {
        $article = Article::where('id', $request->articleId)->first();
        if (!$article)
            return redirect()->route('main')->with('error', 'Can not find your article');

        $article->delete();
        return redirect()->route('main')->with('success', 'Article was completely deleted');
    }

    public function update($slug, $id)
    {
        $article = Article::where('id', $id)->first();
        if (!$article)
            return redirect()->route('main')->with('error', 'Article not found');
        return view('main.post.update-article', ['article' => $article]);
    }

    public function save(Request $request)
    {
        Article::where('id', $request->articleId)->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect()->route('main')->with('success', 'Successfully updated post');
    }
}