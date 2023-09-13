<?php

namespace Database\Seeders;

use App\Models\ClasificacionesAuditorias;
use Illuminate\Database\Seeder;

class ClasificacionesAuditoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $clasif = [
            [
                'identificador' => '1',
                'nombre' => 'No conformidad Menor',
                'descripcion' => '',
            ],
            [
                'identificador' => '2',
                'nombre' => 'No conformidad Mayor',
                'descripcion' => '',
            ],
            [
                'identificador' => '3',
                'nombre' => 'Oportunidad de mejora',
                'descripcion' => '',
            ],
            [
                'identificador' => '4',
                'nombre' => 'Observación',
                'descripcion' => '',
            ],
        ];

        ClasificacionesAuditorias::insert($clasif);
    }
}
