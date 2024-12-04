<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('documento', function (Blueprint $table) {
            // Agregar el campo para_area después de para_label
            $table->string('para_area')->nullable()->after('para_label');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documento', function (Blueprint $table) {
            // Eliminar el campo para_area
            $table->dropColumn('para_area');
        });
    }
};
