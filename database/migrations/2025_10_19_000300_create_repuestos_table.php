<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repuestos', function (Blueprint $table) {
            $table->id(); // Corresponde al N°
            $table->string('numero_parte')->nullable()->index();
            $table->string('numero_serie')->nullable()->index();
            $table->string('descripcion')->nullable();
            $table->string('fabricante')->nullable();
            $table->unsignedInteger('cantidad')->default(0);
            $table->enum('condicion', ['nuevo', 'usado', 'reparado'])->default('nuevo');
            $table->string('ubicacion_actual')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->string('documento_legal')->nullable();
            $table->timestamps();
            $table->index('condicion');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repuestos');
    }
};
