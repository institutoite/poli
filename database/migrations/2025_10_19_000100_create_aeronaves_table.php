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
            $table->string('matricula')->unique();
            $table->string('tipo')->nullable(); // Avioneta / Helicoptero
            $table->string('modelo')->nullable();
            $table->string('marca')->nullable();
            $table->string('numero_serie')->nullable()->index();
            $table->string('numero_parte')->nullable()->index();
            $table->string('fabricante')->nullable();
            $table->enum('estado', ['activo', 'inactivo', 'mantenimiento'])->default('activo');
            $table->string('ubicacion_actual')->nullable();
            $table->string('documento_legal')->nullable(); // Ruta del doc legal de respaldo
            $table->timestamps();
            $table->index('estado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aeronaves');
    }
};
