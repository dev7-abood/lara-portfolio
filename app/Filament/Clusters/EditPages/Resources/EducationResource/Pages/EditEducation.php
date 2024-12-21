<?php

namespace App\Filament\Clusters\EditPages\Resources\EducationResource\Pages;

use App\Filament\Clusters\EditPages\Resources\EducationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEducation extends EditRecord
{
    protected static string $resource = EducationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
