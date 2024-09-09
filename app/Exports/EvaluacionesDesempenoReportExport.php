<?php

namespace App\Exports;

use App\Models\EvaluacionDesempeno;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class EvaluacionesDesempenoReportExport implements FromCollection, WithMultipleSheets
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $id;

    public $evaluacion;

    public function __construct($id_evaluacion)
    {
        $this->id = $id_evaluacion;

        $this->evaluacion = EvaluacionDesempeno::find($id_evaluacion);
    }

    public function collection() {}

    public function sheets(): array
    {

        $datos = new HojaDatosEvaluacionesExport($this->id);

        // foreach ($this->evaluacion->periodos as $key_periodo => $periodo) {
        //     $evldsPer = [
        //         'evldsPer' . $key_periodo => new HojaEvaluadosPeriodoExport($this->id, $periodo->id),
        //     ];
        // }

        // foreach ($this->evaluacion->periodos as $key_periodo => $periodo) {
        $evldsPer = new HojaEvaluadosPeriodoExport($this->id, 9);
        // }

        return [
            'Datos' => $datos,
            'Evaluacion' => $evldsPer,
        ];
    }
}
