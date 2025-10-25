<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('aeronaves', function (Blueprint $table) {
            // Requiere doctrine/dbal para change()
            $table->text('documento_legal')->nullable()->change();
            if (Schema::hasColumn('aeronaves', 'documento')) {
                $table->text('documento')->nullable()->change();
            }
        });
    }

    public function down(): void
    {
        Schema::table('aeronaves', function (Blueprint $table) {
            $table->string('documento_legal', 255)->nullable()->change();
            if (Schema::hasColumn('aeronaves', 'documento')) {
                $table->string('documento', 255)->nullable()->change();
            }
        });
    }
};
