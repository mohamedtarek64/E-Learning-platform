<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)->schema([
                    Section::make('General Information')
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('email')
                                ->email()
                                ->required()
                                ->unique('users', 'email', ignoreRecord: true),
                            Select::make('role')
                                ->options([
                                    'admin' => 'Admin',
                                    'instructor' => 'Instructor',
                                    'student' => 'Student',
                                ])
                                ->required()
                                ->default('student'),
                            FileUpload::make('avatar')
                                ->image()
                                ->avatar()
                                ->directory('avatars')
                                ->columnSpanFull(),
                        ])->columnSpan(1),

                    Section::make('Security & Status')
                        ->schema([
                            TextInput::make('password')
                                ->password()
                                ->dehydrated(fn ($state) => filled($state))
                                ->required(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord)
                                ->maxLength(255),
                            Select::make('instructor_status')
                                ->options([
                                    'none' => 'None',
                                    'pending' => 'Pending',
                                    'approved' => 'Approved',
                                    'rejected' => 'Rejected',
                                ])
                                ->default('none')
                                ->visible(fn (\Filament\Forms\Get $get) => $get('role') === 'instructor'),
                        ])->columnSpan(1),
                ]),
            ]);
    }
}
