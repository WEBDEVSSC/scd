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
        Schema::create('users_niveles', function (Blueprint $table) {
            // Campo id como clave primaria
            $table->id();
            
            // Campo nivel
            $table->string('nivel');  // Puedes cambiar el tipo de dato según tus necesidades
            
            // Timestamps para created_at y updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users_niveles');
    }
};
