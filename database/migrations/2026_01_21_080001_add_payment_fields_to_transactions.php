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
        Schema::table('transactions', function (Blueprint $table) {
            $table->enum('payment_method', ['transfer', 'cash', 'qris'])
                ->default('transfer')
                ->after('status');
            
            $table->foreignId('membership_package_id')
                ->nullable()
                ->after('user_id')
                ->constrained('membership_packages')
                ->nullOnDelete();

            $table->index('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['membership_package_id']);
            $table->dropIndex(['payment_method']);
            $table->dropColumn(['payment_method', 'membership_package_id']);
        });
    }
};
