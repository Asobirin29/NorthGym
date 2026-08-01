<?php

namespace Database\Seeders;

use App\Models\MembershipPackage;
use Illuminate\Database\Seeder;

class MembershipPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'name' => '1 Bulan',
                'duration_months' => 1,
                'price' => 300000,
                'discount_percentage' => 0,
                'description' => 'Paket membership bulanan - Cocok untuk pemula yang ingin mencoba',
                'is_active' => true,
            ],
            [
                'name' => '3 Bulan',
                'duration_months' => 3,
                'price' => 800000,
                'discount_percentage' => 11.11,
                'description' => 'Paket membership 3 bulan - Hemat 11% dibanding bulanan (Rp 900.000)',
                'is_active' => true,
            ],
            [
                'name' => '6 Bulan',
                'duration_months' => 6,
                'price' => 1500000,
                'discount_percentage' => 16.67,
                'description' => 'Paket membership 6 bulan - Hemat 17% dibanding bulanan (Rp 1.800.000)',
                'is_active' => true,
            ],
            [
                'name' => '12 Bulan',
                'duration_months' => 12,
                'price' => 2800000,
                'discount_percentage' => 22.22,
                'description' => 'Paket membership tahunan - Hemat 22% dibanding bulanan (Rp 3.600.000)',
                'is_active' => true,
            ],
        ];

        foreach ($packages as $package) {
            MembershipPackage::create($package);
        }

        $this->command->info('✅ Created 4 membership packages successfully!');
    }
}
