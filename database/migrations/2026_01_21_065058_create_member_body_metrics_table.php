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
        Schema::create('member_body_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('weight', 5, 2); // Berat badan (kg)
            $table->decimal('height', 5, 2); // Tinggi badan (cm)
            $table->decimal('body_fat_percentage', 5, 2)->nullable(); // Persentase lemak tubuh
            $table->decimal('muscle_mass_percentage', 5, 2)->nullable(); // Persentase massa otot
            $table->decimal('water_percentage', 5, 2)->nullable(); // Persentase kadar air
            $table->date('recorded_at'); // Tanggal pencatatan
            $table->text('notes')->nullable(); // Catatan tambahan
            $table->timestamps();
            
            $table->unique(['user_id', 'recorded_at']);
            $table->index(['user_id', 'recorded_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_body_metrics');
    }
};
