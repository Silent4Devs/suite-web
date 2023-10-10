<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudPermisoGoceSueldoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_permiso_goce_sueldo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dias_solicitados')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->longText('descripcion')->nullable();
            $table->integer('aprobacion')->default(1);
            $table->integer('autoriza');
            $table->longText('comentarios_aprobador')->nullable();
            $table->unsignedBigInteger('empleado_id')->nullable();
            $table->unsignedBigInteger('permiso_id')->nullable();
            $table->foreign('permiso_id')->references('id')->on('permisos_goce_sueldo')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('solicitud_permiso_goce_sueldo');
    }
}
