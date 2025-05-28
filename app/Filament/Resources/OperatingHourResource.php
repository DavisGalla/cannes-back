<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OperatingHourResource\Pages;
use App\Filament\Resources\OperatingHourResource\RelationManagers;
use App\Models\OperatingHour;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Tables\Columns\TextColumn;

class OperatingHourResource extends Resource
{
    protected static ?string $model = OperatingHour::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('cinema_id')
                ->relationship('cinema', 'name')
                ->required(),

            Select::make('day_of_week')
                ->options([
                    'Monday' => 'Monday',
                    'Tuesday' => 'Tuesday',
                    'Wednesday' => 'Wednesday',
                    'Thursday' => 'Thursday',
                    'Friday' => 'Friday',
                    'Saturday' => 'Saturday',
                    'Sunday' => 'Sunday',
                ])
                ->required(),

            TimePicker::make('opens_at'),
            TimePicker::make('closes_at'),
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cinema.name'),
                TextColumn::make('day_of_week'),
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
            'index' => Pages\ListOperatingHours::route('/'),
            'create' => Pages\CreateOperatingHour::route('/create'),
            'edit' => Pages\EditOperatingHour::route('/{record}/edit'),
        ];
    }
}
