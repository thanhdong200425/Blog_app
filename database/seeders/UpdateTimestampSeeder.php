<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateTimestampSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::chunk(100, function ($models) {
            foreach ($models as $model) {
                $model->created_at = now();
                $model->updated_at = now();
                $model->save();
            }
        });
        Comment::chunk(100, function ($models) {
            foreach ($models as $model) {
                $model->created_at = now();
                $model->updated_at = now();
                $model->save();
            }
        });
    }
}
