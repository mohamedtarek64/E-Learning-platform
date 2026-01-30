<?php

namespace App\Filament\Resources\CourseEnrollments;

use App\Filament\Resources\CourseEnrollments\Pages\ManageCourseEnrollments;
use App\Models\CourseEnrollment;
use BackedEnum;
use UnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ProgressBarColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CourseEnrollmentResource extends Resource
{
    protected static ?string $model = CourseEnrollment::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-credit-card';

    protected static string | UnitEnum | null $navigationGroup = '🎓 Student Management';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Enrollment Details')->schema([
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
                    Select::make('enrollment_type')
                        ->options(['free' => 'Free', 'paid' => 'Paid'])
                        ->default('free')
                        ->required(),
                    DateTimePicker::make('enrolled_at')
                        ->default(now())
                        ->required(),
                ])->columns(2),

                Section::make('Progress & Status')->schema([
                    TextInput::make('progress_percentage')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100)
                        ->default(0)
                        ->suffix('%'),
                    DateTimePicker::make('completed_at'),
                    DateTimePicker::make('certificate_issued_at'),
                ])->columns(3),
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
                TextColumn::make('enrollment_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'free' => 'gray',
                        default => 'info',
                    }),
                ProgressBarColumn::make('progress_percentage')
                    ->label('Progress')
                    ->color('info'),
                TextColumn::make('enrolled_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('enrollment_type')
                    ->options([
                        'free' => 'Free',
                        'paid' => 'Paid',
                    ]),
                SelectFilter::make('course_id')
                    ->relationship('course', 'title')
                    ->label('Course')
                    ->searchable()
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
            'index' => ManageCourseEnrollments::route('/'),
        ];
    }
}
