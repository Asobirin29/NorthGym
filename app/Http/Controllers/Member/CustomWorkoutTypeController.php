<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\CustomWorkoutType;
use App\Models\WorkoutType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomWorkoutTypeController extends Controller
{
    /**
     * Get all workout types (default + custom) for dropdown
     */
    public function index()
    {
        $defaultTypes = WorkoutType::active()
            ->orderBy('category')
            ->orderBy('name')
            ->get()
            ->map(function ($type) {
                return [
                    'id' => $type->id,
                    'name' => $type->name,
                    'category' => $type->category,
                    'icon' => $type->category_icon,
                    'is_custom' => false,
                ];
            });

        $customTypes = Auth::user()->customWorkoutTypes()
            ->orderBy('name')
            ->get()
            ->map(function ($type) {
                return [
                    'id' => $type->id,
                    'name' => $type->name,
                    'category' => $type->category,
                    'icon' => $type->category_icon,
                    'is_custom' => true,
                ];
            });

        return response()->json([
            'default' => $defaultTypes,
            'custom' => $customTypes,
        ]);
    }

    /**
     * Store new custom workout type
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|in:cardio,strength,flexibility,other',
        ]);

        $workoutType = CustomWorkoutType::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'category' => $request->category,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tipe latihan berhasil ditambahkan!',
            'workout_type' => [
                'id' => $workoutType->id,
                'name' => $workoutType->name,
                'category' => $workoutType->category,
                'icon' => $workoutType->category_icon,
                'is_custom' => true,
            ],
        ]);
    }
}
