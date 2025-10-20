<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('police_officers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            // Datos personales principales
            $table->string('nombres',25);
            $table->string('apellido_paterno',25);
            $table->string('apellido_materno',25)->nullable();
            $table->string('documento_identidad',25)->unique();
            $table->enum('expedido_documento', ['LP', 'CB', 'SC', 'OR', 'PT', 'TJ', 'CH', 'BE', 'PD'])->nullable();
            $table->string('codigo_escalafon',25)->nullable()->unique();

            // Foráneas a catálogos
            $table->foreignId('nacionalidad_id')->nullable()->constrained('nacionalidades')->nullOnDelete();
            $table->foreignId('grado_id')->constrained('grados');
            $table->foreignId('banco_id')->constrained('bancos');

            // Licencia de conducir enum
            $table->enum('categoria_licencia_conducir', ['A','B','C','M','P','T','Ninguna'])->nullable();

            // Contacto y demografía
            $table->string('direccion', 100)->nullable();
            $table->string('telefono', 25)->nullable();
            $table->string('celular', 25)->nullable();
            $table->enum('genero', ['masculino', 'femenino', 'otro'])->nullable();
            $table->date('fecha_nacimiento')->nullable();

            // Ubicación jerárquica
            $table->foreignId('departamento_id')->constrained('departamentos');
            $table->foreignId('provincia_id')->constrained('provincias');
            $table->foreignId('municipio_id')->constrained('municipios');
            $table->foreignId('zona_id')->constrained('zonas');
            $table->foreignId('barrio_id')->constrained('barrios');

            // Otros datos
            $table->string('cuenta_bancaria', 25)->nullable();
            $table->string('croquis_domicilio',25)->nullable();
            $table->decimal('coordenada_x', 10, 7)->nullable(); // longitud
            $table->decimal('coordenada_y', 10, 7)->nullable(); // latitud
            $table->string('correo', 50)->nullable()->unique();
            $table->string('grupo_factor_sangre', 10)->nullable();
            $table->string('contacto_emergencia', 50)->nullable();
            $table->string('telefono_emergencia', 25)->nullable();
            $table->string('parentesco_contacto_emergencia', 25)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        // Pivot para idiomas hablados por el oficial
        Schema::create('idioma_police_officer', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('police_officer_id')->constrained('police_officers')->cascadeOnDelete();
            $table->foreignId('idioma_id')->constrained('idiomas')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['police_officer_id','idioma_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('idioma_police_officer');
        Schema::dropIfExists('police_officers');
    }
};
