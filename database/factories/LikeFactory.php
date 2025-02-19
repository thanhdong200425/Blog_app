<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        static $userIds = null;
        static $commentIds = null;
        static $articleIds = null;

        if ($userIds === null)
            $userIds = User::pluck('id')->all();
        if ($commentIds === null)
            $commentIds = Comment::pluck('id')->all();
        if ($articleIds === null)
            $articleIds = Article::pluck('id')->all();

        do {
            $userId = $this->faker->randomElement($userIds);
            $entityType = $this->faker->randomElement([Article::class, Comment::class]);
            $entityId = ($entityType === Article::class)
                ? $this->faker->randomElement($articleIds)
                : $this->faker->randomElement($commentIds);

            $key = $userId."_".$entityId."_".$entityType;
        } while (isset($generatedKeys[$key]));

        $generatedKeys[$key] = true;

        return [
            'user_id' => $userId,
            'entity_id' => $entityId,
            'entity_type' => $entityType,
        ];
    }
}
