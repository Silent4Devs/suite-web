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
        Schema::table('aprobadores_firma_contratos', function (Blueprint $table) {

            $table->integer('aprobador_id')->nullable();
            $table->foreign('aprobador_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('solicitante_id')->nullable();
            $table->foreign('solicitante_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');

            $table->string('firma')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aprobadores_firma_contratos', function (Blueprint $table) {
            //
        });
    }
};
