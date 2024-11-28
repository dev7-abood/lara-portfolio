<?php

namespace App\Filament\Resources\AboutMeResource\Pages;

use App\Filament\Resources\AboutMeResource;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateAboutMe extends CreateRecord
{
    protected static string $resource = AboutMeResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([

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

                Section::make('Settings')
                    ->schema([
                    Toggle::make('is_public')
                        ->label('Publicly Visible')
                        ->default(true),
                ])
                    ->collapsible(),
            ]);
    }
}
