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
        Schema::table('areas', function (Blueprint $table) {
            //
            $table->integer('unidad')->nullable()->change();
            $table->integer('subdireccion')->nullable()->change();
            $table->integer('jefatura')->nullable()->change();
            $table->integer('programa')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('areas', function (Blueprint $table) {
            //
            $table->string('unidad')->nullable()->change();
            $table->string('subdireccion')->nullable()->change();
            $table->string('jefatura')->nullable()->change();
            $table->string('programa')->nullable()->change();
        });
    }
};
