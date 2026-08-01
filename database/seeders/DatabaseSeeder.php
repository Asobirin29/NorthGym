<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WorkoutPlan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin North Gym',
            'email' => 'admin@northgym.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'status_aktif' => true,
        ]);

        // Create Demo Member
        User::create([
            'name' => 'John Doe',
            'email' => 'member@northgym.com',
            'password' => bcrypt('password'),
            'role' => 'member',
            'phone' => '08123456789',
            'membership_start_date' => now(),
            'membership_end_date' => now()->addMonth(),
            'status_aktif' => true,
        ]);

        // Create Sample Workout Plans
        $workoutPlans = [
            [
                'judul' => 'Full Body HIIT Workout',
                'deskripsi' => "Program latihan HIIT intensitas tinggi untuk membakar kalori maksimal.\n\n🔥 Manfaat:\n- Meningkatkan metabolisme\n- Membakar lemak efektif\n- Meningkatkan kardiovaskular\n\n📋 Langkah-langkah:\n1. Warm up 5 menit\n2. 30 detik jumping jacks\n3. 30 detik burpees\n4. 30 detik mountain climbers\n5. 30 detik rest\n6. Ulangi 4-5 set\n7. Cool down 5 menit",
                'kategori' => 'hiit',
                'level' => 'intermediate',
                'durasi_menit' => 30,
                'kalori_estimasi' => 400,
                'media_url' => 'https://www.youtube.com/watch?v=ml6cT4AZdqI',
                'is_active' => true,
            ],
            [
                'judul' => 'Beginner Strength Training',
                'deskripsi' => "Program latihan kekuatan dasar untuk pemula.\n\n💪 Target Otot:\n- Dada\n- Punggung\n- Kaki\n- Lengan\n\n📋 Latihan:\n1. Push-ups 3x10\n2. Bodyweight Squats 3x15\n3. Lunges 3x10 each leg\n4. Plank hold 3x30 detik\n5. Dumbbell rows 3x12",
                'kategori' => 'strength',
                'level' => 'beginner',
                'durasi_menit' => 45,
                'kalori_estimasi' => 300,
                'is_active' => true,
            ],
            [
                'judul' => 'Morning Cardio Routine',
                'deskripsi' => "Latihan kardio pagi hari untuk memulai hari dengan energi!\n\n☀️ Cocok untuk:\n- Pagi hari sebelum aktivitas\n- Meningkatkan mood\n- Boost energi sepanjang hari\n\n📋 Routine:\n1. Light jog in place 3 menit\n2. High knees 1 menit\n3. Butt kicks 1 menit\n4. Jumping jacks 2 menit\n5. Skipping 2 menit\n6. Cool down stretching",
                'kategori' => 'cardio',
                'level' => 'beginner',
                'durasi_menit' => 20,
                'kalori_estimasi' => 200,
                'is_active' => true,
            ],
            [
                'judul' => 'Advanced Strength Program',
                'deskripsi' => "Program kekuatan lanjutan dengan beban berat.\n\n⚠️ Perhatian: Program ini membutuhkan pengalaman sebelumnya!\n\n📋 Split Routine:\nHari 1 - Dada & Trisep\nHari 2 - Punggung & Bisep\nHari 3 - Kaki\nHari 4 - Bahu & Core\n\n💪 Rep Range:\n- Compound: 4x6-8\n- Isolation: 3x10-12",
                'kategori' => 'strength',
                'level' => 'advanced',
                'durasi_menit' => 60,
                'kalori_estimasi' => 500,
                'is_active' => true,
            ],
            [
                'judul' => 'Yoga Flexibility Flow',
                'deskripsi' => "Latihan yoga untuk meningkatkan fleksibilitas dan keseimbangan.\n\n🧘 Manfaat:\n- Meningkatkan fleksibilitas\n- Mengurangi stress\n- Memperbaiki postur\n- Meningkatkan keseimbangan\n\n📋 Poses:\n1. Child's pose\n2. Downward dog\n3. Warrior I & II\n4. Triangle pose\n5. Tree pose\n6. Savasana",
                'kategori' => 'flexibility',
                'level' => 'beginner',
                'durasi_menit' => 40,
                'kalori_estimasi' => 150,
                'is_active' => true,
            ],
            [
                'judul' => 'Endurance Running Program',
                'deskripsi' => "Program lari untuk meningkatkan daya tahan kardiovaskular.\n\n🏃 Minggu 1-4:\n- Lari 20 menit, jalan 5 menit, ulang\n\n🏃 Minggu 5-8:\n- Lari 30 menit kontinyu\n- Interval training 1x/minggu\n\n📈 Target:\n- Meningkatkan VO2 Max\n- Endurance jarak jauh\n- Fat burning zone",
                'kategori' => 'endurance',
                'level' => 'intermediate',
                'durasi_menit' => 45,
                'kalori_estimasi' => 450,
                'is_active' => true,
            ],
        ];

        foreach ($workoutPlans as $plan) {
            WorkoutPlan::create($plan);
        }
    }
}
