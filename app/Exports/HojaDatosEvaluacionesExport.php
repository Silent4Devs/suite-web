<?php

namespace App\Exports;

use App\Models\EvaluacionDesempeno;
use App\Models\SolicitudDayOff;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class HojaDatosEvaluacionesExport implements FromCollection, WithHeadings, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $id;

    public function __construct($id_evaluacion)
    {
        $this->id = $id_evaluacion;
    }

    public function collection()
    {
        $evaluacion = EvaluacionDesempeno::find($this->id);

        $evlds = $evaluacion->evaluados;

        foreach ($evlds as $key => $evld) {
            $evaluados[] =
                [
                    'Colaborador' => $evld->empleado->name,
                    'Puesto' => $evld->empleado->puestoRelacionado->puesto,
                    'Area' => $evld->empleado->area->area,
                ];
        }

        $coleccion_evaluados = collect($evaluados);
        // $query = SolicitudDayOff::leftJoin('empleados as empleados', 'empleados.id', '=', 'solicitud_dayoff.empleado_id')
        //     ->select(
        //         'empleados.name as Solicitante',
        //         'descripcion as Descripcion',
        //         'año as Periodo',
        //         'dias_solicitados as Dias solicitados',
        //         'fecha_inicio as Fecha Inicio',
        //         'fecha_fin as Fecha Fin',
        //         'aprobacion'
        //     )
        //     ->get();

        // //Cambiar valor numerico por Texto correspondiente
        // function mapAprobacionStatusDayOff($value)
        // {
        //     switch ($value) {
        //         case 1:
        //             return 'Pendiente';
        //         case 2:
        //             return 'Rechazado';
        //         case 3:
        //             return 'Aprobado';
        //         default:
        //             return 'Sin seguimiento';
        //     }
        // }

        // // Cambiar valores de todos los registros
        // foreach ($query as $solicitudDayOff) {
        //     $solicitudDayOff->aprobacion = mapAprobacionStatusDayOff($solicitudDayOff->aprobacion);
        // }

        return $coleccion_evaluados;
    }

    public function headings(): array
    {
        return [
            'Colaborador',
            'Puesto',
            'Area',
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
        return 'Datos';
    }
}
