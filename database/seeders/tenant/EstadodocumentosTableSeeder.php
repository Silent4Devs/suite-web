<?php

namespace Database\Seeders;

use App\Models\EstadoDocumento;
use Illuminate\Database\Seeder;

class EstadodocumentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $estadodoc = [
            [
                'id'                 => 1,
                'estado'               => 'Publicados',
                'descripcion'              => 'Publicados',

            ],
            [
                'id'                 => 2,
                'estado'               => 'Aprobados',
                'descripcion'              => 'Aprobados',

            ],
            [
                'id'                 => 3,
                'estado'               => 'En revision',
                'descripcion'              => 'En revisión',

            ],
            [
                'id'                 => 4,
                'estado'               => 'Elaborado',
                'descripcion'              => 'Generado',

            ],
            [
                'id'                 => 5,
                'estado'               => 'No elaborado',
                'descripcion'              => 'No generado',

            ],
        ];
        EstadoDocumento::insert($estadodoc);
    }
}
