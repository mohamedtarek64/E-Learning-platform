<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Pages\SettingsPage;
use BackedEnum;
use UnitEnum;

class ManageSettings extends SettingsPage
{
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string | UnitEnum | null $navigationGroup = '⚙️ System';

    protected static string $settings = GeneralSettings::class;

    protected static ?string $navigationLabel = 'Site Settings';

    protected static ?string $title = 'App Settings';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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
