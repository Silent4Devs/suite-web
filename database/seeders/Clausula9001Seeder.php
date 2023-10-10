<?php

namespace Database\Seeders;

use App\Models\Clausula;
use Illuminate\Database\Seeder;

class Clausula9001Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clausulas = [
            [
                'nombre' => '4.1 Comprensión de la organización y de su contexto',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '4.2 Comprensión de las necesidades y expectativas de las partes interesadas',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '4.3 Determinación del alcance del sistema de gestión de la calidad',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '4.4 Sistema de gestión de la calidad y sus procesos',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '5.1 Liderazgo y compromiso',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '5.2 Política',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '5.2.1 Establecimiento de la política de la calidad',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '5.2.2 Comunicación de la política de la calidad',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '5.3 Roles, responsabilidades y autoridades en la organización',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '6.1 Acciones para abordar riesgos y oportunidades',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '6.2 Objetivos de la calidad y planificación para lograrlos',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '6.3 Planificación de los cambios',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '7.1 Recursos',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '7.1.1 Generalidades',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '7.1.2 Personas',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '7.1.3 Infraestructura',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '7.1.4 Ambiente para la operación de los procesos',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '7.1.5 Recursos de seguimiento y medición',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '7.1.6 Conocimientos de la organización',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '7.2 Competencia',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '7.3 Toma de conciencia',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '7.4 Comunicación',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '7.5 Información documentada',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '7.5.1 Generalidades',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '7.5.2 Creación y actualización',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '7.5.3 Control de la información documentada',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.1 Planificación y control operacional',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.2 Requisitos para los productos y servicios',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.2.1 Comunicación con el cliente',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.2.2 Determinación de los requisitos para los productos y servicios',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.2.3 Revisión de los requisitos para los productos y servicios',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.2.4 Cambios en los requisitos para los productos y servicios',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.3 Diseño y desarrollo de los productos y servicios',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.3.1 Generalidades',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.3.2 Planificación del diseño y desarrollo',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.3.3 Entradas para el diseño y desarrollo',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.3.4 Controles del diseño y desarrollo',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.3.5 Salidas del diseño y desarrollo',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.3.6 Cambios del diseño y desarrollo',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.4 Control de los procesos, productos y servicios suministrados externament',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.4.1 Generalidades',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.4.2 Tipo y alcance del control',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.4.3 Información para los proveedores externos',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.5 Producción y provisión del servicio',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.5.1 Control de la producción y de la provisión del servicio',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.5.2 Identificación y trazabilidad',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.5.3 Propiedad perteneciente a los clientes o proveedores externos',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.5.4 Preservación',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.5.5 Actividades posteriores a la entrega',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.5.6 Control de los cambios',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.6 Liberación de los productos y servicios',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '8.7 Control de las salidas no conformes',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '9.1 Seguimiento, medición, análisis y evaluación',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '9.1.1 Generalidades',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '9.1.2 Satisfacción del cliente',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '9.1.3 Análisis y evaluación',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '9.2 Auditoría interna',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '9.3 Revisión por la dirección',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '9.3.1 Generalidades',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '9.3.2 Entradas de la revisión por la dirección',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '9.3.3 Salidas de la revisión por la dirección',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '10.1 Generalidades',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '10.2 No conformidad y acción correctiva',
                'modulo' => 'iso9001',
            ],
            [
                'nombre' => '10.3 Mejora continua',
                'modulo' => 'iso9001',
            ],
        ];
        Clausula::insert($clausulas);
    }
}
