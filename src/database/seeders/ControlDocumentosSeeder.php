<?php

namespace Database\Seeders;

use App\Models\ControlDocumento;
use Illuminate\Database\Seeder;

class ControlDocumentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ControlDocumento::create([
            'nombre' => 'Contexto de la organización',
            'version' => '0',
            'estado_id' => 5,
        ]);
    }
}
