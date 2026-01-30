<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\CoursesChart;
use App\Filament\Widgets\LatestCourses;
use BackedEnum;
use UnitEnum;

class Analytics extends Page
{
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-chart-bar';

    protected static string | UnitEnum | null $navigationGroup = '⚙️ System';

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
