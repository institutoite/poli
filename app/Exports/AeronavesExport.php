<?php

namespace App\Exports;

use App\Models\Aeronave;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AeronavesExport implements FromCollection, WithHeadings
{
    /**
     * Devuelve los datos a exportar.
     */
    public function collection()
    {
        return Aeronave::with(['fabricante', 'hangar'])->get()->map(function ($aeronave) {
            // Calcular el valor de 'ultima_accion'
            $ultimaAccion = $aeronave->ultima_accion ?? 'Sin registros';

            return [
                'matricula' => $aeronave->matricula,
                'tipo' => $aeronave->tipo,
                'modelo' => $aeronave->modelo,
                'marca' => $aeronave->marca,
                'numero_serie' => $aeronave->numero_serie,
                'numero_parte' => $aeronave->numero_parte,
                'fabricante' => $aeronave->fabricante->nombre ?? 'N/A',
                'hangar' => $aeronave->hangar->nombre ?? 'N/A',
                'estado' => $aeronave->estado,
                'ultima_accion' => $ultimaAccion, // Agregar la última acción
                'created_at' => $aeronave->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $aeronave->updated_at->format('Y-m-d H:i:s'),
            ];
        });
    }

    /**
     * Encabezados de las columnas.
     */
    public function headings(): array
    {
        return [
            'Matrícula',
            'Tipo',
            'Modelo',
            'Marca',
            'Número de Serie',
            'Número de Parte',
            'Fabricante',
            'Hangar',
            'Estado',
            'Última Acción', // Encabezado para la columna
            'Fecha de Creación',
            'Última Actualización',
        ];
    }
}
