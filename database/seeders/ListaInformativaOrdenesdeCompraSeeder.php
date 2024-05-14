<?php

namespace Database\Seeders;

use App\Models\ListaInformativa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListaInformativaOrdenesdeCompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $modulos = [
            [
                'modulo' => 'Ordenes De Compra',
                'submodulo' => 'Ordenes de Compra - Internas',
                'modelo' => 'OrdenCompra',
            ],
            [
                'modulo' => 'Ordenes De Compra',
                'submodulo' => 'Ordenes de Compra - Externas',
                'modelo' => 'OrdenCompra',
            ],
        ];

        ListaInformativa::insert($modulos);
    }
}
