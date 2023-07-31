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
        Schema::create('generar_contrato', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->longText('contenido');
            $table->longText('informacion')->nullable();
            $table->json('variables_utilizadas')->nullable();
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
        Schema::dropIfExists('generar_contrato');
    }
};
