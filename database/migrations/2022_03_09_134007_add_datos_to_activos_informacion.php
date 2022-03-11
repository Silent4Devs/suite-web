<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDatosToActivosInformacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activos_informacion', function (Blueprint $table) {
            $table->unsignedBigInteger('direccion_envio')->nullable();
            $table->unsignedBigInteger('vp_envio')->nullable();
            $table->unsignedBigInteger('envio_digital')->nullable();
            $table->string('otro_envio_digital')->nullable();
            $table->string('informacion_total')->nullable();
            $table->string('proveedor_envio')->nullable();
            $table->unsignedBigInteger('envio_ext')->nullable();
            $table->string('otro_envioExt')->nullable();
            $table->string('informacion_totalExt')->nullable();
            $table->string('acceso_informacionExt')->nullable();
            $table->string('requiere_info')->nullable();
            $table->unsignedBigInteger('almacenamiento_digital')->nullable();
            $table->unsignedBigInteger('almacenamiento_aplicacion')->nullable();
            $table->string('carpeta_compartida_almacenamiento')->nullable();
            $table->string('otra_AppCarpeta_almacenamiento')->nullable();
            $table->unsignedBigInteger('almacenamiento_fisico')->nullable();
            $table->string('otro_almacenamiento_fisico')->nullable();
            $table->string('ubicacion_fisica')->nullable();
            $table->string('almacenamiento_acceso')->nullable();
            $table->string('acceso_requerido')->nullable();
            $table->string('tiempo_almacenamiento')->nullable();
            $table->string('destruye')->nullable();
            $table->string('eliminacion_digital')->nullable();
            $table->string('otro_eliminacion')->nullable();
            $table->unsignedBigInteger('eliminacion_fisica')->nullable();
            $table->unsignedBigInteger('question')->nullable();
            $table->unsignedBigInteger('question_1')->nullable();
            $table->unsignedBigInteger('question_2')->nullable();
            $table->unsignedBigInteger('question_3')->nullable();
            $table->unsignedBigInteger('question_4')->nullable();
            $table->unsignedBigInteger('question_5')->nullable();
            $table->unsignedBigInteger('question_6')->nullable();
            $table->unsignedBigInteger('question_7')->nullable();
            $table->unsignedBigInteger('confidencialidad_id')->nullable();
            $table->unsignedBigInteger('integridad_id')->nullable();
            $table->unsignedBigInteger('disponibilidad_id')->nullable();
            $table->unsignedBigInteger('valor_criticidad')->nullable();
            $table->foreign('confidencialidad_id')->references('id')->on('activo_confidencialidad')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('integridad_id')->references('id')->on('activo_integridad')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('disponibilidad_id')->references('id')->on('activo_disponibilidad')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activos_informacion', function (Blueprint $table) {
            //
        });
    }
}
