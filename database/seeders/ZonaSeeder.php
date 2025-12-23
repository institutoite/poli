<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Zona;

class ZonaSeeder extends Seeder
{
    public function run(): void
    {
        $municipioIds = json_decode(file_get_contents(database_path('seeders/tmp_municipio_ids.json')), true);
        $zonas = [
            // Santa Cruz de la Sierra
            ['municipio' => 'Santa Cruz de la Sierra', 'nombre' => 'Centro'],
            ['municipio' => 'Santa Cruz de la Sierra', 'nombre' => 'Equipetrol'],
            ['municipio' => 'Santa Cruz de la Sierra', 'nombre' => 'Villa Primero de Mayo'],
            ['municipio' => 'Santa Cruz de la Sierra', 'nombre' => 'Plan 3000'],
            // Warnes
            ['municipio' => 'Warnes', 'nombre' => 'Warnes Centro'],
            ['municipio' => 'Warnes', 'nombre' => 'Satélite Norte'],
            // El Torno
            ['municipio' => 'El Torno', 'nombre' => 'El Torno Centro'],
            // Yapacaní
            ['municipio' => 'Yapacaní', 'nombre' => 'Yapacaní Centro'],
        ];

        $zonaIds = [];
        foreach ($zonas as $zona) {
            $municipio_id = $municipioIds[$zona['municipio']] ?? null;
            if ($municipio_id) {
                $zonaModel = \App\Models\Zona::updateOrCreate(
                    ['municipio_id' => $municipio_id, 'nombre' => $zona['nombre']],
                    []
                );
                $zonaIds[$zona['nombre'].'_'.$zona['municipio']] = $zonaModel->id;
            }
        }
        file_put_contents(database_path('seeders/tmp_zona_ids.json'), json_encode($zonaIds));
    }
}