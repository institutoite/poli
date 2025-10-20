<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PoliceOfficerResource\Pages;
use App\Filament\Resources\PoliceOfficerResource\RelationManagers;
use App\Models\PoliceOfficer;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Municipio;
use App\Models\Zona;
use App\Models\Barrio;
use App\Models\Nacionalidad;
use App\Models\Banco;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PoliceOfficerResource extends Resource
{
    protected static ?string $model = PoliceOfficer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('nombres')
                            ->required()
                            ->maxLength(25),
                        Forms\Components\TextInput::make('apellido_paterno')
                            ->required()
                            ->maxLength(25),
                        Forms\Components\TextInput::make('apellido_materno')
                            ->maxLength(25)
                            ->default(null),
                    ]),
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('documento_identidad')
                            ->label('Documento Identidad')
                            ->required()
                            ->maxLength(25),
                        Forms\Components\Select::make('documento_expedido')
                            ->label('Expedido Documento')
                            ->required()
                            ->options([
                                'LP' => 'La Paz',
                                'CB' => 'Cochabamba',
                                'SC' => 'Santa Cruz',
                                'OR' => 'Oruro',
                                'PT' => 'Potosí',
                                'TJ' => 'Tarija',
                                'CH' => 'Chuquisaca',
                                'BE' => 'Beni',
                                'PD' => 'Pando',
                            ])
                            ->default(null),
                        Forms\Components\TextInput::make('codigo_escalafon')
                            ->label('Código Escalafón')
                            ->maxLength(25)
                            ->default(null),
                    ]),
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\Select::make('nacionalidad_id')
                            ->label('Nacionalidad')
                            ->required()
                            ->options(fn () => Nacionalidad::all()->pluck('nombre', 'id')),
                        Forms\Components\Select::make('banco_id')
                            ->label('Banco')
                            ->required()
                            ->options(fn () => Banco::all()->pluck('nombre', 'id')),
                    ]),
                Forms\Components\Select::make('grado_id')
                    ->relationship('grado', 'nombre')
                    ->required(),
                Forms\Components\Select::make('categoria_licencia_conducir')
                    ->options([
                        'A' => 'A',
                        'B' => 'B',
                        'C' => 'C',
                        'M' => 'M',
                        'P' => 'P',
                        'T' => 'T',
                        'Ninguna' => 'Ninguna',
                    ])
                    ->default(null),
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('direccion')
                            ->label('Dirección')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('telefono')
                            ->label('Teléfono')
                            ->required()
                            ->tel()
                            ->maxLength(25),
                    ]),
                Forms\Components\TextInput::make('celular')
                    ->maxLength(25)
                    ->default(null),
                Forms\Components\Select::make('genero')
                    ->options([
                        'masculino' => 'Masculino',
                        'femenino' => 'Femenino',
                        'otro' => 'Otro',
                    ])
                    ->default(null),
                Forms\Components\DatePicker::make('fecha_nacimiento'),
                Forms\Components\Select::make('departamento_id')
                    ->relationship('departamento', 'nombre')
                    ->required()
                    ->reactive()
                    ->searchable()
                    ->options(fn () => Departamento::all()->pluck('nombre', 'id')),
                Forms\Components\Select::make('provincia_id')
                    ->label('Provincia')
                    ->required()
                    ->reactive()
                    ->searchable()
                    ->options(function ($get) {
                        $departamentoId = $get('departamento_id');
                        return $departamentoId ? Provincia::where('departamento_id', $departamentoId)->pluck('nombre', 'id')->toArray() : [];
                    })
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('municipio_id', null);
                    }),
                Forms\Components\Select::make('municipio_id')
                    ->label('Municipio')
                    ->required()
                    ->reactive()
                    ->searchable()
                    ->options(function ($get) {
                        $provinciaId = $get('provincia_id');
                        return $provinciaId ? Municipio::where('provincia_id', $provinciaId)->pluck('nombre', 'id')->toArray() : [];
                    })
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('zona_id', null);
                    }),
                Forms\Components\Select::make('zona_id')
                    ->label('Zona')
                    ->required()
                    ->reactive()
                    ->searchable()
                    ->options(function ($get) {
                        $municipioId = $get('municipio_id');
                        return $municipioId ? Zona::where('municipio_id', $municipioId)->pluck('nombre', 'id')->toArray() : [];
                    })
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('barrio_id', null);
                    }),
                Forms\Components\Select::make('barrio_id')
                    ->label('Barrio')
                    ->required()
                    ->reactive()
                    ->searchable()
                    ->options(function ($get) {
                        $zonaId = $get('zona_id');
                        return $zonaId ? Barrio::where('zona_id', $zonaId)->pluck('nombre', 'id')->toArray() : [];
                    }),
                Forms\Components\TextInput::make('cuenta_bancaria')
                    ->maxLength(25)
                    ->default(null),
                Forms\Components\TextInput::make('croquis_domicilio')
                    ->maxLength(25)
                    ->default(null),
                Forms\Components\TextInput::make('coordenada_x')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('coordenada_y')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('correo')
                    ->email()
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\Select::make('grupo_factor_sangre')
                    ->options([
                        'A+' => 'A+',
                        'A-' => 'A-',
                        'B+' => 'B+',
                        'B-' => 'B-',
                        'AB+' => 'AB+',
                        'AB-' => 'AB-',
                        'O+' => 'O+',
                        'O-' => 'O-',
                    ])
                    ->default(null),
                Forms\Components\TextInput::make('contacto_emergencia')
                    ->maxLength(50)
                    ->default(null),
                Forms\Components\TextInput::make('telefono_emergencia')
                    ->tel()
                    ->maxLength(25)
                    ->default(null),
                Forms\Components\Select::make('parentesco_contacto_emergencia')
                    ->options([
                        'Padre' => 'Padre',
                        'Madre' => 'Madre',
                        'Hermano/a' => 'Hermano/a',
                        'Esposo/a' => 'Esposo/a',
                        'Hijo/a' => 'Hijo/a',
                        'Otro' => 'Otro',
                    ])
                    ->default(null),
                Forms\Components\FileUpload::make('croquis_domicilio')
                    ->image()
                    ->directory('croquis')
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombres')
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellido_paterno')
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellido_materno')
                    ->searchable(),
                Tables\Columns\TextColumn::make('documento_identidad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('expedido_documento')
                    ->searchable(),
                Tables\Columns\TextColumn::make('codigo_escalafon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nacionalidad.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('grado.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('banco.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('categoria_licencia_conducir'),
                Tables\Columns\TextColumn::make('direccion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('celular')
                    ->searchable(),
                Tables\Columns\TextColumn::make('genero'),
                Tables\Columns\TextColumn::make('fecha_nacimiento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('departamento.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('provincia.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('municipio.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('zona.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('barrio.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cuenta_bancaria')
                    ->searchable(),
                Tables\Columns\TextColumn::make('croquis_domicilio')
                    ->searchable(),
                Tables\Columns\TextColumn::make('coordenada_x')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('coordenada_y')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('correo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('grupo_factor_sangre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contacto_emergencia')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefono_emergencia')
                    ->searchable(),
                Tables\Columns\TextColumn::make('parentesco_contacto_emergencia')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
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
            'index' => Pages\ListPoliceOfficers::route('/'),
            'create' => Pages\CreatePoliceOfficer::route('/create'),
            'edit' => Pages\EditPoliceOfficer::route('/{record}/edit'),
        ];
    }
}
