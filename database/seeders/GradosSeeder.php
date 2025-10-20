<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grado;

class GradosSeeder extends Seeder
{
    public function run(): void
    {
        // Referencial (Policía Boliviana - ejemplo de estructura)
        $grados = [
            ['nombre' => 'Sargento 2º', 'orden' => 1],
            ['nombre' => 'Sargento 1º', 'orden' => 2],
            ['nombre' => 'Sof. Suboficial 2º', 'orden' => 3],
            ['nombre' => 'Sof. Suboficial 1º', 'orden' => 4],
            ['nombre' => 'Sof. Técnico de 3ra', 'orden' => 5],
            ['nombre' => 'Sof. Técnico de 2da', 'orden' => 6],
            ['nombre' => 'Sof. Técnico de 1ra', 'orden' => 7],
            ['nombre' => 'Alferez', 'orden' => 8],
            ['nombre' => 'Teniente', 'orden' => 9],
            ['nombre' => 'Capitán', 'orden' => 10],
            ['nombre' => 'Mayor', 'orden' => 11],
            ['nombre' => 'Teniente Coronel', 'orden' => 12],
            ['nombre' => 'Coronel', 'orden' => 13],
            ['nombre' => 'General', 'orden' => 14],
        ];

        foreach ($grados as $g) {
            Grado::query()->updateOrCreate(
                ['nombre' => $g['nombre']],
                ['orden' => $g['orden']]
            );
        }
    }
}
