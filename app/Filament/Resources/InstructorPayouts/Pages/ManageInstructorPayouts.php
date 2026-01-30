<?php

namespace App\Filament\Resources\InstructorPayouts\Pages;

use App\Filament\Resources\InstructorPayouts\InstructorPayoutResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageInstructorPayouts extends ManageRecords
{
    protected static string $resource = InstructorPayoutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
