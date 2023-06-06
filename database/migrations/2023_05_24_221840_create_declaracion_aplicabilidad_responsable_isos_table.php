<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeclaracionAplicabilidadResponsableIsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'declaracion_aplicabilidad_responsable_isos', function (Blueprint $table) {
                $table->id();
                $table->string('aplica')->nullable();
                $table->longText('justificacion')->nullable();
                 //foreign
                $table->unsignedBigInteger('aprobadores_id')->nullable();
                $table->foreign('aprobadores_id')->references('id')->on('empleados')->nullable();
                 //foreign
                $table->unsignedInteger('declaracion_id')->nullable();
                $table->foreign('declaracion_id')->references('id')->on('declaracion_aplicabilidad_concentrado_isos')->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('declaracion_aplicabilidad_responsable_isos');
    }
}
