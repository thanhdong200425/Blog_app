<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class LikeQuantity extends Model
{
    //
    public function likeQuantity(): MorphTo {
        return $this->morphTo();
    }
}
