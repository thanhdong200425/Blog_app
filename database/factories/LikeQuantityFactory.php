<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;
use App\Models\LikeQuantity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LikeQuantity>
 */
class LikeQuantityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $generatedKeys = [];
        do {
            $entityType = $this->faker->randomElement([
                Article::class,
                Comment::class
            ]);
            $entityId = $entityType::all()->random()->id;
            $key = $entityId."_".$entityType;
        } while (isset($generatedKeys[$key]));
        $generatedKeys[$key] = true;

        return [
            'entity_id' => $entityId,
            'entity_type' => $entityType,
            'quantity' => Like::where('entity_id', $entityId)->where('entity_type', $entityType)->count()
        ];
    }
}
