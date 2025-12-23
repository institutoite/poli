<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grado;

class GradosSeeder extends Seeder
{
    public function run(): void
    {
        // Grados actualizados según la lista proporcionada
        $grados = [
            ['nombre' => 'Gral. 1ro.', 'orden' => 1],
            ['nombre' => 'Gral.', 'orden' => 2],
            ['nombre' => 'Cnl. DESP', 'orden' => 3],
            ['nombre' => 'Tcnl. DEAP.', 'orden' => 4],
            ['nombre' => 'My.', 'orden' => 5],
            ['nombre' => 'Cap.', 'orden' => 6],
            ['nombre' => 'Tte.', 'orden' => 7],
            ['nombre' => 'Sbtte.', 'orden' => 8],
            ['nombre' => 'Sof. My.', 'orden' => 9],
            ['nombre' => 'Sof. 1ro.', 'orden' => 10],
            ['nombre' => 'Sof. 2do.', 'orden' => 11],
            ['nombre' => 'Sgto. My.', 'orden' => 12],
            ['nombre' => 'Sgto. 1ro.', 'orden' => 13],
            ['nombre' => 'Sgto. 2do.', 'orden' => 14],
            ['nombre' => 'Sgto.', 'orden' => 15],
        ];

        foreach ($grados as $g) {
            Grado::query()->updateOrCreate(
                ['nombre' => $g['nombre']],
                ['orden' => $g['orden']]
            );
        }
    }
}
