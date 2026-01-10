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
            if (Schema::hasColumn('areas', 'firma')) {
                $table->dropColumn('firma');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('areas', function (Blueprint $table) {
            //
            if (!Schema::hasColumn('areas', 'firma')) {
                $table->string('firma')->nullable();
            }
        });
    }
};
