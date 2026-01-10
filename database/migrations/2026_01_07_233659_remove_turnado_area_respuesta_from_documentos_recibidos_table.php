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
            if (Schema::hasColumn('documentos_recibidos', 'turnado_area_respuesta')) {
                $table->dropColumn('turnado_area_respuesta');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('documentos_recibidos', function (Blueprint $table) {
            if (!Schema::hasColumn('documentos_recibidos', 'turnado_area_respuesta')) {
                $table->text('turnado_area_respuesta')->nullable();
            }
        });
    }
};
