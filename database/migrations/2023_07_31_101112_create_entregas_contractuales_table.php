<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entregas_contractuales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_entregable')->nullable();
            $table->string('descripcion')->nullable();
            $table->dateTime('plazo_entrega_inicio')->nullable();
            $table->dateTime('plazo_entrega_termina')->nullable();
            $table->dateTime('entrega_real')->nullable();
            $table->string('cumplimiento')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('deductiva_penalizacion')->nullable();
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
        Schema::dropIfExists('entregas_contractuales');
    }
};
