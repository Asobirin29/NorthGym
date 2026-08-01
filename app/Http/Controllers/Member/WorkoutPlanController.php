<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\WorkoutPlan;
use Illuminate\Http\Request;

class WorkoutPlanController extends Controller
{
    /**
     * Display list of workout plans
     */
    public function index(Request $request)
    {
        $query = WorkoutPlan::active();

        if ($request->filled('kategori')) {
            $query->byKategori($request->kategori);
        }

        if ($request->filled('level')) {
            $query->byLevel($request->level);
        }

        $workoutPlans = $query->latest()->paginate(12);

        $categories = ['cardio', 'strength', 'flexibility', 'hiit', 'endurance'];
        $levels = ['beginner', 'intermediate', 'advanced'];

        return view('member.workout-plans.index', compact('workoutPlans', 'categories', 'levels'));
    }

    /**
     * Display single workout plan
     */
    public function show(WorkoutPlan $workoutPlan)
    {
        if (!$workoutPlan->is_active) {
            abort(404);
        }

        $relatedPlans = WorkoutPlan::active()
            ->where('id', '!=', $workoutPlan->id)
            ->where('kategori', $workoutPlan->kategori)
            ->limit(4)
            ->get();

        return view('member.workout-plans.show', compact('workoutPlan', 'relatedPlans'));
    }
}
