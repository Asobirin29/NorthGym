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
        Schema::table('member_progress', function (Blueprint $table) {
            $table->foreignId('workout_type_id')->nullable()->after('catatan')->constrained('workout_types')->nullOnDelete();
            $table->foreignId('custom_workout_type_id')->nullable()->after('workout_type_id')->constrained('custom_workout_types')->nullOnDelete();
            $table->softDeletes(); // Enable soft delete for audit trail
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('member_progress', function (Blueprint $table) {
            $table->dropForeign(['workout_type_id']);
            $table->dropForeign(['custom_workout_type_id']);
            $table->dropColumn(['workout_type_id', 'custom_workout_type_id', 'deleted_at']);
        });
    }
};
