<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('documento', function (Blueprint $table) {
            // Agregar el campo firma_status de tipo entero y permitir valores nulos
            $table->integer('firma_status')->nullable()->after('firma_ruta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documento', function (Blueprint $table) {
            // Eliminar el campo firma_status
            $table->dropColumn('firma_status');
        });
    }
};
