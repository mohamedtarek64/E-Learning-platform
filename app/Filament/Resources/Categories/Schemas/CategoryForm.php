<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use Filament\Forms\Get;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)->schema([
                    Section::make('Basic Info')->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique('categories', 'slug', ignoreRecord: true),
                        Select::make('parent_id')
                            ->relationship('parent', 'name')
                            ->searchable()
                            ->preload()
                            ->label('Parent Category'),
                    ])->columnSpan(1),

                    Section::make('Design & Status')->schema([
                        TextInput::make('icon')
                            ->placeholder('heroicon-o-tag')
                            ->helperText('Use Heroicon name (e.g., heroicon-o-academic-cap)'),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('Show in Navigation')
                            ->default(true),
                    ])->columnSpan(1),

                    Section::make('Content')->schema([
                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columnSpanFull(),
                ]),
            ]);
    }
}
