<?php

namespace App\Filament\Clusters\EditPages\Resources;

use App\Filament\Clusters\EditPages;
use App\Filament\Clusters\EditPages\Resources\ExperienceResource\Pages;
use App\Filament\Clusters\EditPages\Resources\ExperienceResource\RelationManagers;
use App\Models\Experience;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?int $navigationSort = 4;
    protected static ?string $cluster = EditPages::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(12)->schema([
                    Group::make()->schema([
                        Section::make('Main section')->schema([
                            TextInput::make('role')
                                ->placeholder("e.g., 'Full Stack Developer'")
                                ->required(),
                            TextInput::make('company')
                                ->placeholder("e.g., 'Tech Solutions Inc'")
                                ->required(),
                            TextInput::make('link')
                                ->label('Link')
                                ->url()
                                ->placeholder("e.g., 'cerebra.sa'")
                                ->prefix('https://'),
                            Textarea::make('description')
                                ->required(),
                        ]),
                    ])->columnSpan(['default' => 'full', 'md' => 8]),
                    Group::make()->schema([
                        Section::make('')->schema([
                            Toggle::make('is_public')->default(true),
                        ]),
                        Section::make('')->schema([
                            TextInput::make('duration')
                                ->placeholder('2020 - Present')
                                ->label('Duration'),
                        ])->collapsible(),
                    ])->columnSpan(['default' => 'full', 'md' => 4]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit' => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}
