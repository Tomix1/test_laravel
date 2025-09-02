<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('car_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->datetime('started_at');
            $table->datetime('finished_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
