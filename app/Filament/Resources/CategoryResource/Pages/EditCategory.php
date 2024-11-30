<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Models\Portfolio;
use App\Models\Skill;
use Filament\Actions;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    public function form(Form $form): Form
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

                            Select::make('categoryable_type')
                                ->options([
                                    Portfolio::class => Portfolio::class,
                                    Skill::class => Skill::class,
                                ])
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

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
