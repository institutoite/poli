<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Municipio;

class MunicipioSeeder extends Seeder
{
    public function run(): void
    {
        $provinciaIds = json_decode(file_get_contents(database_path('seeders/tmp_provincia_ids.json')), true);
        $municipios = [
            // Provincia: Andrés Ibáñez
            ['provincia' => 'Andrés Ibáñez', 'nombre' => 'Santa Cruz de la Sierra', 'codigo' => 'SCR'],
            ['provincia' => 'Andrés Ibáñez', 'nombre' => 'El Torno', 'codigo' => 'TOR'],
            ['provincia' => 'Andrés Ibáñez', 'nombre' => 'La Guardia', 'codigo' => 'LAG'],
            ['provincia' => 'Andrés Ibáñez', 'nombre' => 'Porongo', 'codigo' => 'POR'],
            ['provincia' => 'Andrés Ibáñez', 'nombre' => 'Cotoca', 'codigo' => 'COT'],
            // Provincia: Warnes
            ['provincia' => 'Warnes', 'nombre' => 'Warnes', 'codigo' => 'WAR'],
            ['provincia' => 'Warnes', 'nombre' => 'Okinawa Uno', 'codigo' => 'OKI'],
            // Provincia: Ichilo
            ['provincia' => 'Ichilo', 'nombre' => 'Yapacaní', 'codigo' => 'YAP'],
            ['provincia' => 'Ichilo', 'nombre' => 'San Carlos', 'codigo' => 'SCA'],
            // Provincia: Sara
            ['provincia' => 'Sara', 'nombre' => 'Portachuelo', 'codigo' => 'POR'],
            ['provincia' => 'Sara', 'nombre' => 'Santa Rosa del Sara', 'codigo' => 'SRS'],
            // Provincia: Velasco
            ['provincia' => 'Velasco', 'nombre' => 'San Ignacio de Velasco', 'codigo' => 'SIV'],
            ['provincia' => 'Velasco', 'nombre' => 'San Miguel de Velasco', 'codigo' => 'SMV'],
        ];

        $municipioIds = [];
        foreach ($municipios as $municipio) {
            $provincia_id = $provinciaIds[$municipio['provincia']] ?? null;
            if ($provincia_id) {
                $municipioModel = \App\Models\Municipio::updateOrCreate(
                    ['provincia_id' => $provincia_id, 'nombre' => $municipio['nombre']],
                    ['codigo' => $municipio['codigo']]
                );
                $municipioIds[$municipio['nombre']] = $municipioModel->id;
            }
        }
        file_put_contents(database_path('seeders/tmp_municipio_ids.json'), json_encode($municipioIds));
    }
}