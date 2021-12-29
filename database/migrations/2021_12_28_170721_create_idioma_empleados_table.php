<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdiomaEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idioma_empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('nivel');
            $table->smallInteger('porcentaje')->nullable();
            $table->string('certificado')->nullable();
            $table->unsignedBigInteger('empleado_id');
            $table->timestamps();

            $table->foreign('empleado_id')
                ->references('id')
                ->on('empleados')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('idioma_empleados');
    }
}
