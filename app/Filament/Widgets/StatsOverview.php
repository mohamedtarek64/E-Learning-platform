<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use App\Models\User;
use App\Models\CourseEnrollment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Students', User::where('role', 'student')->count())
                ->description('All registered students')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Total Courses', Course::count())
                ->description('Published and drafts')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('info'),
            Stat::make('Total Enrollments', CourseEnrollment::count())
                ->description('Course purchases/signups')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('warning'),
        ];
    }
}
