<?php

namespace Database\Seeders;

use App\Models\Documento;
use App\Models\Proceso;
use Illuminate\Database\Seeder;

class DocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $documentos_proceso = Documento::factory(2)->create();
        foreach ($documentos_proceso as $documento) {
            Proceso::create([
                'codigo' => $documento->codigo,
                'nombre' => $documento->nombre,
                'id_macroproceso' => $documento->macroproceso_id,
                'estatus' => Proceso::ACTIVO,
                'documento_id' => $documento->id,
            ]);
        }
    }
}
