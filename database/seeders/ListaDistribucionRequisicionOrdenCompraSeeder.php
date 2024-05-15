<?php

namespace Database\Seeders;

use App\Models\ListaDistribucion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListaDistribucionRequisicionOrdenCompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $LD = [
            [
                'modulo' => "Gestión Contractual",
                'submodulo' => "Requisiciones",
                "modelo" => "KatbolRequsicion",
                "niveles" => 6,
            ],
            [
                'modulo' => "Gestión Contractual",
                'submodulo' => "Ordenes de Compra",
                "modelo" => "OrdenCompra",
                "niveles" => 6,
            ]
        ];

        ListaDistribucion::insert($LD);
    }
}
