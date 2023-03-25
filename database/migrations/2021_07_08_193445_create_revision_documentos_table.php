<?php

use App\Models\Documento;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision_documentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empleado_id');
            $table->unsignedBigInteger('documento_id');
            $table->longText('comentarios')->nullable();
            $table->string('nivel')->nullable();
            $table->enum('estatus', [Documento::APROBADO, Documento::RECHAZADO, Documento::SOLICITUD_REVISION, Documento::RECHAZADO_EN_CONSECUENCIA_POR_NIVEL_ANTERIOR])->default(Documento::SOLICITUD_REVISION);
            $table->string('no_revision')->default('1');
            $table->string('version')->default('0');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('empleado_id')->references('id')->on('empleados');
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
        Schema::dropIfExists('revision_documentos');
    }
}
