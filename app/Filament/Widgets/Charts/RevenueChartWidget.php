<?php

namespace App\Filament\Widgets\Charts;

use App\Services\MembershipService;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;

class RevenueChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Trend Pendapatan Bulanan';
    
    protected static ?string $pollingInterval = null;
    
    protected static ?int $sort = 1;
    
    protected int|string|array $columnSpan = 'full';

    public ?string $filter = '2026';

    protected function getFilters(): ?array
    {
        return [
            '2025' => '2025',
            '2026' => '2026',
            '2027' => '2027',
        ];
    }

    protected function getData(): array
    {
        $year = (int) $this->filter;
        
        $data = Cache::remember("chart.monthly_revenue.{$year}", 60, function () use ($year) {
            $service = new MembershipService();
            return $service->getMonthlyRevenueTrend($year);
        });

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan (Rp)',
                    'data' => $data,
                    'fill' => true,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agust', 'Sep', 'Okt', 'Nov', 'Des'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
