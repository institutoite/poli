<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Zona;

class ZonaSeeder extends Seeder
{
    public function run(): void
    {
        $zonas = [
            ['municipio_id' => 1, 'nombre' => 'Centro'],
            ['municipio_id' => 1, 'nombre' => 'Miraflores'],
            ['municipio_id' => 2, 'nombre' => 'Ciudad Satélite'],
            ['municipio_id' => 3, 'nombre' => 'Villa Tunari'],
        ];

        foreach ($zonas as $zona) {
            Zona::updateOrInsert(
                ['municipio_id' => $zona['municipio_id'], 'nombre' => $zona['nombre']],
                []
            );
        }
    }
}