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
        Schema::create('catalogue_training', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('issuing_company');
            $table->string('mark');
            $table->string('manufacturer');
            $table->string('norma');
            $table->string('status');
            $table->unsignedBigInteger('type_id')->nullable();
            $table->unsignedBigInteger('empleado_id')->nullable();
            $table->foreign('type_id')->references('id')->on('type_catalogue_training')->onDelete('cascade');
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogue_training');
    }
};
