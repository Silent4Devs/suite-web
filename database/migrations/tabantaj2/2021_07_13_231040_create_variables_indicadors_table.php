<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariablesIndicadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variables_indicadors', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_indicador')->nullable();
            $table->foreign('id_indicador')->references('id')->on('indicadores_sgsis');
            $table->string('variable')->nullable();
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
        Schema::dropIfExists('variables_indicadors');
    }
}
