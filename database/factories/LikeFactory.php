<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
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
            $userId = User::all()->random()->id;
            $entityType = $this->faker->randomElement([
                Article::class,
                Comment::class
            ]);
            $entity = $entityType::all()->random();
            $key = $userId."_".$entity->id."_".$entityType;
        } while (isset($generatedKeys[$key]));
        $generatedKeys[$key] = true;

        return [
            'user_id' => $userId,
            'entity_id' => $entity->id,
            'entity_type' => $entityType
        ];
    }
}
