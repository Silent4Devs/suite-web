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
        Schema::table('escalas_objetivos_desempenos', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('no_periodo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('escalas_objetivos_desempenos', function (Blueprint $table) {
            //
            $table->dropColumn('no_periodo');
        });
    }
};
