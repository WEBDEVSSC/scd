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
            $table->string('para')->nullable();        // Campo 'para'
            $table->string('tipo')->nullable();        // Campo 'tipo'
            $table->integer('consecutivo')->nullable(); // Campo 'consecutivo'
            $table->string('asunto')->nullable();      // Campo 'asunto'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documento', function (Blueprint $table) {
            //
            $table->dropColumn(['para', 'tipo', 'consecutivo', 'asunto']);
        });
    }
};
