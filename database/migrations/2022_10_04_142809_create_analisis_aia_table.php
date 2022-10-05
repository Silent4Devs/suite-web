<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisisAiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisis_aia', function (Blueprint $table) {
            $table->increments('id');
            // DATOS DE IDENTIFICACIÓN DEL ENTREVISTADO 
            $table->date('fecha_entrevista')->nullable();
            $table->string('entrevistado')->nullable();
            $table->string('puesto')->nullable();
            $table->string('area')->nullable();
            $table->integer('extencion')->nullable();
            $table->string('correo')->nullable();
            $table->string('aplicaciones_a_cargo')->nullable();
            // DATOS DE IDENTIFICACIÓN DEL PROCESO
            $table->string('id_aplicacion')->nullable();
            $table->string('nombre_aplicacion')->nullable();
            $table->string('version')->nullable();
            $table->string('objetivo_aplicacion')->nullable();
            $table->integer('periodicidad')->nullable();
            $table->string('p_otro_txt')->nullable();
            $table->string('area_pertenece_aplicacion')->nullable();
            $table->string('area_responsable_aplicacion')->nullable();
            // RESPONSABLES DEL PROCESO
            $table->string('titular_nombre')->nullable();
            $table->string('titular_a_paterno')->nullable();
            $table->string('titular_a_materno')->nullable();
            $table->string('titular_puesto')->nullable();
            $table->string('titular_correo')->nullable();
            $table->integer('titular_extencion')->nullable();
            $table->string('suplente_nombre')->nullable();
            $table->string('suplente_a_paterno')->nullable();
            $table->string('suplente_a_materno')->nullable();
            $table->string('suplente_puesto')->nullable();
            $table->string('suplente_correo')->nullable();
            $table->integer('suplente_extencion')->nullable();
            $table->string('supervisor_nombre')->nullable();
            $table->string('supervisor_a_paterno')->nullable();
            $table->string('supervisor_a_materno')->nullable();
            $table->string('supervisor_puesto')->nullable();
            $table->string('supervisor_correo')->nullable();
            $table->integer('supervisor_extencion')->nullable();
            // FLUJO DEL PROCESO
            $table->string('flujo_q_1')->nullable();
            $table->string('flujo_q_2')->nullable();
            $table->string('flujo_q_5')->nullable();
            $table->string('flujo_q_6_app_ip')->nullable();
            $table->string('flujo_q_6_bd_ip')->nullable();
            $table->string('flujo_q_6_otro_ip')->nullable();
            $table->string('flujo_q_6_app_host')->nullable();
            $table->string('flujo_q_6_bd_host')->nullable();
            $table->string('flujo_q_6_otro_host')->nullable();
            $table->string('flujo_q_6_app_base')->nullable();
            $table->string('flujo_q_6_bd_base')->nullable();
            $table->string('flujo_q_6_otro_base')->nullable();
            $table->string('flujo_q_6_app_puerto')->nullable();
            $table->string('flujo_q_6_bd_puerto')->nullable();
            $table->string('flujo_q_6_otro_puerto')->nullable();
            $table->integer('flujo_q_6_app_servidor')->nullable();
            $table->integer('flujo_q_6_bd_servidor')->nullable();
            $table->integer('flujo_q_6_otro_servidor')->nullable();
            $table->string('flujo_q_6_app_SO')->nullable();
            $table->string('flujo_q_6_bd_SO')->nullable();
            $table->string('flujo_q_6_otro_SO')->nullable();
            $table->integer('flujo_q_6_app_acceso')->nullable();
            $table->integer('flujo_q_6_bd_acceso')->nullable();
            $table->integer('flujo_q_6_otro_acceso')->nullable();
            $table->string('flujo_q_6_app_url')->nullable();
            $table->string('flujo_q_6_bd_url')->nullable();
            $table->string('flujo_q_6_otro_url')->nullable();
            $table->string('flujo_q_6_app_ip_publica')->nullable();
            $table->string('flujo_q_6_bd_ip_publica')->nullable();
            $table->string('flujo_q_6_otro_ip_publica')->nullable();
            $table->integer('flujo_q_6_app_certificado')->nullable();
            $table->integer('flujo_q_6_bd_certificado')->nullable();
            $table->integer('flujo_q_6_otro_certificado')->nullable();
            $table->string('flujo_q_6_app_tipo_cifrado')->nullable();
            $table->string('flujo_q_6_bd_tipo_cifrado')->nullable();
            $table->string('flujo_q_6_otro_tipo_cifrado')->nullable();
            $table->integer('flujo_q_6_app_internet')->nullable();
            $table->integer('flujo_q_6_bd_internet')->nullable();
            $table->integer('flujo_q_6_otro_internet')->nullable();
            $table->string('flujo_q_6_app_datos_url')->nullable();
            $table->string('flujo_q_6_bd_datos_url')->nullable();
            $table->string('flujo_q_6_otro_datos_url')->nullable();
            $table->integer('flujo_q_6_app_acceso_moviles')->nullable();
            $table->integer('flujo_q_6_bd_acceso_moviles')->nullable();
            $table->integer('flujo_q_6_otro_acceso_moviles')->nullable();
            $table->string('flujo_q_6_app_nombre_app_movil')->nullable();
            $table->string('flujo_q_6_bd_nombre_app_movil')->nullable();
            $table->string('flujo_q_6_otro_nombre_app_movil')->nullable();
            $table->integer('flujo_q_6_app_interaccion_otras_apps')->nullable();
            $table->integer('flujo_q_6_bd_interaccion_otras_apps')->nullable();
            $table->integer('flujo_q_6_otro_interaccion_otras_apps')->nullable();
            $table->string('flujo_q_6_app_datos_interactuan')->nullable();
            $table->string('flujo_q_6_bd_datos_interactuan')->nullable();
            $table->string('flujo_q_6_otro_datos_interactuan')->nullable();
            $table->integer('flujo_q_6_app_soporte_terceros')->nullable();
            $table->integer('flujo_q_6_bd_soporte_terceros')->nullable();
            $table->integer('flujo_q_6_otro_soporte_terceros')->nullable();
            $table->string('flujo_q_6_app_datos_terceros')->nullable();
            $table->string('flujo_q_6_bd_datos_terceros')->nullable();
            $table->string('flujo_q_6_otro_datos_terceros')->nullable();
            $table->integer('flujo_q_6_app_instancia_balanceo')->nullable();
            $table->integer('flujo_q_6_bd_instancia_balanceo')->nullable();
            $table->integer('flujo_q_6_otro_instancia_balanceo')->nullable();
            $table->string('flujo_q_6_app_datos_balanceo')->nullable();
            $table->string('flujo_q_6_bd_datos_balanceo')->nullable();
            $table->string('flujo_q_6_otro_datos_balanceo')->nullable();
            $table->string('flujo_q_6_app_sofware_adicional')->nullable();
            $table->string('flujo_q_6_bd_sofware_adicional')->nullable();
            $table->string('flujo_q_6_otro_sofware_adicional')->nullable();
            $table->string('flujo_q_6_app_lenguajes')->nullable();
            $table->string('flujo_q_6_bd_lenguajes')->nullable();
            $table->string('flujo_q_6_otro_lenguajes')->nullable();
            $table->string('flujo_q_7_app_ip')->nullable();
            $table->string('flujo_q_7_bd_ip')->nullable();
            $table->string('flujo_q_7_otro_ip')->nullable();
            $table->string('flujo_q_7_app_host')->nullable();
            $table->string('flujo_q_7_bd_host')->nullable();
            $table->string('flujo_q_7_otro_host')->nullable();
            $table->integer('flujo_q_7_app_servidor')->nullable();
            $table->integer('flujo_q_7_bd_servidor')->nullable();
            $table->integer('flujo_q_7_otro_servidor')->nullable();
            $table->string('flujo_q_7_app_SO')->nullable();
            $table->string('flujo_q_7_bd_SO')->nullable();
            $table->string('flujo_q_7_otro_SO')->nullable();
            $table->integer('flujo_q_7_app_acceso')->nullable();
            $table->integer('flujo_q_7_bd_acceso')->nullable();
            $table->integer('flujo_q_7_otro_acceso')->nullable();
            $table->string('flujo_q_7_app_url')->nullable();
            $table->string('flujo_q_7_bd_url')->nullable();
            $table->string('flujo_q_7_otro_url')->nullable();


            // // RESPALDOS DE INFORMACIÓN
            // $table->string('respaldo_q_20')->nullable();
            // $table->string('respaldo_q_21')->nullable();
            // $table->string('respaldo_q_22')->nullable();
            // $table->string('respaldo_q_23')->nullable();
            // // PROBABILIDAD DE INCIDENTES DISRUPTIVOS
            // $table->integer('disruptivos_q_1')->default(0);
            // $table->integer('disruptivos_q_2')->default(0);
            // $table->integer('disruptivos_q_3')->default(0);
            // $table->integer('disruptivos_q_4')->default(0);
            // $table->integer('disruptivos_q_5')->default(0);
            // $table->integer('disruptivos_q_6')->default(0);
            // $table->integer('disruptivos_q_7')->default(0);
            // $table->integer('disruptivos_q_8')->default(0);
            // $table->integer('disruptivos_q_9')->default(0);
            // $table->integer('disruptivos_q_10')->default(0);
            // $table->integer('disruptivos_q_11')->default(0);
            //  // RIESGOS E INCIDENTES DISRUPTIVOS
            //  $table->integer('operacion_q_1')->nullable();
            //  $table->integer('operacion_q_2')->nullable();
            //  $table->integer('operacion_q_3')->nullable();
            //  $table->integer('regulatorio_q_1')->nullable();
            //  $table->integer('regulatorio_q_2')->nullable();
            //  $table->integer('regulatorio_q_3')->nullable();
            //  $table->integer('reputacion_q_1')->nullable();
            //  $table->integer('reputacion_q_2')->nullable();
            //  $table->integer('reputacion_q_3')->nullable();
            //  $table->integer('social_q_1')->nullable();
            //  $table->integer('social_q_2')->nullable();
            //  $table->integer('social_q_3')->nullable();
            //  $table->string('incidentes_q_26')->nullable();
            //  $table->string('incidentes_q_27')->nullable();
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
        Schema::dropIfExists('analisis_aia');
    }
}
