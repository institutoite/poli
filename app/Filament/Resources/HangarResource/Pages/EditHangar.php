<?php

namespace App\Filament\Resources\HangarResource\Pages;

use App\Filament\Resources\HangarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHangar extends EditRecord
{
    protected static string $resource = HangarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
