<?php

namespace Database\Seeders;

use App\Models\ListaDistribucion;
use Illuminate\Database\Seeder;

class ListaDistribucionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        $modulos = [
            [
                'modulo' => 'Entendimiento de Organización',
                'submodulo' => 'Analisis FODA',
                'modelo' => 'EntendimientoOrganizacion',
                'niveles' => 1,
            ],
            [
                'modulo' => 'Contexto SGSI',
                'submodulo' => 'Determinación de Alcance',
                'modelo' => 'AlcanceSgsi',
                'niveles' => 1,
            ],
            [
                'modulo' => 'Contexto SGSI',
                'submodulo' => 'Politicas de SGSI',
                'modelo' => 'PoliticaSgsi',
                'niveles' => 1,
            ],
            [
                'modulo' => 'Contexto SGSI',
                'submodulo' => 'Matriz de Requisitos Legales y Regulatorios',
                'modelo' => 'MatrizRequisitoLegale',
                'niveles' => 1,
            ],
        ];

        ListaDistribucion::insert($modulos);
    }
}
