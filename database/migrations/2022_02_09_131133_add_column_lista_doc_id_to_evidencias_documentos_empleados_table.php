<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnListaDocIdToEvidenciasDocumentosEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evidencias_documentos_empleados', function (Blueprint $table) {
            $table->unsignedBigInteger('lista_documentos_empleados_id')->nullable();
            $table->foreign('lista_documentos_empleados_id')->references('id')->on('lista_documentos_empleados')->onDelete('cascade')->onUpdate('cascade');

            $table->dropColumn('nombre');
            $table->dropColumn('tipo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evidencias_documentos_empleados', function (Blueprint $table) {
            //
        });
    }
}
