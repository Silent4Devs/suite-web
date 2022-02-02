<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnNumeroToListaDocumentosEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lista_documentos_empleados', function (Blueprint $table) {
            $table->boolean('activar_numero')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lista_documentos_empleados', function (Blueprint $table) {
            $table->dropColumn('activar_numero');
        });
    }
}
