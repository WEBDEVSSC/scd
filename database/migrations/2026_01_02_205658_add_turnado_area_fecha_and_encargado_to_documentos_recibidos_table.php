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
            $table->dateTime('turnado_area_fecha')
                  ->nullable()
                  ->after('turnado_area_label');

            $table->string('turnado_area_encargado')
                  ->nullable()
                  ->after('turnado_area_fecha');
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
                'turnado_area_fecha',
                'turnado_area_encargado'
            ]);
        });
    }
};
