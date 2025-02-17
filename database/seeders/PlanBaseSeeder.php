<?php

namespace Database\Seeders;

use App\Models\PlanBaseActividade;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PlanBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $planbs = [
            [
                'actividad' => 'Evaluar tablero y presentar resultados a dirección',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 1,
            ],
            [
                'actividad' => 'Identificar brechas y esfuerzos',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 1,
            ],
            [
                'actividad' => 'Identificar el Contexto de la Organización',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 2,
            ],
            [
                'actividad' => 'Entendimiento de las necesidades y expectativas de las partes interesadas',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 2,
            ],
            [
                'actividad' => 'Manual del SGI',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 2,
            ],
            [
                'actividad' => 'Elaborar matriz FODA',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 2,
            ],
            [
                'actividad' => 'Determinar Alcance del SGSI',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 2,
            ],
            [
                'actividad' => 'Política de Seguridad de Información',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 2,
            ],
            [
                'actividad' => 'Objetivos del SGSI',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 2,
            ],
            [
                'actividad' => 'Análisis y Evaluación de Riesgos',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 2,
            ],
            [
                'actividad' => 'Inventario de activos de Información',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 2,
            ],
            [
                'actividad' => 'Evaluación y valoración del Riesgo',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 2,
            ],
            [
                'actividad' => 'Plan de Tratamiento de Riesgos conforme a los controles de seguridad',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 2,
            ],
            [
                'actividad' => 'Declaración de aplicabilidad SoA',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 2,
            ],
            [
                'actividad' => 'Compromiso de la Alta Dirección',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 3,
            ],
            [
                'actividad' => 'Asignación de Recursos',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 3,
            ],
            [
                'actividad' => 'Conformar el Comité de Seguridad',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 3,
            ],
            [
                'actividad' => 'Elaborar matriz de roles y responsabilidades',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 3,
            ],
            [
                'actividad' => 'Competencias y capacitación',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 3,
            ],
            [
                'actividad' => 'Descripciones de puesto',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 3,
            ],
            [
                'actividad' => 'Control de capacitación del personal',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 3,
            ],
            [
                'actividad' => 'Comunicación del SGSI',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 3,
            ],
            [
                'actividad' => 'Procesos de gestión',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 4,
            ],
            [
                'actividad' => 'Información documentada',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 4,
            ],
            [
                'actividad' => 'Acciones correctivas',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 4,
            ],
            [
                'actividad' => 'Auditoria interna',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 4,
            ],
            [
                'actividad' => 'Gestión de incidentes de seguridad de la información',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 4,
            ],
            [
                'actividad' => 'Manual de Políticas de seguridad de la información',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 4,
            ],
            [
                'actividad' => 'A.5 Políticas de seguridad de información',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 4,
            ],
            [
                'actividad' => 'A.6 Organización de la seguridad de información',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 4,
            ],
            [
                'actividad' => 'A.7 Seguridad en recursos humanos',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 4,
            ],
            [
                'actividad' => 'A.8 Administración de activos',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 4,
            ],
            [
                'actividad' => 'A.9 Control de acceso',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 4,
            ],
            [
                'actividad' => 'A.10 Criptografía',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 4,
            ],
            [
                'actividad' => 'A.11 Seguridad física y ambiental',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 4,
            ],
            [
                'actividad' => 'A.12 Seguridad en operaciones',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 4,
            ],
            [
                'actividad' => 'A.13 Seguridad en comunicaciones',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 4,
            ],
            [
                'actividad' => 'A.14 Adquisición, desarrollo y mantenimiento de sistemas',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 4,
            ],
            [
                'actividad' => 'A.15 Relación con proveedores',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 4,
            ],
            [
                'actividad' => 'A.16 Administración de incidentes de seguridad de la información',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 4,
            ],
            [
                'actividad' => 'A.17 Aspectos de seguridad de la información en la administración de continuidad del negocio',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 4,
            ],
            [
                'actividad' => 'A.18 Cumplimiento',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 4,
            ],
            [
                'actividad' => 'Auditoría Interna',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 5,
            ],
            [
                'actividad' => 'Evaluación',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 5,
            ],
            [
                'actividad' => 'Reporte de Auditoría',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 5,
            ],
            [
                'actividad' => 'Consolidación de Información para la Revisión de la Dirección',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 5,
            ],
            [
                'actividad' => 'Revisión de la Dirección',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 5,
            ],
            [
                'actividad' => 'Revisión de resultados de auditoría y desempeño del SGSI',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 5,
            ],
            [
                'actividad' => 'Documentación de Acciones Correctivas y mejora',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 6,
            ],
            [
                'actividad' => 'Cierre de acciones de mejora',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 6,
            ],
            [
                'actividad' => 'Cierre de acciones correctivas de la Auditoria Interna y/o externa',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 6,
            ],
            [
                'actividad' => 'Cierre de acciones correctivas derivadas de la Revisión de la Dirección',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'estatus_id' => 1,
                'actividad_fase_id' => 6,
            ],

        ];
        PlanBaseActividade::insert($planbs);
    }
}
