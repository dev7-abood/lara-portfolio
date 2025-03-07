<?php

namespace App\Filament\Clusters\EditPages\Resources\SkillResource\Pages;

use App\Filament\Clusters\EditPages\Resources\SkillResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSkill extends EditRecord
{
    protected static string $resource = SkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
