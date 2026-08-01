<?php

namespace App\Filament\Widgets\Charts;

use App\Services\MembershipService;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;

class RevenueByPackageWidget extends ChartWidget
{
    protected static ?string $heading = 'Pendapatan per Paket Keanggotaan';
    
    protected static ?int $sort = 2;
    
    protected static ?string $pollingInterval = '180s';

    protected static bool $isLazy = true;

    protected function getData(): array
    {
        $stats = Cache::remember('stats.revenue_by_package', 600, function () {
            $service = new MembershipService();
            return $service->getRevenueByPackage();
        });

        $labels = array_column($stats, 'name');
        $values = array_column($stats, 'value');

        return [
            'datasets' => [
                [
                    'label' => 'Total Pendapatan',
                    'data' => $values,
                    'backgroundColor' => [
                        '#3b82f6', // blue-500
                        '#10b981', // emerald-500
                        '#f59e0b', // amber-500
                        '#ef4444', // red-500
                        '#8b5cf6', // violet-500
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
