<?php

namespace App\Filament\Clusters\EditPages\Resources;

use App\Filament\Clusters\EditPages;
use App\Filament\Clusters\EditPages\Resources\HireMeResource\Pages;
use App\Filament\Clusters\EditPages\Resources\HireMeResource\RelationManagers;
use App\Models\HireMe;
use Filament\Forms;
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
                Grid::make(12)->schema([
                    Group::make()->schema([
                        Section::make('Main section')->schema([
                            TextInput::make('link')
                                ->label('Link')
                                ->placeholder("e.g., 'mail'")
                                ->required(),
                            TextInput::make('type')
                                ->placeholder('Enter HTML type, e.g., mail or tel')
                                ->label('Input Type')
                                ->helperText('Specify the HTML input type, such as "email" or "tel" for phone number.')
                        ]),
                    ])->columnSpan(['default' => 'full', 'md' => 8]),
                    Group::make()->schema([
                        Section::make('')->schema([
                            Toggle::make('is_public')
                                ->default(true),
                        ]),
                    ])->columnSpan(['default' => 'full', 'md' => 4]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('link'),
                TextColumn::make('type')->label('Input type'),
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
            'index' => Pages\ListHireMes::route('/'),
            'create' => Pages\CreateHireMe::route('/create'),
            'edit' => Pages\EditHireMe::route('/{record}/edit'),
        ];
    }
}
