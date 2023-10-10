<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTratamientoRiesgosTable extends Migration
{
    public function up()
    {
        Schema::create('tratamiento_riesgos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nivelriesgo')->nullable();
            $table->longText('acciones')->nullable();
            $table->date('fechacompromiso')->nullable();
            $table->string('prioridad')->nullable();
            $table->string('estatus')->nullable();
            $table->string('probabilidad')->nullable();
            $table->string('impacto')->nullable();
            $table->string('nivelriesgoresidual')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
