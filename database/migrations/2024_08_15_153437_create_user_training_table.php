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
        Schema::create('user_training', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->unsignedBigInteger('name_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('credential_id')->nullable();
            $table->string('credential_url')->nullable();
            $table->boolean('isChecked')->nullable();
            $table->date('validity')->nullable();
            $table->boolean('validityStatus')->nullable();
            $table->unsignedBigInteger('evidence_id')->nullable();
            $table->unsignedBigInteger('empleado_id')->nullable();

            $table->foreign('type_id')->references('id')->on('type_catalogue_training')->onDelete('cascade');
            $table->foreign('name_id')->references('id')->on('catalogue_training')->onDelete('cascade');
            $table->foreign('evidence_id')->references('id')->on('evidence_training')->onDelete('cascade');
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
        Schema::dropIfExists('user_training');
    }
};
