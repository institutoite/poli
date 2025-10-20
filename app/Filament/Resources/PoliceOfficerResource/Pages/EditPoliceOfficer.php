<?php

namespace App\Filament\Resources\PoliceOfficerResource\Pages;

use App\Filament\Resources\PoliceOfficerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPoliceOfficer extends EditRecord
{
    protected static string $resource = PoliceOfficerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
