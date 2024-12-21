<?php

namespace App\Filament\Clusters\EditPages\Resources\HomeResource\Pages;

use App\Filament\Clusters\EditPages\Resources\HomeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomes extends ListRecords
{
    protected static string $resource = HomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
