<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnFolioToAccionCorrectivasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accion_correctivas', function (Blueprint $table) {
            $table->unsignedInteger('area_id')->nullable();
            $table->unsignedInteger('proceso_id')->nullable();
            $table->unsignedInteger('activo_id')->nullable();
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('proceso_id')->references('id')->on('procesos');
            $table->foreign('activo_id')->references('id')->on('tipoactivos');
            $table->datetime('fecha_cierre')->after('fecharegistro')->nullable();
            $table->string('folio')->before('fecharegistro')->nullable();
            $table->longText('comentarios')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accion_correctivas', function (Blueprint $table) {
            //
        });
    }
}
