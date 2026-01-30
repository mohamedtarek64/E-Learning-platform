<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Pages\SettingsPage;

class ManageSettings extends SettingsPage
{
    protected static $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GeneralSettings::class;

    public static function getNavigationGroup(): ?string
    {
        return '⚙️ System';
    }

    protected static $navigationLabel = 'Site Settings';

    protected static $title = 'App Settings';

    public function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form
            ->schema([
                Tabs::make('Settings')
                    ->tabs([
                        Tabs\Tab::make('General')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                Section::make('Site Configuration')
                                    ->schema([
                                        TextInput::make('site_name')
                                            ->required()
                                            ->maxLength(255),
                                        FileUpload::make('site_logo')
                                            ->image()
                                            ->directory('settings'),
                                        Select::make('timezone')
                                            ->options([
                                                'UTC' => 'UTC',
                                                'America/New_York' => 'Eastern Time',
                                                'Europe/London' => 'London',
                                            ])
                                            ->required(),
                                        Select::make('date_format')
                                            ->options([
                                                'Y-m-d' => 'YYYY-MM-DD',
                                                'd/m/Y' => 'DD/MM/YYYY',
                                                'm/d/Y' => 'MM/DD/YYYY',
                                            ])
                                            ->required(),
                                        TextInput::make('items_per_page')
                                            ->numeric()
                                            ->required()
                                            ->minValue(5)
                                            ->maxValue(100),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
