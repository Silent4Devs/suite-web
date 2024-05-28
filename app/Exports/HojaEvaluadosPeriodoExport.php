<?php

namespace App\Exports;

use App\Models\EvaluacionDesempeno;
use App\Models\SolicitudVacaciones;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class HojaEvaluadosPeriodoExport implements FromCollection, WithHeadings,  WithTitle
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
        foreach ($evaluacion->evaluados as $key => $evaluado) {
            $empleadoId = $evaluado->empleado->id;
            $evaluadores = collect();

            if ($evaluacion->activar_objetivos) {
                $totales_evaluado[$this->periodo_id][$evaluado->id]['objetivos'] = $evaluado->calificacionesObjetivosEvaluadoPeriodo($this->periodo_id);
                $evObj = $evaluado->evaluadoresObjetivos($this->periodo_id);

                $evaluadoresObjetivos = $evObj->reject(function ($item) use ($empleadoId) {
                    return $item['evaluador_desempeno_id'] == $empleadoId;
                });

                $evO = $evaluadoresObjetivos->map(function ($eO) {
                    return [
                        'id' => $eO->empleado->id,
                        'nombre' => $eO->empleado->name
                    ];
                });

                $evaluadores = $evaluadores->merge($evO);
            }

            if ($evaluacion->activar_competencias) {
                $totales_evaluado[$this->periodo_id][$evaluado->id]['competencias'] = $evaluado->calificacionesCompetenciasEvaluadoPeriodo($this->periodo_id);
                $evComp = $evaluado->evaluadoresCompetencias($this->periodo_id);

                $evaluadoresCompetencias = $evComp->reject(function ($item) use ($empleadoId) {
                    return $item['evaluador_desempeno_id'] == $empleadoId;
                });

                $evC = $evaluadoresCompetencias->map(function ($eC) {
                    return [
                        'id' => $eC->empleado->id,
                        'nombre' => $eC->empleado->name
                    ];
                });

                $evaluadores = $evaluadores->merge($evC);
            }

            // Keep only 'nombre' after ensuring uniqueness based on 'id'
            // $totales_evaluado[$this->periodo_id][$evaluado->id]['evaluadores'] = $evaluadores->unique('id')->pluck('nombre')->values()->all();

            // Ensure uniqueness and concatenate 'nombre' values with "/"
            $concatenatedEvaluadores = $evaluadores->unique('id')->pluck('nombre')->implode(' , ');

            // $totales_evaluado[$this->periodo_id][$evaluado->id]['informacion_evaluado'] = [
            //     'nombre' => $evaluado->empleado->name,
            //     'puesto' => $evaluado->empleado->puestoRelacionado->puesto,
            //     'area' => $evaluado->empleado->area->area,
            // ];

            $coleccion->push(
                [
                    'nombre' => $evaluado->empleado->name,
                    'puesto' => $evaluado->empleado->puestoRelacionado->puesto,
                    'area' => $evaluado->empleado->area->area,
                    'evaluadores' => $concatenatedEvaluadores,
                    'estatus' => $evaluado->empleado->estatus,
                    'porcentajeObjetivos' => $evaluacion->porcentaje_objetivos,
                    'porcentajeCompetencias' => $evaluacion->porcentaje_competencias,

                ]
            );
        }
        return $coleccion;
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Puesto',
            'Area',
            'Evaluadores',
            'Estatus',
            'Porcentaje Objetivos',
            'Porcentaje Competencias',
        ];
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
