<?php

use App\Models\RH\ObjetivoComentario;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEv360ObjetivosComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev360_objetivos_comentarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('comentario');
            $table->enum('tipo', [ObjetivoComentario::EVALUADOR, ObjetivoComentario::EVALUADO]);
            $table->unsignedBigInteger('empleado_id');
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ev360_objetivos_comentarios');
    }
}
