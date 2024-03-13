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
        Schema::create('escalas_objetivos_desempenos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_objetivo_desempeno');
            $table->integer('condicion');
            $table->float('valor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escalas_objetivos_desempenos');
    }
};
