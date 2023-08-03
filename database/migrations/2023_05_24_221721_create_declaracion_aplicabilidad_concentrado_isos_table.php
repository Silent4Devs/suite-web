<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeclaracionAplicabilidadConcentradoIsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'declaracion_aplicabilidad_concentrado_isos', function (Blueprint $table) {
                $table->id();
                $table->string('valoracion')->nullable();
                //foreign
                $table->unsignedBigInteger('id_gap_dos_catalogo')->nullable();
                $table->foreign('id_gap_dos_catalogo')->references('id')->on('gap_dos_catalogo_isos');
                $table->timestamps();
                $table->softDeletes();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('declaracion_aplicabilidad_concentrado_isos');
    }
}
