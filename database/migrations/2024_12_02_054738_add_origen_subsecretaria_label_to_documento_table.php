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
            // Agregar el campo `origen_subsecretaria_label` de tipo string después de `origen_subsecretaria`
            $table->string('origen_subsecretaria_label')->nullable()->after('origen_subsecretaria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documento', function (Blueprint $table) {
            // Eliminar el campo `origen_subsecretaria_label`
            $table->dropColumn('origen_subsecretaria_label');
        });
    }
};
