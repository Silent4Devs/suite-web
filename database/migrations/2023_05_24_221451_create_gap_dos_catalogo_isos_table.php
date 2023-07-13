<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGapDosCatalogoIsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'gap_dos_catalogo_isos', function (Blueprint $table) {
                $table->id();
                $table->string('control_iso')->nullable();
                $table->longText('anexo_politica')->nullable();
                $table->longText('anexo_descripcion')->nullable();
                $table->string('valoracion')->nullable();
                //foreign
                $table->unsignedBigInteger('id_clasificacion')->nullable();
                $table->foreign('id_clasificacion')->references('id')->on('clasificacion_isos');
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
        Schema::dropIfExists('gap_dos_catalogo_isos');
    }
}
