<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionRequisitoLegalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacion_requisito_legal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cumplerequisito')->nullable();
            $table->date('fechaverificacion')->nullable();
            $table->string('metodo')->nullable();
            $table->longText('descripcion_cumplimiento')->nullable();
            $table->longText('comentarios')->nullable();
            $table->unsignedBigInteger('id_matriz');
            $table->unsignedBigInteger('id_reviso');
            $table->foreign('id_matriz')->references('id')->on('matriz_requisito_legales')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_reviso')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('evaluacion_requisito_legal');
    }
}
