<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workout_plans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('media_path')->nullable();
            $table->string('media_url')->nullable();
            $table->enum('kategori', ['cardio', 'strength', 'flexibility', 'hiit', 'endurance']);
            $table->enum('level', ['beginner', 'intermediate', 'advanced']);
            $table->integer('durasi_menit')->nullable();
            $table->integer('kalori_estimasi')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('kategori');
            $table->index('level');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_plans');
    }
};
