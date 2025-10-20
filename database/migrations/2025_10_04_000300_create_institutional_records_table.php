<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('institutional_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('police_officer_id')->constrained('police_officers')->cascadeOnDelete();

            // Datos institucionales
            $table->date('fecha_ingreso_institucion')->nullable();
            $table->string('direccion_policial')->nullable();
            $table->date('fecha_destino_direccion')->nullable();
            $table->string('direccion_policial_procedente')->nullable();

            // Unidad o dirección
            $table->string('unidad_o_direccion_actual')->nullable();
            $table->date('fecha_alta_nueva_unidad')->nullable();
            $table->string('numero_memorial_alta')->nullable();
            $table->date('fecha_cambio_destino')->nullable();
            $table->string('memorandum_cambio_destino')->nullable();
            $table->unsignedSmallInteger('anios_servicio')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institutional_records');
    }
};
