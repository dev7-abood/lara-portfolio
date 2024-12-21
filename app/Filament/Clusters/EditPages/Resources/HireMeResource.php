<?php

namespace App\Filament\Clusters\EditPages\Resources;

use App\Filament\Clusters\EditPages;
use App\Filament\Clusters\EditPages\Resources\HireMeResource\Pages;
use App\Filament\Clusters\EditPages\Resources\HireMeResource\RelationManagers;
use App\Models\HireMe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HireMeResource extends Resource
{
    protected static ?string $model = HireMe::class;

    protected static ?string $navigationIcon = 'heroicon-o-hand-raised';

    protected static ?string $cluster = EditPages::class;

    protected static ?int $navigationSort = 6;
    protected static ?string $navigationLabel = 'Hire Me';
    protected static ?string $label = 'Hire Me';
    protected static ?string $pluralLabel = 'Hire Me';
    protected static ?string $slug = 'hire-me';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
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
            'index' => Pages\ListHireMes::route('/'),
            'create' => Pages\CreateHireMe::route('/create'),
            'edit' => Pages\EditHireMe::route('/{record}/edit'),
        ];
    }
}
