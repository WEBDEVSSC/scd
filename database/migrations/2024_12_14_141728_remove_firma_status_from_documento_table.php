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
            // Eliminar el campo firma_status
            $table->dropColumn('firma_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documento', function (Blueprint $table) {
            // Revertir la eliminación, añadiendo de nuevo firma_status
            $table->integer('firma_status')->nullable()->after('firma_ruta');
        });
    }
};
