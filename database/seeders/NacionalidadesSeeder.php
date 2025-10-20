<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nacionalidad;

class NacionalidadesSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nombre' => 'Boliviana', 'codigo' => 'BO'],
            ['nombre' => 'Peruana', 'codigo' => 'PE'],
            ['nombre' => 'Argentina', 'codigo' => 'AR'],
            ['nombre' => 'Chilena', 'codigo' => 'CL'],
            ['nombre' => 'Brasileña', 'codigo' => 'BR'],
            ['nombre' => 'Paraguaya', 'codigo' => 'PY'],
        ];

        foreach ($data as $row) {
            Nacionalidad::query()->updateOrCreate(
                ['nombre' => $row['nombre']],
                ['codigo' => $row['codigo']]
            );
        }
    }
}
