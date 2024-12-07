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
            // Añadir la columna status_firma después de status_label
            $table->integer('status_firma')->after('status_label');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documento', function (Blueprint $table) {
            // Eliminar la columna status_firma si se revierte la migración
            $table->dropColumn('status_firma');
        });
    }
};
