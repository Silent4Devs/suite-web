<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanImplementacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_implementacions', function (Blueprint $table) {
            $table->id();
            $table->json('tasks');
            // $table->array('deletedTaskIds');
            $table->string('canAdd')->nullable();
            $table->string('canWrite')->nullable();
            $table->string('canWriteOnParent')->nullable();
            $table->string('changesReasonWhy')->nullable();
            $table->string('selectedRow')->nullable();
            $table->string('zoom')->nullable();
            $table->string('parent');
            $table->string('slug')->unique();
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
        Schema::dropIfExists('plan_implementacions');
    }
}
