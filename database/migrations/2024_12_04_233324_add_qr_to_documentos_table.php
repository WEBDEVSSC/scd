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
            // Agregar el campo 'qr'
            $table->text('qr')->nullable(); // Puedes ajustarlo a tu necesidad (por ejemplo, 'nullable' si es opcional)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documento', function (Blueprint $table) {
            // Eliminar el campo 'qr' en caso de deshacer la migración
            $table->dropColumn('qr');
        });
    }
};
