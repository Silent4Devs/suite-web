<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDuenoToTratamientoRiesgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tratamiento_riesgos', function (Blueprint $table) {
            $table->unsignedInteger('id_dueno')->nullable();
            $table->foreign('id_dueno')->references('id')->on('empleados');
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
