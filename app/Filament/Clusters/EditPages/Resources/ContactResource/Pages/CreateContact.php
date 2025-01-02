<?php

namespace App\Filament\Clusters\EditPages\Resources\ContactResource\Pages;

use App\Filament\Clusters\EditPages\Resources\ContactResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateContact extends CreateRecord
{
    protected static string $resource = ContactResource::class;
}
