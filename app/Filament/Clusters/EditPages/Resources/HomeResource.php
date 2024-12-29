<?php

namespace App\Filament\Clusters\EditPages\Resources;

use App\Filament\Clusters\EditPages;
use App\Filament\Clusters\EditPages\Resources\HomeResource\Pages;
use App\Models\Category;
use App\Models\Home;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\KeyValue;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class HomeResource extends Resource
{
    protected static ?string $model = Home::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Home';

    protected static ?string $label = 'Home';
    protected static ?string $slug = 'home';
    protected static ?string $pluralLabel = 'Home';
    protected static ?string $cluster = EditPages::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(12)->schema([
                    Group::make()->schema([
                        Section::make('Main Section')->schema([
                            TextInput::make('name')
                                ->placeholder('e.g., Abdulrhman Herzallah')
                                ->label('Full Name'),

                            TextInput::make('specialization')
                                ->placeholder('e.g., Software Developer')
                                ->label('Specialization'),

                            TextInput::make('greeting_title')
                                ->placeholder('e.g., Hello, I’m')
                                ->label('Greeting Title'),

                            Textarea::make('bio')
                                ->placeholder('Write a detailed description about yourself...')
                                ->label('Biography'),
                        ]),

                        Section::make('Manage Files')->schema([
                            FileUpload::make('profile_image')
                                ->directory('profile-image')
                                ->image()
                                ->required()
                                ->maxFiles(1)
                                ->label('Profile Image')
                                ->placeholder('Upload a profile picture'),

                            FileUpload::make('resume_file')
                                ->directory('resume-file')
                                ->required()
                                ->maxFiles(1)
                                ->label('Resume File')
                                ->placeholder('Upload your resume')
                                ->acceptedFileTypes(['application/pdf'])
                                ->downloadable()
                            ,
                        ]),
                    ])->columnSpan(['default' => 'full', 'md' => 8]),

                    Group::make()->schema([
                        Section::make('Visibility')->schema([
                            Toggle::make('is_public')
                                ->default(true)
                                ->label('Public Profile'),
                        ]),

                        Section::make('Additional Info')->schema([
                            KeyValue::make('social_media')
                                ->label('Social Media Links')
                                ->reorderable()
                                ->helperText('Add social media links like Facebook, Twitter, etc.'),

                            KeyValue::make('stats')
                                ->label('Statistics')
                                ->reorderable()
                                ->helperText('e.g., Experience, Projects Completed, Technologies Used'),
                        ]),
                    ])->columnSpan(['default' => 'full', 'md' => 4]),
                ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('specialization'),
                TextColumn::make('greeting_title'),
                ImageColumn::make('profile_image')->circular(),
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
            'index' => Pages\ListHomes::route('/'),
            'create' => Pages\CreateHome::route('/create'),
            'edit' => Pages\EditHome::route('/{record}/edit'),
        ];
    }
}
