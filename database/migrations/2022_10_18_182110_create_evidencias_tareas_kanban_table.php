<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidenciasTareasKanbanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidencias_tareas_kanban', function (Blueprint $table) {
            $table->id();
            $table->string('archivo');
            $table->string('extension');
            $table->foreignId('task_kanban_p_a_s_id')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('evidencias_tareas_kanban');
    }
}
