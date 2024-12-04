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
            $table->renameColumn('unidadsub', 'unidad');
            $table->integer('subsecretaria')->nullable(); // o $table->integer('subsecretaria'); si no quieres que sea nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('areas', function (Blueprint $table) {
            //
            $table->renameColumn('unidad', 'unidadsub');
            $table->dropColumn('subsecretaria');
        });
    }
};
