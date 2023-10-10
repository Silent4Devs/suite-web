<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPlanificacionControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('planificacion_controls', function (Blueprint $table) {
            $table->string('folio_cambio')->nullable();
            $table->date('fecha_registro')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_termino')->nullable();
            $table->longText('objetivo')->nullable();
            $table->longText('criterios_aceptacion')->nullable();
            $table->unsignedBigInteger('id_responsable')->nullable();
            $table->unsignedBigInteger('origen_id')->nullable();
            $table->foreign('id_responsable')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('origen_id')->references('id')->on('planificacion_control_origen_cambio')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planificacion_controls', function (Blueprint $table) {
            //
        });
    }
}
