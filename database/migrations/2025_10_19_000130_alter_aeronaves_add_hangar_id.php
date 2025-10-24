<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('aeronaves', function (Blueprint $table) {
            $table->foreignId('hangar_id')->nullable()->after('estado')->constrained('hangares')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('aeronaves', function (Blueprint $table) {
            $table->dropConstrainedForeignId('hangar_id');
        });
    }
};
