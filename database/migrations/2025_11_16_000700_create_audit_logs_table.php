<?php
// database/migrations/2025_11_16_000700_create_audit_logs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditLogsTable extends Migration
{
    public function up()
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // ID del usuario que realizó la acción
            $table->string('model_type'); // Clase del modelo afectado
            $table->unsignedBigInteger('model_id'); // ID del modelo afectado
            $table->string('action'); // Acción realizada (created, updated, deleted, etc.)
            $table->json('changes')->nullable(); // Cambios realizados (si aplica)
            $table->timestamp('deleted_at')->nullable(); // Fecha de eliminación lógica (si aplica)
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('audit_logs');
    }
}
