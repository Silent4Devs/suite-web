<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPlanesAccionKanbanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('planes_accion_kanban', function (Blueprint $table) {
            $table->string('origen')->nullable();
            $table->longText('descripcion')->nullable();
            $table->string('estatus')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planes_accion_kanban', function (Blueprint $table) {
            //
        });
    }
}
