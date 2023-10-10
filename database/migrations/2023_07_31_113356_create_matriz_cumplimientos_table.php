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
        Schema::create('matriz_cumplimiento', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('clausula_vineta_numeral')->nullable();
            $table->integer('pagina')->nullable();
            $table->string('descripcion')->nullable();
            $table->date('plazo_maximo')->nullable();
            $table->date('fecha_entrega')->nullable();
            $table->string('evidencia')->nullable();
            $table->string('tipo')->nullable();
            $table->string('observaciones')->nullable();
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
        Schema::dropIfExists('matriz_cumplimiento');
    }
};
