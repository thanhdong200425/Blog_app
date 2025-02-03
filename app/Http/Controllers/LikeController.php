<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;
use App\Models\LikeQuantity;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        try {
            // Validate request
            $validatedResult = $request->validate([
                'entityId' => ['required', 'integer'],
                'type' => ['required']
            ]);

            $model = $validatedResult['type'] == 'comment' ? Comment::find($validatedResult['entityId']) : Article::find($validatedResult['entityId']);
            if ($validatedResult['type'] == 'article' && $model->likes()->where('user_id', Auth::id())->exists())
                return response()->json([
                    'error' => 'You have already liked this article'
                ], 400);

            // If the condition is passed, create a new like for model (Comment or Article)
            $model->likes()->create([
                'user_id' => Auth::id()
            ]);
            // Create a record for the like quantity for article if not exists or update it
            $currentQuantity = $model->likeQuantity()->first();
            $model->likeQuantity()->updateOrCreate(
                ['entity_id' => $model->id],
                ['quantity' => ($currentQuantity ? $currentQuantity->quantity : 0) + 1]
            );
            return response()->json(['liked' => true]);
        } catch (Exception $e) {
            Log::error('Like error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function unlike(Request $request)
    {
        try {
            $validatedResult = $request->validate([
                'entityId' => ['required', 'integer'],
            ]);

            // Find the article and delete like of it
            $article = Article::find($validatedResult['entityId']);
            $likeArticle = $article->likes()->where('user_id', Auth::id())->first();

            // Check whether a user has liked the article
            if (!$likeArticle)
                return response()->json(['error' => 'You have not liked this post yet'], 400);

            $likeArticle->delete();

            // Decrement like quantity
            $article->likeQuantity()->update([
                'quantity' => $article->likeQuantity()->first()->quantity - 1
            ]);

            return response()->json(['liked' => false]);
        } catch (Exception $e) {
            Log::error('Like error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
