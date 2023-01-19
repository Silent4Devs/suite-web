<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveFkEv360ObjetivoEmpleadosObjetivoIdForeignToEv360ObjetivoEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ev360_objetivo_empleados', function (Blueprint $table) {
            $table->dropForeign('ev360_objetivo_empleados_objetivo_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ev360_objetivo_empleados', function (Blueprint $table) {
            //
        });
    }
}
