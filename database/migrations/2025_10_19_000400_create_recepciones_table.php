<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recepciones', function (Blueprint $table) {
            $table->id();
            // Datos Generales
            $table->string('lugar')->nullable();
            $table->date('fecha')->nullable();
            $table->string('formulario_no')->nullable();
            $table->string('aeropuerto')->nullable();
            $table->string('hangar')->nullable();
            // Condición de Permanencia
            $table->boolean('cond_custodio')->default(false);
            $table->boolean('cond_depositario')->default(false);
            $table->boolean('cond_comodato')->default(false);
            $table->string('numero_caso')->nullable();
            // Personal Investigación (referencia a policía si existe)
            $table->string('cargo')->nullable();
            $table->string('unidad')->nullable();
            $table->foreignId('grado_id')->nullable()->constrained('grados')->nullOnDelete();
            $table->string('nombres')->nullable();
            $table->string('celular')->nullable();
            $table->foreignId('police_officer_id')->nullable()->constrained('police_officers')->nullOnDelete();
            // Características de la aeronave
            $table->foreignId('aeronave_id')->nullable()->constrained('aeronaves')->nullOnDelete();
            $table->string('tipo_aeronave')->nullable();
            $table->string('matricula')->nullable();
            $table->string('procedencia')->nullable();
            $table->string('serie')->nullable();
            $table->string('modelo')->nullable();
            $table->string('marca')->nullable();
            $table->string('marca_motor')->nullable();
            $table->string('modelo_motor')->nullable();
            $table->string('marca_helices')->nullable();
            $table->string('palas')->nullable();
            $table->string('color')->nullable();
            $table->text('observaciones')->nullable();
            // Firma / autorización
            $table->string('firmado_por')->nullable();
            $table->string('cargo_firmante')->nullable();
            $table->timestamp('fecha_firma')->nullable();
            $table->timestamps();
        });

        Schema::create('catalogo_partes', function (Blueprint $table) {
            $table->id();
            $table->enum('ambito', ['externa', 'interna']);
            $table->string('descripcion');
            $table->timestamps();
            $table->unique(['ambito','descripcion']);
        });

        Schema::create('recepcion_partes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recepcion_id')->constrained('recepciones')->cascadeOnDelete();
            $table->enum('ambito', ['externa', 'interna']);
            $table->string('descripcion'); // e.g., Fuselaje, Instrumentos
            $table->unsignedInteger('cantidad')->default(0);
            $table->enum('estado', ['malo', 'regular', 'bueno'])->default('bueno');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
    Schema::dropIfExists('recepcion_partes');
    Schema::dropIfExists('catalogo_partes');
    Schema::dropIfExists('recepciones');
    }
};
