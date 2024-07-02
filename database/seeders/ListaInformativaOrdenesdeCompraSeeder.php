<?php

namespace Database\Seeders;

use App\Models\ListaInformativa;
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
                'modulo' => 'Gestión Contractual',
                'submodulo' => 'Ordenes de Compra - Internas',
                'modelo' => 'OrdenCompra',
            ],
            [
                'modulo' => 'Gestión Contractual',
                'submodulo' => 'Ordenes de Compra - Externas',
                'modelo' => 'OrdenCompra',
            ],
        ];

        ListaInformativa::insert($modulos);
    }
}
