<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use Filament\Actions;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Edit Configuration')->schema([
                    TextInput::make('key')->required()->unique(ignoreRecord: true),
                    TextInput::make('value')->required(),
                    Toggle::make('is_publish')
                ])->collapsible()
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
