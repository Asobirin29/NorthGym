<?php

namespace App\Filament\Widgets\Charts;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class MonthlyRevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Pendapatan Bulanan (12 Bulan Terakhir)';

    protected static ?int $sort = 4;

    protected static ?string $pollingInterval = '180s';

    protected static bool $isLazy = true;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        return Cache::remember('chart.monthly_revenue', 3600, function () {
            $revenues = Transaction::where('status', 'approved')
                ->where('tanggal_transaksi', '>=', now()->subMonths(12))
                ->select(
                    DB::raw("DATE_FORMAT(tanggal_transaksi, '%Y-%m') as month"),
                    DB::raw('SUM(nominal) as total')
                )
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('total', 'month')
                ->toArray();

            return $this->formatChartData($revenues);
        });
    }

    private function formatChartData(array $revenues): array
    {
        $labels = [];
        $data = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthKey = $date->format('Y-m');
            $labels[] = $date->format('M Y');
            $data[] = (float) ($revenues[$monthKey] ?? 0);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan (Rp)',
                    'data' => $data,
                    'backgroundColor' => 'rgba(251, 191, 36, 0.2)',
                    'borderColor' => 'rgb(251, 191, 36)',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'callback' => 'function(value) { return "Rp " + value.toLocaleString("id-ID"); }',
                    ],
                ],
            ],
        ];
    }
}
