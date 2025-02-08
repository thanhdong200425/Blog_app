<?php
namespace App\Repositories;

use App\Contract\LikeRepositoryInterface;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;

class LikeRepository implements LikeRepositoryInterface
{
    private Like $like;
    public function __construct(Like $like)
    {
        $this->like = $like;
    }
    public function getEntityByType($type, $entityId)
    {
        return $type == 'comment' ? Comment::find($entityId) : Article::find($entityId);
    }
    public function checkWhetherUserLikedOrNot($model, $userId): bool
    {
        return $model->likes()->where('user_id', $userId)->exists();
    }
    public function createLike($model, $userId)
    {
        $model->likes()->create([
            'user_id' => $userId,
        ]);
        return $this->updateOrCreateLikeQuantity($model);
    }
    public function getLikeQuantity($model)
    {
        return $model->likeQuantity()->first();
    }
    public function getLikesForSpecificUser($model, $userId)
    {
        return $model->likes()->where('user_id', $userId)->first();
    }
    public function updateOrCreateLikeQuantity($model, $isIncrement = true)
    {
        $quantityChange = $isIncrement ? 1 : -1;
        $currentQuantity = $this->getLikeQuantity($model) ? $this->getLikeQuantity($model)->quantity : 0;
        return $model->likeQuantity()->updateOrCreate(
            ['entity_id' => $model->id],
            ['quantity' => max(0, $currentQuantity + $quantityChange)]
        );
    }
    public function deleteLike($entityModel, $likeModel)
    {
        $this->updateOrCreateLikeQuantity($entityModel, false);
        return $likeModel->delete();
    }
}
