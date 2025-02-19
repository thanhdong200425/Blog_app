<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ArticleSeeder::class,
            CommentSeeder::class,
            LikeSeeder::class,
            ArticleQuantityUpdaterSeeder::class,
        ]);
    }
}
