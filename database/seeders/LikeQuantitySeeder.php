<?php

namespace Database\Seeders;


use App\Models\LikeQuantity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeQuantitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LikeQuantity::factory()->count(1000)->create();
    }
}
