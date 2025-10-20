<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barrio;

class BarrioSeeder extends Seeder
{
    public function run(): void
    {
        $barrios = [
            ['zona_id' => 1, 'nombre' => 'San Pedro'],
            ['zona_id' => 1, 'nombre' => 'Sopocachi'],
            ['zona_id' => 2, 'nombre' => 'Villa Fátima'],
            ['zona_id' => 3, 'nombre' => 'Villa Adela'],
        ];

        foreach ($barrios as $barrio) {
            Barrio::updateOrInsert(
                ['zona_id' => $barrio['zona_id'], 'nombre' => $barrio['nombre']],
                []
            );
        }
    }
}