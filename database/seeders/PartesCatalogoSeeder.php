<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartesCatalogoSeeder extends Seeder
{
    public function run(): void
    {
        // Lista base sugerida (se puede ampliar con datos del Excel si se carga).
        $externas = [
            'Fuselaje','Empenaje','Cubiertas de motor','Cabina','Tren de aterrizaje','Hélices','Antenas','Luces','Tubo pitot','Parabrisas frontal','Puertas','Compartimiento de carga','Ventanas','Alas',
        ];
        $internas = [
            'Instrumentos','Gages de motor','Controles de vuelo','Asientos','Panel de circuitos','Cinturones de seguridad','Motor','Equipos nav/com','Llave',
        ];

        foreach ($externas as $nombre) {
            DB::table('catalogo_partes')->updateOrInsert(
                ['descripcion' => $nombre, 'ambito' => 'externa'],
                []
            );
        }
        foreach ($internas as $nombre) {
            DB::table('catalogo_partes')->updateOrInsert(
                ['descripcion' => $nombre, 'ambito' => 'interna'],
                []
            );
        }
    }
}
