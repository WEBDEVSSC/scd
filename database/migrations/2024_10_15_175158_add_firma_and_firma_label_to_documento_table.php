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
            //
            $table->integer('firma')->nullable(); // Campo firma de tipo integer
            $table->string('firma_label')->nullable(); // Campo firma_label de tipo string
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documento', function (Blueprint $table) {
            //
            $table->dropColumn('firma'); // Elimina el campo firma
            $table->dropColumn('firma_label'); // Elimina el campo firma_label
        });
    }
};
