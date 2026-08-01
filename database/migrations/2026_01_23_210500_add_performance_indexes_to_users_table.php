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
            // Index for filtering active/inactive members efficiently
            $table->index(['role', 'status_aktif', 'membership_end_date'], 'users_membership_status_index');
            
            // Index for sorting by creation date (Latest Members)
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('users_membership_status_index');
            $table->dropIndex(['created_at']);
        });
    }
};
