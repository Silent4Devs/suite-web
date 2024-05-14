<?php

namespace Database\Seeders;

use App\Models\ParametrosTemplateAnalisisdeBrechas;
use App\Models\PreguntasTemplateAnalisisdeBrechas;
use App\Models\SeccionesTemplateAnalisisdeBrechas;
use App\Models\TemplateAnalisisdeBrechas;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $template = TemplateAnalisisdeBrechas::create([
            'nombre_template' => 'Análisis de Brechas Iso 27001:2022',
            'norma_id' => '1',
            'descripcion' => 'Antes de iniciar con la implementación del Sistema de Gestión de Seguridad de la Información (SGSI) en la Organizacion, es necesario realizar un diagnóstico inicial para determinar el grado de cumplimiento tanto de los requisitos de la norma ISO 27001 como de sus controles. Para lograr este objetivo emplearemos el Análisis de Brechas (Gap Analysis).',
            'no_secciones' => '3',
            'innamovible' => 'true',
        ]);

        $parametros = ParametrosTemplateAnalisisdeBrechas::insert(
            [

                [
                    'template_id' => $template->id,
                    'estatus' => 'Cumple Satisfactoriamente',
                    'valor' => 2,
                    'color' => '#34B990',
                    'descripcion' => 'El requerimiento se cumple en su totalidad.',
                ],
                [
                    'template_id' => $template->id,
                    'estatus' => 'Cumple Parcialmente',
                    'valor' => 1,
                    'color' => '#73A7D5',
                    'descripcion' => 'El requerimiento se cumple parcialmente.',
                ],
                [
                    'template_id' => $template->id,
                    'estatus' => 'No Cumple',
                    'valor' => 0,
                    'color' => '#F59595',
                    'descripcion' => 'El requerimiento no es cumplido.',
                ],
            ]
        );

        $seccion1 = SeccionesTemplateAnalisisdeBrechas::create([
            'template_id' => $template->id,
            'numero_seccion' => '1',
            'descripcion' => 'Definicion del Marco de Seguridad y Privacidad de la Organización. Tiene un peso del 30% del total del componente: 10% - Diagnostico de Seguridad y Privacidad , 20% - Proposito de Seguridad y Privacidad de la Informacion.',
            'porcentaje_seccion' => '30',
        ]);

        $seccion2 = SeccionesTemplateAnalisisdeBrechas::create([
            'template_id' => $template->id,
            'numero_seccion' => '2',
            'descripcion' => 'Implementacion del Plan de Seguridad y Privacidad. Tiene un peso del 40% del total del componente: 20% - Identificacion y analisis de riesgos, 20% - Plan de tratamiento de riesgos, clasificacion y gestion de controles.',
            'porcentaje_seccion' => '40',
        ]);

        $seccion3 =
            SeccionesTemplateAnalisisdeBrechas::create([
                'template_id' => $template->id,
                'numero_seccion' => '3',
                'descripcion' => 'Monitoreo y mejoramiento continuo. Tiene un peso del 30% del total del componente: 20% - Actividades de seguimiento, medicion, analisis y evaluacion. 10% - Revision e Implementacion de Acciones de Mejora.',
                'porcentaje_seccion' => '30',
            ]);

        $preguntas1 = PreguntasTemplateAnalisisdeBrechas::insert([
            [
                'seccion_id' => $seccion1->id,
                'pregunta' => '¿La entidad cuenta con un autodiagnóstico realizado para medir el avance en el establecimiento, implementación, mantenimiento y mejora continua de su SGSI (Sistema de Gestión de Seguridad de la información)?',
                'numero_pregunta' => '1',
            ],
            [
                'seccion_id' => $seccion1->id, 'pregunta' => '¿La entidad creó un caso de estudio o plan inicial del proyecto, donde se incluyen las prioridades y objetivos para la implementación del SGSI?',
                'numero_pregunta' => '2',
            ],
            [
                'seccion_id' => $seccion1->id, 'pregunta' => '¿La entidad contó con la aprobación de la dirección para iniciar el proyecto del SGSI?	',
                'numero_pregunta' => '3',
            ],
            [
                'seccion_id' => $seccion1->id, 'pregunta' => '¿La entidad ha identificado los aspectos internos y externos que pueden afectar en el desarrollo del proyecto de implementación del sistema de gestión de seguridad de la información?	',
                'numero_pregunta' => '4',
            ],
            [
                'seccion_id' => $seccion1->id, 'pregunta' => '¿La entidad ha identificado las partes interesadas, necesidades y expectativas de estas respecto al Sistema de Gestión de Seguridad de la Información?	',
                'numero_pregunta' => '5',
            ],
            [
                'seccion_id' => $seccion1->id, 'pregunta' => '¿La entidad ha evaluado los objetivos y las necesidades respecto a la Seguridad de la Información?',
                'numero_pregunta' => '6',
            ],
            [
                'seccion_id' => $seccion1->id, 'pregunta' => '¿En la entidad se ha definido un Comité de Seguridad de la Información?',
                'numero_pregunta' => '7',
            ],
            [
                'seccion_id' => $seccion1->id, 'pregunta' => '¿La entidad cuenta con una definición del alcance y los límites del Sistema de Gestión de Seguridad de la Información?',
                'numero_pregunta' => '8',
            ],
            [
                'seccion_id' => $seccion1->id, 'pregunta' => 'En la entidad existe un documento de política del Sistema de Gestión de Seguridad de la Información, el cual ha sido aprobado por la Dirección?',
                'numero_pregunta' => '9',
            ],
            [
                'seccion_id' => $seccion1->id, 'pregunta' => '¿En la entidad existe un documento de roles, responsabilidades y autoridades en seguridad de la información?',
                'numero_pregunta' => '10',
            ],
            [
                'seccion_id' => $seccion1->id, 'pregunta' => '¿La entidad tiene establecido algún proceso para identificar, analizar, valorar y tratar los riesgos de seguridad de la información?',
                'numero_pregunta' => '11',
            ],
            [
                'seccion_id' => $seccion1->id, 'pregunta' => '¿La entidad ha realizado una declaración de aplicabilidad que contenga los controles requeridos por la entidad?',
                'numero_pregunta' => '12',
            ],
            [
                'seccion_id' => $seccion1->id, 'pregunta' => '¿La entidad ha evaluado las competencias de las personas que realizan, bajo su control, un trabajo que afecta el desempeño de la seguridad de la Información?',
                'numero_pregunta' => '13',
            ],
            [
                'seccion_id' => $seccion1->id, 'pregunta' => '¿La entidad tiene definido un modelo de comunicaciones tanto internas como externas respecto a la seguridad de la información?',
                'numero_pregunta' => '14',
            ],
            [
                'seccion_id' => $seccion1->id, 'pregunta' => '¿La entidad tiene la información referente al Sistema de Gestión de Seguridad de la Información debidamente documentada y controlada?',
                'numero_pregunta' => '15',
            ],
        ]);

        $preguntas2 = PreguntasTemplateAnalisisdeBrechas::insert([
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Políticas para la seguridad de la información',

                'numero_pregunta' => '1',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Funciones y responsabilidades de seguridad de la Información ',

                'numero_pregunta' => '2',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Segregación de funciones ',

                'numero_pregunta' => '3',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Gestión de Responsabilidades',

                'numero_pregunta' => '4',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Contacto con las autoridades ',

                'numero_pregunta' => '5',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Contacto con los grupos de interés especial',

                'numero_pregunta' => '6',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Seguridad de la información en la gestión de proyectos',

                'numero_pregunta' => '7',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Seguridad de la información en la gestión de proyectos.',

                'numero_pregunta' => '8',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Inventario de información y otros activos asociados',

                'numero_pregunta' => '9',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Uso aceptable de la información y otros activos asociados',

                'numero_pregunta' => '10',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Devolución de activos',

                'numero_pregunta' => '11',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Clasificación de la información',

                'numero_pregunta' => '12',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Etiquetado de información',

                'numero_pregunta' => '13',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Transferencia de información',

                'numero_pregunta' => '14',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Control de acceso',

                'numero_pregunta' => '15',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Gestión de identidad',

                'numero_pregunta' => '16',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Información de autenticación',

                'numero_pregunta' => '17',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Derechos de acceso',

                'numero_pregunta' => '18',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Seguridad de la información en las relaciones con los proveedores',

                'numero_pregunta' => '19',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Abordar la seguridad de la información en los acuerdos con los proveedores',

                'numero_pregunta' => '20',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Gestión de la seguridad de la información en la cadena de suministro de tecnologías de la información y la comunicación (TIC)',

                'numero_pregunta' => '21',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Seguimiento, revisión y gestión de cambios de servicios de proveedores',

                'numero_pregunta' => '22',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Seguridad de la información para el uso de servicios en la nube',

                'numero_pregunta' => '23',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Planificación y preparación de la gestión de incidentes de seguridad de la información',

                'numero_pregunta' => '24',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Evaluación y decisión sobre eventos de seguridad de la información',

                'numero_pregunta' => '25',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Respuesta a incidentes de seguridad de la información',

                'numero_pregunta' => '26',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Aprender de los incidentes de seguridad de la información',

                'numero_pregunta' => '27',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Recolección de evidencia',

                'numero_pregunta' => '28',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Seguridad de la información durante la interrupción',

                'numero_pregunta' => '29',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Preparación de las TIC para la continuidad del negocio',

                'numero_pregunta' => '30',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Requisitos legales, estatutarios, reglamentarios y contractuales',

                'numero_pregunta' => '31',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Derechos de propiedad intelectual',

                'numero_pregunta' => '32',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Protección de registros',

                'numero_pregunta' => '33',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Privacidad y protección de la información de identificación personal (PII)',

                'numero_pregunta' => '34',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Revisión independiente de la seguridad de la información.',

                'numero_pregunta' => '35',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Cumplimiento de políticas, normas y estándares de seguridad de la información',

                'numero_pregunta' => '36',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Procedimientos operativos documentados',

                'numero_pregunta' => '37',
            ],

            //personas

            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Investigación de antecedentess',

                'numero_pregunta' => '38',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Términos y condiciones de empleo',

                'numero_pregunta' => '39',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Concientización, educación y capacitación en seguridad de la información',

                'numero_pregunta' => '40',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Proceso Disciplinario',

                'numero_pregunta' => '41',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Responsabilidades después de la terminación o cambio de empleo',

                'numero_pregunta' => '42',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Acuerdos de confidencialidad o no divulgación',

                'numero_pregunta' => '43',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Trabajo remoto',

                'numero_pregunta' => '44',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Informes de eventos de seguridad de la información',

                'numero_pregunta' => '45',
            ],

            //fisico
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Perímetros físicos de seguridad',

                'numero_pregunta' => '46',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Entrada física',

                'numero_pregunta' => '47',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Asegurar oficinas, salas e instalaciones',

                'numero_pregunta' => '48',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Monitoreo de seguridad física',

                'numero_pregunta' => '49',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Protección contra amenazas físicas y ambientales.',

                'numero_pregunta' => '50',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Trabajar en áreas seguras',

                'numero_pregunta' => '51',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Escritorio y pantalla despejados',

                'numero_pregunta' => '52',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Emplazamiento y protección de equipos',

                'numero_pregunta' => '53',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Seguridad de los activos fuera de las instalaciones',

                'numero_pregunta' => '54',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Medios de almacenamiento',

                'numero_pregunta' => '55',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Utilidades de apoyo',

                'numero_pregunta' => '56',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Seguridad del cableado',

                'numero_pregunta' => '57',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Mantenimiento de equipo',

                'numero_pregunta' => '58',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Eliminación segura o reutilización de equipos',

                'numero_pregunta' => '59',
            ],

            //tecnologicos

            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Dispositivos de punto final de usuario',

                'numero_pregunta' => '60',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Derechos de acceso privilegiado',

                'numero_pregunta' => '61',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Restricción de acceso a la información',

                'numero_pregunta' => '62',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Acceso al código fuente',

                'numero_pregunta' => '63',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Autenticación segura',

                'numero_pregunta' => '64',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Gestión de capacidad',

                'numero_pregunta' => '65',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Protección contra malware',

                'numero_pregunta' => '66',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Gestión de vulnerabilidades técnicas',

                'numero_pregunta' => '67',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Gestión de la configuración',

                'numero_pregunta' => '68',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Eliminación de información',

                'numero_pregunta' => '69',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Enmascaramiento de datos',

                'numero_pregunta' => '70',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Prevención de fuga de datos',

                'numero_pregunta' => '71',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Copia de seguridad de la información',

                'numero_pregunta' => '72',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Redundancia de las instalaciones de procesamiento de información',

                'numero_pregunta' => '73',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Inicio de sesión',

                'numero_pregunta' => '74',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Actividades de seguimiento',

                'numero_pregunta' => '75',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Sincronización de reloj',

                'numero_pregunta' => '76',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Uso de programas de utilidad privilegiados',

                'numero_pregunta' => '77',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Instalación de software en sistemas operativos',

                'numero_pregunta' => '78',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Seguridad en redes',

                'numero_pregunta' => '79',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Seguridad de los servicios de red',

                'numero_pregunta' => '80',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Segregación de redes',

                'numero_pregunta' => '81',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Filtrado web',

                'numero_pregunta' => '82',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Uso de criptografía',

                'numero_pregunta' => '83',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Ciclo de vida de desarrollo seguro',

                'numero_pregunta' => '84',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Requisitos de seguridad de la aplicación',

                'numero_pregunta' => '85',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Principios de arquitectura e ingeniería de sistemas seguros',

                'numero_pregunta' => '86',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Codificación segura',

                'numero_pregunta' => '87',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Pruebas de seguridad en desarrollo y aceptación.',

                'numero_pregunta' => '88',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Desarrollo subcontratado',

                'numero_pregunta' => '89',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Separación de los entornos de desarrollo, prueba y producción',

                'numero_pregunta' => '90',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Gestión del cambio',

                'numero_pregunta' => '91',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Información de prueba',

                'numero_pregunta' => '92',
            ],
            [

                'seccion_id' => $seccion2->id, 'pregunta' => 'Protección de los sistemas de información durante las pruebas de auditoría',

                'numero_pregunta' => '93',
            ],
        ]);

        $preguntas3 = PreguntasTemplateAnalisisdeBrechas::insert([
            [
                'seccion_id' => $seccion3->id, 'pregunta' => '¿La entidad tiene una metodología para realizar seguimiento, medición y análisis permanente al desempeño de la Seguridad de laInformación?',
                'numero_pregunta' => '1',
            ],
            [
                'seccion_id' => $seccion3->id, 'pregunta' => '¿La entidad ha realizado auditorías internas al Sistema de Gestión de Seguridad de la Información?',
                'numero_pregunta' => '2',
            ],
            [
                'seccion_id' => $seccion3->id, 'pregunta' => '¿La entidad cuenta con programas de auditorias aplicables al SGSI donde se incluye frecuencia, métodos, responsabilidades, elaboración de informes?',
                'numero_pregunta' => '3',
            ],
            [
                'seccion_id' => $seccion3->id, 'pregunta' => '¿La alta dirección realiza revisiones periodicas al Sistema de Gestión de Seguridad de la Información?',
                'numero_pregunta' => '4',
            ],
            [
                'seccion_id' => $seccion3->id, 'pregunta' => '¿En las revisiones realizadas al sistema por la Dirección, se realizan procesos de retroalimentación sobre el desempeño de la seguridad de la información?',
                'numero_pregunta' => '5',
            ],
            [
                'seccion_id' => $seccion3->id, 'pregunta' => '¿Las revisiones realizadas por la Dirección al Sistema de Gestión de Seguridad de la Información, están debidamente documentadas?',
                'numero_pregunta' => '6',
            ],
            [
                'seccion_id' => $seccion3->id, 'pregunta' => '¿La entidad da respuesta a las no conformidades referentes a la seguridad de la información presentadas en los planes de auditoria?',
                'numero_pregunta' => '7',
            ],
            [
                'seccion_id' => $seccion3->id, 'pregunta' => '¿La entidad ha implementado acciones a las no conformidades de seguridad de la información presentadas?',
                'numero_pregunta' => '8',
            ],
            [
                'seccion_id' => $seccion3->id, 'pregunta' => '¿La entidad revisa la eficacia de las acciones correctivas tomadas por la presencia de una no conformidad de seguridad de la información?',
                'numero_pregunta' => '9',
            ],
            [
                'seccion_id' => $seccion3->id, 'pregunta' => '¿La entidad realiza cambios al Sistema de Gestión de Seguridad de la Información después de las acciones tomadas?',
                'numero_pregunta' => '10',
            ],
            [
                'seccion_id' => $seccion3->id, 'pregunta' => '¿La entidad documenta la información referente a las acciones correctivas que toma respecto a la seguridad de la información?',
                'numero_pregunta' => '11',
            ],
            [
                'seccion_id' => $seccion3->id, 'pregunta' => '¿La entidad realiza procesos de mejora continua para el Sistema de Gestión de Seguridad de la Información?',
                'numero_pregunta' => '12',
            ],
        ]);
    }
}
