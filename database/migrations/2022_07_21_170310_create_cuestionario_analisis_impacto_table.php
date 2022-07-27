<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuestionarioAnalisisImpactoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuestionario_analisis_impacto', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_entrevista')->nullable(); 
            $table->string('entrevistado')->nullable();
            $table->string('puesto')->nullable();
            $table->string('area')->nullable();
            $table->string('direccion')->nullable();
            $table->integer('extencion')->nullable();
            $table->string('correo')->nullable();
            $table->string('procesos_a_cargo')->nullable();
            $table->string('id_proceso')->nullable();
            $table->string('nombre_proceso')->nullable();
            $table->string('version')->nullable();
            $table->string('tipo')->nullable();
            $table->string('objetivo_proceso')->nullable();
            $table->integer('periodicidad')->default(1)->nullable();
            $table->string('p_otro_txt')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('cuestionario_analisis_impacto');
    }
}
