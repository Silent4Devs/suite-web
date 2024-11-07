<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAnalisisAiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('analisis_aia', function (Blueprint $table) {
            $table->integer('productivo_desarrollo')->nullable();
            $table->integer('interno_externo')->nullable();
            $table->integer('operacion_q_4')->nullable();
            $table->integer('regulatorio_q_4')->nullable();
            $table->integer('reputacion_q_4')->nullable();
            $table->integer('social_q_4')->nullable();
            $table->string('manejador_bd')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('analisis_aia', function (Blueprint $table) {
            //
        });
    }
}
