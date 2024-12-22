<?php

namespace App\Filament\Clusters\EditPages\Resources;

use App\Filament\Clusters\EditPages;
use App\Filament\Clusters\EditPages\Resources\SkillResource\Pages;
use App\Filament\Clusters\EditPages\Resources\SkillResource\RelationManagers;
use App\Models\Skill;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    protected static ?int $navigationSort = 3;

    protected static ?string $cluster = EditPages::class;

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
                                ->placeholder("e.g., 'HTML', 'CSS', 'JavaScript'")
                                ->required(),

                            TextInput::make('icon')
                                ->label('icon')
                                ->placeholder("Path or reference to an icon")
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


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('icon'),
                ToggleColumn::make('is_public'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'edit' => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}
