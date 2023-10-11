<?php

namespace Database\Seeders;

use App\Models\GapUno;
use Illuminate\Database\Seeder;

class GapunoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gapuno = [
            [
                'pregunta' => '¿La entidad cuenta con un autodiagnóstico realizado para medir el avance en el establecimiento, implementación, mantenimiento y mejora continua de su SGSI (Sistema de Gestión de Seguridad de la información)?',
            ],
            [
                'pregunta' => '¿La entidad creó un caso de estudio o plan inicial del proyecto, donde se incluyen las prioridades y objetivos para la implementación del SGSI?',
            ],
            [
                'pregunta' => '¿La entidad contó con la aprobación de la dirección para iniciar el proyecto del SGSI?	',
            ],
            [
                'pregunta' => '¿La entidad ha identificado los aspectos internos y externos que pueden afectar en el desarrollo del proyecto de implementación del sistema de gestión de seguridad de la información?	',
            ],
            [
                'pregunta' => '¿La entidad ha identificado las partes interesadas, necesidades y expectativas de estas respecto al Sistema de Gestión de Seguridad de la Información?	',
            ],
            [
                'pregunta' => '¿La entidad ha evaluado los objetivos y las necesidades respecto a la Seguridad de la Información?	',
            ],
            [
                'pregunta' => '¿En la entidad se ha definido un Comité de Seguridad de la Información?',
            ],
            [
                'pregunta' => '¿La entidad cuenta con una definición del alcance y los límites del Sistema de Gestión de Seguridad de la Información?',
            ],
            [
                'pregunta' => 'En la entidad existe un documento de política del Sistema de Gestión de Seguridad de la Información, el cual ha sido aprobado por la Dirección?',
            ],
            [
                'pregunta' => '¿En la entidad existe un documento de roles, responsabilidades y autoridades en seguridad de la información?',
            ],
            [
                'pregunta' => '¿La entidad tiene establecido algún proceso para identificar, analizar, valorar y tratar los riesgos de seguridad de la información?',
            ],
            [
                'pregunta' => '¿La entidad ha realizado una declaración de aplicabilidad que contenga los controles requeridos por la entidad?',
            ],
            [
                'pregunta' => '¿La entidad ha evaluado las competencias de las personas que realizan, bajo su control, un trabajo que afecta el desempeño de la seguridad de la Información?',
            ],
            [
                'pregunta' => '¿La entidad tiene definido un modelo de comunicaciones tanto internas como externas respecto a la seguridad de la información?',
            ],
            [
                'pregunta' => '¿La entidad tiene la información referente al Sistema de Gestión de Seguridad de la Información debidamente documentada y controlada?',
            ],
        ];

        GapUno::insert($gapuno);
    }
}
