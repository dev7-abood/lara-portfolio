<?php

namespace App\Filament\Resources\PortfolioResource\Pages;

use App\Filament\Resources\PortfolioResource;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditPortfolio extends EditRecord
{
    protected static string $resource = PortfolioResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('General Information') // Add a title for clarity
                ->schema([
                    TextInput::make('title')
                        ->label('Title')
                        ->required(),
                    TextInput::make('sub_title')
                        ->label('Subtitle'),
                    TextInput::make('url')
                        ->label('Portfolio URL')
                        ->url()
                        ->placeholder('https://example.com'),
                ])
                    ->collapsible(), // Allow collapsing for cleaner UI

                Section::make('Media') // Separate section for media uploads
                ->schema([
                    FileUpload::make('background')
                        ->label('Background Image')
                        ->image() // Ensure only image files are uploaded
                        ->directory('portfolio/backgrounds'), // Optional directory setting
                    FileUpload::make('images')
                        ->label('Gallery Images')
                        ->multiple() // Allow multiple file uploads
                        ->directory('portfolio/images'), // Optional directory setting
                ])
                    ->collapsible(),

                Section::make('Descriptions') // Dedicated section for descriptions
                ->schema([
                    RichEditor::make('description')
                        ->label('Main Description')
                        ->required()
                        ->placeholder('Write the main description here...')
                        ->columnSpan(6), // Half-width
                    RichEditor::make('sub_description')
                        ->label('Additional Description')
                        ->placeholder('Optional: Write any additional details here...')
                        ->columnSpan(6), // Half-width
                ])->collapsible(),

                Section::make('Settings') // Separate section for toggles and configurations
                ->schema([
                    Toggle::make('is_public')
                        ->label('Publicly Visible')
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
