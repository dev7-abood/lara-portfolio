<?php

namespace App\Filament\Clusters\EditPages\Resources\AboutMeResource\Pages;

use App\Filament\Clusters\EditPages\Resources\AboutMeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAboutMe extends EditRecord
{
    protected static string $resource = AboutMeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
