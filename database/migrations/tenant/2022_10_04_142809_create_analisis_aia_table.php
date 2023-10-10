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

            //INFRAESTRUCTURA TECNOLÓGICA
            $table->string('app_ip')->nullable();
            $table->string('bd_ip')->nullable();
            $table->string('otro_ip')->nullable();
            $table->string('app_host')->nullable();
            $table->string('bd_host')->nullable();
            $table->string('otro_host')->nullable();
            $table->string('app_base')->nullable();
            $table->string('bd_base')->nullable();
            $table->string('otro_base')->nullable();
            $table->string('app_puerto')->nullable();
            $table->string('bd_puerto')->nullable();
            $table->string('otro_puerto')->nullable();
            $table->integer('app_servidor')->nullable();
            $table->integer('bd_servidor')->nullable();
            $table->integer('otro_servidor')->nullable();
            $table->string('app_SO')->nullable();
            $table->string('bd_SO')->nullable();
            $table->string('otro_SO')->nullable();
            $table->integer('app_acceso')->nullable();
            $table->integer('bd_acceso')->nullable();
            $table->integer('otro_acceso')->nullable();
            $table->string('app_url')->nullable();
            $table->string('bd_url')->nullable();
            $table->string('otro_url')->nullable();
            $table->string('app_ip_publica')->nullable();
            $table->string('bd_ip_publica')->nullable();
            $table->string('otro_ip_publica')->nullable();
            $table->integer('app_certificado')->nullable();
            $table->integer('bd_certificado')->nullable();
            $table->integer('otro_certificado')->nullable();
            $table->string('app_tipo_cifrado')->nullable();
            $table->string('bd_tipo_cifrado')->nullable();
            $table->string('otro_tipo_cifrado')->nullable();
            $table->integer('app_internet')->nullable();
            $table->integer('bd_internet')->nullable();
            $table->integer('otro_internet')->nullable();
            $table->string('app_datos_url')->nullable();
            $table->string('bd_datos_url')->nullable();
            $table->string('otro_datos_url')->nullable();
            $table->integer('app_acceso_moviles')->nullable();
            $table->integer('bd_acceso_moviles')->nullable();
            $table->integer('otro_acceso_moviles')->nullable();
            $table->string('app_nombre_app_movil')->nullable();
            $table->string('bd_nombre_app_movil')->nullable();
            $table->string('otro_nombre_app_movil')->nullable();
            $table->integer('app_interaccion_otras_apps')->nullable();
            $table->integer('bd_interaccion_otras_apps')->nullable();
            $table->integer('otro_interaccion_otras_apps')->nullable();
            $table->longText('app_datos_interactuan')->nullable();
            $table->longText('bd_datos_interactuan')->nullable();
            $table->longText('otro_datos_interactuan')->nullable();
            $table->integer('app_soporte_terceros')->nullable();
            $table->integer('bd_soporte_terceros')->nullable();
            $table->integer('otro_soporte_terceros')->nullable();
            $table->longText('app_datos_terceros')->nullable();
            $table->longText('bd_datos_terceros')->nullable();
            $table->longText('otro_datos_terceros')->nullable();
            $table->integer('app_instancia_balanceo')->nullable();
            $table->integer('bd_instancia_balanceo')->nullable();
            $table->integer('otro_instancia_balanceo')->nullable();
            $table->string('app_datos_balanceo')->nullable();
            $table->string('bd_datos_balanceo')->nullable();
            $table->string('otro_datos_balanceo')->nullable();
            $table->longText('app_sofware_adicional')->nullable();
            $table->longText('bd_sofware_adicional')->nullable();
            $table->longText('otro_sofware_adicional')->nullable();
            $table->longText('app_lenguajes')->nullable();
            $table->longText('bd_lenguajes')->nullable();
            $table->longText('otro_lenguajes')->nullable();
            // // INFRAESTRUCTURA TECNOLÓGICA Contingencia
            $table->string('contingencia_app_ip')->nullable();
            $table->string('contingencia_bd_ip')->nullable();
            $table->string('contingencia_otro_ip')->nullable();
            $table->string('contingencia_app_host')->nullable();
            $table->string('contingencia_bd_host')->nullable();
            $table->string('contingencia_otro_host')->nullable();
            $table->integer('contingencia_app_servidor')->nullable();
            $table->integer('contingencia_bd_servidor')->nullable();
            $table->integer('contingencia_otro_servidor')->nullable();
            $table->string('contingencia_app_SO')->nullable();
            $table->string('contingencia_bd_SO')->nullable();
            $table->string('contingencia_otro_SO')->nullable();
            $table->integer('contingencia_app_acceso')->nullable();
            $table->integer('contingencia_bd_acceso')->nullable();
            $table->integer('contingencia_otro_acceso')->nullable();
            $table->string('contingencia_app_url')->nullable();
            $table->string('contingencia_bd_url')->nullable();
            $table->string('contingencia_otro_url')->nullable();
            // PERÍODOS CRÍTICOS
            $table->integer('primer_semestre')->default(1);
            $table->integer('segundo_semestre')->default(1);
            $table->integer('ene')->default(1);
            $table->integer('feb')->default(1);
            $table->integer('mar')->default(1);
            $table->integer('abr')->default(1);
            $table->integer('may')->default(1);
            $table->integer('jun')->default(1);
            $table->integer('jul')->default(1);
            $table->integer('ago')->default(1);
            $table->integer('sep')->default(1);
            $table->integer('oct')->default(1);
            $table->integer('nov')->default(1);
            $table->integer('dic')->default(1);
            $table->integer('s1')->default(1);
            $table->integer('s2')->default(1);
            $table->integer('s3')->default(1);
            $table->integer('s4')->default(1);
            $table->integer('d1')->default(1);
            $table->integer('d2')->default(1);
            $table->integer('d3')->default(1);
            $table->integer('d4')->default(1);
            $table->integer('d5')->default(1);
            $table->integer('d6')->default(1);
            $table->integer('d7')->default(1);
            $table->integer('d8')->default(1);
            $table->integer('d9')->default(1);
            $table->integer('d10')->default(1);
            $table->integer('d11')->default(1);
            $table->integer('d12')->default(1);
            $table->integer('d13')->default(1);
            $table->integer('d14')->default(1);
            $table->integer('d15')->default(1);
            $table->integer('d16')->default(1);
            $table->integer('d17')->default(1);
            $table->integer('d18')->default(1);
            $table->integer('d19')->default(1);
            $table->integer('d20')->default(1);
            $table->integer('d21')->default(1);
            $table->integer('d22')->default(1);
            $table->integer('d23')->default(1);
            $table->integer('d24')->default(1);
            $table->integer('d25')->default(1);
            $table->integer('d26')->default(1);
            $table->integer('d27')->default(1);
            $table->integer('d28')->default(1);
            $table->integer('d29')->default(1);
            $table->integer('d30')->default(1);
            $table->integer('d31')->default(1);
            $table->integer('h1')->default(1);
            $table->integer('h2')->default(1);
            $table->integer('h3')->default(1);
            $table->integer('h4')->default(1);
            $table->integer('h5')->default(1);
            $table->integer('h6')->default(1);
            $table->integer('h7')->default(1);
            $table->integer('h8')->default(1);
            $table->integer('h9')->default(1);
            $table->integer('h10')->default(1);
            $table->integer('h11')->default(1);
            $table->integer('h12')->default(1);
            $table->integer('h13')->default(1);
            $table->integer('h14')->default(1);
            $table->integer('h15')->default(1);
            $table->integer('h16')->default(1);
            $table->integer('h17')->default(1);
            $table->integer('h18')->default(1);
            $table->integer('h19')->default(1);
            $table->integer('h20')->default(1);
            $table->integer('h21')->default(1);
            $table->integer('h22')->default(1);
            $table->integer('h23')->default(1);
            $table->integer('h24')->default(1);
            // TIEMPOS DE RECUPERACIÓN
            $table->integer('rpo_mes')->nullable();
            $table->integer('rpo_semana')->nullable();
            $table->integer('rpo_dia')->nullable();
            $table->integer('rpo_hora')->nullable();
            $table->integer('rto_mes')->nullable();
            $table->integer('rto_semana')->nullable();
            $table->integer('rto_dia')->nullable();
            $table->integer('rto_hora')->nullable();
            $table->integer('wrt_mes')->nullable();
            $table->integer('wrt_semana')->nullable();
            $table->integer('wrt_dia')->nullable();
            $table->integer('wrt_hora')->nullable();
            $table->integer('mtpd_mes')->nullable();
            $table->integer('mtpd_semana')->nullable();
            $table->integer('mtpd_dia')->nullable();
            $table->integer('mtpd_hora')->nullable();
            // RESPALDOS DE INFORMACIÓN
            $table->string('respaldo_q_14')->nullable();
            $table->string('respaldo_q_15')->nullable();
            $table->string('respaldo_q_16')->nullable();

            // PROBABILIDAD DE INCIDENTES DISRUPTIVOS
            $table->integer('disruptivos_q_1')->default(0);
            $table->integer('disruptivos_q_2')->default(0);
            $table->integer('disruptivos_q_3')->default(0);
            $table->integer('disruptivos_q_4')->default(0);
            $table->integer('disruptivos_q_5')->default(0);
            $table->integer('disruptivos_q_6')->default(0);
            $table->integer('disruptivos_q_7')->default(0);
            $table->integer('disruptivos_q_8')->default(0);
            $table->integer('disruptivos_q_9')->default(0);
            $table->integer('disruptivos_q_10')->default(0);
            $table->integer('disruptivos_q_11')->default(0);
            // RIESGOS E INCIDENTES DISRUPTIVOS
            $table->integer('operacion_q_1')->nullable();
            $table->integer('operacion_q_2')->nullable();
            $table->integer('operacion_q_3')->nullable();
            $table->integer('regulatorio_q_1')->nullable();
            $table->integer('regulatorio_q_2')->nullable();
            $table->integer('regulatorio_q_3')->nullable();
            $table->integer('reputacion_q_1')->nullable();
            $table->integer('reputacion_q_2')->nullable();
            $table->integer('reputacion_q_3')->nullable();
            $table->integer('social_q_1')->nullable();
            $table->integer('social_q_2')->nullable();
            $table->integer('social_q_3')->nullable();
            $table->string('incidentes_q_26')->nullable();
            $table->string('incidentes_q_27')->nullable();
            $table->longText('q_19')->nullable();
            // Firmas
            $table->string('firma_Entrevistado')->nullable();
            $table->string('firma_Jefe')->nullable();
            $table->string('firma_Entrevistador')->nullable();
            $table->boolean('exite_firma_Entrevistado')->nullable();
            $table->boolean('exite_firma_Jefe')->nullable();
            $table->boolean('exite_firma_Entrevistador')->nullable();
            // Firmas
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
