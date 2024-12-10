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
            // Agregar el campo firma_ruta después de firma_area
            $table->string('firma_ruta')->nullable()->after('firma_area');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documento', function (Blueprint $table) {
            // Eliminar el campo firma_ruta en caso de revertir la migración
            $table->dropColumn('firma_ruta');
        });
    }
};
