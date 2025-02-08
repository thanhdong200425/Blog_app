<?php
namespace App\Http\Controllers;

use App\Contract\LikeRepositoryInterface;
use App\Models\Like;
use App\Models\LikeQuantity;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LikeController extends Controller
{
    private LikeRepositoryInterface $likeRepository;
    public function __construct(LikeRepositoryInterface $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }
    public function like(Request $request)
    {
        try {
            // Validate request
            $validatedResult = $request->validate([
                'entityId' => ['required', 'integer'],
                'type' => ['required'],
            ]);
            $model = $this->likeRepository->getEntityByType($validatedResult['type'], $validatedResult['entityId']);
            if ($validatedResult['type'] == 'article' && $this->likeRepository->checkWhetherUserLikedOrNot($model, Auth::id()))
                return response()->json([
                    'error' => 'You have already liked this',
                ], 400);

            $this->likeRepository->createLike($model, Auth::id());
            return response()->json(['liked' => true]);
        } catch (Exception $e) {
            Log::error('Like error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function unlike(Request $request)
    {
        try {
            $validatedResult = $request->validate([
                'entityId' => ['required', 'integer'],
                'type' => ['required'],
            ]);

            // Find the article and delete like of it
            $model = $this->likeRepository->getEntityByType($validatedResult['type'], $validatedResult['entityId']);
            $likesModel = $this->likeRepository->getLikesForSpecificUser($model, Auth::id());
            // Check whether a user has liked the article
            if ($validatedResult['type'] == 'article' && ! $likesModel)
                return response()->json(['error' => 'You have not liked this post yet'], 400);
            $this->likeRepository->deleteLike($model, $likesModel);
            return response()->json(['liked' => false]);
        } catch (Exception $e) {
            Log::error('Like error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
