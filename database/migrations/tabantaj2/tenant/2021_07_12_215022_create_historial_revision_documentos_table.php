<?php

use App\Models\Documento;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialRevisionDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_revision_documentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('documento_id');
            $table->longText('descripcion');
            $table->longText('comentarios');
            $table->dateTime('fecha')->nullable();
            $table->enum('estatus', [Documento::EN_ELABORACION, Documento::EN_REVISION, Documento::PUBLICADO, Documento::DOCUMENTO_RECHAZADO, Documento::DOCUMENTO_OBSOLETO])->default(Documento::EN_ELABORACION);
            $table->string('version');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('documento_id')->references('id')->on('documentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_revision_documentos');
    }
}
