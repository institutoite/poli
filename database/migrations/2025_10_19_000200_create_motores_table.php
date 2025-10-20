<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('motores', function (Blueprint $table) {
            $table->id();
            $table->string('numero_serie')->nullable()->index();
            $table->string('numero_parte')->nullable()->index();
            $table->string('tipo_modelo')->nullable();
            $table->string('fabricante')->nullable();
            $table->foreignId('aeronave_id')->nullable()->constrained('aeronaves')->nullOnDelete();
            $table->enum('estado', ['operativo', 'resguardo', 'mantenimiento'])->default('operativo');
            $table->string('ubicacion_actual')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->string('documento_legal')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('motores');
    }
};
