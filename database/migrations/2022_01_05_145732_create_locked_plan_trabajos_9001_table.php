<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLockedPlanTrabajos9001Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locked_plan_trabajos_9001', function (Blueprint $table) {
            $table->id();
            $table->dateTime('locked_to');
            $table->enum('blocked', ['1', '0']);
            $table->string('locked_by');
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
        Schema::dropIfExists('locked_plan_trabajos_9001');
    }
}
