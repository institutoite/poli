<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('studies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('police_officer_id')->constrained('police_officers')->cascadeOnDelete();

            // Estudios de bachillerato
            $table->string('unidad_educativa_bachillerato')->nullable();
            $table->date('fecha_graduacion_secundaria')->nullable();
            $table->string('municipio_egreso_secundaria')->nullable();
            $table->string('titulo_bachiller')->nullable();

            // Estudios universitarios
            $table->unsignedSmallInteger('numero_semestres_aprobados')->nullable();
            $table->string('institucion_formacion')->nullable();
            $table->string('titulo_profesional')->nullable();
            $table->date('fecha_graduacion_universitaria')->nullable();
            $table->string('departamento_egreso')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('studies');
    }
};
