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
        Schema::create('documentos_recibidos', function (Blueprint $table) {
            $table->id();

            $table->integer('emisor_id');
            $table->string('emisor');
            $table->integer('tipo_id');
            $table->string('tipo');
            $table->string('asunto');

            $table->enum('anexo', ['SI', 'NO']);
            $table->string('anexo_descripcion')->nullable();

            $table->text('contenido');

            $table->integer('subdireccion_id')->nullable();
            $table->string('subdireccion')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_recibidos');
    }
};
