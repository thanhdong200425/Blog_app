<?php

namespace App\Http\Controllers;

use App\Contract\ArticleRepositoryInterface;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    private ArticleRepositoryInterface $articleRepository;
    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }
    public function index()
    {
        return view('main.post.list-article', ['articles' => $this->articleRepository->getAllPaginated(10), 'latestArticles' => $this->articleRepository->getAllBySort('created_at', 'desc')]);
    }

    public function show($slug)
    {
        return view('main.post.article', ['article' => $this->articleRepository->getBySlug($slug)]);
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
        if (!Auth::check())
            return redirect()->back()->withErrors(['error', 'OOps, Sorry, we have some problem!']);

        $this->articleRepository->create([
            'title' => $validateData['title'],
            'content' => $validateData['content'],
            'user_id' => Auth::id(),
            'slug' => Str::slug($validateData['title'])
        ]);
        return redirect()->route('main')->with('success', 'Added post successfully');
    }

    public function delete(Request $request)
    {
        $result = $this->articleRepository->delete($request->articleId);
        if (!$result)
            return redirect()->route('main')->with('error', 'OOps, Sorry, we have some problem!');
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