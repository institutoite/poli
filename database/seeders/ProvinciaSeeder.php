<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provincia;

class ProvinciaSeeder extends Seeder
{
    public function run(): void
    {
        $departamentoId = (int) file_get_contents(database_path('seeders/tmp_departamento_id.txt'));
        $provincias = [
            ['nombre' => 'Andrés Ibáñez', 'codigo' => 'AND'],
            ['nombre' => 'Warnes', 'codigo' => 'WAR'],
            ['nombre' => 'Ichilo', 'codigo' => 'ICH'],
            ['nombre' => 'Sara', 'codigo' => 'SAR'],
            ['nombre' => 'Velasco', 'codigo' => 'VEL'],
            ['nombre' => 'Chiquitos', 'codigo' => 'CHQ'],
            ['nombre' => 'Cordillera', 'codigo' => 'COR'],
            ['nombre' => 'Florida', 'codigo' => 'FLO'],
            ['nombre' => 'Germán Busch', 'codigo' => 'GBU'],
            ['nombre' => 'Guarayos', 'codigo' => 'GUA'],
            ['nombre' => 'Obispo Santistevan', 'codigo' => 'OBS'],
            ['nombre' => 'Ángel Sandoval', 'codigo' => 'SAN'],
            ['nombre' => 'Manuel María Caballero', 'codigo' => 'MMC'],
            ['nombre' => 'Ñuflo de Chávez', 'codigo' => 'NCH'],
            ['nombre' => 'Vallegrande', 'codigo' => 'VAL'],
        ];

        $provinciaIds = [];
        foreach ($provincias as $provincia) {
            $provinciaModel = \App\Models\Provincia::updateOrCreate(
                ['departamento_id' => $departamentoId, 'nombre' => $provincia['nombre']],
                ['codigo' => $provincia['codigo']]
            );
            $provinciaIds[$provincia['nombre']] = $provinciaModel->id;
        }
        file_put_contents(database_path('seeders/tmp_provincia_ids.json'), json_encode($provinciaIds));
    }
}