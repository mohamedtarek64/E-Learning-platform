<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use Filament\Forms\Get;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Course Details')
                    ->tabs([
                        Tabs\Tab::make('Basic Info')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('title')
                                        ->required()
                                        ->maxLength(255)
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                    TextInput::make('slug')
                                        ->required()
                                        ->maxLength(255)
                                        ->unique('courses', 'slug', ignoreRecord: true),
                                ]),
                                TextInput::make('subtitle')
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                Select::make('instructor_id')
                                    ->relationship('instructor', 'name', fn ($query) => $query->where('role', 'instructor'))
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                                Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                                RichEditor::make('description')
                                    ->columnSpanFull(),
                            ]),
                        
                        Tabs\Tab::make('Course content')
                            ->icon('heroicon-o-book-open')
                            ->schema([
                                TagsInput::make('learning_objectives')
                                    ->placeholder('What will students learn?')
                                    ->columnSpanFull(),
                                TagsInput::make('requirements')
                                    ->placeholder('What are the requirements?')
                                    ->columnSpanFull(),
                                TagsInput::make('target_audience')
                                    ->placeholder('Who is this course for?')
                                    ->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Media & Pricing')
                            ->icon('heroicon-o-currency-dollar')
                            ->schema([
                                Grid::make(2)->schema([
                                    FileUpload::make('thumbnail_image')
                                        ->image()
                                        ->directory('courses/thumbnails')
                                        ->columnSpan(1),
                                    TextInput::make('promo_video_url')
                                        ->url()
                                        ->columnSpan(1),
                                ]),
                                Grid::make(3)->schema([
                                    TextInput::make('price')
                                        ->numeric()
                                        ->prefix('$')
                                        ->required(),
                                    TextInput::make('discounted_price')
                                        ->numeric()
                                        ->prefix('$'),
                                    TextInput::make('currency')
                                        ->default('USD')
                                        ->required(),
                                ]),
                            ]),

                        Tabs\Tab::make('Settings')
                            ->icon('heroicon-o-cog')
                            ->schema([
                                Grid::make(2)->schema([
                                    Select::make('level')
                                        ->options([
                                            'beginner' => 'Beginner',
                                            'intermediate' => 'Intermediate',
                                            'advanced' => 'Advanced',
                                            'all_levels' => 'All Levels',
                                        ])->required(),
                                    Select::make('language')
                                        ->options([
                                            'English' => 'English',
                                            'Arabic' => 'Arabic',
                                            'Spanish' => 'Spanish',
                                        ])->default('English')->required(),
                                ]),
                                Section::make('Status')->schema([
                                    Toggle::make('is_published')
                                        ->live()
                                        ->afterStateUpdated(fn (Set $set, $state) => $set('published_at', $state ? now() : null)),
                                    Toggle::make('is_featured'),
                                    Select::make('status')
                                        ->options([
                                            'draft' => 'Draft',
                                            'pending_review' => 'Pending Review',
                                            'published' => 'Published',
                                            'archived' => 'Archived',
                                        ])->default('draft')->required(),
                                ])->columns(3),
                            ]),

                        Tabs\Tab::make('Curriculum')
                            ->icon('heroicon-o-list-bullet')
                            ->schema([
                                Repeater::make('sections')
                                    ->relationship()
                                    ->schema([
                                        TextInput::make('title')
                                            ->required()
                                            ->maxLength(255),
                                        Textarea::make('description')
                                            ->rows(2),
                                        TextInput::make('sort_order')
                                            ->numeric()
                                            ->default(0),
                                        
                                        Section::make('Lessons')->schema([
                                            Repeater::make('lessons')
                                                ->relationship()
                                                ->schema([
                                                    Grid::make(2)->schema([
                                                        TextInput::make('title')
                                                            ->required()
                                                            ->maxLength(255),
                                                        Select::make('lesson_type')
                                                            ->options([
                                                                'video' => 'Video',
                                                                'quiz' => 'Quiz',
                                                                'article' => 'Article',
                                                            ])->default('video')->required(),
                                                    ]),
                                                    RichEditor::make('content')
                                                        ->columnSpanFull(),
                                                    Grid::make(2)->schema([
                                                        TextInput::make('video_url')
                                                            ->url(),
                                                        TextInput::make('video_duration_seconds')
                                                            ->numeric()
                                                            ->suffix('sec'),
                                                    ]),
                                                    Toggle::make('is_preview'),
                                                    Toggle::make('is_published'),
                                                    TextInput::make('sort_order')
                                                        ->numeric()
                                                        ->default(0),
                                                ])
                                                ->orderColumn('sort_order')
                                                ->collapsible()
                                                ->collapsed()
                                                ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
                                        ])->compact(),
                                    ])
                                    ->orderColumn('sort_order')
                                    ->collapsible()
                                    ->collapsed()
                                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                                    ->columnSpanFull(),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }
}
