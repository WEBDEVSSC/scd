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
        Schema::table('documentos_recibidos', function (Blueprint $table) {
            //
            $table->text('turnado_area_observaciones')
                  ->nullable()
                  ->after('turnado_area_encargado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documentos_recibidos', function (Blueprint $table) {
            //
            $table->dropColumn('turnado_area_observaciones');
        });
    }
};
