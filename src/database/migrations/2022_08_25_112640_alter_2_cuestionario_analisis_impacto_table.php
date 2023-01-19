<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Alter2CuestionarioAnalisisImpactoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cuestionario_analisis_impacto', function (Blueprint $table) {
            $table->integer('primer_semestre')->default(1);
            $table->integer('segundo_semestre')->default(1);
            $table->integer('ene')->default(1);
            $table->integer('feb')->default(1);
            $table->integer('mar')->default(1);
            $table->integer('abr')->default(1);
            $table->integer('may')->default(1);
            $table->integer('jun')->default(1);
            $table->integer('jul')->default(1);
            $table->integer('ago')->default(1);
            $table->integer('sep')->default(1);
            $table->integer('oct')->default(1);
            $table->integer('nov')->default(1);
            $table->integer('dic')->default(1);
            $table->integer('s1')->default(1);
            $table->integer('s2')->default(1);
            $table->integer('s3')->default(1);
            $table->integer('s4')->default(1);
            $table->integer('d1')->default(1);
            $table->integer('d2')->default(1);
            $table->integer('d3')->default(1);
            $table->integer('d4')->default(1);
            $table->integer('d5')->default(1);
            $table->integer('d6')->default(1);
            $table->integer('d7')->default(1);
            $table->integer('d8')->default(1);
            $table->integer('d9')->default(1);
            $table->integer('d10')->default(1);
            $table->integer('d11')->default(1);
            $table->integer('d12')->default(1);
            $table->integer('d13')->default(1);
            $table->integer('d14')->default(1);
            $table->integer('d15')->default(1);
            $table->integer('d16')->default(1);
            $table->integer('d17')->default(1);
            $table->integer('d18')->default(1);
            $table->integer('d19')->default(1);
            $table->integer('d20')->default(1);
            $table->integer('d21')->default(1);
            $table->integer('d22')->default(1);
            $table->integer('d23')->default(1);
            $table->integer('d24')->default(1);
            $table->integer('d25')->default(1);
            $table->integer('d26')->default(1);
            $table->integer('d27')->default(1);
            $table->integer('d28')->default(1);
            $table->integer('d29')->default(1);
            $table->integer('d30')->default(1);
            $table->integer('d31')->default(1);
            $table->integer('h1')->default(1);
            $table->integer('h2')->default(1);
            $table->integer('h3')->default(1);
            $table->integer('h4')->default(1);
            $table->integer('h5')->default(1);
            $table->integer('h6')->default(1);
            $table->integer('h7')->default(1);
            $table->integer('h8')->default(1);
            $table->integer('h9')->default(1);
            $table->integer('h10')->default(1);
            $table->integer('h11')->default(1);
            $table->integer('h12')->default(1);
            $table->integer('h13')->default(1);
            $table->integer('h14')->default(1);
            $table->integer('h15')->default(1);
            $table->integer('h16')->default(1);
            $table->integer('h17')->default(1);
            $table->integer('h18')->default(1);
            $table->integer('h19')->default(1);
            $table->integer('h20')->default(1);
            $table->integer('h21')->default(1);
            $table->integer('h22')->default(1);
            $table->integer('h23')->default(1);
            $table->integer('h24')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cuestionario_analisis_impacto', function (Blueprint $table) {
            //
        });
    }
}
