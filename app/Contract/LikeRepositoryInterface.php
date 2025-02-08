<?php

namespace App\Contract;

interface LikeRepositoryInterface
{
    public function getEntityByType($type, $entityId);
    public function checkWhetherUserLikedOrNot($model, $userId);
    public function createLike($model, $userId);
    public function getLikeQuantity($model);
    public function updateOrCreateLikeQuantity($model, $isIncrement = true);
    public function getLikesForSpecificUser($model, $userId);
    public function deleteLike($entityModel, $likeModel);
}