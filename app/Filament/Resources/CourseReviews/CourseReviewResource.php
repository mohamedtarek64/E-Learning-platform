<?php

namespace App\Filament\Resources\CourseReviews;

use App\Filament\Resources\CourseReviews\Pages\ManageCourseReviews;
use App\Models\CourseReview;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;

class CourseReviewResource extends Resource
{
    protected static ?string $model = CourseReview::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Review Details')->schema([
                    Select::make('student_id')
                        ->relationship('student', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    Select::make('course_id')
                        ->relationship('course', 'title')
                        ->searchable()
                        ->preload()
                        ->required(),
                    TextInput::make('rating')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(5)
                        ->step(0.5)
                        ->required(),
                    Toggle::make('is_public')
                        ->label('Publicly Visible')
                        ->default(true),
                ])->columns(2),

                Section::make('Content')->schema([
                    Textarea::make('review_text')
                        ->rows(3)
                        ->columnSpanFull(),
                    Textarea::make('instructor_response')
                        ->rows(3)
                        ->columnSpanFull(),
                    DateTimePicker::make('responded_at'),
                    TextInput::make('helpful_count')
                        ->numeric()
                        ->default(0)
                        ->disabled(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.name')
                    ->label('Student')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('course.title')
                    ->label('Course')
                    ->searchable()
                    ->limit(30)
                    ->sortable(),
                TextColumn::make('rating')
                    ->formatStateUsing(fn ($state) => str_repeat('⭐', (int)$state))
                    ->sortable(),
                ToggleColumn::make('is_public')
                    ->label('Visible'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('rating')
                    ->options([
                        '5' => '5 Stars',
                        '4' => '4 Stars',
                        '3' => '3 Stars',
                        '2' => '2 Stars',
                        '1' => '1 Star',
                    ]),
                SelectFilter::make('is_public')
                    ->label('Visibility')
                    ->options([
                        '1' => 'Public',
                        '0' => 'Hidden',
                    ])
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageCourseReviews::route('/'),
        ];
    }
}
