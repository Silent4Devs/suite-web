<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCanalToQuejasClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quejas_clientes', function (Blueprint $table) {
            $table->string('canal')->nullable();
            $table->string('otro_canal')->nullable();
            $table->boolean('correo_cliente')->default(false);
            $table->string('urgencia')->nullable();
            $table->string('impacto')->nullable();
            $table->string('prioridad')->nullable();
            $table->longText('solucion_requerida_cliente')->nullable();
            $table->string('categoria_queja')->nullable();
            $table->string('otro_categoria')->nullable();
            $table->boolean('queja_procedente')->default(false);
            $table->longText('porque_procedente')->nullable();
            $table->boolean('realizar_accion')->default(false);
            $table->longText('cual_accion')->nullable();
            $table->boolean('desea_levantar_ac')->default(false);
            $table->longText('acciones_tomara_responsable')->nullable();
            $table->date('fecha_limite')->nullable();
            $table->longText('comentarios_atencion')->nullable();
            $table->boolean('cumplio_ac_responsable')->default(false);
            $table->longText('porque_no_cumplio_responsable')->nullable();
            $table->boolean('conforme_solucion')->default(false);
            $table->boolean('cerrar_ticket')->default(false);
            $table->unsignedBigInteger('empleado_reporto_id')->nullable();
            $table->unsignedBigInteger('responsable_sgi_id')->nullable();
            $table->unsignedBigInteger('responsable_atencion_queja_id')->nullable();
            $table->unsignedBigInteger('accion_correctiva_id')->nullable();
            $table->foreign('empleado_reporto_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('responsable_sgi_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('responsable_atencion_queja_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('accion_correctiva_id')->references('id')->on('accion_correctivas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quejas_clientes', function (Blueprint $table) {
            //
        });
    }
}
