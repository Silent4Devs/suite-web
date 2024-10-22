<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosMaterialSgsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_material_sgsi', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('material_id')->nullable();
            $table->string('documento')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('material_id')->references('id')->on('material_sgsis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos_material_sgsi');
    }
}
