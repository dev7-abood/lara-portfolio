<?php

namespace App\Filament\Clusters\EditPages\Resources;

use App\Filament\Clusters\EditPages;
use App\Filament\Clusters\EditPages\Resources\ServiceResource\Pages;
use App\Filament\Clusters\EditPages\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $cluster = EditPages::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $label = 'Service';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(12)->schema([
                    Group::make()->schema([
                        Section::make('Main section')->schema([
                            TextInput::make('title')
                                ->placeholder('e.g., Web Development, SEO Services')
                                ->required(),
                            TextInput::make('link')
                                ->label('Link')
                                ->placeholder('e.g., https://yourwebsite.com/service')
                                ->url()
                                ->prefix('https://'),
                            Textarea::make('description')
                                ->placeholder('e.g., A comprehensive explanation of the services offered, including features, benefits, and unique selling points.')
                                ->required(),
                        ]),
                    ])->columnSpan(['default' => 'full', 'md' => 8]),
                    Group::make()->schema([
                        Section::make('')->schema([
                            Toggle::make('is_public')
                                ->label('Public Visibility')
                                ->default(true)
                        ]),
                    ])->columnSpan(['default' => 'full', 'md' => 4]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\ToggleColumn::make('is_public'),
                Tables\Columns\TextColumn::make('created_at'),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
