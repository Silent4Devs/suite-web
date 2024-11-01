<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeclaracionAplicabilidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('declaracion_aplicabilidad', function (Blueprint $table) {
            $table->id();
            $table->string('control-uno')->nullable();
            $table->string('control-dos')->nullable();
            $table->string('anexo_indice')->nullable();
            $table->longText('anexo_politica')->nullable();
            $table->longText('anexo_descripcion')->nullable();
            $table->string('aplica')->nullable();
            $table->longText('justificacion')->nullable();
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
        Schema::dropIfExists('declaracion_aplicabilidad');
    }
}
