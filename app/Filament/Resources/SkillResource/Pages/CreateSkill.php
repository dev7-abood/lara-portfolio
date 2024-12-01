<?php

namespace App\Filament\Resources\SkillResource\Pages;

use App\Filament\Resources\SkillResource;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Skill;
use Filament\Resources\Pages\CreateRecord;

class CreateSkill extends CreateRecord
{
    protected static string $resource = SkillResource::class;

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

                            Select::make('category_id')
                                ->label('Select Category')
                                ->relationship(
                                    'category',
                                    'name',
                                    fn (Builder $query)
                                    => $query->where(['is_public' => true, 'categoryable_type' => Skill::class])
                                )
                                ->searchable()
                                ->preload()

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


}
