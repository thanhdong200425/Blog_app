<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $userIds = null;
        if ($userIds === null)
            $userIds = User::pluck('id')->all();
        $title = fake()->sentence();
        $shortText = fake()->sentence(1);
        $content = "<p>{$shortText}</p><h2>".fake()->word()."</h2><p>".fake()->text(100)."</p>";
        return [
            'user_id' => $this->faker->randomElement($userIds),
            'title' => $title,
            'content' => $content,
            "slug" => Str::slug($title),
        ];
    }
}
