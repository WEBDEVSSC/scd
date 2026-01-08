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
            $table->text('turnado_area_respuesta')
                  ->nullable()
                  ->after('turnado_area_observaciones');

            $table->dateTime('turnado_area_respuesta_fecha')
                  ->nullable()
                  ->after('turnado_area_respuesta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documentos_recibidos', function (Blueprint $table) {
            //
            $table->dropColumn([
                'turnado_area_respuesta',
                'turnado_area_respuesta_fecha'
            ]);
        });
    }
};
