<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $userIds = null, $articleIds = null;

        if ($userIds === null)
            $userIds = User::pluck('id')->all();
        if ($articleIds === null)
            $articleIds = Article::pluck('id')->all();

        return [
            'user_id' => $this->faker->randomElement($userIds),
            'article_id' => $this->faker->randomElement($articleIds),
            'content' => fake()->paragraph(1),
        ];
    }
}
