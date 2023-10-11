<?php

namespace Database\Seeders;

use App\Models\Puesto;
use Illuminate\Database\Seeder;

class PuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $puestos = [
            [
                'puesto' => 'Analista de Diseño',
            ],
            [
                'puesto' => 'Analista de Contenido',
            ],
            [
                'puesto' => 'Arquitecto De Soluciones',
            ],
            [
                'puesto' => 'Analista Sr. Alianzas Estratégicas',
            ],
            [
                'puesto' => 'Asistente',
            ],
            [
                'puesto' => 'Líder de Innovación y Desarrollo',
            ],
            [
                'puesto' => 'Analista Gestión de Talento',
            ],
            [
                'puesto' => 'Pentest Jr.',
            ],
            [
                'puesto' => 'Inteligencia del Negocio',
            ],
            [
                'puesto' => 'Trainee De Operaciones',
            ],
            [
                'puesto' => 'Ingeniero en Monitoreo',
            ],
            [
                'puesto' => 'Consultor Junior',
            ],
            [
                'puesto' => 'Desarrollo',
            ],
            [
                'puesto' => 'ITMS',
            ],
            [
                'puesto' => 'ITSM',
            ],
            [
                'puesto' => 'ITSM',
            ],
            [
                'puesto' => 'Trainee de Ciberinteligencia',
            ],
            [
                'puesto' => 'Gerente Comercial IP',
            ],
            [
                'puesto' => 'Gerente De Arquitectura',
            ],
            [
                'puesto' => 'Líder Comercial de Gobierno',
            ],
            [
                'puesto' => 'Gerente Comercial IP / Gobierno',
            ],
            [
                'puesto' => 'Soporte Nivel 1',
            ],
            [
                'puesto' => 'Líder SOC',
            ],
            [
                'puesto' => 'Supervisor Operativo',
            ],
            [
                'puesto' => 'Soporte Técnico Interno',
            ],
            [
                'puesto' => 'Analista de Contabilidad',
            ],
            [
                'puesto' => 'Analista de Contabilidad',
            ],
            [
                'puesto' => 'Analista de Monitoreo',
            ],
            [
                'puesto' => 'Soporte y BI',
            ],
            [
                'puesto' => 'ITSM Y Cognitive Services',
            ],
            [
                'puesto' => 'Monitoreo',
            ],
            [
                'puesto' => 'Trainee',
            ],
            [
                'puesto' => 'Director Sr. Innovación y Nuevos Productos',
            ],
            [
                'puesto' => 'Asistente de Dirección',
            ],
            [
                'puesto' => 'Operativo',
            ],
            [
                'puesto' => 'Director Jr. Comercial',
            ],
            [
                'puesto' => 'Gerente De Operaciones',
            ],
            [
                'puesto' => 'Director Jr. de Finanzas y Administración',
            ],
            [
                'puesto' => 'Líder de Consultoría Estratégica',
            ],
            [
                'puesto' => 'Líder de Servicios de Ciberinteligencia',
            ],
            [
                'puesto' => 'Coordinador de Gestión de Talento',
            ],
            [
                'puesto' => 'Control Documental',
            ],
            [
                'puesto' => 'Líder de Entrega de Servicios',
            ],
            [
                'puesto' => 'Líder de Contraloría',
            ],
            [
                'puesto' => 'Trainee Desarrollador Web',
            ],
            [
                'puesto' => 'Analista De Calidad',
            ],
            [
                'puesto' => 'Project Manager Servicios',
            ],
            [
                'puesto' => 'Especialista',
            ],
            [
                'puesto' => 'Consultor Senior',
            ],
            [
                'puesto' => 'Especialista de Consultoría Estratégica',
            ],
            [
                'puesto' => 'Automatización',
            ],
            [
                'puesto' => 'Analista De Innovación Y Desarrollo',
            ],
            [
                'puesto' => 'Pentest Sr.',
            ],
            [
                'puesto' => 'Analista de Ciberinteligencia',
            ],
            [
                'puesto' => 'Especialista Ciberinteligencia',
            ],
            [
                'puesto' => 'Director Sr. Nuevos Productos',
            ],
            [
                'puesto' => 'Director(a) General',
            ],

        ];

        Puesto::insert($puestos);
    }
}
