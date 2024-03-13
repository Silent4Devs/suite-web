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
        Schema::create('objetivos_desempeno_empleados', function (Blueprint $table) {
            $table->id();
            $table->text('objetivo');
            $table->longText('descripcion')->nullable();
            $table->unsignedBigInteger('categoria_objetivo_id');
            $table->text('KPI');
            $table->unsignedBigInteger('unidad_objetivo_id');
            $table->unsignedBigInteger('empleado_id');
            $table->boolean('papelera')->default(false);

            $table->timestamps();

            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('categoria_objetivo_id')->references('id')->on('categoria_objetivos_desempenos')->onDelete('cascade');
            $table->foreign('unidad_objetivo_id')->references('id')->on('unidad_objetivos_desempenos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objetivos_desempeno_empleados');
    }
};
