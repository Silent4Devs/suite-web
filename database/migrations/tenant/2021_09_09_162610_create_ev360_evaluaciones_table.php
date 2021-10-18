<?php

use App\Models\RH\Evaluacion;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEv360EvaluacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev360_evaluaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->longText('descripcion')->nullable();
            $table->enum('estatus', [Evaluacion::DRAFT, Evaluacion::ACTIVE, Evaluacion::CLOSED])->default(Evaluacion::DRAFT);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ev360_evaluaciones');
    }
}
