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
            $table->unsignedBigInteger('turnado_area_id')->nullable()->after('fecha_recepcion');
            $table->string('turnado_area_label')->nullable()->after('turnado_area_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documentos_recibidos', function (Blueprint $table) {
            //
            $table->dropColumn(['turnado_area_id', 'turnado_area_label']);
        });
    }
};
