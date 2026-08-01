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
        Schema::create('member_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('tanggal');
            $table->decimal('berat_badan', 5, 2)->nullable();
            $table->decimal('tinggi_badan', 5, 2)->nullable();
            $table->decimal('lingkar_perut', 5, 2)->nullable();
            $table->decimal('lingkar_dada', 5, 2)->nullable();
            $table->decimal('lingkar_lengan', 5, 2)->nullable();
            $table->string('foto_before_path')->nullable();
            $table->string('foto_after_path')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'tanggal']);
            $table->index(['user_id', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_progress');
    }
};
