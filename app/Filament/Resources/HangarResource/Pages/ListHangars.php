<?php

namespace App\Filament\Resources\HangarResource\Pages;

use App\Filament\Resources\HangarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHangars extends ListRecords
{
    protected static string $resource = HangarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
