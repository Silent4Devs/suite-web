<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTipoEvidenciasDocumentosEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evidencias_documentos_empleados', function (Blueprint $table) {
            $table->string('tipo')->default('opcional');
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
            $table->dropColumn('tipo');
        });
    }
}
