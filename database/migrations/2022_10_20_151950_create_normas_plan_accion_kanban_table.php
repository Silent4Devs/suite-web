<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNormasPlanAccionKanbanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('normas_plan_accion_kanban', function (Blueprint $table) {
            $table->id();
            $table->foreignId('norma_id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('planes_accion_kanban_id')->onUpdate('cascade');
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
        Schema::dropIfExists('normas_plan_accion_kanban');
    }
}
