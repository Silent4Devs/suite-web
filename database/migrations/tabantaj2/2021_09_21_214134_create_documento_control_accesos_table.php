<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoControlAccesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_control_accesos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('controlA_id')->nullable();
            $table->string('documento')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('controlA_id')->references('id')->on('control_accesos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documento_control_accesos');
    }
}
