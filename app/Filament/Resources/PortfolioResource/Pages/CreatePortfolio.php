<?php

namespace App\Filament\Resources\PortfolioResource\Pages;

use App\Filament\Resources\PortfolioResource;
use App\Models\Portfolio;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Builder;


class CreatePortfolio extends CreateRecord
{
    protected static string $resource = PortfolioResource::class;

    public function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(12)->schema([
                Group::make([
                    Section::make('General Information')
                        ->schema([
                            TextInput::make('title')
                                ->label('Title')
                                ->required(),
                            TextInput::make('subtitle')
                                ->label('Subtitle'),
                            TextInput::make('url')
                                ->label('Portfolio URL')
                                ->url()
                                ->placeholder('https://example.com'),
                        ])
                        ->collapsible()
                        ->columnSpan([
                            'default' => 12,
                            'md' => 8,
                        ]),

                    Section::make('Descriptions')
                        ->schema([
                            RichEditor::make('description')
                                ->label('Main Description')
                                ->required()
                                ->placeholder('Write the main description here...')
                                ->columnSpan(12),
                            RichEditor::make('sub_description')
                                ->label('Additional Description')
                                ->placeholder('Optional: Write any additional details here...')
                                ->columnSpan(12),
                        ])
                        ->collapsible()
                        ->columnSpan([
                            'default' => 12,
                            'md' => 8,
                        ]),

                    Section::make('Media')
                        ->schema([
                            FileUpload::make('background')
                                ->label('Background Image')
                                ->image()
                                ->directory('portfolio/backgrounds'),
                            FileUpload::make('images')
                                ->label('Gallery Images')
                                ->image()
                                ->multiple()
                                ->reorderable()
                                ->directory('portfolio/images'),
                        ])
                        ->collapsible()
                        ->columnSpan([
                            'default' => 12,
                            'md' => 8,
                        ]),


                ])->columnSpan([
                    'default' => 12,
                    'md' => 8,
                ]),

                Group::make([
                    Section::make('Settings')
                        ->schema([
                            Toggle::make('is_public')
                                ->label('Publicly Visible')
                                ->default(true),
                        ])
                        ->collapsible(),

                    Section::make('Categories')
                        ->schema([
                            Select::make('categories')
                                ->label('Select Categories')
                                ->multiple()
                                ->relationship('categorise', 'name',
                                    fn(Builder $query) => $query->where(['is_public' => true, 'categoryable_type' => Portfolio::class])
                                )
                                ->preload()
//                                ->default()
                                ->required(),
                        ])
                        ->collapsible(),

                    Section::make('Tags')
                        ->schema([
                            Select::make('tags')
                                ->label('Select Tags')
                                ->multiple()
                                ->relationship('tags', 'name')
                                ->preload(),
                        ])
                        ->collapsible(),

                ])->columnSpan([
                    'default' => 12,
                    'md' => 4,
                ]),
            ])->columnSpanFull(),
        ]);
    }
}
