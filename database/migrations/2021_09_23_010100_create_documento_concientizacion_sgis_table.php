<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoConcientizacionSgisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_concientizacion_sgis', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('concientSgsi_id')->nullable();
            $table->string('documento')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('concientSgsi_id')->references('id')->on('concientizacion_sgis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documento_concientizacion_sgis');
    }
}
