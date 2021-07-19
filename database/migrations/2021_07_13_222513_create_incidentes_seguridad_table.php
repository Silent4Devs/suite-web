<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\IncidentesSeguridad;

class CreateIncidentesSeguridadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidentes_seguridad', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->nullable();
            $table->longText('descripcion')->nullable();
            $table->text('activos_afectados')->nullable();
            $table->dateTime('fecha')->nullable();
            $table->string('categoria')->nullable();
            $table->string('subcategoria')->nullable();
            $table->string('clasificacion')->nullable();
            $table->string('prioridad')->nullable();
            $table->string('estatus')->default('nuevo');
            $table->longText('comentarios')->nullable();


            $table->unsignedBigInteger('empleado_reporto_id')->nullable();
            $table->unsignedBigInteger('empleado_asignado_id')->nullable();

            $table->foreign('empleado_reporto_id')->references('id')->on('empleados');
            $table->foreign('empleado_asignado_id')->references('id')->on('empleados');

            $table->string('evidencia')->nullable();

            $table->enum('archivado', [IncidentesSeguridad::NO_ARCHIVADO, IncidentesSeguridad::ARCHIVADO])->default(IncidentesSeguridad::NO_ARCHIVADO);
            

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incidentes_seguridad');
    }
}
