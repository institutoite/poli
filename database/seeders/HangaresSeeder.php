<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HangaresSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['nombre' => 'Hangar A', 'codigo' => 'H-A', 'ubicacion' => 'Base Central'],
            ['nombre' => 'Hangar B', 'codigo' => 'H-B', 'ubicacion' => 'Base Central'],
            ['nombre' => 'Hangar 1', 'codigo' => 'H-1', 'ubicacion' => 'Aeropuerto'],
        ];

        foreach ($rows as $r) {
            DB::table('hangares')->updateOrInsert(
                ['nombre' => $r['nombre']],
                ['codigo' => $r['codigo'], 'ubicacion' => $r['ubicacion']]
            );
        }
    }
}
