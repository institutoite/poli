<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Municipio;

class MunicipioSeeder extends Seeder
{
    public function run(): void
    {
        $municipios = [
            // Provincia: Murillo
            ['provincia_id' => 1, 'nombre' => 'La Paz', 'codigo' => 'LPZ'],
            ['provincia_id' => 1, 'nombre' => 'El Alto', 'codigo' => 'ALT'],
            ['provincia_id' => 1, 'nombre' => 'Viacha', 'codigo' => 'VIA'],

            // Provincia: Pacajes
            ['provincia_id' => 2, 'nombre' => 'Achacachi', 'codigo' => 'ACH'],
            ['provincia_id' => 2, 'nombre' => 'Pucarani', 'codigo' => 'PUC'],

            // Provincia: Cercado
            ['provincia_id' => 3, 'nombre' => 'Cochabamba', 'codigo' => 'CBB'],
            ['provincia_id' => 3, 'nombre' => 'Quillacollo', 'codigo' => 'QUI'],

            // Provincia: Andrés Ibáñez
            ['provincia_id' => 4, 'nombre' => 'Santa Cruz de la Sierra', 'codigo' => 'SCR'],
            ['provincia_id' => 4, 'nombre' => 'Warnes', 'codigo' => 'WAR'],
        ];

        foreach ($municipios as $municipio) {
            Municipio::updateOrInsert(
                ['provincia_id' => $municipio['provincia_id'], 'nombre' => $municipio['nombre']],
                ['codigo' => $municipio['codigo']]
            );
        }
    }
}