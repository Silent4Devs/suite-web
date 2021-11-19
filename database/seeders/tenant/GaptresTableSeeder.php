<?php

namespace Database\Seeders;

use App\Models\GapTre;
use Illuminate\Database\Seeder;

class GaptresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gaptre = [
            [
                'pregunta' => '¿La entidad tiene una metodología para realizar seguimiento, medición y análisis permanente al desempeño de la Seguridad de laInformación?',
                'estado' => 'verificar',
            ],
            [
                'pregunta' => '¿La entidad ha realizado auditorías internas al Sistema de Gestión de Seguridad de la Información?',
                'estado' => 'verificar',
            ],
            [
                'pregunta' => '¿La entidad cuenta con programas de auditorias aplicables al SGSI donde se incluye frecuencia, métodos, responsabilidades, elaboración de informes?',
                'estado' => 'verificar',
            ],
            [
                'pregunta' => '¿La alta dirección realiza revisiones periodicas al Sistema de Gestión de Seguridad de la Información?',
                'estado' => 'verificar',
            ],
            [
                'pregunta' => '¿En las revisiones realizadas al sistema por la Dirección, se realizan procesos de retroalimentación sobre el desempeño de la seguridad de la información?',
                'estado' => 'verificar',
            ],
            [
                'pregunta' => '¿Las revisiones realizadas por la Dirección al Sistema de Gestión de Seguridad de la Información, están debidamente documentadas?',
                'estado' => 'verificar',
            ],
            [
                'pregunta' => '¿La entidad da respuesta a las no conformidades referentes a la seguridad de la información presentadas en los planes de auditoria?',
                'estado' => 'actuar',
            ],
            [
                'pregunta' => '¿La entidad ha implementado acciones a las no conformidades de seguridad de la información presentadas?',
                'estado' => 'actuar',
            ],
            [
                'pregunta' => '¿La entidad revisa la eficacia de las acciones correctivas tomadas por la presencia de una no conformidad de seguridad de la información?',
                'estado' => 'actuar',
            ],
            [
                'pregunta' => '¿La entidad realiza cambios al Sistema de Gestión de Seguridad de la Información después de las acciones tomadas?',
                'estado' => 'actuar',
            ],
            [
                'pregunta' => '¿La entidad documenta la información referente a las acciones correctivas que toma respecto a la seguridad de la información?',
                'estado' => 'actuar',
            ],
            [
                'pregunta' => '¿La entidad realiza procesos de mejora continua para el Sistema de Gestión de Seguridad de la Información?',
                'estado' => 'actuar',
            ],
        ];

        GapTre::insert($gaptre);
    }
}
