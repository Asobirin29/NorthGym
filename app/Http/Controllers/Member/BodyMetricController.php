<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\BodyMetric;
use App\Services\BodyMetricsCalculator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BodyMetricController extends Controller
{
    /**
     * Display body metrics history
     */
    public function index()
    {
        $metrics = Auth::user()->bodyMetrics()
            ->latest('recorded_at')
            ->paginate(15);

        return view('member.body-metrics.index', compact('metrics'));
    }

    /**
     * Show form to input new body metrics
     */
    public function create()
    {
        $latestMetric = Auth::user()->bodyMetrics()
            ->latest('recorded_at')
            ->first();

        return view('member.body-metrics.create', compact('latestMetric'));
    }

    /**
     * Store new body metrics
     */
    public function store(Request $request)
    {
        $request->validate([
            'weight' => 'required|numeric|min:20|max:500',
            'height' => 'required|numeric|min:50|max:300',
            'body_fat_percentage' => 'nullable|numeric|min:0|max:100',
            'muscle_mass_percentage' => 'nullable|numeric|min:0|max:100',
            'water_percentage' => 'nullable|numeric|min:0|max:100',
            'recorded_at' => 'required|date',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Check if record already exists for this date
        $existing = BodyMetric::where('user_id', Auth::id())
            ->where('recorded_at', $request->recorded_at)
            ->first();

        if ($existing) {
            $existing->update($request->only([
                'weight',
                'height',
                'body_fat_percentage',
                'muscle_mass_percentage',
                'water_percentage',
                'notes',
            ]));
            $message = 'Body metrics berhasil diperbarui!';
        } else {
            BodyMetric::create([
                'user_id' => Auth::id(),
                'weight' => $request->weight,
                'height' => $request->height,
                'body_fat_percentage' => $request->body_fat_percentage,
                'muscle_mass_percentage' => $request->muscle_mass_percentage,
                'water_percentage' => $request->water_percentage,
                'recorded_at' => $request->recorded_at,
                'notes' => $request->notes,
            ]);
            $message = 'Body metrics berhasil disimpan!';
        }

        return redirect()->route('member.body-metrics.index')
            ->with('success', $message);
    }

    /**
     * Get chart data for metrics visualization (JSON endpoint)
     */
    public function getChartData(Request $request)
    {
        $period = $request->get('period', '30'); // default 30 days
        
        $metrics = Auth::user()->bodyMetrics()
            ->where('recorded_at', '>=', now()->subDays($period))
            ->orderBy('recorded_at', 'asc')
            ->get();

        $data = [
            'labels' => $metrics->pluck('recorded_at')->map(fn($date) => $date->format('d M')),
            'datasets' => [
                [
                    'label' => 'Weight (kg)',
                    'data' => $metrics->pluck('weight'),
                    'borderColor' => 'rgb(75, 192, 192)',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                ],
                [
                    'label' => 'BMI',
                    'data' => $metrics->map(fn($m) => $m->bmi),
                    'borderColor' => 'rgb(153, 102, 255)',
                    'backgroundColor' => 'rgba(153, 102, 255, 0.2)',
                ],
                [
                    'label' => 'Body Fat %',
                    'data' => $metrics->pluck('body_fat_percentage'),
                    'borderColor' => 'rgb(255, 159, 64)',
                    'backgroundColor' => 'rgba(255, 159, 64, 0.2)',
                ],
                [
                    'label' => 'Muscle Mass %',
                    'data' => $metrics->pluck('muscle_mass_percentage'),
                    'borderColor' => 'rgb(255, 99, 132)',
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                ],
            ],
        ];

        return response()->json($data);
    }
}
