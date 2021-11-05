<?php

use App\Models\Documento;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialVersionesDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_versiones_documentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('documento_id');
            $table->string('codigo');
            $table->string('nombre');
            $table->string('tipo');
            $table->unsignedInteger('macroproceso_id')->nullable();
            $table->enum('estatus', [Documento::EN_ELABORACION, Documento::EN_REVISION, Documento::PUBLICADO, Documento::DOCUMENTO_RECHAZADO, Documento::DOCUMENTO_OBSOLETO])->default(Documento::EN_ELABORACION);
            $table->string('version');
            $table->dateTime('fecha');
            $table->string('archivo');
            $table->unsignedBigInteger('elaboro_id')->nullable();
            $table->unsignedBigInteger('reviso_id')->nullable();
            $table->unsignedBigInteger('aprobo_id')->nullable();
            $table->unsignedBigInteger('responsable_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('historial_versiones_documentos', function (Blueprint $table) {
            // Relaciones
            $table->foreign('documento_id')->references('id')->on('documentos');
            $table->foreign('macroproceso_id')->references('id')->on('macroprocesos');
            $table->foreign('elaboro_id')->references('id')->on('empleados')->onDelete('SET NULL');
            $table->foreign('reviso_id')->references('id')->on('empleados')->onDelete('SET NULL');
            $table->foreign('aprobo_id')->references('id')->on('empleados')->onDelete('SET NULL');
            $table->foreign('responsable_id')->references('id')->on('empleados')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_versiones_documentos');
    }
}
