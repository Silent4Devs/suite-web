<?php

use App\Models\RevisionDocumento;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArchivadoToRevisionDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('revision_documentos', function (Blueprint $table) {
            $table->enum('archivado', [RevisionDocumento::NO_ARCHIVADO, RevisionDocumento::ARCHIVADO])->after('version')->default(RevisionDocumento::NO_ARCHIVADO);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('revision_documentos', function (Blueprint $table) {
            $table->dropColumn('archivado');
        });
    }
}
