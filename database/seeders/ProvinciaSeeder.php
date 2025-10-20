<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provincia;

class ProvinciaSeeder extends Seeder
{
    public function run(): void
    {
        $provincias = [
            ['departamento_id' => 1, 'nombre' => 'Murillo', 'codigo' => 'MUR'],
            ['departamento_id' => 1, 'nombre' => 'Pacajes', 'codigo' => 'PAC'],
            ['departamento_id' => 1, 'nombre' => 'Ingavi', 'codigo' => 'ING'],
            ['departamento_id' => 1, 'nombre' => 'Los Andes', 'codigo' => 'AND'],
            ['departamento_id' => 1, 'nombre' => 'Larecaja', 'codigo' => 'LAR'],

            ['departamento_id' => 2, 'nombre' => 'Cercado', 'codigo' => 'CER'],
            ['departamento_id' => 2, 'nombre' => 'Chapare', 'codigo' => 'CHA'],
            ['departamento_id' => 2, 'nombre' => 'Quillacollo', 'codigo' => 'QUI'],
            ['departamento_id' => 2, 'nombre' => 'Tapacarí', 'codigo' => 'TAP'],
            ['departamento_id' => 2, 'nombre' => 'Arque', 'codigo' => 'ARQ'],
            
            ['departamento_id' => 3, 'nombre' => 'Andrés Ibáñez', 'codigo' => 'AND'],
            ['departamento_id' => 3, 'nombre' => 'Warnes', 'codigo' => 'WAR'],
            ['departamento_id' => 3, 'nombre' => 'Ichilo', 'codigo' => 'ICH'],
            ['departamento_id' => 3, 'nombre' => 'Sara', 'codigo' => 'SAR'],
            ['departamento_id' => 3, 'nombre' => 'Velasco', 'codigo' => 'VEL'],
        ];

        foreach ($provincias as $provincia) {
            Provincia::updateOrInsert(
                ['departamento_id' => $provincia['departamento_id'], 'nombre' => $provincia['nombre']],
                ['codigo' => $provincia['codigo']]
            );
        }
    }
}