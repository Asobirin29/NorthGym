<?php

namespace App\Services;

class BodyMetricsCalculator
{
    /**
     * Calculate ideal weight using Devine formula.
     * 
     * @param float $height Height in centimeters
     * @param string $gender 'male' or 'female'
     * @return float Ideal weight in kilograms
     */
    public static function calculateIdealWeight(float $height, string $gender): float
    {
        // Convert height to inches
        $heightInInches = $height / 2.54;
        
        // Devine Formula
        if ($gender === 'male') {
            // Men: IBW (kg) = 50 + 2.3 × (height in inches - 60)
            $idealWeight = 50 + 2.3 * ($heightInInches - 60);
        } else {
            // Women: IBW (kg) = 45.5 + 2.3 × (height in inches - 60)
            $idealWeight = 45.5 + 2.3 * ($heightInInches - 60);
        }
        
        return round(max($idealWeight, 40), 2); // Minimum 40kg
    }

    /**
     * Calculate BMI (Body Mass Index).
     * 
     * @param float $weight Weight in kilograms
     * @param float $height Height in centimeters
     * @return float BMI value
     */
    public static function calculateBMI(float $weight, float $height): float
    {
        $heightInMeters = $height / 100;
        $bmi = $weight / ($heightInMeters * $heightInMeters);
        
        return round($bmi, 2);
    }

    /**
     * Get BMI category.
     * 
     * @param float $bmi BMI value
     * @return string Category name
     */
    public static function getBMICategory(float $bmi): string
    {
        if ($bmi < 18.5) {
            return 'Underweight';
        } elseif ($bmi < 25) {
            return 'Normal';
        } elseif ($bmi < 30) {
            return 'Overweight';
        } else {
            return 'Obese';
        }
    }

    /**
     * Get BMI status color for UI.
     * 
     * @param float $bmi BMI value
     * @return string Color code
     */
    public static function getBMIColor(float $bmi): string
    {
        $category = self::getBMICategory($bmi);
        
        return match($category) {
            'Normal' => 'green',
            'Underweight', 'Overweight' => 'yellow',
            'Obese' => 'red',
            default => 'gray',
        };
    }

    /**
     * Get water percentage category.
     * 
     * @param float $percentage Water percentage
     * @param string $gender 'male' or 'female'
     * @param int $age Age in years
     * @return string Category name
     */
    public static function getWaterPercentageCategory(float $percentage, string $gender, int $age = 30): string
    {
        if ($gender === 'male') {
            if ($percentage < 50) return 'Low';
            if ($percentage <= 65) return 'Normal';
            return 'High';
        } else {
            if ($percentage < 45) return 'Low';
            if ($percentage <= 60) return 'Normal';
            return 'High';
        }
    }

    /**
     * Get muscle mass category.
     * 
     * @param float $percentage Muscle mass percentage
     * @param string $gender 'male' or 'female'
     * @return string Category name
     */
    public static function getMuscleMassCategory(float $percentage, string $gender): string
    {
        if ($gender === 'male') {
            if ($percentage < 33) return 'Below Average';
            if ($percentage < 40) return 'Average';
            if ($percentage < 45) return 'Above Average';
            return 'Athlete';
        } else {
            if ($percentage < 25) return 'Below Average';
            if ($percentage < 31) return 'Average';
            if ($percentage < 36) return 'Above Average';
            return 'Athlete';
        }
    }

    /**
     * Get body fat percentage category.
     * 
     * @param float $percentage Body fat percentage
     * @param string $gender 'male' or 'female'
     * @return string Category name
     */
    public static function getBodyFatCategory(float $percentage, string $gender): string
    {
        if ($gender === 'male') {
            if ($percentage < 6) return 'Essential Fat';
            if ($percentage < 14) return 'Athlete';
            if ($percentage < 18) return 'Fitness';
            if ($percentage < 25) return 'Average';
            return 'Obese';
        } else {
            if ($percentage < 14) return 'Essential Fat';
            if ($percentage < 21) return 'Athlete';
            if ($percentage < 25) return 'Fitness';
            if ($percentage < 32) return 'Average';
            return 'Obese';
        }
    }

    /**
     * Get health status color based on category.
     * 
     * @param string $category Category name
     * @return string Color code
     */
    public static function getCategoryColor(string $category): string
    {
        return match($category) {
            'Normal', 'Average', 'Fitness' => 'green',
            'Athlete', 'Above Average' => 'blue',
            'Low', 'Below Average', 'Underweight', 'Overweight' => 'yellow',
            'High', 'Obese', 'Essential Fat' => 'red',
            default => 'gray',
        };
    }
}
