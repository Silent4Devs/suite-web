<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnEvidenciaTextualToTaskKanbanPASTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task_kanban_p_a_s', function (Blueprint $table) {
            $table->string('evidencia_textual')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_kanban_p_a_s', function (Blueprint $table) {
            //
        });
    }
}
