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
        Schema::table('areas', function (Blueprint $table) {
            //
            $table->integer('subsecretaria')->after('unidad')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('areas', function (Blueprint $table) {
            //
            $table->integer('subsecretaria')->after('otra_columna')->nullable()->change(); // Cambia 'otra_columna' por la columna anterior a subsecretaria
        });
    }
};
