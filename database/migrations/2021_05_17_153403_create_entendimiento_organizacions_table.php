<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntendimientoOrganizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entendimiento_organizacions', function (Blueprint $table) {
            $table->id();
            $table->text('fortalezas')->nullable();
            $table->text('oportunidades')->nullable();
            $table->text('debilidades')->nullable();
            $table->text('amenazas')->nullable();
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
        Schema::dropIfExists('entendimiento_organizacions');
    }
}
