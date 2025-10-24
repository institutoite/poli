<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FabricantesSeeder extends Seeder
{
    public function run(): void
    {
        $fabricantes = [
            ['nombre' => 'Cessna', 'pais' => 'Estados Unidos'],
            ['nombre' => 'Piper', 'pais' => 'Estados Unidos'],
            ['nombre' => 'Beechcraft', 'pais' => 'Estados Unidos'],
            ['nombre' => 'Airbus', 'pais' => 'Europa'],
            ['nombre' => 'Boeing', 'pais' => 'Estados Unidos'],
            ['nombre' => 'Embraer', 'pais' => 'Brasil'],
            ['nombre' => 'Bombardier', 'pais' => 'Canadá'],
            ['nombre' => 'Bell', 'pais' => 'Estados Unidos'],
            ['nombre' => 'Robinson', 'pais' => 'Estados Unidos'],
            ['nombre' => 'Sikorsky', 'pais' => 'Estados Unidos'],
            ['nombre' => 'Diamond', 'pais' => 'Austria'],
            ['nombre' => 'Cirrus', 'pais' => 'Estados Unidos'],
            ['nombre' => 'Tecnam', 'pais' => 'Italia'],
        ];

        foreach ($fabricantes as $f) {
            DB::table('fabricantes')->updateOrInsert(
                ['nombre' => $f['nombre']],
                ['pais' => $f['pais']]
            );
        }
    }
}
