<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function comment(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'content' => ['required', 'string'],
                'parentId' => ['nullable', 'exists:comments,id'],
                'articleId' => ['required', 'exists:articles,id']
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }

        $commentPath = $this->generateCommentPath($validatedData['parentId'] ?? null);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'article_id' => $validatedData['articleId'],
            'content' => $validatedData['content'],
            'path' => $commentPath
        ]);

        // Perform a eager loading to the new comment
        $comment->load('author');

        return response()->json([
            'data' => $comment
        ], 200);
    }

    protected function generateCommentPath($parentId)
    {
        // When the comment is a root
        if ($parentId === null) {
            $rootQuantity = Comment::whereNull('parent_id')->count();
            return (string) ($rootQuantity + 1);
        }
        // When the comment is a children (reply comment)
        try {
            $parent = Comment::findOrFail($parentId);
            $childQuantity = $parent->children()->count();
            return (string) ($parent->path . '.' . ($childQuantity + 1));
        } catch (Exception $e) {
            Log::error('Parent comment does not found: ' + $e->getMessage());
            throw $e;
        }
    }
}
