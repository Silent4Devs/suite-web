<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanAuditoriaTable extends Migration
{
    public function up()
    {
        Schema::create('plan_auditoria', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('objetivo')->nullable();
            $table->longText('alcance')->nullable();
            $table->longText('criterios')->nullable();
            $table->longText('documentoauditar')->nullable();
            $table->string('equipoauditor')->nullable();
            $table->longText('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
