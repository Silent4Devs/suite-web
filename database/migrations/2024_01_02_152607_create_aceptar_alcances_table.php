<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aceptar_alcances', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('id_alcance');

            $table->boolean('acepto')->default(true);

            $table->unsignedInteger('id_empleado');

            $table->foreign('id_empleado')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('id_alcance')->references('id')->on('alcance_sgsis')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aceptar_alcances');
    }
};