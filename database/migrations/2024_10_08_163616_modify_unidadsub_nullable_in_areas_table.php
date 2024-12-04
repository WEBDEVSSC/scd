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
            $table->string('unidadsub')->nullable()->change(); // Cambiar a nullable
            $table->string('subdireccion')->nullable()->change(); // Cambiar a nullable
            $table->string('jefatura')->nullable()->change(); // Cambiar a nullable
            $table->string('programa')->nullable()->change(); // Cambiar a nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->string('unidadsub')->nullable(false)->change(); // Revertir a no nullable
            $table->string('subdireccion')->nullable(false)->change(); // Revertir a no nullable
            $table->string('jefatura')->nullable(false)->change(); // Revertir a no nullable
            $table->string('programa')->nullable(false)->change(); // Revertir a no nullable
        });
    }
};
