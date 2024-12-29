<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioResource\Pages;
use App\Filament\Resources\PortfolioResource\RelationManagers;
use App\Models\Portfolio;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;

class PortfolioResource extends Resource
{
    protected static ?string $model = Portfolio::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Work';

    protected static ?int $navigationSort = 1;
    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(12)->schema([
                Group::make([
                    Section::make('General Information')
                        ->schema([
                            TextInput::make('title')
                                ->label('Title')
                                ->placeholder('Enter the project title')
                                ->required(),
                            TextInput::make('subtitle')
                                ->label('Subtitle')
                                ->placeholder('Enter the subtitle'),
                            TextInput::make('url')
                                ->label('Project URL')
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
                                ->placeholder('Upload a background image')
                                ->image()
                                ->maxFiles(1)
                                ->downloadable()
                                ->required()
                                ->directory('portfolio/backgrounds'),
                            FileUpload::make('images')
                                ->label('Gallery Images')
                                ->placeholder('Upload gallery images')
                                ->image()
                                ->multiple()
                                ->reorderable()
                                ->downloadable()
                                ->required()
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
                                ->helperText('Toggle to make this portfolio publicly visible.')
                                ->default(true),

                            Toggle::make('is_main')
                                ->label('Main Visible')
                                ->helperText('Toggle to set this as the main visible portfolio.')
                                ->default(true),

                            Select::make('categories')
                                ->label('Select Categories')
                                ->multiple()
                                ->placeholder('Choose categories')
                                ->relationship('categories', 'name')
                                ->preload()
                                ->required(),

                            Select::make('tags')
                                ->label('Select Tags')
                                ->multiple()
                                ->placeholder('Choose tags')
                                ->relationship('tags', 'name')
                                ->preload(),

                            TextInput::make('duration')
                                ->label('Duration')
                                ->helperText('Toggle to set this as the main visible portfolio.')
                                ->placeholder( "2025 - Present"),

                        ])
                        ->collapsible(),
                ])->columnSpan([
                    'default' => 12,
                    'md' => 4,
                ]),
            ])->columnSpanFull(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolio::route('/create'),
            'edit' => Pages\EditPortfolio::route('/{record}/edit'),
        ];
    }
}
