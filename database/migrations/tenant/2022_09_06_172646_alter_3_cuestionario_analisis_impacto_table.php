<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Alter3CuestionarioAnalisisImpactoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cuestionario_analisis_impacto', function (Blueprint $table) {
            $table->integer('rpo_mes')->nullable();
            $table->integer('rpo_semana')->nullable();
            $table->integer('rpo_dia')->nullable();
            $table->integer('rpo_hora')->nullable();
            $table->integer('rto_mes')->nullable();
            $table->integer('rto_semana')->nullable();
            $table->integer('rto_dia')->nullable();
            $table->integer('rto_hora')->nullable();
            $table->integer('wrt_mes')->nullable();
            $table->integer('wrt_semana')->nullable();
            $table->integer('wrt_dia')->nullable();
            $table->integer('wrt_hora')->nullable();
            $table->integer('mtpd_mes')->nullable();
            $table->integer('mtpd_semana')->nullable();
            $table->integer('mtpd_dia')->nullable();
            $table->integer('mtpd_hora')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cuestionario_analisis_impacto', function (Blueprint $table) {
            //
        });
    }
}
