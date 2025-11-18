<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('aeronaves', function (Blueprint $table) {
            $table->decimal('horas_vuelo_total', 8, 1)->default(0)->after('documento');
            $table->decimal('horas_desde_mantenimiento', 8, 1)->default(0)->after('horas_vuelo_total');
            $table->unsignedSmallInteger('mantenimiento_cada_horas')->default(50)->after('horas_desde_mantenimiento');
            $table->date('fecha_ultimo_mantenimiento')->nullable()->after('mantenimiento_cada_horas');

            // Userstamps
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();

            // Soft deletes
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('aeronaves', function (Blueprint $table) {
            $table->dropColumn(['horas_vuelo_total', 'horas_desde_mantenimiento', 'mantenimiento_cada_horas', 'fecha_ultimo_mantenimiento']);
            $table->dropConstrainedForeignId('created_by');
            $table->dropConstrainedForeignId('updated_by');
            $table->dropConstrainedForeignId('deleted_by');
            $table->dropSoftDeletes();
        });
    }
};
