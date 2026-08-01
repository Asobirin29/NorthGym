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
        // Add indexes to users table for membership queries
        Schema::table('users', function (Blueprint $table) {
            $table->index('role');
            $table->index('status_aktif');
            $table->index('membership_end_date');
            // Composite index for active members query
            $table->index(['role', 'status_aktif', 'membership_end_date'], 'users_active_members_idx');
        });

        // Add indexes to transactions table for status and date filtering
        Schema::table('transactions', function (Blueprint $table) {
            // Composite index for status + date queries
            $table->index(['status', 'tanggal_transaksi'], 'transactions_status_date_idx');
        });

        // Add composite index to member_progress for user progress lookups
        Schema::table('member_progress', function (Blueprint $table) {
            $table->index(['user_id', 'tanggal'], 'progress_user_date_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
            $table->dropIndex(['status_aktif']);
            $table->dropIndex(['membership_end_date']);
            $table->dropIndex('users_active_members_idx');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropIndex('transactions_status_date_idx');
        });

        Schema::table('member_progress', function (Blueprint $table) {
            $table->dropIndex('progress_user_date_idx');
        });
    }
};
