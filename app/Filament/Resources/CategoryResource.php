<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use App\Models\Portfolio;
use App\Models\Skill;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-view-columns';

    protected static ?string $navigationGroup = 'Work';

    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(12) // Main grid with 12 columns
                ->schema([
                    Section::make('General Information')
                        ->schema([
                            TextInput::make('name')
                                ->label('Name')
                                ->required(),

//                            Select::make('categoryable_type')
//                                ->options([
//                                    Portfolio::class => 'Portfolio',
//                                    Skill::class => 'Skill',
//                                ])->required()
                        ])
                        ->columnSpan([
                            'sm' => 12,
                            'lg' => 8,
                        ])
                        ->collapsible(),

                    Section::make('Settings')
                        ->schema([
                            Toggle::make('is_public')
                                ->label('Publicly Visible')
                                ->default(true),
                        ])
                        ->columnSpan([
                            'sm' => 12,
                            'lg' => 4,
                        ])
                        ->collapsible(),
                ])
                    ->columns(12)
                    ->columnSpan('full'),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
