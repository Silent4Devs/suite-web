<?php

namespace Database\Seeders;

use App\Models\Clausula;
use Illuminate\Database\Seeder;

class ClausulasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clausulas = [
            ['nombre' => '4.1 Comprensión de la organización y de su contexto'],
            ['nombre' => '4.2 Comprensión de las necesidades y expectativas de las partes interesadas'],
            ['nombre' => '4.3 Determinación del alcance del SGSI'],
            ['nombre' => '4.4 Sistema de Gestión de Seguridad de la Información'],
            ['nombre' => '5.1 Liderazgo y compromiso'],
            ['nombre' => '5.2 Política'],
            ['nombre' => '5.3 Roles, responsabilidades y autoridades en la organización'],
            ['nombre' => '6.1 Acciones para tratar los riesgos y oportunidades'],
            ['nombre' => '6.1.1 Consideraciones generales'],
            ['nombre' => '6.1.2 Apreciación de riesgos de seguridad de la información'],
            ['nombre' => '6.1.3 Tratamiento de los riesgos de seguridad de la información'],
            ['nombre' => '6.2 Objetivos de seguridad de la información y planificación para su consecusión'],
            ['nombre' => '7.1 Recursos'],
            ['nombre' => '7.2 Competencia'],
            ['nombre' => '7.3 Concienciación'],
            ['nombre' => '7.4 Comunicación'],
            ['nombre' => '7.5 Información documentada'],
            ['nombre' => '7.5.1 Consideraciones generales'],
            ['nombre' => '7.5.2 Creación y actualización'],
            ['nombre' => '7.5.3 Control de la información documentada'],
            ['nombre' => '8.1 Planificación y control operacional'],
            ['nombre' => '8.2 Apreciación de los riesgos de seguridad de la información'],
            ['nombre' => '8.3 Tratamiento de los riesgos de seguridad de la información'],
            ['nombre' => '9.1 Seguimiento, medición, análisis y evaluación'],
            ['nombre' => '9.2 Auditoría interna'],
            ['nombre' => '9.3 Revisión por la Dirección'],
            ['nombre' => '10.1 No conformidad y acciones correctivas'],
            ['nombre' => '10.2 Mejora continua'],
        ];
        Clausula::insert($clausulas);
    }
}
