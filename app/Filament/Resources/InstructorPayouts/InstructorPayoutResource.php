<?php

namespace App\Filament\Resources\InstructorPayouts;

use App\Filament\Resources\InstructorPayouts\Pages\ManageInstructorPayouts;
use App\Models\InstructorPayout;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;

class InstructorPayoutResource extends Resource
{
    protected static ?string $model = InstructorPayout::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-currency-dollar';

    protected static string | UnitEnum | null $navigationGroup = '⚙️ System';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Payout Request')->schema([
                    Select::make('instructor_id')
                        ->relationship('instructor', 'name')
                        ->label('Instructor')
                        ->searchable()
                        ->preload()
                        ->required(),
                    TextInput::make('total_amount')
                        ->label('Amount')
                        ->prefix('$')
                        ->numeric()
                        ->required(),
                    Select::make('status')
                        ->options([
                            'pending' => 'Pending',
                            'processing' => 'Processing',
                            'completed' => 'Completed',
                            'failed' => 'Failed',
                        ])
                        ->default('pending')
                        ->required(),
                ])->columns(3),

                Section::make('Payment Info')->schema([
                    TextInput::make('payment_method')
                        ->required(),
                    TextInput::make('transaction_reference')
                        ->placeholder('Stripe Transfer ID, etc.'),
                    DateTimePicker::make('requested_at')
                        ->default(now())
                        ->required(),
                    DateTimePicker::make('processed_at'),
                    Textarea::make('notes')
                        ->columnSpanFull(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('instructor.name')
                    ->label('Instructor')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('total_amount')
                    ->money('USD')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'completed' => 'success',
                        'pending' => 'warning',
                        'processing' => 'info',
                        'failed' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('payment_method')
                    ->searchable(),
                TextColumn::make('requested_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('processed_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'completed' => 'Completed',
                        'failed' => 'Failed',
                    ]),
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
            'index' => ManageInstructorPayouts::route('/'),
        ];
    }
}
