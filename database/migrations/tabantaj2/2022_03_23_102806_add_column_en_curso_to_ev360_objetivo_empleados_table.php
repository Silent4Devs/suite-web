<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnEnCursoToEv360ObjetivoEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ev360_objetivo_empleados', function (Blueprint $table) {
            $table->boolean('en_curso')->default(true);
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
