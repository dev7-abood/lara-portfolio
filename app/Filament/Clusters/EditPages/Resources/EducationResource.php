<?php

namespace App\Filament\Clusters\EditPages\Resources;

use App\Filament\Clusters\EditPages;
use App\Filament\Clusters\EditPages\Resources\EducationResource\Pages;
use App\Filament\Clusters\EditPages\Resources\EducationResource\RelationManagers;
use App\Models\Education;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Repeater;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EducationResource extends Resource
{
    protected static ?string $model = Education::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?int $navigationSort = 5;
    protected static ?string $cluster = EditPages::class;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(12)->schema([
                    Group::make()->schema([
                        Section::make('General')->schema([
                            Toggle::make('is_public')
                                ->default(true),
                        ]),
                        Repeater::make('educations')
                            ->schema([
                                TextInput::make('program')->placeholder("e.g., 'Full Stack Web Development Bootcamp'")->required(),
                                TextInput::make('institution')->placeholder("e.g., 'Online Course Platform'")->required(),
                                TextInput::make('duration')
                                    ->placeholder('2020 - Present')
                                    ->label('Duration')->required(),
                                TextInput::make('link')
                                    ->label('Link')
                                    ->url()
                                    ->placeholder("e.g., 'coursera.org'")
                                    ->prefix('https://'),
                                Textarea::make('description'),
                                Toggle::make('is_public')
                                    ->default(true),
                            ]),
                    ])->columnSpan(['default' => 'full', 'md' => 8]),
                    Group::make()->schema([
                        Section::make('')->schema([
                            Textarea::make('description')->required(),
                        ]),
                    ])->columnSpan(['default' => 'full', 'md' => 4]),
                ]),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('description')->limit(40),
                TextColumn::make('educations')->limit(30),
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
            ])
            ->defaultSort('sort', 'asc')
            ->reorderable('sort');
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
            'index' => Pages\ListEducation::route('/'),
            'create' => Pages\CreateEducation::route('/create'),
            'edit' => Pages\EditEducation::route('/{record}/edit'),
        ];
    }
}
