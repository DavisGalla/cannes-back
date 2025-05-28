<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovieResource\Pages;
use App\Filament\Resources\MovieResource\RelationManagers;
use App\Models\Movie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class MovieResource extends Resource
{
    protected static ?string $model = Movie::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

   public static function form(Form $form): Form
{
    return $form->schema([
        TextInput::make('title')->required(),
        Textarea::make('summary')->rows(4),
        TextInput::make('director')->required(),
        TextInput::make('year')->numeric()->minValue(1900)->maxValue(date('Y')),
        TextInput::make('country'),
        TextInput::make('duration_minutes')->numeric()->suffix('min'),
        Textarea::make('credits')->json(),
        Textarea::make('casting')->json(),
        TextInput::make('poster_url')->label('Poster URL'),
    ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Textcolumn::make('title')->searchable()->sortable(),
                TextColumn::make('director'),
                Textcolumn::make('year')->sortable(),
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
            'index' => Pages\ListMovies::route('/'),
            'create' => Pages\CreateMovie::route('/create'),
            'edit' => Pages\EditMovie::route('/{record}/edit'),
        ];
    }
}
