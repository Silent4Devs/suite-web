<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoImpactoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_impacto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_impacto')->nullable();
            $table->longText('criterio')->nullable();
            $table->longText('base')->nullable();
            $table->foreign('niveles_impacto_id')->references('id')->on('niveles_impacto');
            $table->unsignedInteger('niveles_impacto_id')->nullable();
            $table->foreign('tabla_impacto_id')->references('id')->on('tabla_impacto');
            $table->unsignedInteger('tabla_impacto_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_impacto');
    }
}
