<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidenciasMatrizRequisitoLegalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidencias_matriz_requisito_legales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_matriz_requisito')->nullable();
            $table->string('evidencia');
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
        Schema::dropIfExists('evidencias_matriz_requisito_legales');
    }
}
