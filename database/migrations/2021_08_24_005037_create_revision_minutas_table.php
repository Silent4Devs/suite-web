<?php

use App\Models\RevisionMinuta;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionMinutasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision_minutas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empleado_id');
            $table->unsignedInteger('minuta_id');
            $table->longText('comentarios')->nullable();
            $table->string('nivel')->nullable();
            $table->enum('estatus', [RevisionMinuta::APROBADO, RevisionMinuta::RECHAZADO, RevisionMinuta::SOLICITUD_REVISION, RevisionMinuta::RECHAZADO_EN_CONSECUENCIA_POR_NIVEL_ANTERIOR, RevisionMinuta::RECHAZADO_POR_NUEVA_EDICION])->default(RevisionMinuta::SOLICITUD_REVISION);
            $table->string('no_revision')->default('1');
            $table->enum('archivado', [RevisionMinuta::NO_ARCHIVADO, RevisionMinuta::ARCHIVADO])->default(RevisionMinuta::NO_ARCHIVADO);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('empleado_id')->references('id')->on('empleados');
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
        Schema::dropIfExists('revision_minutas');
    }
}
