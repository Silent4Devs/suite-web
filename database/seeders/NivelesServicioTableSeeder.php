<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NivelesServicioTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {


        \DB::table('niveles_servicio')->delete();

        \DB::table('niveles_servicio')->insert(array(
            0 =>
            array(
                            'contrato_id' => 2,
                'nombre' => 'Servicio Administrativo del Centro de Operaciones  de Seguridad (SOC)',
                'metrica' => 'Es el tiempo que transcurre desde que se atiende el reporte hasta que se solucionará. El tiempo de respuesta máximo es de 3 hrs a partir que se recibe la primera respuesta.',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => null,
                'periodo_evaluacion' => '2',
                'revisiones' => 0,
                'area' => 'Dirección General de Tecnologías de la Información y Comunicaciones',
                'descripcion' => 'Es el tiempo que transcurre entre que se recibe la solicitud de reporte por alguno de los cuales definidos (correo electrónico, llamada telefónica o web ) y la asignación del número de ticket.
Primera respuesta telefónica: 5 min.
Primera respuesta vía correo electrónico: 20 min.

',
                'created_at' => '2022-02-18 16:01:58',
                'updated_at' => '2022-02-18 16:01:58',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            1 =>
            array(
                            'contrato_id' => 2,
                'nombre' => 'Gestión de incidentes de seguridad',
                'metrica' => 'Es el tiempo que transcurre desde que se atiende el reporte hasta que se solucione.',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '2',
                'revisiones' => 0,
                'area' => 'Dirección General de Tecnologías de la Información y la Comunicaciones ',
                'descripcion' => 'Es el tiempo que transcurre entre que se identifica en una actividad anormal se convirtió en incidente de seguridad. Se realizará la notificación en un máximo de 30 min. posterior a su confirmación y apertura de ticket.
',
                'created_at' => '2022-02-18 16:21:07',
                'updated_at' => '2022-02-18 16:21:07',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            2 =>
            array(
                            'contrato_id' => 4,
                'nombre' => 'Gestión de Cambios',
                'metrica' => 'Tiempo de aplicación de cambios',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => null,
                'periodo_evaluacion' => 'Diario',
                'revisiones' => 0,
                'area' => 'NULL',
                'descripcion' => 'Correcta y oportuna aplicación de los cambios solicitados sobre las  configuraciones de la infraestructura tecnológica de seguridad administrada por S4B',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            3 =>
            array(
                            'contrato_id' => 4,
                'nombre' => 'Gestión de Incidentes',
                'metrica' => 'Envio de notificación si la actividad sospechosa que se haya presentado sobre la infraestructura',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => null,
                'periodo_evaluacion' => 'Diario',
                'revisiones' => 0,
                'area' => 'NULL',
                'descripcion' => 'El software no es operativo o inaccesible',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            4 =>
            array(
                            'contrato_id' => 4,
                'nombre' => 'Atención y Solución de las incidencias o problemas con prioridad Alta.',
                'metrica' => 'No de incidentes solucionados en tiempo/total de incidentes presentados x 100',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => null,
                'periodo_evaluacion' => 'Diario',
                'revisiones' => 0,
                'area' => 'NULL',
                'descripcion' => 'Una de las fases (implementación de procesos básicos, implementación de procesosm complementarios o implementación de Gestión de conocimientos de la mesa de servicios)no funciona en su totalidad',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            5 =>
            array(
                            'contrato_id' => 4,
                'nombre' => 'Disponibilidad de la Infraestructura',
                'metrica' => 'Disponibilidad de los servicios asociados a los componentes habilitadores del servicio',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => null,
                'periodo_evaluacion' => 'Diario',
                'revisiones' => 0,
                'area' => 'NULL',
                'descripcion' => 'Disponibilidad Integral de los servicios de los componentes habilitadores (95%) , disponibilidad del servicio de SIEM (no se incluye dashboard) (99.5%).',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            6 =>
            array(
                            'contrato_id' => 4,
                'nombre' => 'Entregables',
                'metrica' => 'Entrega oportuna de los reportes mensuales',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => null,
                'periodo_evaluacion' => 'Mensual',
                'revisiones' => 0,
                'area' => 'NULL',
                'descripcion' => 'Entrega  de los reportes a más tardar  10 días hábiles naturales posteriores al mes vencido  0.5% sobre el monto del pago mensual por retraso en la entrega de reportes.',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            7 =>
            array(
                            'contrato_id' => 8,
                'nombre' => 'Servicio Administrado de Centro de Operaciones de Seguridad. Tiempo de atención',
                'metrica' => '1ra. respuesta vía telefónica 5 min y 20 min 1ra. respuesta vía correo electrónico ',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => null,
                'periodo_evaluacion' => '2',
                'revisiones' => 0,
                'area' => 'Dirección General de Tecnologías de la Información',
                'descripcion' => 'Es el tiempo que transcurre entre que se recibe la solicitud de reporte  por alguno de los canales definidos (correo electrónico, llamada telefónica o web) ',
                'created_at' => '2022-04-27 12:34:15',
                'updated_at' => '2022-04-27 12:34:15',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            8 =>
            array(
                            'contrato_id' => 8,
                'nombre' => 'Servicio Administrado de Centro de Operaciones de Seguridad (SOC) Tiempo de solución.',
                'metrica' => 'Tiempo máximo 3hrs a partir de que se recibe la 1ra. respuesta',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '2',
                'revisiones' => 0,
                'area' => 'Dirección General de Tecnologías de la Información ',
                'descripcion' => 'Es el tiempo que transcurre desde que se atiende el reporte hasta que se soluciona.',
                'created_at' => '2022-04-27 12:37:05',
                'updated_at' => '2022-04-27 12:37:05',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            9 =>
            array(

                'contrato_id' => 8,
                'nombre' => 'Servicio Administrado de Centro de Operaciones de Seguridad (SOC) Disponibilidad de tiempo',
                'metrica' => 'Se debe observar el 99.5%',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '2',
                'revisiones' => 0,
                'area' => 'Dirección General de Tecnologías de la Información',
                'descripcion' => 'Es el tiempo en el que el servicio estuvo efectivamente disponible para su uso por parte del cliente.',
                'created_at' => '2022-04-27 12:41:52',
                'updated_at' => '2022-04-27 12:41:52',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            10 =>
            array(

                'contrato_id' => 8,
                'nombre' => 'Gestión de incidentes de Seguridad. Tiempo de notificación',
                'metrica' => 'Se realizará la notificación en un máximo de 30 minutos posterior a su confirmación y apertura  de ticket',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '2',
                'revisiones' => 0,
                'area' => 'Dirección General de Tecnologías de la Información',
                'descripcion' => 'Es el tiempo que transcurre entre que se identifica que una actividad anormal se convirtió en incidente de seguridad ',
                'created_at' => '2022-04-27 13:06:09',
                'updated_at' => '2022-04-27 13:06:09',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            11 =>
            array(

                'contrato_id' => 8,
                'nombre' => 'Gestión de incidentes de Seguridad. Tiempo de solución.',
                'metrica' => 'Prioridad Alta el tiempo máximo de solución será de 3 hrs, Prioridad Media el tiempo máximo de solución será de 8 hrs y Pridadad Baja el tiempo máximo de solución será planeado ',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '2',
                'revisiones' => 0,
                'area' => 'Dirección General de Tecnologías de Información ',
                'descripcion' => 'Es el tiempo que transcurre desde que se atiende el reporte hasta que se soluciona.
Prioridad Alta.- Es el incidente de seguridad que afecta la operación del cliente
Prioridad Media.- Es el incidente de seguridad que puede causar intermitencias en el servicio pero que no detiene la operación del cliente.
Prioridad Baja.- Son aquellos incidentes de seguridad que no detienen la operación  del cliente y que no causan intermitencias en los servicios.',
                'created_at' => '2022-04-27 13:18:08',
                'updated_at' => '2022-04-27 13:18:08',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            12 =>
            array(

                'contrato_id' => 8,
                'nombre' => 'Gestión de incidentes de Seguridad. Disponibilidad del Servicio.',
                'metrica' => 'Se deberá observar un 99.5%',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '2',
                'revisiones' => 0,
                'area' => 'Dirección General de Tecnologías de la Información',
                'descripcion' => 'Es el tiempo en el que el servicio estuvo efectivamente disponible para su uso por parte del Cliente.',
                'created_at' => '2022-04-27 13:22:03',
                'updated_at' => '2022-04-27 13:22:03',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            13 =>
            array(

                'contrato_id' => 17,
                'nombre' => 'Certificados de Renovación de licencias ',
                'metrica' => 'Se aplicará una deductiva del 0.25% por cada día de incumplimiento sobre el importe total de este concepto sin considerar el IVA',
                'meta' => '100',
                'unidad' => '100%',
                'info_consulta' => null,
                'periodo_evaluacion' => '9',
                'revisiones' => 1,
                'area' => 'Dirección de Infraestructura Tecnológica',
                'descripcion' => 'Se aplicará una deductiva del 0.25% por cada día de incumplimiento sobre el importe total de este concepto sin considerar el IVA',
                'created_at' => '2022-05-06 10:16:33',
                'updated_at' => '2022-05-06 10:33:18',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            14 =>
            array(

                'contrato_id' => 17,
                'nombre' => 'Memoria Técnicas',
                'metrica' => 'Se aplicará una deductiva del 0.25% por cada día de incumplimiento sobre el importe mensual del servicio de soporte técnico sin considerar el IVA',
                'meta' => '100',
                'unidad' => '100%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Infraestructura Tecnológica',
                'descripcion' => 'Se aplicará una deductiva del 0.25% por cada día de incumplimiento sobre el importe mensual del servicio de soporte técnico sin considerar el IVA',
                'created_at' => '2022-05-06 10:18:08',
                'updated_at' => '2022-05-06 10:18:08',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            15 =>
            array(

                'contrato_id' => 17,
                'nombre' => 'Relación de Tickets atendidos durante el mes',
                'metrica' => 'Se aplicará una deductiva del 0.25% por cada día de incumplimiento sobre el importe mensual del servicio de soporte técnico sin considerar el IVA',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Infraestructura Tecnológica',
                'descripcion' => 'Se aplicará una deductiva del 0.25% por cada día de incumplimiento sobre el importe mensual del servicio de soporte técnico sin considerar el IVA',
                'created_at' => '2022-05-06 10:20:59',
                'updated_at' => '2022-05-06 10:20:59',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            16 =>
            array(

                'contrato_id' => 17,
                'nombre' => 'Informe Mensual de Soporte Técnico',
                'metrica' => 'Se aplicará una deductiva del 0.25% por cada día de incumplimiento sobre el importe mensual del servicio de soporte técnico sin considerar el IVA',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Infraestructura Tecnológica',
                'descripcion' => 'Se aplicará una deductiva del 0.25% por cada día de incumplimiento sobre el importe mensual del servicio de soporte técnico sin considerar el IVA',
                'created_at' => '2022-05-06 10:25:15',
                'updated_at' => '2022-05-06 10:25:15',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            17 =>
            array(

                'contrato_id' => 17,
                'nombre' => 'Reporte de Servicio por Ticket',
                'metrica' => 'Se aplicará una deductiva del 0.25% por cada día de incumplimiento sobre el importe mensual del servicio de soporte técnico sin considerar el IVA',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Infraestructura Tecnológica',
                'descripcion' => 'Se aplicará una deductiva del 0.25% por cada día de incumplimiento sobre el importe mensual del servicio de soporte técnico sin considerar el IVA',
                'created_at' => '2022-05-06 10:31:04',
                'updated_at' => '2022-05-06 10:31:04',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            18 =>
            array(

                'contrato_id' => 17,
                'nombre' => 'Atención de solicitudes e incidentes',
                'metrica' => 'Se aplicará una deductiva del 0.5% por cada hora de incumplimiento en la atención de solicitudes e incidentes sobre el importe mensual del servicio de soporte técnico sin considerar IVA',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '0',
                'revisiones' => 0,
                'area' => 'Dirección de Infraestructura Tecnológica',
                'descripcion' => 'Se aplicará una deductiva del 0.5% por cada hora de incumplimiento en la atención de solicitudes e incidentes sobre el importe mensual del servicio de soporte técnico sin considerar IVA',
                'created_at' => '2022-05-06 10:32:52',
                'updated_at' => '2022-05-06 10:32:52',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            19 =>
            array(

                'contrato_id' => 20,
                'nombre' => 'Servicios. Atraso en la documentación presentada',
                'metrica' => '5% sobre el total de la factura mensual (se incluye todos los servicios) y 0.05% por cada día de atraso adicional',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => null,
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Tecnologías de la Información',
                'descripcion' => 'Aplicada para cualquier servicio o documento descrito en el anexo técnico que el proveedor ganador deje de cumplir de acuerdo con la forma y las características solicitadas.',
                'created_at' => '2022-05-20 13:29:28',
                'updated_at' => '2022-05-20 13:29:28',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            20 =>
            array(

                'contrato_id' => 17,
                'nombre' => 'Soporte Técnico Atención de tiempos',
                'metrica' => 'No debe pasar más de 30 min para que se asigne el Ticket',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => null,
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Infraestructura Tecnológica ',
                'descripcion' => 'Tiempo en el requerimiento en el servicio es tomado y asignado por el personal de Silent4Business',
                'created_at' => '2022-05-23 12:52:30',
                'updated_at' => '2022-05-23 12:52:30',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            21 =>
            array(

                'contrato_id' => 17,
                'nombre' => 'Soporte Técnico: Tiempos de Solución Crítica',
                'metrica' => 'Critico <=30 hrs',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Infraestructura Tecnológica ',
                'descripcion' => 'Es el tiempo en que el incidente en el servicio fue solucionado considerando lo siguiente.
Crítica: Cualquier incidente que degrade o interrumpa la operación de los equipos, aplicaciones y/o sistemas de la ASF',
                'created_at' => '2022-05-23 12:59:00',
                'updated_at' => '2022-05-23 12:59:00',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            22 =>
            array(

                'contrato_id' => 17,
                'nombre' => 'Soporte Técnico: Tiempos de solución Media',
                'metrica' => '<=5 hrs',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Infraestructura Tecnológica ',
                'descripcion' => 'Es el tiempo en el que un incidente en el servicio fue solucionado considerando lo siguiente:
Media: Solicitudes de asistencia de configuración o parametrización de la infraestructura.',
                'created_at' => '2022-05-23 13:11:15',
                'updated_at' => '2022-05-23 13:11:15',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            23 =>
            array(

                'contrato_id' => 17,
                'nombre' => 'Soporte Técnico: Tiempos de solución Baja',
                'metrica' => '<= 8hrs',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Infraestructura Tecnológica ',
                'descripcion' => 'Es el tiempo en el que un incidente en el servicio fue solucionado considerando lo siguiente:
Baja: Solicitudes de información o reportes asociados a la infraestructura en donde no exista interrupción o degradación.',
                'created_at' => '2022-05-23 13:15:02',
                'updated_at' => '2022-05-23 13:15:02',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            24 =>
            array(

                'contrato_id' => 21,
                'nombre' => 'Vía Telefónica 7x24x365. Nivel Bajo',
                'metrica' => '90 minutos naturales a partir de que se levante el reporte al centro de soporte',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => null,
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Subdirección General de Tecnologías de la Información',
                'descripcion' => 'El técnico especializado asignado tendría un tiempo máximo de 30 min para comunicarse con el área de soporte del el INFONAVIT una  vez levantado el reporte.

Si la asistencia telefónica /remota no ha solucionado el problema en un lapso de 60 minutos una vez que sea comunicado el técnico con el INFONAVIT el proveedor enviará un técnico especializado a las instalaciones de el INFONAVIT y creará un nuevo reporte con severidad media o alta de acuerdo con el impacto al equipo y la operación.

La pena convencional.- 0.5% del valor de concepto de servicio mensual de soporte por cada minuto de atraso a la comunicación con el área de soporte de el INFONAVIT.',
                'created_at' => '2022-05-24 09:58:22',
                'updated_at' => '2022-05-24 10:06:25',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            25 =>
            array(

                'contrato_id' => 21,
                'nombre' => 'En sitio por técnico especializado. 7X24X365. Nivel Medio',
                'metrica' => '6 hrs naturales a partir de que se levante el reporte al centro de soporte ',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Subdirección General de Tecnologías de la Información',
                'descripcion' => 'El tiempo máximo para la asistencia en sitio del reporte técnico especializado será de 2 hrs contadas a partir de que se levante el reporte al centro de soporte técnico.

El tiempo para la solución de la falla será de 6 hrs contadas a partir de que se levante el reporte al centro de soporte.

La pena convencional.- 1% del valor de concepto de servicio mensual de soporte por cada hora de atraso en la asistencia en sitio. 0.5% del valor de concepto de servicio mensual de soporte por cada día natural de atraso en la solución de la falla.',
                'created_at' => '2022-05-24 10:15:58',
                'updated_at' => '2022-05-24 10:45:56',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            26 =>
            array(

                'contrato_id' => 21,
                'nombre' => 'En sitio por técnico especializado. 7X24X365. Nivel Alto',
                'metrica' => 'El tiempo de respuesta es de 4 horas naturales a partir de que se levante el reporte al centro de soporte',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Subdirección General de Tecnologías de la Información',
                'descripcion' => 'El proveedor enviará a un técnico especializado inmediatamente después de levantado el reporte a través de la mesa de ayuda o centro de soporte.

Pena convencional.- 1% del valor de concepto de servicio mensual de soporte por cada 10 minutos de atraso en la asistencia en sitio.
1% del valor de concepto de servicio mensual de soporte por cada día natural de atraso en la solución de la falla.',
                'created_at' => '2022-05-24 10:52:32',
                'updated_at' => '2022-05-24 10:52:32',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            27 =>
            array(

                'contrato_id' => 21,
                'nombre' => 'Reposición de algún componente de la solución. Nivel Crítico',
                'metrica' => '2 días a partir de que se levante el reporte al centro de soporte',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Subdirección General de Tecnologías de la Información',
                'descripcion' => 'El proveedor deberá realizar el reemplazo de los componentes de hardware dañado del equipo.

Pena convencional.- 10% del valor de concepto de servicio mensual de soporte cada día natural de atraso.',
                'created_at' => '2022-05-24 11:04:08',
                'updated_at' => '2022-05-24 11:04:08',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            28 =>
            array(

                'contrato_id' => 19,
                'nombre' => 'Servicios de Ciberamenazas avanzadas y visibilidad en la red del engaño',
                'metrica' => '<=99.90%',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => null,
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Infraestructura y de Comunicaciones',
                'descripcion' => 'Para el Nivel de Servicio del Servicio de Ciberamenazas avanzadas y visibilidad en la red del engaño, deberá ser mayor o igual a 99.90%',
                'created_at' => '2022-05-26 09:43:44',
                'updated_at' => '2022-05-26 09:43:44',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            29 =>
            array(

                'contrato_id' => 19,
                'nombre' => 'Servicios de Correlación de Eventos de Seguridad',
                'metrica' => '<=99.90%',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Infraestructura y de Comunicaciones',
                'descripcion' => 'Para el Nivel de Servicio del Servicio de Correlación de Eventos de Seguridad, deberá ser mayor o igual a 99.90%',
                'created_at' => '2022-05-26 09:49:45',
                'updated_at' => '2022-05-26 09:49:45',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            30 =>
            array(

                'contrato_id' => 19,
                'nombre' => 'Servicio de Ciberinteligencia de amenazas',
                'metrica' => '<=99.90%',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Infraestructura y de Comunicaciones',
                'descripcion' => 'Para el Nivel de Servicio del Servicio de Ciberinteligencia de amenazas, deberá ser mayor o igual a 99.90%',
                'created_at' => '2022-05-26 09:51:33',
                'updated_at' => '2022-05-26 09:51:33',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            31 =>
            array(

                'contrato_id' => 19,
                'nombre' => 'Servicio Administrado de Centro de Operaciones de Seguridad (SOC) y Centro de Operaciones de Red (NOC) 7x24x365',
                'metrica' => '<=99.90%',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Infraestructura y de Comunicaciones',
                'descripcion' => 'Para el Nivel de Servicio del Servicio de Administrado de Centro de Operaciones de Seguridad (SOC) y Centro de Operaciones de Red (NOC) 7X24X365, deberá ser mayor o igual a 99.90%',
                'created_at' => '2022-05-26 09:57:34',
                'updated_at' => '2022-05-26 09:57:34',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            32 =>
            array(

                'contrato_id' => 19,
                'nombre' => 'El Tiempo de atención de requerimientos',
                'metrica' => 'es de 30 minutos para cualquier requerimiento',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Infraestructura y de Comunicaciones',
                'descripcion' => 'El tiempo de atención es de 30 minutos para cualquier requerimiento y podrán realizarse a través de cualquier medio: Telefónico y/o Correo.',
                'created_at' => '2022-05-26 10:04:11',
                'updated_at' => '2022-05-26 10:14:39',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            33 =>
            array(

                'contrato_id' => 19,
                'nombre' => 'Tiempo de Solución de requerimientos',
                'metrica' => 'El tiempo de solución para prioridad alta es de 90 min, para prioridad media es de 3 hrs y para prioridad baja será programado',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Infraestructura y de Comunicaciones',
                'descripcion' => 'El Tiempo de Solución de los requerimientos de solicitud de información hacia la Cámara de Senadores se considera el tiempo de solución a partir  de la notificación  correspondiente por parte del Centro de Operaciones de Seguridad de acuerdo con los siguientes tiempos:
Alta: 90 minutos
Media: 3 horas
Baja: Programado

',
                'created_at' => '2022-05-26 10:14:01',
                'updated_at' => '2022-05-26 10:14:01',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            34 =>
            array(

                'contrato_id' => 19,
                'nombre' => 'Control de Cambios',
                'metrica' => 'El tiempo para realizar el cambio es para prioridad horas, para prioridad media es de 6 horas y para prioridad baja será planeado',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Infraestructura y de Comunicaciones',
                'descripcion' => 'El Control de Cambios es el tiempo que tarda en realizar un cambio de configuración (alta, baja, modificación) sobre  la infraestructura del servicio será acorde a las necesidades de conectividad y flujos de información de las aplicaciones de la Cámara de Senadores.
Alta: 3 horas;
Media: 6 horas;
Baja: Planeado',
                'created_at' => '2022-05-26 10:27:45',
                'updated_at' => '2022-05-26 10:27:45',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            35 =>
            array(

                'contrato_id' => 19,
                'nombre' => 'Incidentes de Control',
                'metrica' => 'Cualquier requerimiento el tiempo será de 30 miniutos y el tiempo de contención será de 120 minutos',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Infraestructura y de Comunicaciones',
                'descripcion' => 'Incidentes de Control, este tipo de incidentes puede potencialmente ocasionar afección y/o daño en activos y servicios de la Cámara de Senadores. Eventos de afectación total al servicio, pérdida total de Sistema de Comunicación  y/o Seguridad, Degradación de los Recursos de la Cámara de Senadores.',
                'created_at' => '2022-05-26 10:35:36',
                'updated_at' => '2022-05-26 10:35:36',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            36 =>
            array(

                'contrato_id' => 19,
                'nombre' => 'Actividad Sospechosa',
                'metrica' => 'El tiempo de notificación será 30 minutos para cualquiera y el tiempo de contención será de 90 minutos. ',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Infraestructura y de Comunicaciones		',
                'descripcion' => 'Actividad Sospechosa este nivel cubre el monitoreo en linea de los servicios de seguridad para la detección de actividad sospechosa.',
                'created_at' => '2022-05-26 10:42:23',
                'updated_at' => '2022-05-26 10:42:23',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            37 =>
            array(

                'contrato_id' => 24,
                'nombre' => 'Niveles de Servicio para incidente. Nivel Bajo',
                'metrica' => 'El tiempo de configuración es de 8hrs y el tiempo de hardware es de 24 hrs',
                'meta' => '90',
                'unidad' => '%',
                'info_consulta' => null,
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Informática',
                'descripcion' => 'Son cambios programados que no afectan la operación y continuidad del negocio solicitud de información y reportes.',
                'created_at' => '2022-05-26 15:20:07',
                'updated_at' => '2022-05-26 15:20:07',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            38 =>
            array(

                'contrato_id' => 24,
                'nombre' => 'Nivel de Servicio para Incidentes. Nivel Medio',
                'metrica' => 'Tiempo de Configuración 4 horas, Tiempo de hardware 8 horas',
                'meta' => '90',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Informática',
                'descripcion' => 'Son cambios que en caso de no aplicarse pueden comprometerse la continuidad del negocio afectando los dispositivos críticos',
                'created_at' => '2022-05-26 15:45:13',
                'updated_at' => '2022-05-26 17:16:29',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            39 =>
            array(

                'contrato_id' => 32,
                'nombre' => 'reportes de disponibilidad',
                'metrica' => 'disponibilidad del servicio mensual',
                'meta' => '90',
                'unidad' => 'tiempo',
                'info_consulta' => null,
                'periodo_evaluacion' => '3',
                'revisiones' => 1,
                'area' => 'operaciones',
                'descripcion' => null,
                'created_at' => '2022-05-26 15:46:24',
                'updated_at' => '2022-05-26 15:46:24',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            40 =>
            array(

                'contrato_id' => 24,
                'nombre' => 'Niveles de Servicio para incidente. Nivel Alta',
                'metrica' => 'Tiempo de configuración 1 hrs y tiempo de hardware 4 hrs',
                'meta' => '95',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Informática',
                'descripcion' => 'Es cuando se presenta afectación en la disponibilidad y funcionalidad de los dispositivos para una falla física o lógica.',
                'created_at' => '2022-05-26 15:47:43',
                'updated_at' => '2022-05-26 17:18:02',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            41 =>
            array(

                'contrato_id' => 24,
                'nombre' => 'Niveles de Servicio para requerimiento. Nivel Bajo',
                'metrica' => 'Tiempo de configuración 8hrs y tiempo de hardware 24 hrs',
                'meta' => '90',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Informática',
                'descripcion' => 'Son cambios programados que no afectan la operación y continuidad del negocio solicitud de información y reportes.',
                'created_at' => '2022-05-26 15:50:03',
                'updated_at' => '2022-05-26 15:50:03',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            42 =>
            array(

                'contrato_id' => 24,
                'nombre' => 'Niveles de Servicio para requerimiento. Nivel Medio',
                'metrica' => 'Tiempo de configuración 4hrs y tiempo de hardware 8 hrs',
                'meta' => '90',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Informática',
                'descripcion' => 'Son cambios que en caso de no aplicarse pueden comprometerse la continuidad del negocio afectando los dispositivos críticos',
                'created_at' => '2022-05-26 15:52:08',
                'updated_at' => '2022-05-26 15:52:08',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            43 =>
            array(

                'contrato_id' => 24,
                'nombre' => 'Niveles de Servicio para requerimiento. Nivel Alta',
                'metrica' => 'Tiempo de configuración 1 hrs y tiempo de hardware 4hrs',
                'meta' => '95',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Informática',
                'descripcion' => 'Es cuando se presenta afectación en la disponibilidad y funcionalidad de los dispositivos para una falla física o lógica.',
                'created_at' => '2022-05-26 15:53:54',
                'updated_at' => '2022-05-26 15:53:54',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            44 =>
            array(

                'contrato_id' => 25,
                'nombre' => 'Niveles de Servicio para incidente. Nivel Bajo',
                'metrica' => 'El tiempo de configuración es de 8hrs y el tiempo de hardware es de 24 hrs',
                'meta' => '90',
                'unidad' => '%',
                'info_consulta' => null,
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Informática',
                'descripcion' => 'Son cambios programados que no afectan la operación y continuidad del negocio solicitud de información y reportes.',
                'created_at' => '2022-05-26 17:14:51',
                'updated_at' => '2022-05-26 17:14:51',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            45 =>
            array(

                'contrato_id' => 25,
                'nombre' => 'Nivel de Servicio para Incidentes. Nivel Medio',
                'metrica' => 'Tiempo de Configuración 4 horas, Tiempo de hardware 8 horas',
                'meta' => '90',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Informática',
                'descripcion' => 'Son cambios que en caso de no aplicarse pueden comprometerse la continuidad del negocio afectando los dispositivos críticos',
                'created_at' => '2022-05-26 17:16:20',
                'updated_at' => '2022-05-26 17:16:20',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            46 =>
            array(

                'contrato_id' => 25,
                'nombre' => 'Niveles de Servicio para incidente. Nivel Alta',
                'metrica' => 'Tiempo de configuración 1 hrs y tiempo de hardware 4 hrs',
                'meta' => '95',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Informática',
                'descripcion' => 'Es cuando se presenta afectación en la disponibilidad y funcionalidad de los dispositivos para una falla física o lógica.',
                'created_at' => '2022-05-26 17:17:56',
                'updated_at' => '2022-05-26 17:17:56',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            47 =>
            array(

                'contrato_id' => 25,
                'nombre' => 'Niveles de Servicio para requerimiento. Nivel Bajo',
                'metrica' => 'Tiempo de configuración 8hrs y tiempo de hardware 24 hrs',
                'meta' => '90',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Informática',
                'descripcion' => 'Son cambios programados que no afectan la operación y continuidad del negocio solicitud de información y reportes.',
                'created_at' => '2022-05-26 17:19:12',
                'updated_at' => '2022-05-26 17:19:12',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            48 =>
            array(

                'contrato_id' => 25,
                'nombre' => 'Niveles de Servicio para requerimiento. Nivel Medio',
                'metrica' => 'Tiempo de configuración 4hrs y tiempo de hardware 8 hrs',
                'meta' => '90',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Informática ',
                'descripcion' => 'Son cambios que en caso de no aplicarse pueden comprometerse la continuidad del negocio afectando los dispositivos críticos',
                'created_at' => '2022-05-26 17:21:16',
                'updated_at' => '2022-05-26 17:21:16',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            49 =>
            array(

                'contrato_id' => 25,
                'nombre' => 'Niveles de Servicio para requerimiento. Nivel Alta',
                'metrica' => 'Tiempo de configuración 1 hrs y tiempo de hardware 4hrs',
                'meta' => '95',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección de Informática',
                'descripcion' => 'Es cuando se presenta afectación en la disponibilidad y funcionalidad de los dispositivos para una falla física o lógica.',
                'created_at' => '2022-05-26 17:22:39',
                'updated_at' => '2022-05-26 17:22:39',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            50 =>
            array(

                'contrato_id' => 26,
                'nombre' => 'Servicio administrado de monitoreo y correlación de eventos de seguridad',
                'metrica' => 'Prioridad critica máximo tiempo de respuesta es de 20 min, para prioridad alta es de 40 min, para prioridad media es de 60 min y para la prioridad baja es de 120 minutos',
                'meta' => '99.5',
                'unidad' => '%',
                'info_consulta' => null,
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Coordinación de Operación de Tecnologías de la Información y Comunicaciones',
                'descripcion' => 'Disponibilidad mensual de la solución  de correlación de Eventos es de 99.5%.
Tiempo de identificación notificación comportamientos anómalos, cambios, boletines o notificaciones de seguridad.
Prioridad crítica: 20 minutos
Prioridad alta: 40 minutos
Prioridad media: 60 minutos
Prioridad baja: 120 minutos.

',
                'created_at' => '2022-05-31 18:23:14',
                'updated_at' => '2022-06-01 09:30:10',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            51 =>
            array(

                'contrato_id' => 26,
                'nombre' => 'Equipo de respuesta ante incidentes de seguridad computacional.  Tiempo de reacción del equipo a incidentes',
                'metrica' => 'El tiempo de reacción máximo para prioridad crítica es de 20 minutos, para prioridad alta es de 40 minutos, para prioridad media es de 60 minutos y baja es de 120 minutos',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Coordinación de Operación de Tecnologías de la Información y Comunicaciones',
                'descripcion' => 'El tiempo de reacción del equipo de respuesta a incidentes:
Prioridad crítica: 20 minutos
Prioridad alta: 40 minutos
Prioridad media: 60 minutos
Prioridad baja: 120 minutos

El tiempo de solución de acuerdo con los tiempos determinados en el plan de trabajo de remediación correspondiente, autorizado por el INDEP.',
                'created_at' => '2022-05-31 18:28:03',
                'updated_at' => '2022-06-01 09:38:08',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            52 =>
            array(

                'contrato_id' => 26,
                'nombre' => 'Servicio administrado de una solución de seguridad para equipos de cómputo de escritorio (EDR - Endpoint Detection and Response)',
                'metrica' => 'El tiempo de identificación para prioridad crítica es de 30 minutos, para prioridad alta es de 60 minutos, para prioridad media es de 120 minutos y para prioridad baja es de 180 minutos ',
                'meta' => '99.5',
                'unidad' => '%',
                'info_consulta' => null,
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Coordinación de Operación de Tecnologías de la Información y Comunicaciones',
                'descripcion' => 'La Disponibilidad mensual de la solución de Endpoint Detection and Response es de 99.5%.
El tiempo de identificación, notificación , comportamiento anónimo, boletines o notificaciones de seguridad
Prioridad Crítica: 30 minutos
Prioridad Alta: 60 minutos
Prioridad Media: 120 minutos
Prioridad Baja : 180 minutos',
                'created_at' => '2022-06-01 09:29:50',
                'updated_at' => '2022-06-01 09:29:50',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            53 =>
            array(

                'contrato_id' => 26,
                'nombre' => 'Equipo de respuesta ante incidentes de seguridad computacional: Tiempos de investigación',
                'metrica' => 'El tiempo máximo para la investigación e investigación causa raíz es para la Prioridad Crítica: 8 hrs. continuas, para prioridad alta es de 12 hrs. continuas, para prioridad media es de 24 hrs. continuas y para prioridad baja es de 48 hrs. continuas',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Coordinación de Operación de Tecnologías de la Información y Comunicaciones',
                'descripcion' => 'Los tiempos de investigación e identificación a causa raíz de incidentes, comportamientos anómalos, boletines o notificaciones de seguridad.
Prioridad Crítica: 8 hrs continuas
Prioridad Alta: 12 hrs continuas
Prioridad Media: 24 hrs continuas
Prioridad Baja: 48 hrs continuas',
                'created_at' => '2022-06-01 09:36:18',
                'updated_at' => '2022-06-01 09:36:18',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            54 =>
            array(

                'contrato_id' => 26,
                'nombre' => 'Servicio administrado de una solución de seguridad para equipos de cómputo de escritorio (EDR - Endpoint Detection and Response). Tiempos de Solución ',
                'metrica' => 'El tiempo máximo para la solución de incidentes es para: prioridad crítica 4 hrs, para la prioridad alta un día natural, para prioridad media es de 2 días naturales y para prioridad baja es de 4 días naturales ',
                'meta' => '99.5',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Coordinación de Operación de Tecnologías de la Información y Comunicaciones',
                'descripcion' => 'Los tiempos de solución de incidentes para el servicio administrado de una solución de seguridad para equipo de cómputo de escritorio. (Endpoint Detection and Response)
Tiempos de solución:
Prioridad Critica: 4 horas
Prioridad Alta: 1 día natural
Prioridad Media: 2 días naturales
Prioridad Baja: 4 días naturales',
                'created_at' => '2022-06-01 09:46:45',
                'updated_at' => '2022-06-01 09:46:45',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            55 =>
            array(

                'contrato_id' => 26,
                'nombre' => 'Servicio administrado de una solución de seguridad para equipos de cómputo de escritorio (EDR - Endpoint Detection and Response). Tiempos de investigación ',
                'metrica' => 'Los tiempos máximos para la investigación son para prioridad crítica 8 hrs continuas, para prioridad alta es de 12 hrs continuas, para prioridad media es de 24 hrs continuas y para prioridad baja es de 48 hrs continuas ',
                'meta' => '99.5',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Coordinación de Operación de Tecnologías de la Información y Comunicaciones',
                'descripcion' => 'El tiempo de investigación e identificación a causa raiz de incidentes, comportamientos anómalos, boletines  o notificaciones  de seguridad:
Prioridad Crítica: 8 hrs continuas
Prioridad Alta: 12 hrs continuas
Prioridad Media: 24 hrs continuas
Prioridad Baja 48 hrs continuas.',
                'created_at' => '2022-06-01 09:53:11',
                'updated_at' => '2022-06-01 09:53:11',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            56 =>
            array(

                'contrato_id' => 26,
                'nombre' => 'Servicio de Ciber inteligencia análisis de vulnerabilidades de suficiencia de controles de seguridad ',
                'metrica' => 'Análisis de vulnerabilidades , pruebas de penetración  verificación  de suficiencia es de 99.5% su disponibilidad mensual de servicio.',
                'meta' => '99.5',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Coordinación de Operación de Tecnologías de la Información y Comunicaciones',
                'descripcion' => 'Disponibilidad  mensual del servicio de ciber patrullaje: 99.5%
Disponibilidad mensual del servicio de Ciberinteligencia: 99.5%
Análisis de vulnerabilidades, pruebas de penetración verificación  de suficiencia de controles de seguridad e ingeniería social de acuerdo a los tiempos comprometidos en los planes de trabajo en los planes de trabajo autorizados para INDEP.',
                'created_at' => '2022-06-01 10:01:32',
                'updated_at' => '2022-06-01 10:01:32',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            57 =>
            array(

                'contrato_id' => 26,
                'nombre' => 'Servicios de despliegue y monitoreo de una consola de antivirus tipo Enterprise',
                'metrica' => 'La disponibilidad del solución de consola de antivirus tipo Enterprise 99.5%',
                'meta' => '99.5',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Coordinación de Operación de Tecnologías de la Información y Comunicaciones',
                'descripcion' => 'La disponibilidad mensual de la solución de despliegue y monitoreo de la consola de antivirus tipo Enterprise 99.5%',
                'created_at' => '2022-06-01 10:08:01',
                'updated_at' => '2022-06-01 10:08:01',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            58 =>
            array(

                'contrato_id' => 26,
                'nombre' => 'Servicios de despliegue y monitoreo de una consola de antivirus tipo Enterprise: Tiempo de identificación de incidentes',
                'metrica' => 'El tiempo máximo para la identificación es para el periodo crítica es de 30 minutos, para la prioridad alta es de 60 minutos, para la prioridad media es de 120 minutos y para prioridad baja es de 180 minutos',
                'meta' => '99.5',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Coordinación de Operación de Tecnologías de la Información y Comunicaciones',
                'descripcion' => 'El tiempo de identificación, notificación, comportamientos anómalos o notificaciones de seguridad.
Prioridad Crítica: 30 minutos
Prioridad Alta: 60 minutos
Prioridad Media: 120 minutos
Prioridad Baja: 180 minutos
',
                'created_at' => '2022-06-01 10:12:25',
                'updated_at' => '2022-06-01 10:12:25',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            59 =>
            array(

                'contrato_id' => 26,
                'nombre' => '	Servicios de despliegue y monitoreo de una consola de antivirus tipo Enterprise: Tiempo de solución',
                'metrica' => 'Los tiempos máximo para la solución de incidentes es para la prioridad crítica 4 hrs, para prioridad alta es de un día natural, para prioridad media es de 2 días naturales y para prioridad baja es de 4 días naturales',
                'meta' => '99.5',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Coordinación de Operación de Tecnologías de la Información y Comunicaciones',
                'descripcion' => 'Los tiempos de solución para el servicio de despliegue y monitoreo de una consola de antivirus de tipo Enterprise
Prioridad Crítica: 4 hrs
Prioridad Alta: 1 día natural
Prioridad Media: 2 días naturales
Prioridad Baja: 4 días naturales
',
                'created_at' => '2022-06-01 10:18:09',
                'updated_at' => '2022-06-01 10:18:09',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            60 =>
            array(

                'contrato_id' => 26,
                'nombre' => 'Entregables iniciales ',
                'metrica' => 'Los entregable iniciales deberán entregarse de acuerdo con los tiempos establecidos dentro del anexo técnico de los contrario se aplicará una pena del 2% sobre le valor del costo mensual de cada uno de los servicios.',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Coordinación de Operación de Tecnologías de la Información y Comunicaciones',
                'descripcion' => 'Los entregables iniciales en los plazos establecidos en el presente anexo técnico. Dicha pena será del 2% del valor del costo mensual de cada uno de los servicios por cada día natural de atraso.',
                'created_at' => '2022-06-01 10:21:56',
                'updated_at' => '2022-06-01 10:32:41',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            61 =>
            array(

                'contrato_id' => 26,
                'nombre' => 'Entregables mensuales',
                'metrica' => 'Los entregables mensuales deben ser entregados en los tiempos establecidos en el anexo técnico en caso contrario la pena será del 1% del valor del costo mensual de cada uno de los servicios.',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Coordinación de Operación de Tecnologías de la Información y Comunicaciones',
                'descripcion' => 'Los entregables mensuales y bajo demanda en los plazos establecidos en el plazo establecidos en el presente anexo técnico. Dicha pena será del 1% del valor del costo mensual, de cada uno de los servicios, por cada día natural de atraso.',
                'created_at' => '2022-06-01 10:25:04',
                'updated_at' => '2022-06-01 10:27:01',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            62 =>
            array(

                'contrato_id' => 26,
                'nombre' => 'Entregables finales ',
                'metrica' => 'Los entregables finales deberán de entregarse de acuerdo con lo establecido al anexo técnico en caso contrario se aplicará una pena de 2% sobre el valor del costo mensual de cada unos de los servicios.',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => '',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Coordinación de Operación de Tecnologías de la Información y Comunicaciones',
                'descripcion' => 'Los entregables finales en los plazos establecidos en el presente anexo técnico. Dicha pena será de 2% del valor del costo mensual de cada uno de los servicios, por cada día natural de atraso.',
                'created_at' => '2022-06-01 10:30:28',
                'updated_at' => '2022-06-01 10:30:28',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            63 =>
            array(

                'contrato_id' => 36,
                'nombre' => 'Solicitudes / Cambios Prioridad Alta',
                'metrica' => 'El tiempo máximo de atención es de 30 minutos y el tiempo máximo de respuesta es de 8 hrs',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => 'Cumple con las especificaciones establecidas en el Acuerdo de los Niveles de Servicios',
                'periodo_evaluacion' => '5',
                'revisiones' => 0,
                'area' => 'Dirección General de Tecnologías de Información y Comunicaciones',
                'descripcion' => 'El tiempo de atención  se considera ese tiempo desde que se recibe la solicitud por parte del Grupo Peñoles hasta la primera notificación de Silent4business. y el tiempo máximo de solución desde la 1ra notificación por parte de Silent4business.',
                'created_at' => '2022-06-17 12:28:11',
                'updated_at' => '2022-06-17 12:28:11',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            64 =>
            array(

                'contrato_id' => 36,
                'nombre' => 'Solicitudes / Cambios Prioridad Media',
                'metrica' => 'El tiempo máximo de atención será de 30 minutos y el tiempo de respuesta máximo será de 12 hrs',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => 'Cumple con las especificaciones establecidas en el acuerdo de nivel de servicio',
                'periodo_evaluacion' => '5',
                'revisiones' => 1,
                'area' => 'Dirección General de Tecnologías de Información y Comunicaciones',
                'descripcion' => 'El tiempo de atención se considera ese tiempo desde que se recibe la solicitud por parte del Grupo Peñoles hasta la primera notificación de Silent4business. y el tiempo máximo de solución desde la 1ra notificación por parte de Silent4business.',
                'created_at' => '2022-06-17 12:32:13',
                'updated_at' => '2022-06-17 12:32:13',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            65 =>
            array(

                'contrato_id' => 36,
                'nombre' => 'Solicitudes / Cambios Prioridad Baja',
                'metrica' => 'El tiempo máximo de atención será de 30 min y el tiempo máximo de respuesta será programado',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => 'Cumple con las especificaciones establecidas en el acuerdo de nivel de servicio',
                'periodo_evaluacion' => '5',
                'revisiones' => 1,
                'area' => 'Dirección General de Tecnologías de Información y Comunicaciones',
                'descripcion' => 'El tiempo de atención se considera ese tiempo desde que se recibe la solicitud por parte del Grupo Peñoles hasta la primera notificación de Silent4business. y el tiempo máximo de solución desde la 1ra notificación por parte de Silent4business.',
                'created_at' => '2022-06-17 12:34:53',
                'updated_at' => '2022-06-17 12:34:53',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            66 =>
            array(

                'contrato_id' => 36,
                'nombre' => 'Incidente Prioridad Alta',
                'metrica' => 'El tiempo máximo de atención será de 30 minutos y el tiempo máximo de respuesta será de  8 hrs',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => 'Cumple con las especificaciones establecidas en el  acuerdo de nivel de servicio',
                'periodo_evaluacion' => '5',
                'revisiones' => 1,
                'area' => 'Dirección General de Tecnologías de Información y Comunicaciones',
                'descripcion' => 'El tiempo de atención se considera ese tiempo desde que se recibe la solicitud por parte del Grupo Peñoles hasta la primera notificación de Silent4business. y el tiempo máximo de solución desde la 1ra notificación por parte de Silent4business.',
                'created_at' => '2022-06-17 12:40:20',
                'updated_at' => '2022-06-17 12:40:20',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            67 =>
            array(

                'contrato_id' => 36,
                'nombre' => 'Incidente Prioridad Media',
                'metrica' => 'El tiempo máximo de atención será de 30 min y el tiempo máximo  de respuesta será de 12 hrs.',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => 'Cumple con las especificaciones establecidas en el acuerdo de nivel de servicio',
                'periodo_evaluacion' => '5',
                'revisiones' => 1,
                'area' => 'Dirección General de Tecnologías de Información y Comunicaciones',
                'descripcion' => 'El tiempo de atención se considera ese tiempo desde que se recibe la solicitud por parte del Grupo Peñoles hasta la primera notificación de Silent4business. y el tiempo máximo de solución desde la 1ra notificación por parte de Silent4business.',
                'created_at' => '2022-06-17 12:42:25',
                'updated_at' => '2022-06-17 12:46:18',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            68 =>
            array(

                'contrato_id' => 36,
                'nombre' => 'Incidente Prioridad Baja',
                'metrica' => 'El tiempo máximo de atención será de 30 min y el tiempo máximo de respuesta será programado',
                'meta' => '100',
                'unidad' => '%',
                'info_consulta' => 'Cumple con las especificaciones establecidas en el acuerdo de nivel de servicio',
                'periodo_evaluacion' => '5',
                'revisiones' => 1,
                'area' => 'Dirección General de Tecnologías de Información y Comunicaciones',
                'descripcion' => 'El tiempo de atención se considera ese tiempo desde que se recibe la solicitud por parte del Grupo Peñoles hasta la primera notificación de Silent4business. y el tiempo máximo de solución desde la 1ra notificación por parte de Silent4business.',
                'created_at' => '2022-06-17 12:46:02',
                'updated_at' => '2022-06-17 12:46:02',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
        ));
    }
}