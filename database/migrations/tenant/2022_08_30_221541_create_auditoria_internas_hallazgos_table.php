<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditoriaInternasHallazgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditoria_internas_hallazgos', function (Blueprint $table) {
            $table->id();
            $table->longText('incumplimiento_requisito')->nullable();
            $table->longText('descripcion')->nullable();
            $table->string('clasificacion_hallazgo')->nullable();
            $table->unsignedInteger('auditoria_internas_id')->nullable();
            $table->unsignedInteger('area_id')->nullable();
            $table->unsignedInteger('proceso_id')->nullable();
            $table->foreign('auditoria_internas_id')->references('id')->on('auditoria_internas');
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('proceso_id')->references('id')->on('procesos');
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
        Schema::dropIfExists('auditoria_internas_hallazgos');
    }
}
