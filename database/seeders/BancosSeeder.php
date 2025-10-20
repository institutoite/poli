<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banco;

class BancosSeeder extends Seeder
{
    public function run(): void
    {
        $bancos = [
            ['nombre' => 'Banco Nacional de Bolivia', 'codigo' => 'BNB'],
            ['nombre' => 'Banco Mercantil Santa Cruz', 'codigo' => 'BMSC'],
            ['nombre' => 'Banco Unión', 'codigo' => 'UNION'],
            ['nombre' => 'Banco Ganadero', 'codigo' => 'GAN'],
            ['nombre' => 'Banco Económico', 'codigo' => 'BEC'],
            ['nombre' => 'Banco de Crédito BCP', 'codigo' => 'BCP'],
            ['nombre' => 'BancoSol', 'codigo' => 'BANCOSOL'],
            ['nombre' => 'Banco PRODEM', 'codigo' => 'PRODEM'],
            ['nombre' => 'Banco Fortaleza', 'codigo' => 'FORTALEZA'],
        ];

        foreach ($bancos as $row) {
            Banco::query()->updateOrCreate(
                ['nombre' => $row['nombre']],
                ['codigo' => $row['codigo']]
            );
        }
    }
}
