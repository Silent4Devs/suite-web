<?php

use App\Models\Minutasaltadireccion;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoralRevisionMinutasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historal_revision_minutas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('minuta_id');
            $table->longText('descripcion');
            $table->longText('comentarios');
            $table->dateTime('fecha')->nullable();
            $table->enum('estatus', [Minutasaltadireccion::EN_ELABORACION, Minutasaltadireccion::EN_REVISION, Minutasaltadireccion::PUBLICADO, Minutasaltadireccion::DOCUMENTO_RECHAZADO, Minutasaltadireccion::DOCUMENTO_OBSOLETO])->default(Minutasaltadireccion::EN_ELABORACION);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('minuta_id')->references('id')->on('minutasaltadireccions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historal_revision_minutas');
    }
}
