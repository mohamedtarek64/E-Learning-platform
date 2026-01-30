<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\CoursesChart;
use App\Filament\Widgets\LatestCourses;

class Analytics extends Page
{
    protected static $navigationIcon = 'heroicon-o-chart-bar';

    public static function getNavigationGroup(): ?string
    {
        return '⚙️ System';
    }

    protected string $view = 'filament.pages.analytics';

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            CoursesChart::class,
            LatestCourses::class,
        ];
    }
}
