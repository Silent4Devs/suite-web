<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddControlToTratamientoRiesgos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tratamiento_riesgos', function (Blueprint $table) {
            $table->dropForeign('control_fk_2444996');
            $table->foreign('control_id')->references('id')->on('declaracion_aplicabilidad');
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
