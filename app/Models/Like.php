<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Like extends Model
{
    /** @use HasFactory<\Database\Factories\LikeFactory> */
    use HasFactory;

    public function likeable(): MorphTo {
        return $this->morphTo();
    }

    protected $fillable = ['user_id', 'entity_id', 'entity_type_id'];
}
