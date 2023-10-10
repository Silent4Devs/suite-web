<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatrizRequisitoLegalesTable extends Migration
{
    public function up()
    {
        Schema::create('matriz_requisito_legales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombrerequisito');
            $table->date('fechaexpedicion')->nullable();
            $table->date('fechavigor')->nullable();
            $table->string('requisitoacumplir')->nullable();
            $table->string('cumplerequisito')->nullable();
            $table->string('formacumple')->nullable();
            $table->string('periodicidad_cumplimiento')->nullable();
            $table->date('fechaverificacion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
