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
            // Agregar el campo `origen_subsecretaria` de tipo entero después del campo `origen`
            $table->integer('origen_subsecretaria')->nullable()->after('origen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documento', function (Blueprint $table) {
            // Eliminar el campo `origen_subsecretaria`
            $table->dropColumn('origen_subsecretaria');
        });
    }
};
