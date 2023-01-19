<?php

namespace Database\Seeders;

use App\Models\TablaImpacto;
use Illuminate\Database\Seeder;

class TablaImpactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tablaImpacto = [
            [
                'impacto' => 'Tabla de Impactos',
            ],
        ];

        TablaImpacto::insert($tablaImpacto);
    }
}
