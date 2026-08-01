<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkoutType;

class WorkoutTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workoutTypes = [
            // Cardio
            ['name' => 'Running', 'category' => 'cardio'],
            ['name' => 'Cycling', 'category' => 'cardio'],
            ['name' => 'Swimming', 'category' => 'cardio'],
            ['name' => 'HIIT', 'category' => 'cardio'],
            ['name' => 'Jump Rope', 'category' => 'cardio'],
            ['name' => 'Treadmill', 'category' => 'cardio'],
            ['name' => 'Elliptical', 'category' => 'cardio'],
            
            // Strength
            ['name' => 'Weightlifting', 'category' => 'strength'],
            ['name' => 'Bodyweight Training', 'category' => 'strength'],
            ['name' => 'CrossFit', 'category' => 'strength'],
            ['name' => 'Powerlifting', 'category' => 'strength'],
            ['name' => 'Resistance Training', 'category' => 'strength'],
            ['name' => 'Bench Press', 'category' => 'strength'],
            ['name' => 'Squat', 'category' => 'strength'],
            ['name' => 'Deadlift', 'category' => 'strength'],
            
            // Flexibility
            ['name' => 'Yoga', 'category' => 'flexibility'],
            ['name' => 'Pilates', 'category' => 'flexibility'],
            ['name' => 'Stretching', 'category' => 'flexibility'],
            ['name' => 'Mobility Work', 'category' => 'flexibility'],
            
            // Other
            ['name' => 'Mixed Training', 'category' => 'other'],
            ['name' => 'Sports', 'category' => 'other'],
            ['name' => 'Functional Training', 'category' => 'other'],
        ];

        foreach ($workoutTypes as $type) {
            WorkoutType::create([
                'name' => $type['name'],
                'category' => $type['category'],
                'is_active' => true,
            ]);
        }
    }
}
