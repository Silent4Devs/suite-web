<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('foto')->nullable();
            $table->string('puesto')->nullable();
            $table->date('antiguedad')->nullable();
            $table->string('estatus')->nullable();
            $table->string('email')->nullable();
            $table->integer('supervisor_id')->nullable();
            $table->integer('area_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('supervisor_id')->references('id')->on('empleados')->onDelete('SET NULL');
        });

        Schema::table('empleados', function ($table) {
            $table->foreign('area_id')->references('id')->on('areas')->onUpdate('cascade')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
