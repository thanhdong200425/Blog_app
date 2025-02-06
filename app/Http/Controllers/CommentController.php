<?php

namespace App\Http\Controllers;

use App\Contract\CommentRepositoryInterface;
use App\Models\Comment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    protected CommentRepositoryInterface $commentRepository;
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    public function comment(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'content' => ['required', 'string'],
                'parentId' => ['nullable', 'exists:comments,id'],
                'articleId' => ['required', 'exists:articles,id']
            ]);
            $newComment = $this->commentRepository->create([
                'user_id' => Auth::id(),
                'article_id' => $validatedData['articleId'],
                'content' => $validatedData['content'],
                'parent_id' => $validatedData['parentId'] ?? null
            ]);
            return response()->json([
                'data' => $newComment
            ], 200);
        } catch (Exception $er) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $er
            ], 422);
        }
    }

    public function delete(Request $request)
    {
        $validatedResult = $request->validate([
            'id' => 'required'
        ]);

        $result = $this->commentRepository->delete($validatedResult['id']);

        return response()->json([
            'delete' => $result > 0 ? true : false,
        ], 200);
    }
}
