<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->integer('duration_in_seconds');

            $table->foreignId('album_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('author_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('genre_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
