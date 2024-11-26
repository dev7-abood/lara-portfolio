<?php

namespace App\Filament\Resources\AboutMeResource\Pages;

use App\Filament\Resources\AboutMeResource;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditAboutMe extends EditRecord
{
    protected static string $resource = AboutMeResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Settings') // Separate section for toggles and configurations
                ->schema([
                    Toggle::make('is_public')
                        ->label('Publicly Visible')
                ])
                    ->collapsible(),

                Section::make('Descriptions')
                    ->schema([
                        RichEditor::make('description')
                            ->label('Main Description')
                            ->required()
                            ->placeholder('Write the main description here...')
                            ->columnSpan(6), // Half-width
                    ])
                    ->collapsible(),

                Section::make('Media')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Background Image')
                            ->image() // Ensure only image files are uploaded
                            ->directory('portfolio/backgrounds'), // Optional directory setting
                    ])
                    ->collapsible(),

                Section::make('Media')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Background Image')
                            ->image() // Ensure only image files are uploaded
                            ->directory('portfolio/backgrounds'), // Optional directory setting
                    ])
                    ->collapsible(),

            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
