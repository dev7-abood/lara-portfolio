<?php

namespace App\Filament\Clusters\EditPages\Resources;

use App\Filament\Clusters\EditPages;
use App\Filament\Clusters\EditPages\Resources\AboutMeResource\Pages;
use App\Filament\Clusters\EditPages\Resources\AboutMeResource\RelationManagers;
use App\Models\AboutMe;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutMeResource extends Resource
{
    protected static ?string $model = AboutMe::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $cluster = EditPages::class;
    protected static ?string $navigationLabel = 'About Me';
    protected static ?string $pluralLabel = 'About Me';
    protected static ?string $slug = 'about-me';

    protected static ?int $navigationSort = 8;

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
                        KeyValue::make('contact_details')
                            ->reorderable()
                            ->required(),
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
                TextColumn::make('contact_details')->limit(25),
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
            'index' => Pages\ListAboutMes::route('/'),
            'create' => Pages\CreateAboutMe::route('/create'),
            'edit' => Pages\EditAboutMe::route('/{record}/edit'),
        ];
    }
}
