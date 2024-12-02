<?php

namespace App\Filament\Resources\ContactUsResource\Pages;

use App\Filament\Resources\ContactUsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Support\Enums\FontWeight;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;

class ListContactUs extends ListRecords
{
    protected static string $resource = ContactUsResource::class;

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')
                    ->label('Full Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Phone')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('message')
                    ->label('Message')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->message),
                TextColumn::make('type')
                    ->label('Type')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),
            ])
            ->actions([
                Action::make('view')
                    ->label('View Details')
                    ->icon('heroicon-o-eye')
                    ->infolist([
                        Section::make()
                            ->schema([
                                TextEntry::make('full_name')
                                    ->label('Full Name')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('email')
                                    ->label('Email')
                                    ->weight(FontWeight::Bold)
                                    ->url(fn ($record) => 'mailto:' . $record->email)
                                    ->openUrlInNewTab(false)
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('phone')
                                    ->label('Phone')
                                    ->url(fn ($record) => 'tel:' . $record->phone)
                                    ->openUrlInNewTab(false)
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('message')
                                    ->label('Message')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('type')
                                    ->label('Type')
                                    ->placeholder('N/A')
                                    ->weight(FontWeight::Bold),
                            ])
                            ->columns(2),
                    ])
                    ->modalHeading('Contact Us Details')
                    ->modalSubmitAction(false),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
    }
}
