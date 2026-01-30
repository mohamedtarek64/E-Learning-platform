<?php

namespace App\Filament\Resources\Courses\Schemas;

use App\Models\Course;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CourseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('instructor_id')
                    ->numeric(),
                TextEntry::make('category_id')
                    ->numeric(),
                TextEntry::make('title'),
                TextEntry::make('slug'),
                TextEntry::make('subtitle')
                    ->placeholder('-'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('target_audience')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('level')
                    ->badge(),
                TextEntry::make('language'),
                ImageEntry::make('thumbnail_image')
                    ->placeholder('-'),
                TextEntry::make('promo_video_url')
                    ->placeholder('-'),
                TextEntry::make('price')
                    ->money(),
                TextEntry::make('discounted_price')
                    ->money()
                    ->placeholder('-'),
                TextEntry::make('discount_expires_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('currency'),
                IconEntry::make('is_published')
                    ->boolean(),
                TextEntry::make('published_at')
                    ->dateTime()
                    ->placeholder('-'),
                IconEntry::make('is_featured')
                    ->boolean(),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('total_duration_minutes')
                    ->numeric(),
                TextEntry::make('total_lectures_count')
                    ->numeric(),
                TextEntry::make('total_quizzes_count')
                    ->numeric(),
                TextEntry::make('total_students')
                    ->numeric(),
                TextEntry::make('average_rating')
                    ->numeric(),
                TextEntry::make('total_reviews_count')
                    ->numeric(),
                TextEntry::make('last_updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Course $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
