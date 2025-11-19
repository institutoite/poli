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
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AeronavesExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;

class AeronaveResource extends Resource
{
    protected static ?string $model = Aeronave::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Aeronaves';
    protected static ?string $navigationGroup = 'Inventario aéreo';
    protected static ?int $navigationSort = 2;
    protected static bool $shouldRegisterNavigation = true;

    public static function getModelLabel(): string
    {
        return 'Aeronave';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Aeronaves';
    }

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
                        'ala fija' => 'Avión (Ala fija)',
                        'ala rotatoria' => 'Helicóptero (Ala rotatoria)',
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
                Forms\Components\Textarea::make('documento_legal')
                    ->label('Documento legal')
                    ->rows(2)
                    ->columnSpanFull(),
            Forms\Components\FileUpload::make('documento')
                ->label('Documento')
                ->directory('documentos') // Carpeta donde se guardarán los archivos
                ->required()
                ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('matricula')->searchable(),
                Tables\Columns\TextColumn::make('tipo'),
                Tables\Columns\TextColumn::make('modelo')->searchable(),
                Tables\Columns\TextColumn::make('marca'),
                Tables\Columns\TextColumn::make('numero_serie')->searchable(),
                Tables\Columns\TextColumn::make('numero_parte')->searchable(),
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
                Tables\Columns\TextColumn::make('documento')
                    ->label('Documento')
                    ->formatStateUsing(fn () => 'Descargar')
                    ->url(fn (Aeronave $record) => $record->documento ? asset('storage/' . $record->documento) : null)
                    ->openUrlInNewTab()
                    ->tooltip('Descargar documento')
                    ->extraAttributes(['class' => 'text-primary-600 font-semibold underline']),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('ultima_accion')
                    ->label('Última Acción')
                    ->sortable()
                    ->getStateUsing(fn (Aeronave $record) => $record->ultima_accion),
            ])
            ->filters([
                Tables\Filters\Filter::make('tipo')
                    ->form([
                        Forms\Components\Radio::make('tipo')
                            ->label('Filtrar por tipo')
                            ->options([
                                'ala fija' => 'Ala fija',
                                'ala rotatoria' => 'Ala rotatoria',
                            ])
                            ->inline()
                            ->columnSpanFull(),
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (!empty($data['tipo'])) {
                            $query->where('tipo', $data['tipo']);
                        }
                        return $query;
                    })
                    ->indicateUsing(function (array $data) {
                        if (!empty($data['tipo'])) {
                            return 'Tipo: ' . ($data['tipo'] === 'ala fija' ? 'Ala fija' : 'Ala rotatoria');
                        }
                        return null;
                    }),
            ])
            ->headerActions([
                Tables\Actions\Action::make('exportExcel')
                    ->label('Exportar a Excel')
                    ->action(function () {
                        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\AeronavesExport, 'aeronaves.xlsx');
                    }),
                Tables\Actions\Action::make('exportWord')
                    ->label('Exportar a Word')
                    ->disabled() // Botón deshabilitado
                    ->tooltip('Muy pronto disponible'), // Mensaje al pasar el cursor
                Tables\Actions\Action::make('exportPdf')
                    ->label('Exportar a PDF')
                    ->disabled() // Botón deshabilitado
                    ->tooltip('Muy pronto disponible'), // Mensaje al pasar el cursor
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Editar'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->label('Eliminar seleccionados')
                    ->modalHeading('Eliminar registros seleccionados')
                    ->modalSubmitActionLabel('Eliminar')
                    ->modalCancelActionLabel('Cancelar'),
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
