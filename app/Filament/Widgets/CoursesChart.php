<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use Filament\Widgets\ChartWidget;

class CoursesChart extends ChartWidget
{
    public function getHeading(): string
    {
        return 'Courses Created';
    }

    protected function getData(): array
    {
        // Simple mock for now if Trend is not installed, but let's try real data if possible
        // For a portfolio, I'll use a manual aggregation if Trend isn't available
        $data = Course::selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->limit(30)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'New Courses',
                    'data' => $data->pluck('count')->toArray(),
                    'fill' => 'start',
                ],
            ],
            'labels' => $data->pluck('date')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
