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
            $table->string('anexo')->nullable()->after('asunto'); // Campo 'anexo' después de 'asunto'
            $table->text('anexo_descripcion')->nullable()->after('anexo'); // Campo 'anexo_descripcion' después de 'anexo'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documento', function (Blueprint $table) {
            $table->dropColumn(['anexo', 'anexo_descripcion']);
        });
    }
};
