<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('body');
            $table->timestamps();
        });

        DB::statement('CREATE FULLTEXT INDEX posts_title_body_fulltext ON posts(title, body) WITH PARSER ngram');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function($table) {
            $table->dropFullText(['title', 'body']);
        });

        Schema::dropIfExists('posts');    }
};
