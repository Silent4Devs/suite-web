<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanelOrganizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panel_organizacions', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('empresa')->nullable()->default(1);
            $table->boolean('direccion')->nullable()->default(1);
            $table->boolean('telefono')->nullable()->default(1);
            $table->boolean('correo')->nullable()->default(1);
            $table->boolean('pagina_web')->nullable()->default(1);
            $table->boolean('giro')->nullable()->default(1);
            $table->boolean('servicios')->nullable()->default(1);
            $table->boolean('mision')->nullable()->default(1);
            $table->boolean('vision')->nullable()->default(1);
            $table->boolean('valores')->nullable()->default(1);
            $table->boolean('team_id')->nullable()->default(1);
            $table->boolean('antecedentes')->nullable()->default(1);
            $table->boolean('logotipo')->nullable()->default(1);
            $table->boolean('razon_social')->nullable()->default(1);
            $table->boolean('rfc')->nullable()->default(1);
            $table->boolean('representante_legal')->nullable()->default(1);
            $table->boolean('fecha_constitucion')->nullable()->default(1);
            $table->boolean('num_empleados')->nullable()->default(1);
            $table->boolean('tamano')->nullable()->default(1);
            $table->boolean('schedule')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('panel_organizacions');
    }
}
