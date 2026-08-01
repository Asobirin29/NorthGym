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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'member'])->default('member')->after('password');
            $table->date('membership_start_date')->nullable()->after('role');
            $table->date('membership_end_date')->nullable()->after('membership_start_date');
            $table->boolean('status_aktif')->default(false)->after('membership_end_date');
            $table->string('phone', 20)->nullable()->after('status_aktif');
            $table->text('address')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'membership_start_date', 'membership_end_date', 'status_aktif', 'phone', 'address']);
        });
    }
};
