<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variables_contratos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('generar_contrato_id')->nullable();
            // $table->foreign('generar_contrato_id')->references('id')->on('generar_contrato');

            $table->unsignedBigInteger('plantilla_id')->nullable();
            // $table->foreign('plantilla_id')->references('id')->on('plantillas');

            $table->unsignedBigInteger('variable_id')->nullable();
            // $table->foreign('variable_id')->references('id')->on('variables_plantillas');

            $table->string('valor_variable');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variables_contratos');
    }
};
