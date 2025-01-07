<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsJustificacionProcedenteToIncidentesSeguridadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incidentes_seguridad', function (Blueprint $table) {
            $table->boolean('procedente')->default(true);
            $table->longText('justificacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incidentes_seguridad', function (Blueprint $table) {
            //
        });
    }
}
