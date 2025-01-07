<?php

namespace Database\Seeders;

use App\Models\Organizacion;
use Illuminate\Database\Seeder;

class OrganizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organizacion::create([
            'empresa' => 'Silent 4 Business',
            'direccion' => 'Dirección de prueba',
            'telefono' => '5592003298',
            'correo' => 'empresa@silent4business.com',
            'pagina_web' => 'https://www.silent4business.com',
            'giro' => 'Ciberseguridad',
            'servicios' => 'Desarrollo de herramientas de Seguridad Informática, Análisis de Riesgos, Concientización, Implementación y configuración de herramientas de Seguridad, aplicaciones e infraestructuras',
            'mision' => 'Proveer servicios especializados de atención y respuesta a amenazas e incidentes de seguridad, a través de mejora continua de nuestros procesos y alianzas con otras organizaciones para contribuir a un entorno digital de nuestros clientes.',
            'vision' => 'A través de un equipo especializado, ser un referente confiable en materia de investigación, asistencia y difusión en actividades de atención y respuesta a incidentes de seguridad.',
            'valores' => 'Proporcionar asistencia técnica especializada a nuestros clientes y a las organizaciones en general, en la atención de amenazas y/o incidentes de seguridad.',
            'antecedentes' => 'Antecendentes de prueba',
        ]);
    }
}

// INSERT INTO public.organizacions
// (
//     id,
//     empresa, ...
//     direccion, ...
//     telefono,
//     correo,
//     pagina_web,
//     giro,
//     servicios,
//     mision,
//     ision,
//     valores,
//     created_at,
//     updated_at,
//     deleted_at,
//     team_id,
//     antecedentes,
//     logotipo,
//     razon_social,
//     rfc,
//     representante_legal,
//     fecha_constitucion,
//     num_empleados,
//     tamano,
//     linkedln,
//     youtube,
//     facebook,
//     twitter,
//     dia_timesheet, ...
//     inicio_timesheet, ...
//     fin_timesheet, ...
//     fecha_registro_timesheet,
//     semanas_min_timesheet,
//     semanas_adicionales ...
//     )
// VALUES(nextval('organizacions_id_seq'::regclass), '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', 0, '', '', '', '', '', 'Viernes'::character varying, 'Lunes'::character varying, 'Domingo'::character varying, '', 0, '2'::smallint);
