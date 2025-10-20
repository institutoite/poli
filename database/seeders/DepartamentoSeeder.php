<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departamento;

class DepartamentoSeeder extends Seeder
{
    public function run(): void
    {
        $departamentos = [
            ['nombre' => 'La Paz', 'codigo' => 'LP'],
            ['nombre' => 'Cochabamba', 'codigo' => 'CB'],
            ['nombre' => 'Santa Cruz', 'codigo' => 'SC'],
            ['nombre' => 'Oruro', 'codigo' => 'OR'],
            ['nombre' => 'Potosí', 'codigo' => 'PT'],
            ['nombre' => 'Tarija', 'codigo' => 'TJ'],
            ['nombre' => 'Chuquisaca', 'codigo' => 'CH'],
            ['nombre' => 'Beni', 'codigo' => 'BE'],
            ['nombre' => 'Pando', 'codigo' => 'PD'],
        ];

        foreach ($departamentos as $departamento) {
            Departamento::updateOrInsert(
                ['nombre' => $departamento['nombre']],
                ['codigo' => $departamento['codigo']]
            );
        }
    }
}