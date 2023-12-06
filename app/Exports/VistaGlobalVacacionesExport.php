<?php

namespace App\Exports;

use App\Models\SolicitudVacaciones;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;


class VistaGlobalVacacionesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct()
    {
    }


    public function collection()
    {

        $query = SolicitudVacaciones::leftJoin('empleados as empleados', 'empleados.id', '=', 'solicitud_vacaciones.empleado_id')
            ->select(
                'empleados.name as Solicitante',
                'descripcion as Descripcion',
                'año as Periodo',
                'dias_solicitados as Dias solicitados',
                'fecha_inicio as Fecha Inicio',
                'fecha_fin as Fecha Fin',
                'aprobacion'
            )
            ->get();

        //Cambiar valor numerico por Texto correspondiente
        function mapAprobacionStatus($value)
        {
            switch ($value) {
                case 1:
                    return 'Pendiente';
                case 2:
                    return 'Rechazado';
                case 3:
                    return 'Aprobado';
                default:
                    return 'Sin seguimiento';
            }
        }

        // Cambiar valores de todos los registros
        foreach ($query as $solicitudDayOff) {
            $solicitudDayOff->aprobacion = mapAprobacionStatus($solicitudDayOff->aprobacion);
        }

        return $query;
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
}
