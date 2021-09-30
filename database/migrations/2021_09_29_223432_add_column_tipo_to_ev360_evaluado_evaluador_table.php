<?php

use App\Models\RH\EvaluadoEvaluador;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTipoToEv360EvaluadoEvaluadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ev360_evaluado_evaluador', function (Blueprint $table) {
            $table->enum('tipo', [EvaluadoEvaluador::AUTOEVALUACION, EvaluadoEvaluador::JEFE_INMEDIATO, EvaluadoEvaluador::EQUIPO, EvaluadoEvaluador::MISMA_AREA])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ev360_evaluado_evaluador', function (Blueprint $table) {
            //
        });
    }
}
