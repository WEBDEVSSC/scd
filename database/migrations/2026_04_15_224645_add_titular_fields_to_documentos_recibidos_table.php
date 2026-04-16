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
        Schema::table('documentos_recibidos', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('titular_id')->nullable()->after('subdireccion');
            $table->string('titular')->nullable()->after('titular_id');

            $table->foreign('titular_id')
                ->references('id')
                ->on('areas')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documentos_recibidos', function (Blueprint $table) {
            //
            $table->dropForeign(['titular_id']);
            $table->dropColumn(['titular_id', 'titular']);
        });
    }
};
