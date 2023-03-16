<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResponsanbleToCartaAceptacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carta_aceptacion', function (Blueprint $table) {
            $table->longText('hallazgos_auditoria')->nullable();
            $table->unsignedBigInteger('responsable_riesgo')->nullable();
            $table->foreign('responsable_riesgo')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carta_aceptacion', function (Blueprint $table) {
        });
    }
}
