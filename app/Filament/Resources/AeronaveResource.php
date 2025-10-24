<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AeronaveResource\Pages;
use App\Filament\Resources\AeronaveResource\RelationManagers;
use App\Models\Aeronave;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AeronaveResource extends Resource
{
    protected static ?string $model = Aeronave::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('matricula')
                    ->required()
                    ->maxLength(15),
                Forms\Components\Select::make('tipo')
                    ->label('Tipo')
                    ->options([
                        'avioneta' => 'Avioneta',
                        'helicoptero' => 'Helicóptero',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('modelo')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\Select::make('marca')
                    ->label('Marca')
                    ->options([
                        'cessna' => 'Cessna',
                        'piper' => 'Piper',
                        'beechcraft' => 'Beechcraft',
                        'airbus' => 'Airbus',
                        'boeing' => 'Boeing',
                        'embraer' => 'Embraer',
                        'bombardier' => 'Bombardier',
                        'bell' => 'Bell',
                        'robinson' => 'Robinson',
                        'sikorsky' => 'Sikorsky',
                        'diamond' => 'Diamond',
                        'cirrus' => 'Cirrus',
                        'tecnam' => 'Tecnam',
                        'otro' => 'Otro',
                    ])
                    ->searchable(),
                Forms\Components\TextInput::make('numero_serie')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\TextInput::make('numero_parte')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\Select::make('fabricante_id')
                    ->label('Fabricante')
                    ->relationship('fabricante', 'nombre')
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('estado')
                    ->label('Estado')
                    ->options([
                        'activo' => 'Activo',
                        'inactivo' => 'Inactivo',
                        'mantenimiento' => 'Mantenimiento',
                    ])
                    ->required(),
                Forms\Components\Select::make('hangar_id')
                    ->label('Hangar')
                    ->relationship('hangar', 'nombre')
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('documento_legal')
                    ->maxLength(50)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('matricula')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipo'),
                Tables\Columns\TextColumn::make('modelo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('marca'),
                Tables\Columns\TextColumn::make('numero_serie')
                    ->searchable(),
                Tables\Columns\TextColumn::make('numero_parte')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fabricante.nombre')
                    ->label('Fabricante')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('hangar.nombre')
                    ->label('Hangar')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('estado')
                    ->badge()
                    ->colors([
                        'success' => 'activo',
                        'warning' => 'mantenimiento',
                        'secondary' => 'inactivo',
                    ]),
                Tables\Columns\TextColumn::make('documento_legal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListAeronaves::route('/'),
            'create' => Pages\CreateAeronave::route('/create'),
            'edit' => Pages\EditAeronave::route('/{record}/edit'),
        ];
    }
}
