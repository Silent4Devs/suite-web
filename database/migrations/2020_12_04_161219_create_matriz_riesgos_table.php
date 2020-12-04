<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatrizRiesgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriz_riesgos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('proceso')->nullable();
            $table->string('responsableproceso')->nullable();
            $table->string('amenaza')->nullable();
            $table->string('vulnerabilidad')->nullable();
            $table->string('descripcionriesgo')->nullable();
            $table->string('tipo_riesgo')->nullable();
            $table->float('confidencialidad', 5, 2)->nullable();
            $table->float('integridad', 5, 2)->nullable();
            $table->float('disponibilidad', 5, 2)->nullable();
            $table->string('probabilidad')->nullable();
            $table->string('impacto')->nullable();
            $table->float('nivelriesgo', 5, 2)->nullable();
            $table->float('riesgototal', 5, 2)->nullable();
            $table->float('resultadoponderacion', 5, 2)->nullable();
            $table->float('riesgoresidual', 5, 2)->nullable();
            $table->string('justificacion')->nullable();
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
        Schema::dropIfExists('matriz_riesgos');
    }
}
