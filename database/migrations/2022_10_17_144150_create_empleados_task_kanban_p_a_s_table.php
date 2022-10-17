<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTaskKanbanPASTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados_task_kanban_p_a_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleados_id')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('empleados_task_kanban_p_a_s');
    }
}
