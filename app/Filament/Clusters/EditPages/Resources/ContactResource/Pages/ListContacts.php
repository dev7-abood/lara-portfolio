<?php

namespace App\Filament\Clusters\EditPages\Resources\ContactResource\Pages;

use App\Filament\Clusters\EditPages\Resources\ContactResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
