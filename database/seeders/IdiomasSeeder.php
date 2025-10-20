<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Idioma;

class IdiomasSeeder extends Seeder
{
    public function run(): void
    {
        $idiomas = [
            ['nombre' => 'Español', 'codigo_iso' => 'es'],
            ['nombre' => 'Quechua', 'codigo_iso' => 'qu'],
            ['nombre' => 'Aymara', 'codigo_iso' => 'ay'],
            ['nombre' => 'Guaraní', 'codigo_iso' => 'gn'],
            ['nombre' => 'Inglés', 'codigo_iso' => 'en'],
            ['nombre' => 'Portugués', 'codigo_iso' => 'pt'],
        ];

        foreach ($idiomas as $row) {
            Idioma::query()->updateOrCreate(
                ['nombre' => $row['nombre']],
                ['codigo_iso' => $row['codigo_iso']]
            );
        }
    }
}
