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
        Schema::create('penas_deductivas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_servicio')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('penalizacion')->nullable();
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
        Schema::dropIfExists('penas_deductivas');
    }
};
