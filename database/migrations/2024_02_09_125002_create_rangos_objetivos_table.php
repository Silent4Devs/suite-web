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
        Schema::create('rangos_objetivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('catalogo_rangos_id');
            $table->string('parametro');
            $table->float('valor');
            $table->string('color');
            $table->longText('descripcion');

            $table->foreign('catalogo_rangos_id')->references('id')->on('catalogo_rangos_objetivos')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            // catalogo_rangos_objetivos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rangos_objetivos');
    }
};
