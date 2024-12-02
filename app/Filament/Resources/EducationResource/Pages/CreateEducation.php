<?php

namespace App\Filament\Resources\EducationResource\Pages;

use App\Filament\Resources\EducationResource;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class CreateEducation extends CreateRecord
{
    protected static string $resource = EducationResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(12)
                    ->schema([
                        Group::make([
                            Section::make('Descriptions')
                                ->schema([
                                    TextInput::make('title')
                                        ->label('Title')
                                        ->required()
                                        ->placeholder('Enter the title...'),

                                    TextInput::make('subtitle')
                                        ->label('Subtitle')
                                        ->nullable()
                                        ->placeholder('Enter the subtitle...'),

                                    TextInput::make('since')
                                        ->label('Since')
                                        ->required()
                                        ->placeholder('Apr, 2016 — May, 2020'),

                                    Textarea::make('description')
                                        ->label('Description')
                                        ->placeholder('Write the description here...')
                                        ->nullable()
                                ])
                                ->collapsible(),

                            Section::make('Media')
                                ->schema([
                                    TextInput::make('url')
                                        ->label('URL')
                                        ->nullable()
                                        ->placeholder('Enter a URL...')
                                        ->columnSpan('full'),
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
