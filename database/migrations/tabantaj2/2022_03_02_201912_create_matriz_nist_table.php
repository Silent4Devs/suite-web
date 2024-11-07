<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatrizNistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriz_nist', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique()->nullable();
            $table->string('amenaza')->nullable();
            $table->string('impacto_vulnerabilidad')->nullable();
            $table->string('aplicaciones')->nullable();
            $table->string('escenario')->nullable();
            $table->string('categoria')->nullable();
            $table->string('causa')->nullable();
            $table->string('tipo')->nullable();
            $table->integer('severidad')->nullable();
            $table->integer('probabilidad')->nullable();
            $table->integer('impacto_num')->nullable();
            $table->integer('valor')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matriz_nist');
    }
}
