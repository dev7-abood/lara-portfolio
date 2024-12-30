<?php

namespace App\Filament\Clusters\EditPages\Resources\AboutMeResource\Pages;

use App\Filament\Clusters\EditPages\Resources\AboutMeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAboutMe extends CreateRecord
{
    protected static string $resource = AboutMeResource::class;
}
