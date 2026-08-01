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
            $table->decimal('body_fat_percentage', 5, 2)->nullable()->after('lingkar_lengan');
            $table->decimal('muscle_mass_percentage', 5, 2)->nullable()->after('body_fat_percentage');
            $table->decimal('water_percentage', 5, 2)->nullable()->after('muscle_mass_percentage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('member_progress', function (Blueprint $table) {
            $table->dropColumn(['body_fat_percentage', 'muscle_mass_percentage', 'water_percentage']);
        });
    }
};
