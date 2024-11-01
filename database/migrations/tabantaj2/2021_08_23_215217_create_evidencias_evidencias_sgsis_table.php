<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidenciasEvidenciasSgsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidencias_evidencias_sgsis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_evidencias_sgsis')->nullable();
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
        Schema::dropIfExists('evidencias_evidencias_sgsis');
    }
}
