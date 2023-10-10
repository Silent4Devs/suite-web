<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguimientoQuejaClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimiento_queja_cliente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('queja_cliente_id');
            $table->tinyInteger('estado')->default(0);
            $table->foreign('queja_cliente_id')->references('id')->on('quejas_clientes')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('seguimiento_queja_cliente');
    }
}
