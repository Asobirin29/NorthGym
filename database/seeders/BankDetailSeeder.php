<?php

namespace Database\Seeders;

use App\Models\BankDetail;
use Illuminate\Database\Seeder;

class BankDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BankDetail::create([
            'bank_name' => 'BCA',
            'account_number' => '1234567890',
            'account_name' => 'North Gym',
            'is_active' => true,
        ]);
        
        BankDetail::create([
            'bank_name' => 'Mandiri',
            'account_number' => '0987654321',
            'account_name' => 'North Gym',
            'is_active' => true,
        ]);
    }
}
