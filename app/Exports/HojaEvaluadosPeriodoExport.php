<?php

namespace App\Exports;

use App\Models\EvaluacionDesempeno;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class HojaEvaluadosPeriodoExport implements FromCollection, WithHeadings, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $id;

    public $periodo_id;

    public function __construct($id_evaluacion, $id_periodo)
    {
        $this->id = $id_evaluacion;
        $this->periodo_id = $id_periodo;
    }

    public function collection()
    {
        $evaluacion = EvaluacionDesempeno::find($this->id);
        $coleccion = collect();
        foreach ($evaluacion->periodos as $key_periodo => $periodo) {
            $coleccion = collect();
            foreach ($evaluacion->evaluados as $key => $evaluado) {
                $empleadoId = $evaluado->empleado->id;
                $evaluadores = collect();
                $total_objetivos = 0;
                $total_competencias = 0;
                $calificacion_evaluacion = 0;

                if ($evaluacion->activar_objetivos) {
                    $totales_evaluado[$periodo->id][$evaluado->id]['objetivos'] = $evaluado->calificacionesObjetivosEvaluadoPeriodo($periodo->id);
                    $evObj = $evaluado->evaluadoresObjetivos($periodo->id);

                    $evaluadoresObjetivos = $evObj->reject(function ($item) use ($empleadoId) {
                        return $item['evaluador_desempeno_id'] == $empleadoId;
                    });

                    $evO = $evaluadoresObjetivos->map(function ($eO) {
                        return [
                            'id' => $eO->empleado->id,
                            'nombre' => $eO->empleado->name,
                        ];
                    });

                    $evaluadores = $evaluadores->merge($evO);

                    $total_objetivos = ($totales_evaluado[$periodo->id][$evaluado->id]['objetivos']['promedio_total'] * $evaluacion->porcentaje_objetivos) / 100;
                }

                if ($evaluacion->activar_competencias) {
                    $totales_evaluado[$periodo->id][$evaluado->id]['competencias'] = $evaluado->calificacionesCompetenciasEvaluadoPeriodo($periodo->id);
                    $evComp = $evaluado->evaluadoresCompetencias($periodo->id);

                    $evaluadoresCompetencias = $evComp->reject(function ($item) use ($empleadoId) {
                        return $item['evaluador_desempeno_id'] == $empleadoId;
                    });

                    $evC = $evaluadoresCompetencias->map(function ($eC) {
                        return [
                            'id' => $eC->empleado->id,
                            'nombre' => $eC->empleado->name,
                        ];
                    });

                    $evaluadores = $evaluadores->merge($evC);

                    $total_competencias = ($totales_evaluado[$periodo->id][$evaluado->id]['competencias']['promedio_total'] * $evaluacion->porcentaje_competencias) / 100;
                }

                // Keep only 'nombre' after ensuring uniqueness based on 'id'
                // $totales_evaluado[$periodo->id][$evaluado->id]['evaluadores'] = $evaluadores->unique('id')->pluck('nombre')->values()->all();

                // Ensure uniqueness and concatenate 'nombre' values with "/"
                $concatenatedEvaluadores = $evaluadores->unique('id')->pluck('nombre')->implode(' , ');

                $calificacion_evaluacion = $total_objetivos + $total_competencias;

                $data =
                    [
                        'nombre' => $evaluado->empleado->name,
                        'puesto' => $evaluado->empleado->puestoRelacionado->puesto,
                        'area' => $evaluado->empleado->area->area,
                        'evaluadores' => $concatenatedEvaluadores,
                        'estatus' => $evaluado->empleado->estatus,
                        'porcentajeObjetivos' => $evaluacion->porcentaje_objetivos,
                        'porcentajeCompetencias' => $evaluacion->porcentaje_competencias,
                        'competencias' => $total_competencias,
                        'objetivos' => $total_objetivos,
                        'total' => $calificacion_evaluacion,
                    ];

                $filtro_competencias = $totales_evaluado[$periodo->id][$evaluado->id]['competencias']['calif_total'];
                $filtro_objetivos = $totales_evaluado[$periodo->id][$evaluado->id]['objetivos']['calif_total'];

                foreach ($filtro_competencias as $key_c => $comp) {
                    $data['nombre_competencia'.($key_c + 1)] = $comp['competencia'];
                    $data['calif_competencia'.($key_c + 1)] = $comp['calificacion_total'];
                }

                foreach ($filtro_objetivos as $key_o => $obj) {
                    $data['nombre_objetivo'.($key_o + 1)] = $obj['nombre'];
                    $data['calif_objetivo'.($key_o + 1)] = $obj['calificacion_total'];
                }
                $coleccion->push($data);
            }
        }

        return $coleccion;
    }

    public function headings(): array
    {
        $evaluacion = EvaluacionDesempeno::find($this->id);

        if ($evaluacion->activar_objetivos && $evaluacion->activar_competencias) {
            $allHeaders = [
                'Nombre',
                'Puesto',
                'Area',
                'Evaluadores',
                'Estatus',
                'Porcentaje Objetivos',
                'Porcentaje Competencias',
                'Total Competencias',
                'Total Objetivos',
                'Calificacion',
            ];
        } elseif ($evaluacion->activar_objetivos && ! $evaluacion->activar_competencias) {
            $allHeaders = [
                'Nombre',
                'Puesto',
                'Area',
                'Evaluadores',
                'Estatus',
                'Porcentaje Objetivos',
                'Porcentaje Competencias',
                'Total Objetivos',
                'Calificacion',
            ];
        } elseif (! $evaluacion->activar_objetivos && $evaluacion->activar_competencias) {
            $allHeaders = [
                'Nombre',
                'Puesto',
                'Area',
                'Evaluadores',
                'Estatus',
                'Porcentaje Objetivos',
                'Porcentaje Competencias',
                'Total Competencias',
                'Calificacion',
            ];
        }

        return $allHeaders;
    }

    public function headingsStyle(): array
    {
        return [
            'font' => [
                'color' => ['rgb' => 'FFFFFF'], // Color del texto (blanco)
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => '00FF00'], // Color de fondo (verde)
            ],
        ];
    }

    public function title(): string
    {
        return 'Evaluacion';
    }
}
