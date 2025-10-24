<?php

namespace App\Filament\Resources\AeronaveResource\Pages;

use App\Filament\Resources\AeronaveResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAeronave extends EditRecord
{
    protected static string $resource = AeronaveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
