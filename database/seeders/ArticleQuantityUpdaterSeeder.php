<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleQuantityUpdaterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $likeCounts = DB::table('likes')
            ->where('entity_type', 'like', '%Article')
            ->groupBy('entity_id')
            ->select('entity_id', DB::raw('count(*) as count'))
            ->pluck('count', 'entity_id')
            ->all();
        $commentCounts = DB::table('comments')
            ->groupBy('article_id')
            ->select('article_id', DB::raw('count(*) as count'))
            ->pluck('count', 'article_id')
            ->all();

        // "use" is used to tell PHP that inside the anonymous function, $likeCounts and $commentCounts will be used. If you do not tell PHP, all the variables can't access that are defined outside anonymous function
        Article::chunkById(100, function ($articles) use ($likeCounts, $commentCounts) {
            foreach ($articles as $article) {
                $article->like_quantity = $likeCounts[$article->id] ?? 0;
                $article->comment_quantity = $commentCounts[$article->id] ?? 0;
                $article->save();
            }
        });
    }
}
