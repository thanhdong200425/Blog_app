<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDateTime = now()->format("Y-m-d H:i:s");
        DB::table('entity_types')->insert([
            ['name' => 'comment', 'created_at' => $currentDateTime],
            ['name' => 'article', 'created_at' => $currentDateTime]
        ]);
    }
}
