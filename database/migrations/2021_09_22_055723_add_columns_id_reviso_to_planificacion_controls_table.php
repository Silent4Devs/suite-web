<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsIdRevisoToPlanificacionControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('planificacion_controls', function (Blueprint $table) {
            $table->unsignedBigInteger('id_reviso')->nullable();
            $table->foreign('id_reviso')->references('id')->on('empleados');
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
