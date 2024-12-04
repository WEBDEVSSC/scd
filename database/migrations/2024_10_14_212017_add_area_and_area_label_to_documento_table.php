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
            $table->integer('area')->nullable(); // Campo 'area' de tipo integer
            $table->string('area_label')->nullable(); // Campo 'area_label' de tipo string
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documento', function (Blueprint $table) {
            //
            $table->dropColumn(['area', 'area_label']);
        });
    }
};
