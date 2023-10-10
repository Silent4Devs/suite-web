<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddComlumnsSignatureToEv360EvaluadoEvaluadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ev360_evaluado_evaluador', function (Blueprint $table) {
            $table->string('firma_evaluado')->nullable();
            $table->string('firma_evaluador')->nullable();
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
