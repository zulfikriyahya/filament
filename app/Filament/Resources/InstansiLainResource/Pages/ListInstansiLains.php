<?php

namespace App\Filament\Resources\InstansiLainResource\Pages;

use App\Filament\Resources\InstansiLainResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInstansiLains extends ListRecords
{
    protected static string $resource = InstansiLainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
