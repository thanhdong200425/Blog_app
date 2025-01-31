<?php

namespace App\Http\Controllers;

use App\Models\Article;
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
            ]);




            // Find the article
            $article = Article::find($validatedResult['entityId']);
            // Check whether a like for specific article is exist in likes table
            if ($article->likes()->where('user_id', Auth::id())->exists())
                return response()->json([
                    'error' => 'You have already liked this article'
                ], 400);

            $article->likes()->create([
                'user_id' => Auth::id()
            ]);

            // Create a record for the like quantity for article if not exists or update it
            $currentQuantity = $article->likeQuantity()->first();
            $article->likeQuantity()->updateOrCreate(
                ['entity_id' => $article->id],
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
}
