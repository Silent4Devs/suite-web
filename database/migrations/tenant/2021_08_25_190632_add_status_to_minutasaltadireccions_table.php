<?php

use App\Models\Minutasaltadireccion;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToMinutasaltadireccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('minutasaltadireccions', function (Blueprint $table) {
            $table->enum('estatus', [Minutasaltadireccion::EN_ELABORACION, Minutasaltadireccion::EN_REVISION, Minutasaltadireccion::PUBLICADO, Minutasaltadireccion::DOCUMENTO_RECHAZADO, Minutasaltadireccion::DOCUMENTO_OBSOLETO])->default(Minutasaltadireccion::EN_ELABORACION);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('minutasaltadireccions', function (Blueprint $table) {
            $table->dropColumn('estatus');
        });
    }
}
