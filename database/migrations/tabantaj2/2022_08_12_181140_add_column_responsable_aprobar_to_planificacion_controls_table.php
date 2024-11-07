<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnResponsableAprobarToPlanificacionControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('planificacion_controls', function (Blueprint $table) {
            $table->unsignedBigInteger('id_responsable_aprobar')->nullable();
            $table->longText('firma_registro')->nullable();
            $table->longText('firma_responsable')->nullable();
            $table->longText('firma_responsable_aprobador')->nullable();
            $table->boolean('aprobado')->default(false);
            $table->foreign('id_responsable_aprobar')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
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
