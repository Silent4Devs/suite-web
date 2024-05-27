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
        dd($evaluacion);
        if ($evaluacion->activar_objetivos) {
        }

        if ($evaluacion->activar_competencias) {
        }

        foreach ($evaluacion->evaluados as $key => $evaluado) {
            dd($evaluado);
            // $totales_evaluado[$key][$evaluado->id] =
            //     [
            //         'competencias' => $evaluado->calificacionesCompetenciasEvaluadoPeriodo($this->periodo_id)['promedio_total'] * ($this->evaluacion->porcentaje_competencias / 100),
            //         'objetivos' => $evaluado->calificacionesObjetivosEvaluadoPeriodo($this->periodo_id)['promedio_total'] * ($this->evaluacion->porcentaje_objetivos / 100),
            //         'final' => $evaluado->calificacionesCompetenciasEvaluadoPeriodo($this->periodo_id)['promedio_total'] * ($this->evaluacion->porcentaje_competencias / 100) + $evaluado->calificacionesObjetivosEvaluadoPeriodo($periodo["id_periodo"])['promedio_total'] * ($this->evaluacion->porcentaje_objetivos / 100),
            //     ];

            // $promedio_evaluados_area[$key][$evaluado->empleado->area_id]["promedioEvdsObjs"][] = $this->totales_evaluado[$key][$evaluado->id]["objetivos"];
        }
    }

    public function headings(): array
    {
        return [
            'Solicitante',
            'Descripcion',
            'Periodo',
            'Dias solicitados',
            'Fecha Inicio',
            'Fecha Fin',
            'Aprobacion',
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
        return 'Vacaciones';
    }
}
