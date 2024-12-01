<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;
use Filament\Actions;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\ColorPicker;
use Filament\Resources\Pages\CreateRecord;

class CreateTag extends CreateRecord
{
    protected static string $resource = TagResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(12)->schema([

                    Section::make('General Information')->schema([
                        TextInput::make('name')->required(),
                        ColorPicker::make('color')
                    ])->columnSpan(8),

                    Section::make('Settings')
                        ->schema([
                            Toggle::make('is_public')
                                ->label('Publicly Visible')
                                ->default(true),
                        ])
                        ->columnSpan(4)
                        ->collapsible(),
                ])
            ]);
    }

}
