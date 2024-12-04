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
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); 
            $table->string('responsable'); 
            $table->string('siglas'); 
            $table->string('correo'); 
            $table->string('extension'); 
            $table->integer('tipo'); 
            $table->integer('unidadsub'); 
            $table->integer('subdireccion'); 
            $table->integer('jefatura'); 
            $table->integer('programa'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('areas');
    }
};
