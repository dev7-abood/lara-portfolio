<?php

namespace App\Filament\Clusters\EditPages\Resources\HomeResource\Pages;

use App\Filament\Clusters\EditPages\Resources\HomeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHome extends CreateRecord
{
    protected static string $resource = HomeResource::class;
}
