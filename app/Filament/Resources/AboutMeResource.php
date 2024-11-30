<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutMeResource\Pages;
use App\Models\AboutMe;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutMeResource extends Resource
{
    protected static ?string $model = AboutMe::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationLabel = 'About Me';
    protected static ?string $pluralLabel = 'About Me';
    protected static ?string $slug = 'about-me';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationGroup = 'About Me';

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAboutMes::route('/'),
            'create' => Pages\CreateAboutMe::route('/create'),
            'edit' => Pages\EditAboutMe::route('/{record}/edit'),
        ];
    }
}
