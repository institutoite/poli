<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aeronaves', function (Blueprint $table) {
            $table->id();
            $table->string('matricula',15)->unique();
            // Avioneta / Helicoptero
            $table->enum('tipo', ['avioneta', 'helicoptero'])->nullable();
            $table->string('modelo',50)->nullable();
            // Algunas marcas comunes de aeronaves y opción 'otro'
            $table->enum('marca', [
                'cessna','piper','beechcraft','airbus','boeing','embraer','bombardier',
                'bell','robinson','sikorsky','diamond','cirrus','tecnam','otro'
            ])->nullable();
            $table->string('numero_serie',50)->nullable()->index();
            $table->string('numero_parte',50)->nullable()->index();
            // Llave foránea a fabricantes
            $table->foreignId('fabricante_id')->nullable()->constrained('fabricantes')->nullOnDelete();
            $table->enum('estado', ['activo', 'inactivo', 'mantenimiento'])->default('activo');
            $table->string('ubicacion_actual',50)->nullable();
            $table->string('documento_legal',50)->nullable(); // Ruta del doc legal de respaldo
            $table->timestamps();
            $table->index('estado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aeronaves');
    }
};
