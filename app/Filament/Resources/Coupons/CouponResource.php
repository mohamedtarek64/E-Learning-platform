<?php

namespace App\Filament\Resources\Coupons;

use App\Filament\Resources\Coupons\Pages\ManageCoupons;
use App\Models\Coupon;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use UnitEnum;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-ticket';

    protected static string | UnitEnum | null $navigationGroup = '💸 Promotions';

    protected static ?string $recordTitleAttribute = 'code';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Info')->schema([
                    TextInput::make('code')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->placeholder('SUMMER2026')
                        ->maxLength(20),
                    Select::make('discount_type')
                        ->options([
                            'percentage' => 'Percentage (%)',
                            'fixed_amount' => 'Fixed Amount ($)'
                        ])
                        ->required(),
                    TextInput::make('discount_value')
                        ->required()
                        ->numeric()
                        ->minValue(0),
                ])->columns(3),

                Section::make('Usage Limits & Validity')->schema([
                    TextInput::make('max_uses')
                        ->label('Maximum Uses')
                        ->helperText('Leave empty for unlimited')
                        ->numeric(),
                    DateTimePicker::make('valid_from')
                        ->default(now()),
                    DateTimePicker::make('valid_until'),
                    Select::make('applicable_courses')
                        ->multiple()
                        ->options(\App\Models\Course::all()->pluck('title', 'id'))
                        ->preload()
                        ->searchable()
                        ->helperText('Leave empty if applicable to all courses'),
                    Toggle::make('is_active')
                        ->label('Active')
                        ->default(true),
                ])->columns(2),

                TextInput::make('created_by')
                    ->hidden()
                    ->default(auth()->id()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->searchable()
                    ->weight('bold')
                    ->sortable(),
                TextColumn::make('discount_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'percentage' => 'warning',
                        'fixed_amount' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('discount_value')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('times_used')
                    ->label('Usage')
                    ->formatStateUsing(fn ($record) => $record->times_used . ($record->max_uses ? ' / ' . $record->max_uses : '')),
                ToggleColumn::make('is_active')
                    ->label('Status'),
                TextColumn::make('valid_until')
                    ->dateTime()
                    ->color(fn ($state) => $state && $state < now() ? 'danger' : null)
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => ManageCoupons::route('/'),
        ];
    }
}
