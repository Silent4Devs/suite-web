<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeclaracionAplicabilidadAprobarIsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'declaracion_aplicabilidad_aprobar_isos',
            function (Blueprint $table) {
                $table->id();
                $table->integer('estatus')->nullable();
                $table->longText('comentarios')->nullable();
                $table->date('fecha_aprobacion')->nullable();
                $table->boolean('esta_correo_enviado')->default(true);
                //foreign
                $table->unsignedBigInteger('empleado_id')->nullable();
                $table->foreign('empleado_id')->references('id')->on('empleados')->nullable();
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
        Schema::dropIfExists('declaracion_aplicabilidad_aprobar_isos');
    }
}
