<?php

namespace App\Exports;

use App\Models\EvaluacionDesempeno;
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

    public $headers_competencias;

    public function __construct($id_evaluacion, $id_periodo)
    {
        $this->id = $id_evaluacion;
        $this->periodo_id = $id_periodo;
    }

    public function collection()
    {

        $headers_competencias = ['test1'];

        $evaluacion = EvaluacionDesempeno::find($this->id);
        $coleccion = collect();
        foreach ($evaluacion->periodos as $key_periodo => $periodo) {
            $coleccion = collect();
            foreach ($evaluacion->evaluados as $key => $evaluado) {
                $empleadoId = $evaluado->empleado->id;
                $evaluadores = collect();

                if ($evaluacion->activar_objetivos) {
                    $totales_evaluado[$periodo->id][$evaluado->id]['objetivos'] = $evaluado->calificacionesObjetivosEvaluadoPeriodo($periodo->id);
                    $evObj = $evaluado->evaluadoresObjetivos($periodo->id);

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
                    $totales_evaluado[$periodo->id][$evaluado->id]['competencias'] = $evaluado->calificacionesCompetenciasEvaluadoPeriodo($periodo->id);
                    $evComp = $evaluado->evaluadoresCompetencias($periodo->id);

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
                // $totales_evaluado[$periodo->id][$evaluado->id]['evaluadores'] = $evaluadores->unique('id')->pluck('nombre')->values()->all();

                // Ensure uniqueness and concatenate 'nombre' values with "/"
                $concatenatedEvaluadores = $evaluadores->unique('id')->pluck('nombre')->implode(' , ');

                $total_competencias = ($totales_evaluado[$periodo->id][$evaluado->id]['competencias']['promedio_total'] * $evaluacion->porcentaje_competencias) / 100;
                $total_objetivos = ($totales_evaluado[$periodo->id][$evaluado->id]['objetivos']['promedio_total'] * $evaluacion->porcentaje_objetivos) / 100;

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
                    ];

                $filtro_competencias = $totales_evaluado[$periodo->id][$evaluado->id]['competencias']['calif_total'];
                $filtro_objetivos = $totales_evaluado[$periodo->id][$evaluado->id]['objetivos']['calif_total'];

                foreach ($filtro_competencias as $key_c => $comp) {
                    $data[$comp["competencia"]] = $comp["calificacion_total"];
                }


                foreach ($filtro_objetivos as $key_o => $obj) {
                    $data['nombre_objetivo' . ($key_o + 1)] = $obj["nombre"];
                    $data['calif_objetivo' . ($key_o + 1)] = $obj["calificacion_total"];
                }

                $coleccion->push($data);
            }
        }

        return $coleccion;
    }

    public function headings(): array
    {
        $headersBasicos = [
            'Nombre',
            'Puesto',
            'Area',
            'Evaluadores',
            'Estatus',
            'Porcentaje Objetivos',
            'Porcentaje Competencias',
            'Objetivos',
            'Competencias',
        ];

        // $merge = array_merge($headersBasicos, $this->headers_competencias);
        return $headersBasicos;
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
