<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_title_car_category', function (Blueprint $table) {
            $table->id();

            $table->foreignId('job_title_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('car_category_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->unique(['job_title_id', 'car_category_id']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_title_car_category');
    }
};
