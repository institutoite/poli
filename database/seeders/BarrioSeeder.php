<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barrio;

class BarrioSeeder extends Seeder
{
    public function run(): void
    {
        $zonaIds = json_decode(file_get_contents(database_path('seeders/tmp_zona_ids.json')), true);
        $barrios = [
            // Centro (Santa Cruz de la Sierra)
            ['zona' => 'Centro', 'municipio' => 'Santa Cruz de la Sierra', 'nombre' => 'Barrio Urbari'],
            ['zona' => 'Centro', 'municipio' => 'Santa Cruz de la Sierra', 'nombre' => 'Barrio Hamacas'],
            // Equipetrol
            ['zona' => 'Equipetrol', 'municipio' => 'Santa Cruz de la Sierra', 'nombre' => 'Barrio Equipetrol'],
            // Villa Primero de Mayo
            ['zona' => 'Villa Primero de Mayo', 'municipio' => 'Santa Cruz de la Sierra', 'nombre' => 'Barrio Primavera'],
            // Plan 3000
            ['zona' => 'Plan 3000', 'municipio' => 'Santa Cruz de la Sierra', 'nombre' => 'Barrio 16 de Noviembre'],
            // Warnes Centro
            ['zona' => 'Warnes Centro', 'municipio' => 'Warnes', 'nombre' => 'Barrio Satélite'],
            // Satélite Norte
            ['zona' => 'Satélite Norte', 'municipio' => 'Warnes', 'nombre' => 'Barrio Satélite Norte'],
            // El Torno Centro
            ['zona' => 'El Torno Centro', 'municipio' => 'El Torno', 'nombre' => 'Barrio El Torno'],
            // Yapacaní Centro
            ['zona' => 'Yapacaní Centro', 'municipio' => 'Yapacaní', 'nombre' => 'Barrio Yapacaní'],
        ];

        foreach ($barrios as $barrio) {
            $zona_id = $zonaIds[$barrio['zona'].'_'.$barrio['municipio']] ?? null;
            if ($zona_id) {
                \App\Models\Barrio::updateOrCreate(
                    ['zona_id' => $zona_id, 'nombre' => $barrio['nombre']],
                    []
                );
            }
        }
    }
}