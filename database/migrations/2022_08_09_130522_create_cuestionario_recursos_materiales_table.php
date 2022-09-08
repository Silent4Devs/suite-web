<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuestionarioRecursosMaterialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuestionario_recursos_materiales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('equipos')->nullable()->default(0);
            $table->integer('impresoras')->nullable()->default(0);
            $table->integer('telefono')->nullable()->default(0);
            $table->string('otro')->nullable();
            $table->integer('escenario')->nullable();
            $table->unsignedBigInteger('cuestionario_id')->nullable();
            $table->foreign('cuestionario_id')->references('id')->on('cuestionario_analisis_impacto')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('cuestionario_recursos_materiales');
    }
}
