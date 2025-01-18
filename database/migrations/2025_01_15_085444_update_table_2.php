<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add foreign keys for comments table
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('article_id')->references('id')->on('articles');
        });

        // Add foreign keys for likes table
        Schema::table('likes', function (Blueprint $table) {
            $table->foreign('entity_type_id')->references('id')->on('entity_types');
        });

        // Add foreign keys for likes_quantity table
        Schema::table('likes_quantity', function (Blueprint $table) {
            $table->foreign('entity_type_id')->references('id')->on('entity_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
//        Schema::table('comments', function (Blueprint $table) {
//            $table->dropForeign()
//        });
    }
};
