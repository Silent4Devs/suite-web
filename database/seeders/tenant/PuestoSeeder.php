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
            ['id' => 1, 'puesto' => 'Analista de Contenido'],
            ['id' => 2, 'puesto' => 'Analista de Diseño'],
            ['id' => 3, 'puesto' => 'Arquitecto De Soluciones'],
            ['id' => 4, 'puesto' => 'Analista Sr. Alianzas Estratégicas'],
            ['id' => 5, 'puesto' => 'Asistente'],
            ['id' => 6, 'puesto' => 'Líder de Innovación y Desarrollo'],
            ['id' => 7, 'puesto' => 'Analista Gestión de Talento'],
            ['id' => 8, 'puesto' => 'Pentest Jr.'],
            ['id' => 9, 'puesto' => 'Inteligencia del Negocio'],
            ['id' => 10, 'puesto' => 'Trainee De Operaciones'],
            ['id' => 11, 'puesto' => 'Ingeniero en Monitoreo'],
            ['id' => 12, 'puesto' => 'Consultor Junior'],
            ['id' => 13, 'puesto' => 'Desarrollo'],
            ['id' => 14, 'puesto' => 'ITMS'],
            ['id' => 15, 'puesto' => 'ITSM'],
            ['id' => 16, 'puesto' => 'ITSM'],
            ['id' => 17, 'puesto' => 'Trainee de Ciberinteligencia'],
            ['id' => 18, 'puesto' => 'Gerente Comercial IP'],
            ['id' => 19, 'puesto' => 'Gerente De Arquitectura'],
            ['id' => 20, 'puesto' => 'Líder Comercial de Gobierno'],
            ['id' => 21, 'puesto' => 'Gerente Comercial IP / Gobierno'],
            ['id' => 22, 'puesto' => 'Soporte Nivel 1'],
            ['id' => 23, 'puesto' => 'Líder SOC'],
            ['id' => 24, 'puesto' => 'Supervisor Operativo'],
            ['id' => 25, 'puesto' => 'Soporte Técnico Interno'],
            ['id' => 26, 'puesto' => 'Analista de Contabilidad'],
            ['id' => 27, 'puesto' => 'Analista de Contabilidad'],
            ['id' => 28, 'puesto' => 'Analista de Monitoreo'],
            ['id' => 29, 'puesto' => 'Soporte y BI'],
            ['id' => 30, 'puesto' => 'ITSM Y Cognitive Services'],
            ['id' => 31, 'puesto' => 'Monitoreo'],
            ['id' => 32, 'puesto' => 'Trainee'],
            ['id' => 33, 'puesto' => 'Director Sr. Innovación y Nuevos Productos'],
            ['id' => 34, 'puesto' => 'Asistente de Dirección'],
            ['id' => 35, 'puesto' => 'Operativo'],
            ['id' => 36, 'puesto' => 'Director Jr. Comercial'],
            ['id' => 37, 'puesto' => 'Gerente De Operaciones'],
            ['id' => 38, 'puesto' => 'Director Jr. de Finanzas y Administración'],
            ['id' => 39, 'puesto' => 'Líder de Consultoría Estratégica'],
            ['id' => 40, 'puesto' => 'Líder de Servicios de Ciberinteligencia'],
            ['id' => 41, 'puesto' => 'Coordinador de Gestión de Talento'],
            ['id' => 42, 'puesto' => 'Control Documental'],
            ['id' => 43, 'puesto' => 'Líder de Entrega de Servicios'],
            ['id' => 44, 'puesto' => 'Líder de Contraloría'],
            ['id' => 45, 'puesto' => 'Trainee Desarrollador Web'],
            ['id' => 46, 'puesto' => 'Analista De Calidad'],
            ['id' => 47, 'puesto' => 'Project Manager Servicios'],
            ['id' => 48, 'puesto' => 'Especialista'],
            ['id' => 49, 'puesto' => 'Consultor Senior'],
            ['id' => 50, 'puesto' => 'Especialista de Consultoría Estratégica'],
            ['id' => 51, 'puesto' => 'Automatización'],
            ['id' => 52, 'puesto' => 'Analista De Innovación Y Desarrollo'],
            ['id' => 53, 'puesto' => 'Pentest Sr.'],
            ['id' => 54, 'puesto' => 'Analista de Ciberinteligencia'],
            ['id' => 55, 'puesto' => 'Especialista Ciberinteligencia'],
            ['id' => 56, 'puesto' => 'Director Sr. Nuevos Productos'],
            ['id' => 57, 'puesto' => 'Director(a) General'],

        ];

        Puesto::insert($puestos);
    }
}
