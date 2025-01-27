<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class LikeQuantity extends Model
{
    //
    protected $table = 'likes_quantity';
    protected $fillable = [
        'entity_id',
        'entity_type_id',
        'quantity'
    ];
    public function likeQuantity(): MorphTo
    {
        return $this->morphTo();
    }
}
