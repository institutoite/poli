<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Nacionalidades
        Schema::create('nacionalidades', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nombre')->unique();
            $table->string('codigo')->nullable()->unique();
            $table->timestamps();
        });

        // Grados policiales
        Schema::create('grados', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nombre')->unique();
            $table->unsignedSmallInteger('orden')->nullable();
            $table->timestamps();
        });

        // Bancos
        Schema::create('bancos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nombre')->unique();
            $table->string('codigo')->nullable()->unique();
            $table->timestamps();
        });

        // Idiomas
        Schema::create('idiomas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nombre')->unique();
            $table->string('codigo_iso')->nullable()->unique();
            $table->timestamps();
        });

        // Ubicación: departamentos, provincias, municipios, zonas, barrios
        Schema::create('departamentos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nombre')->unique();
            $table->string('codigo')->nullable()->unique();
            $table->timestamps();
        });

        Schema::create('provincias', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('departamento_id')->constrained('departamentos')->cascadeOnDelete();
            $table->string('nombre');
            $table->string('codigo')->nullable();
            $table->timestamps();
            $table->unique(['departamento_id','nombre']);
        });

        Schema::create('municipios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('provincia_id')->constrained('provincias')->cascadeOnDelete();
            $table->string('nombre');
            $table->string('codigo')->nullable();
            $table->timestamps();
            $table->unique(['provincia_id','nombre']);
        });

        Schema::create('zonas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('municipio_id')->constrained('municipios')->cascadeOnDelete();
            $table->string('nombre');
            $table->timestamps();
            $table->unique(['municipio_id','nombre']);
        });

        Schema::create('barrios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('zona_id')->constrained('zonas')->cascadeOnDelete();
            $table->string('nombre');
            $table->timestamps();
            $table->unique(['zona_id','nombre']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barrios');
        Schema::dropIfExists('zonas');
        Schema::dropIfExists('municipios');
        Schema::dropIfExists('provincias');
        Schema::dropIfExists('departamentos');
        Schema::dropIfExists('idiomas');
        Schema::dropIfExists('bancos');
        Schema::dropIfExists('grados');
        Schema::dropIfExists('nacionalidades');
    }
};
