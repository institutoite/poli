<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PoliceOfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cantidad = 10;
        $documentos = [];
        $correos = [];
        for ($i = 1; $i <= $cantidad; $i++) {
            try {
                // Obtener IDs de catálogos relacionados
                $nacionalidad_id = DB::table('nacionalidades')->inRandomOrder()->value('id');
                $grado_id = DB::table('grados')->inRandomOrder()->value('id');
                $banco_id = DB::table('bancos')->inRandomOrder()->value('id');
                $departamento_id = DB::table('departamentos')->inRandomOrder()->value('id');
                $provincia_id = DB::table('provincias')->inRandomOrder()->value('id');
                $municipio_id = DB::table('municipios')->inRandomOrder()->value('id');
                $zona_id = DB::table('zonas')->inRandomOrder()->value('id');
                $barrio_id = DB::table('barrios')->inRandomOrder()->value('id');

                // Generar datos únicos
                $documento = strval(1000000 + $i);
                $correo = 'oficial'.$i.'@example.com';
                $documentos[] = $documento;
                $correos[] = $correo;

                DB::table('police_officers')->insert([
                    [
                        'nombres' => 'Oficial'.$i,
                        'apellido_paterno' => 'ApellidoP'.$i,
                        'apellido_materno' => 'ApellidoM'.$i,
                        'documento_identidad' => $documento,
                        'expedido_documento' => 'LP',
                        'codigo_escalafon' => Str::random(8),
                        'nacionalidad_id' => $nacionalidad_id,
                        'grado_id' => $grado_id,
                        'banco_id' => $banco_id,
                        'cuenta_bancaria' => '10020030'.str_pad($i,2,'0',STR_PAD_LEFT),
                        'categoria_licencia_conducir' => 'B',
                        'direccion' => 'Calle Ejemplo '.$i,
                        'telefono' => '7000000'.strval($i),
                        'celular' => '7800000'.strval($i),
                        'genero' => $i%2==0 ? 'masculino' : 'femenino',
                        'fecha_nacimiento' => '199'.($i%10).'-0'.(($i%9)+1).'-1'.($i%9),
                        'departamento_id' => $departamento_id,
                        'provincia_id' => $provincia_id,
                        'municipio_id' => $municipio_id,
                        'zona_id' => $zona_id,
                        'barrio_id' => $barrio_id,
                        'croquis_domicilio' => null,
                        'coordenada_x' => null,
                        'coordenada_y' => null,
                        'correo' => $correo,
                        'grupo_factor_sangre' => 'O+',
                        'contacto_emergencia' => 'Contacto'.$i,
                        'telefono_emergencia' => '7600000'.strval($i),
                        'parentesco_contacto_emergencia' => 'Familiar',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ]);
            } catch (\Throwable $e) {
                dump('Seeder error: ' . $e->getMessage());
            }
        }
    }
}
