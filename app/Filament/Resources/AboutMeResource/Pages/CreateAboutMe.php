<?php

namespace App\Filament\Resources\AboutMeResource\Pages;

use App\Filament\Resources\AboutMeResource;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
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
                Grid::make(12)
                    ->schema([
                        Group::make([
                            Section::make('Descriptions')
                                ->schema([
                                    RichEditor::make('description')
                                        ->label('Main Description')
                                        ->required()
                                        ->placeholder('Write the main description here...')
                                        ->columnSpan([
                                            'default' => 'full',
                                            'lg' => 8,
                                        ]),
                                ])
                                ->collapsible(),

                            Section::make('Media')
                                ->schema([
                                    FileUpload::make('image')
                                        ->label('Background Image')
                                        ->image()
                                        ->directory('portfolio/backgrounds'),
                                ])
                                ->collapsible(),
                        ])->columnSpan([
                            'default' => 'full',
                            'lg' => 8,
                        ]),

                        Group::make([
                            Section::make('Settings')
                                ->schema([
                                    Toggle::make('is_public')
                                        ->label('Publicly Visible')
                                        ->default(true),
                                ])
                                ->collapsible(),
                        ])->columnSpan([
                            'default' => 'full',
                            'lg' => 4,
                        ]),
                    ]),
            ]);
    }

}
