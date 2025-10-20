<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Municipio;
use App\Models\Zona;
use App\Models\Barrio;

class UbicacionesSeeder extends Seeder
{
    public function run(): void
    {
        // Datos representativos de Bolivia (lista parcial con ejemplos reales)
        $data = [
            'La Paz' => [
                'codigo' => 'LP',
                'provincias' => [
                    'Murillo' => [
                        'codigo' => 'MUR',
                        'municipios' => [
                            'La Paz' => [
                                'zonas' => [
                                    'Centro' => ['barrios' => ['San Sebastián','San Jorge','Sopocachi']],
                                    'Max Paredes' => ['barrios' => ['Villa Fátima','El Tejar']],
                                ],
                            ],
                            'El Alto' => [
                                'zonas' => [
                                    'Distrito 1' => ['barrios' => ['Villa Adela','Ceja']],
                                    'Distrito 3' => ['barrios' => ['Villa Bolívar A','Santiago II']],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'Cochabamba' => [
                'codigo' => 'CB',
                'provincias' => [
                    'Cercado' => [
                        'codigo' => 'CER',
                        'municipios' => [
                            'Cochabamba' => [
                                'zonas' => [
                                    'Centro' => ['barrios' => ['Queru Queru','Recoleta','Huayra K’asa']],
                                    'Sud' => ['barrios' => ['Alalay','Sarcobamba']],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'Santa Cruz' => [
                'codigo' => 'SC',
                'provincias' => [
                    'Andrés Ibáñez' => [
                        'codigo' => 'AI',
                        'municipios' => [
                            'Santa Cruz de la Sierra' => [
                                'zonas' => [
                                    'Centro' => ['barrios' => ['Equipetrol','Hama Hama','Las Palmas']],
                                    'Pampa de la Isla' => ['barrios' => ['Plan 3000','Villa 1ro de Mayo']],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($data as $depNombre => $dep) {
            $departamento = Departamento::updateOrCreate(
                ['nombre' => $depNombre],
                ['codigo' => $dep['codigo']]
            );

            foreach ($dep['provincias'] as $provNombre => $prov) {
                $provincia = Provincia::updateOrCreate(
                    ['departamento_id' => $departamento->id, 'nombre' => $provNombre],
                    ['codigo' => $prov['codigo'] ?? null]
                );

                foreach ($prov['municipios'] as $munNombre => $mun) {
                    $municipio = Municipio::updateOrCreate(
                        ['provincia_id' => $provincia->id, 'nombre' => $munNombre],
                        ['codigo' => $mun['codigo'] ?? null]
                    );

                    foreach ($mun['zonas'] as $zonaNombre => $zona) {
                        $zonaModel = Zona::updateOrCreate(
                            ['municipio_id' => $municipio->id, 'nombre' => $zonaNombre],
                            []
                        );

                        foreach ($zona['barrios'] as $barrioNombre) {
                            Barrio::updateOrCreate(
                                ['zona_id' => $zonaModel->id, 'nombre' => $barrioNombre],
                                []
                            );
                        }
                    }
                }
            }
        }
    }
}
