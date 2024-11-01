<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsIdRevisoToTratamientoRiesgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tratamiento_riesgos', function (Blueprint $table) {
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
        Schema::table('tratamiento_riesgos', function (Blueprint $table) {
            //
        });
    }
}
