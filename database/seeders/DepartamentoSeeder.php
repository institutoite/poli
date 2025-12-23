<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departamento;

class DepartamentoSeeder extends Seeder
{
    public function run(): void
    {
        $departamento = ['nombre' => 'Santa Cruz', 'codigo' => 'SC'];
        $departamentoId = \App\Models\Departamento::updateOrCreate(
            ['nombre' => $departamento['nombre']],
            ['codigo' => $departamento['codigo']]
        )->id;
        // Guardar el ID para usarlo en otros seeders si es necesario
        file_put_contents(database_path('seeders/tmp_departamento_id.txt'), $departamentoId);
    }
}