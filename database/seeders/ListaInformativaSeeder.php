<?php

namespace Database\Seeders;

use App\Models\ListaInformativa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListaInformativaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $modulos = [
            [
                'modulo' => 'Entendimiento de Organización',
                'submodulo' => 'Analisis FODA',
                'modelo' => 'EntendimientoOrganizacion',
            ],
            [
                'modulo' => 'Contexto SGSI',
                'submodulo' => 'Determinación de Alcance',
                'modelo' => 'AlcanceSgsi',
            ],
            [
                'modulo' => 'Contexto SGSI',
                'submodulo' => 'Politicas de SGSI',
                'modelo' => 'PoliticaSgsi',
            ],
            [
                'modulo' => 'Contexto SGSI',
                'submodulo' => 'Matriz de Requisitos Legales y Regulatorios',
                'modelo' => 'MatrizRequisitoLegale',
            ],
        ];

        ListaInformativa::insert($modulos);
    }
}
