<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoNivelImpactoToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_nivel_impacto', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('tipo_impacto_id')->nullable();
            $table->unsignedInteger('niveles_impacto_id')->nullable();
            $table->text('contenido')->nullable();
            $table->foreign('tipo_impacto_id')->references('id')->on('tipo_impacto');
            $table->foreign('niveles_impacto_id')->references('id')->on('niveles_impacto');
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
        Schema::dropIfExists('tipo_nivel_impacto');
    }
}
