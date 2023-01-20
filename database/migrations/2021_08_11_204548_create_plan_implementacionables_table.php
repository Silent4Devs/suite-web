<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanImplementacionablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_implementacionables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_implementacion_id')->nullable();
            $table->unsignedBigInteger('plan_implementacionable_id')->nullable();
            $table->string('plan_implementacionable_type')->nullable();
            $table->foreign('plan_implementacion_id')->references('id')->on('plan_implementacions')->onDelete('cascade');
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
        Schema::dropIfExists('plan_implementacionables');
    }
}
