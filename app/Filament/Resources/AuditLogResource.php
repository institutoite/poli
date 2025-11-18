<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuditLogResource\Pages;
use App\Models\AuditLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class AuditLogResource extends Resource
{
    protected static ?string $model = AuditLog::class; // Asegúrate de que el tipo sea ?string

    protected static ?string $navigationIcon = 'heroicon-o-clipboard'; // Cambia a un ícono válido
    protected static ?string $navigationLabel = 'Historial de Auditoría';
    protected static ?string $pluralLabel = 'Historial de Auditoría';
    protected static ?string $navigationGroup = 'Administración';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuario')
                    ->sortable()
                    ->searchable(),
                /*Tables\Columns\TextColumn::make('model_type')
                    ->label('Objeto')
                    ->sortable()
                    ->searchable(),*/
                Tables\Columns\TextColumn::make('model_type')
                    ->label('Objeto')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($state) => class_basename($state)),
                Tables\Columns\TextColumn::make('model_id')
                    ->label('ID del Objeto')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('action')
                    ->label('Acción')
                    ->colors([
                        'success' => 'creado',
                        'warning' => 'actualizado',
                        'danger' => 'eliminado',
                        'primary' => 'restaurado',
                    ]),
                Tables\Columns\TextColumn::make('changes')
                    ->label('Cambios')
                    ->formatStateUsing(fn ($state) => $state ? json_encode($state) : 'N/A')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha')
                    ->sortable()
                    ->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                SelectFilter::make('action')
                    ->label('Acción')
                    ->options([
                        'creado' => 'Creación',
                        'actualizado' => 'Actualización',
                        'eliminado' => 'Eliminación',
                        'restaurado' => 'Restauración',
                    ]),
                Filter::make('created_at')
                    ->label('Fecha')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')->label('Desde'),
                        Forms\Components\DatePicker::make('created_until')->label('Hasta'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['created_from'], fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
                            ->when($data['created_until'], fn ($query, $date) => $query->whereDate('created_at', '<=', $date));
                    }),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAuditLogs::route('/'),
        ];
    }
}
