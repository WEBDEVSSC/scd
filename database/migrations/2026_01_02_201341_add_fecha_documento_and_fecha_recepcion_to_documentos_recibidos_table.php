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
            $table->date('fecha_documento')->after('status');
            $table->dateTime('fecha_recepcion')->after('fecha_documento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documentos_recibidos', function (Blueprint $table) {
            //
            $table->dropColumn(['fecha_documento', 'fecha_recepcion']);
        });
    }
};
