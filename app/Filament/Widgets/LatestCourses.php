<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestCourses extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Course::latest()->limit(5)
            )
            ->columns([
                ImageColumn::make('thumbnail_image')
                    ->square(),
                TextColumn::make('title')
                    ->weight('bold'),
                TextColumn::make('instructor.name')
                    ->label('Instructor'),
                TextColumn::make('price')
                    ->money('USD'),
                TextColumn::make('created_at')
                    ->dateTime(),
            ]);
    }
}
