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
        Schema::table('users', function (Blueprint $table) {
            $table->string('area_nombre')->nullable();
            $table->string('area_responsable')->nullable();
            $table->string('siglas')->nullable();
            $table->string('correo')->nullable();
            $table->string('extension')->nullable();
            $table->integer('tipo')->nullable();
            $table->integer('unidadsub')->nullable();
            $table->integer('subdireccion')->nullable();
            $table->integer('jefatura')->nullable();
            $table->integer('programa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'area_nombre',
                'area_responsable',
                'siglas',
                'correo',
                'extension',
                'tipo',
                'unidadsub',
                'subdireccion',
                'jefatura',
                'programa',
            ]);
        });
    }
};
