<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Only add indexes if they don't exist
            if (!$this->indexExists('transactions', 'transactions_created_at_index')) {
                $table->index('created_at');
            }
            if (!$this->indexExists('transactions', 'transactions_membership_package_id_status_index')) {
                $table->index(['membership_package_id', 'status']);
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (!$this->indexExists('users', 'users_membership_end_date_index')) {
                $table->index('membership_end_date');
            }
        });
    }

    private function indexExists($table, $index): bool
    {
        return collect(DB::select("SHOW INDEX FROM {$table}"))->pluck('Key_name')->contains($index);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropIndex(['payment_method']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['membership_package_id', 'status']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['membership_end_date']);
        });
    }
};
