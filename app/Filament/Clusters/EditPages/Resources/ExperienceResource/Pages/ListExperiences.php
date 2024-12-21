<?php

namespace App\Filament\Clusters\EditPages\Resources\ExperienceResource\Pages;

use App\Filament\Clusters\EditPages\Resources\ExperienceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExperiences extends ListRecords
{
    protected static string $resource = ExperienceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
