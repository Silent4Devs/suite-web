<?php

namespace Database\Seeders;

use App\Models\Iso27\GapDosCatalogoIso;
use Illuminate\Database\Seeder;

class GapDosCatalogoIsoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organizacional = 1;
        $personal = 2;
        $Fisico = 3;
        $tecnologicas = 4;

        $Controles = [
            [
                'control_iso' => '5.1',
                'anexo_politica' => 'Políticas para la seguridad de la información',
                'anexo_descripcion' => 'La política de seguridad de la información y las políticas específicas del tema deben ser definidas aprobadas por la gerencia publicadas comunicadas y reconocidas por el personal relevante y las partes interesadas relevantes y revisadas a intervalos planificados y si ocurren cambios significativos',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.2',
                'anexo_politica' => 'Funciones y responsabilidades de seguridad de la Información ',
                'anexo_descripcion' => 'Los roles y responsabilidades de seguridad de la información deben definirse y asignarse de acuerdo con las necesidades de la organización.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.3',
                'anexo_politica' => 'Segregación de funciones ',
                'anexo_descripcion' => 'Deben separarse las tareas y las áreas conflictivos de responsabilidad.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.4',
                'anexo_politica' => 'Gestión de Responsabilidades',
                'anexo_descripcion' => 'La gerencia debe exigir a todo el personal que aplique la seguridad de la información de acuerdo con la política de seguridad de la información establecida, las políticas y los procedimientos específicos del tema de la organización.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.5',
                'anexo_politica' => 'Contacto con las autoridades ',
                'anexo_descripcion' => 'La organización deberá establecer y mantener contacto con las autoridades pertinentes.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.6',
                'anexo_politica' => 'Contacto con los grupos de interés especial',
                'anexo_descripcion' => 'La organización debe establecer y mantener contacto con grupos de interés especial u otros foros especializados en seguridad y asociaciones profesionales.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.7',
                'anexo_politica' => 'Seguridad de la información en la gestión de proyectos',
                'anexo_descripcion' => 'La información relacionada con las amenazas a la seguridad de la información se recopilará y analizará para generar información sobre amenazas.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.8',
                'anexo_politica' => 'Seguridad de la información en la gestión de proyectos.',
                'anexo_descripcion' => 'La seguridad de la información se integrará en la gestión de proyectos.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.9',
                'anexo_politica' => 'Inventario de información y otros activos asociados',
                'anexo_descripcion' => 'Se debe desarrollar y mantener un inventario de información y otros activos asociados, incluidos los propietarios.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.10',
                'anexo_politica' => 'Uso aceptable de la información y otros activos asociados',
                'anexo_descripcion' => 'Se identificarán, documentarán e implementarán reglas para el uso aceptable y procedimientos para el manejo de la información y otros activos asociados.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.11',
                'anexo_politica' => 'Devolución de activos',
                'anexo_descripcion' => 'El personal y otras partes interesadas, según corresponda, devolverán todos los activos de la organización que estén en su poder al cambiar o terminar su empleo, contrato o acuerdo.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.12',
                'anexo_politica' => 'Clasificación de la información',
                'anexo_descripcion' => 'La información se clasificará de acuerdo con las necesidades de seguridad de la información de la organización en función de la confidencialidad, la integridad, la disponibilidad y los requisitos pertinentes de las partes interesadas.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.13',
                'anexo_politica' => 'Etiquetado de información',
                'anexo_descripcion' => 'Se debe desarrollar e implementar un conjunto apropiado de procedimientos para el etiquetado de la información de acuerdo con el esquema de clasificación de la información adoptado por la organización.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.14',
                'anexo_politica' => 'Transferencia de información',
                'anexo_descripcion' => 'Deben existir reglas, procedimientos y acuerdos de transferencia de información para todos los tipos de instalaciones de transferencia dentro de la organización y entre la organización y otras partes.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.15',
                'anexo_politica' => 'Control de acceso',
                'anexo_descripcion' => 'Las reglas para controlar el acceso físico y lógico a la información y otros activos asociados se establecerán e implementarán en función de los requisitos de seguridad de la información y del negocio.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.16',
                'anexo_politica' => 'Gestión de identidad',
                'anexo_descripcion' => 'Se gestionará el ciclo de vida completo de las identidades.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.17',
                'anexo_politica' => 'Información de autenticación',
                'anexo_descripcion' => 'La asignación y gestión de la información de autenticación se controlará mediante un proceso de gestión, incluido el asesoramiento al personal sobre el manejo adecuado de la información de autenticación.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.18',
                'anexo_politica' => 'Derechos de acceso',
                'anexo_descripcion' => 'Los derechos de acceso a la información y otros activos asociados deben proporcionarse, revisarse, modificarse y eliminarse de acuerdo con la política y las reglas de control de acceso específicas del tema de la organización.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.19',
                'anexo_politica' => 'Seguridad de la información en las relaciones con los proveedores',
                'anexo_descripcion' => 'Se deben definir e implementar procesos y procedimientos para gestionar los riesgos de seguridad de la información asociados con el uso de los productos o servicios del proveedor.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.20',
                'anexo_politica' => 'Abordar la seguridad de la información en los acuerdos con los proveedores',
                'anexo_descripcion' => 'Los requisitos de seguridad de la información pertinentes se establecerán y acordarán con cada proveedor en función del tipo de relación con el proveedor.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.21',
                'anexo_politica' => 'Gestión de la seguridad de la información en la cadena de suministro de tecnologías de la información y la comunicación (TIC)',
                'anexo_descripcion' => 'Se deben definir e implementar procesos y procedimientos para gestionar los riesgos de seguridad de la información asociados con la cadena de suministro de productos y servicios de TIC.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.22',
                'anexo_politica' => 'Seguimiento, revisión y gestión de cambios de servicios de proveedores',
                'anexo_descripcion' => 'La organización debe monitorear, revisar, evaluar y gestionar periódicamente los cambios en las prácticas de seguridad de la información del proveedor y la prestación de servicios.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.23',
                'anexo_politica' => 'Seguridad de la información para el uso de servicios en la nube',
                'anexo_descripcion' => 'Los procesos de adquisición, uso, gestión y salida de los servicios en la nube se deben establecer de acuerdo con los requisitos de seguridad de la información de la organización.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.24',
                'anexo_politica' => 'Planificación y preparación de la gestión de incidentes de seguridad de la información',
                'anexo_descripcion' => 'La organización debe planificar y prepararse para la gestión de incidentes de seguridad de la información definiendo, estableciendo y comunicando procesos, roles y responsabilidades de gestión de incidentes de seguridad de la información.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.25',
                'anexo_politica' => 'Evaluación y decisión sobre eventos de seguridad de la información',
                'anexo_descripcion' => 'La organización debe evaluar los eventos de seguridad de la información y decidir si se clasificarán como incidentes de seguridad de la información.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.26',
                'anexo_politica' => 'Respuesta a incidentes de seguridad de la información',
                'anexo_descripcion' => 'Se debe responder a los incidentes de seguridad de la información de acuerdo con los procedimientos documentados.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.27',
                'anexo_politica' => 'Aprender de los incidentes de seguridad de la información',
                'anexo_descripcion' => 'El conocimiento obtenido de los incidentes de seguridad de la información se utilizará para fortalecer y mejorar los controles de seguridad de la información.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.28',
                'anexo_politica' => 'Recolección de evidencia',
                'anexo_descripcion' => 'La organización debe establecer e implementar procedimientos para la identificación, recolección, adquisición y preservación de evidencia relacionada con eventos de seguridad de la información.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.29',
                'anexo_politica' => 'Seguridad de la información durante la interrupción',
                'anexo_descripcion' => 'La organización debe planificar cómo mantener la seguridad de la información en un nivel adecuado durante la interrupción.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.30',
                'anexo_politica' => 'Preparación de las TIC para la continuidad del negocio',
                'anexo_descripcion' => 'La preparación de las TIC debe planificarse, implementarse, mantenerse y probarse en función de los objetivos de continuidad del negocio y los requisitos de continuidad de las TIC.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.31',
                'anexo_politica' => 'Requisitos legales, estatutarios, reglamentarios y contractuales',
                'anexo_descripcion' => 'Los requisitos legales, estatutarios, reglamentarios y contractuales relevantes para la seguridad de la información y el enfoque de la organización para cumplir con estos requisitos deben identificarse, documentarse y mantenerse actualizados.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.32',
                'anexo_politica' => 'Derechos de propiedad intelectual',
                'anexo_descripcion' => 'La organización debe implementar procedimientos apropiados para proteger los derechos de propiedad intelectual.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.33',
                'anexo_politica' => 'Protección de registros',
                'anexo_descripcion' => 'Los registros deben protegerse contra pérdida, destrucción, falsificación, acceso no autorizado y publicación no autorizada.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.34',
                'anexo_politica' => 'Privacidad y protección de la información de identificación personal (PII)',
                'anexo_descripcion' => 'La organización deberá identificar y cumplir los requisitos relacionados con la preservación de la privacidad y la protección de la PII de acuerdo con las leyes y reglamentos aplicables y los requisitos contractuales.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.35',
                'anexo_politica' => 'Revisión independiente de la seguridad de la información.',
                'anexo_descripcion' => 'El enfoque de la organización para gestionar la seguridad de la información y su implementación, incluidas las personas, los procesos y las tecnologías, se revisará de forma independiente a intervalos planificados o cuando se produzcan cambios significativos.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.36',
                'anexo_politica' => 'Cumplimiento de políticas, normas y estándares de seguridad de la información',
                'anexo_descripcion' => 'El cumplimiento de la política de seguridad de la información de la organización, las políticas, las reglas y los estándares específicos de cada tema se revisará periódicamente.',
                'id_clasificacion' => $organizacional,
            ],
            [
                'control_iso' => '5.37',
                'anexo_politica' => 'Procedimientos operativos documentados',
                'anexo_descripcion' => 'Los procedimientos operativos para las instalaciones de procesamiento de información deben documentarse y ponerse a disposición del personal que los necesite.',
                'id_clasificacion' => $organizacional,
            ],

            //personas

            [
                'control_iso' => '6.1',
                'anexo_politica' => 'Investigación de antecedentess',
                'anexo_descripcion' => 'Los controles de verificación de antecedentes de todos los candidatos para convertirse en personal se llevarán a cabo antes de unirse a la organización y de manera continua, teniendo en cuenta las leyes, los reglamentos y la ética aplicables, y serán proporcionales a los requisitos comerciales, la clasificación de la información a la que se accederá y los riesgos percibidos.',
                'id_clasificacion' => $personal,
            ],
            [
                'control_iso' => '6.2',
                'anexo_politica' => 'Términos y condiciones de empleo',
                'anexo_descripcion' => 'Los acuerdos contractuales de trabajo deben establecer las responsabilidades del personal y de la organización en materia de seguridad de la información.',
                'id_clasificacion' => $personal,
            ],
            [
                'control_iso' => '6.3',
                'anexo_politica' => 'Concientización, educación y capacitación en seguridad de la información',
                'anexo_descripcion' => 'El personal de la organización y las partes interesadas relevantes deben recibir la conciencia, educación y capacitación adecuadas en seguridad de la información y actualizaciones periódicas de la política de seguridad de la información de la organización, las políticas y los procedimientos específicos del tema, según sea relevante para su función laboral.',
                'id_clasificacion' => $personal,
            ],
            [
                'control_iso' => '6.4',
                'anexo_politica' => 'Proceso Disciplinario',
                'anexo_descripcion' => 'Se formalizará y comunicará un proceso disciplinario para tomar acciones contra el personal y otras partes interesadas relevantes que hayan cometido una violación a la política de seguridad de la información.',
                'id_clasificacion' => $personal,
            ],
            [
                'control_iso' => '6.5',
                'anexo_politica' => 'Responsabilidades después de la terminación o cambio de empleo',
                'anexo_descripcion' => 'Las responsabilidades y deberes de seguridad de la información que sigan siendo válidos después de la terminación o el cambio de empleo se definirán, aplicarán y comunicarán al personal pertinente y otras partes interesadas.',
                'id_clasificacion' => $personal,
            ],
            [
                'control_iso' => '6.6',
                'anexo_politica' => 'Acuerdos de confidencialidad o no divulgación',
                'anexo_descripcion' => 'Los acuerdos de confidencialidad o no divulgación que reflejen las necesidades de la organización para la protección de la información deben ser identificados, documentados, revisados regularmente y firmados por el personal y otras partes interesadas relevantes.',
                'id_clasificacion' => $personal,
            ],
            [
                'control_iso' => '6.7',
                'anexo_politica' => 'Trabajo remoto',
                'anexo_descripcion' => 'Se implementarán medidas de seguridad cuando el personal trabaje de forma remota para proteger la información a la que se acceda, procese o almacene fuera de las instalaciones de la organización.',
                'id_clasificacion' => $personal,
            ],
            [
                'control_iso' => '6.8',
                'anexo_politica' => 'Informes de eventos de seguridad de la información',
                'anexo_descripcion' => 'La organización debe proporcionar un mecanismo para que el personal informe eventos de seguridad de la información observados o sospechados a través de los canales apropiados de manera oportuna.',
                'id_clasificacion' => $personal,
            ],

            //fisico
            [
                'control_iso' => '7.1',
                'anexo_politica' => 'Perímetros físicos de seguridad',
                'anexo_descripcion' => 'Los perímetros de seguridad se definirán y utilizarán para proteger las áreas que contienen información y otros activos asociados.',
                'id_clasificacion' => $Fisico,
            ],
            [
                'control_iso' => '7.2',
                'anexo_politica' => 'Entrada física',
                'anexo_descripcion' => 'Las áreas seguras deben estar protegidas por controles de entrada y puntos de acceso apropiados.',
                'id_clasificacion' => $Fisico,
            ],
            [
                'control_iso' => '7.3',
                'anexo_politica' => 'Asegurar oficinas, salas e instalaciones',
                'anexo_descripcion' => 'Se diseñará e implementará la seguridad física de las oficinas, salas e instalaciones.',
                'id_clasificacion' => $Fisico,
            ],
            [
                'control_iso' => '7.4',
                'anexo_politica' => 'Monitoreo de seguridad física',
                'anexo_descripcion' => 'Las instalaciones deben ser monitoreadas continuamente para detectar accesos físicos no autorizados.',
                'id_clasificacion' => $Fisico,
            ],
            [
                'control_iso' => '7.5',
                'anexo_politica' => 'Protección contra amenazas físicas y ambientales.',
                'anexo_descripcion' => 'Se debe diseñar e implementar la protección contra amenazas físicas y ambientales, tales como desastres naturales y otras amenazas físicas intencionales o no intencionales a la infraestructura.',
                'id_clasificacion' => $Fisico,
            ],
            [
                'control_iso' => '7.6',
                'anexo_politica' => 'Trabajar en áreas seguras',
                'anexo_descripcion' => 'Se diseñarán e implementarán medidas de seguridad para trabajar en áreas seguras',
                'id_clasificacion' => $Fisico,
            ],
            [
                'control_iso' => '7.7',
                'anexo_politica' => 'Escritorio y pantalla despejados',
                'anexo_descripcion' => 'Se deben definir y hacer cumplir adecuadamente las reglas de escritorio limpio para documentos y medios de almacenamiento extraíbles y las reglas de pantalla limpia para las instalaciones de procesamiento de información.',
                'id_clasificacion' => $Fisico,
            ],
            [
                'control_iso' => '7.8',
                'anexo_politica' => 'Emplazamiento y protección de equipos',
                'anexo_descripcion' => 'El equipo se colocará de forma segura y protegida',
                'id_clasificacion' => $Fisico,
            ],
            [
                'control_iso' => '7.9',
                'anexo_politica' => 'Seguridad de los activos fuera de las instalaciones',
                'anexo_descripcion' => 'Se protegerán los activos fuera del sitio.',
                'id_clasificacion' => $Fisico,
            ],
            [
                'control_iso' => '7.10',
                'anexo_politica' => 'Medios de almacenamiento',
                'anexo_descripcion' => 'Los medios de almacenamiento deben gestionarse a lo largo de su ciclo de vida de adquisición, uso, transporte y eliminación de acuerdo con el esquema de clasificación y los requisitos de manipulación de la organización.',
                'id_clasificacion' => $Fisico,
            ],
            [
                'control_iso' => '7.11',
                'anexo_politica' => 'Utilidades de apoyo',
                'anexo_descripcion' => 'Las instalaciones de procesamiento de información deben estar protegidas contra cortes de energía y otras interrupciones causadas por fallas en los servicios públicos de apoyo.',
                'id_clasificacion' => $Fisico,
            ],
            [
                'control_iso' => '7.12',
                'anexo_politica' => 'Seguridad del cableado',
                'anexo_descripcion' => 'Los cables que transportan energía, datos o servicios de información de apoyo deben estar protegidos contra intercepciones, interferencias o daños.',
                'id_clasificacion' => $Fisico,
            ],
            [
                'control_iso' => '7.13',
                'anexo_politica' => 'Mantenimiento de equipo',
                'anexo_descripcion' => 'El equipo se mantendrá correctamente para garantizar la disponibilidad, integridad y confidencialidad de la información.',
                'id_clasificacion' => $Fisico,
            ],
            [
                'control_iso' => '7.14',
                'anexo_politica' => 'Eliminación segura o reutilización de equipos',
                'anexo_descripcion' => 'Los elementos del equipo que contengan medios de almacenamiento se verificarán para garantizar que todos los datos confidenciales y el software con licencia se hayan eliminado o sobrescrito de forma segura antes de su eliminación o reutilización.',
                'id_clasificacion' => $Fisico,
            ],

            //tecnologicos

            [
                'control_iso' => '8.1',
                'anexo_politica' => 'Dispositivos de punto final de usuario',
                'anexo_descripcion' => 'Se protegerá la información almacenada, procesada o accesible a través de los dispositivos finales del usuario.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.2',
                'anexo_politica' => 'Derechos de acceso privilegiado',
                'anexo_descripcion' => 'La asignación y uso de los derechos de acceso privilegiado se restringirá y gestionará.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.3',
                'anexo_politica' => 'Restricción de acceso a la información',
                'anexo_descripcion' => 'El acceso a la información y otros activos asociados se restringirá de acuerdo con la política específica del tema establecida sobre el control de acceso.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.4',
                'anexo_politica' => 'Acceso al código fuente',
                'anexo_descripcion' => 'El acceso de lectura y escritura al código fuente, las herramientas de desarrollo y las bibliotecas de software se gestionará adecuadamente.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.5',
                'anexo_politica' => 'Autenticación segura',
                'anexo_descripcion' => 'Las tecnologías y procedimientos de autenticación segura se implementarán en función delas restricciones de acceso a la información y la política específica del tema sobre el control de acceso.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.6',
                'anexo_politica' => 'Gestión de capacidad',
                'anexo_descripcion' => 'El uso de los recursos se controlará y ajustará de acuerdo con los requisitos de capacidad actuales y previstos.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.7',
                'anexo_politica' => 'Protección contra malware',
                'anexo_descripcion' => 'La protección contra el malware se implementará y respaldará mediante la conciencia adecuada del usuario.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.8',
                'anexo_politica' => 'Gestión de vulnerabilidades técnicas',
                'anexo_descripcion' => 'Se debe obtener información sobre las vulnerabilidades técnicas de los sistemas de información en uso, se debe evaluar la exposición de la organización a tales vulnerabilidades y se deben tomar las medidas apropiadas.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.9',
                'anexo_politica' => 'Gestión de la configuración',
                'anexo_descripcion' => 'Las configuraciones, incluidas las configuraciones de seguridad, de hardware, software, servicios y redes deben establecerse, documentarse, implementarse, monitorearse y revisarse.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.10',
                'anexo_politica' => 'Eliminación de información',
                'anexo_descripcion' => 'La información almacenada en los sistemas de información, dispositivos o en cualquier otro medio de almacenamiento será eliminada cuando ya no sea necesaria.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.11',
                'anexo_politica' => 'Enmascaramiento de datos',
                'anexo_descripcion' => 'El enmascaramiento de datos se debe utilizar de acuerdo con la política específica del tema de la organización sobre el control de acceso y otras políticas relacionadas con el tema específico, y los requisitos comerciales, teniendo en cuenta la legislación aplicable.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.12',
                'anexo_politica' => 'Prevención de fuga de datos',
                'anexo_descripcion' => 'Las medidas de prevención de fuga de datos se aplicarán a los sistemas, redes y cualquier otro dispositivo que procese, almacene o transmita información sensible.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.13',
                'anexo_politica' => 'Copia de seguridad de la información',
                'anexo_descripcion' => 'Las copias de seguridad de la información, el software y los sistemas se mantendrán y probarán periódicamente de acuerdo con la política de copia de seguridad específica del tema acordada.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.14',
                'anexo_politica' => 'Redundancia de las instalaciones de procesamiento de información',
                'anexo_descripcion' => 'Las instalaciones de procesamiento de información se implementarán con suficiente redundancia para cumplir con los requisitos de disponibilidad.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.15',
                'anexo_politica' => 'Inicio de sesión',
                'anexo_descripcion' => 'Se producirán, almacenarán, protegerán y analizarán registros que registren actividades, excepciones, fallas y otros eventos relevantes.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.16',
                'anexo_politica' => 'Actividades de seguimiento',
                'anexo_descripcion' => 'Las redes, los sistemas y las aplicaciones deberán ser monitoreados por comportamiento anómalo y se tomarán las acciones apropiadas para evaluar posibles incidentes de seguridad de la información.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.17',
                'anexo_politica' => 'Sincronización de reloj',
                'anexo_descripcion' => 'Los relojes de los sistemas de procesamiento de información utilizados por la organización deben estar sincronizados con las fuentes de tiempo aprobadas.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.18',
                'anexo_politica' => 'Uso de programas de utilidad privilegiados',
                'anexo_descripcion' => 'El uso de programas de utilidad que puedan anular los controles del sistema y de la aplicación debe estar restringido y estrictamente controlado.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.19',
                'anexo_politica' => 'Instalación de software en sistemas operativos',
                'anexo_descripcion' => 'Se implementarán procedimientos y medidas para gestionar de forma segura la instalación de software en los sistemas operativos.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.20',
                'anexo_politica' => 'Seguridad en redes',
                'anexo_descripcion' => 'Las redes y los dispositivos de red se asegurarán, administrarán y controlarán para proteger la información en los sistemas y aplicaciones.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.21',
                'anexo_politica' => 'Seguridad de los servicios de red',
                'anexo_descripcion' => 'Se identificarán, implementarán y controlarán los mecanismos de seguridad, los niveles de servicio y los requisitos de servicio de los servicios de red.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.22',
                'anexo_politica' => 'Segregación de redes',
                'anexo_descripcion' => 'Los grupos de servicios de información, usuarios y sistemas de información deben estar segregados en las redes de la organización.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.23',
                'anexo_politica' => 'Filtrado web',
                'anexo_descripcion' => 'El acceso a sitios web externos se gestionará para reducir la exposición a contenido malicioso.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.24',
                'anexo_politica' => 'Uso de criptografía',
                'anexo_descripcion' => 'Se deben definir e implementar reglas para el uso efectivo de la criptografía, incluida la gestión de claves criptográficas.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.25',
                'anexo_politica' => 'Ciclo de vida de desarrollo seguro',
                'anexo_descripcion' => 'Se establecerán y aplicarán reglas para el desarrollo seguro de software y sistemas.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.26',
                'anexo_politica' => 'Requisitos de seguridad de la aplicación',
                'anexo_descripcion' => 'Los requisitos de seguridad de la información deben identificarse, especificarse y aprobarse al desarrollar o adquirir aplicaciones.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.27',
                'anexo_politica' => 'Principios de arquitectura e ingeniería de sistemas seguros',
                'anexo_descripcion' => 'Se deben establecer, documentar, mantener y aplicar principios para la ingeniería de sistemas seguros en cualquier actividad de desarrollo de sistemas de información.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.28',
                'anexo_politica' => 'Codificación segura',
                'anexo_descripcion' => 'Los principios de codificación segura se aplicarán al desarrollo de software.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.29',
                'anexo_politica' => 'Pruebas de seguridad en desarrollo y aceptación.',
                'anexo_descripcion' => 'Los procesos de pruebas de seguridad se definirán e implementarán en el ciclo de vida del desarrollo.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.30',
                'anexo_politica' => 'Desarrollo subcontratado',
                'anexo_descripcion' => 'La organización debe dirigir, monitorear y revisar las actividades relacionadas con el desarrollo de sistemas subcontratados.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.31',
                'anexo_politica' => 'Separación de los entornos de desarrollo, prueba y producción',
                'anexo_descripcion' => 'Los entornos de desarrollo, prueba y producción deben estar separados y protegidos.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.32',
                'anexo_politica' => 'Gestión del cambio',
                'anexo_descripcion' => 'Los cambios en las instalaciones de procesamiento de información y los sistemas de información estarán sujetos a procedimientos de gestión de cambios.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.33',
                'anexo_politica' => 'Información de prueba',
                'anexo_descripcion' => 'La información de las pruebas se seleccionará, protegerá y gestionará adecuadamente.',
                'id_clasificacion' => $tecnologicas,
            ],
            [
                'control_iso' => '8.34',
                'anexo_politica' => 'Protección de los sistemas de información durante las pruebas de auditoría',
                'anexo_descripcion' => 'Las pruebas de auditoría y otras actividades de aseguramiento que involucren la evaluación de los sistemas operativos deben planificarse y acordarse entre el evaluador y la gerencia correspondiente.',
                'id_clasificacion' => $tecnologicas,
            ],

        ];

        GapDosCatalogoIso::insert($Controles);
    }
}
