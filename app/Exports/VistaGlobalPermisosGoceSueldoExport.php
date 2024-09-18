<?php

namespace App\Exports;

use App\Models\SolicitudPermisoGoceSueldo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VistaGlobalPermisosGoceSueldoExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct() {}

    public function collection()
    {
        // Usamos las relaciones definidas en el modelo SolicitudPermisoGoceSueldo
        return SolicitudPermisoGoceSueldo::with('empleado:id,name', 'permiso')
            ->get(); // Esto trae todos los registros con las relaciones cargadas
    }

    public function map($solicitudDayOff): array
    {
        return [
            $solicitudDayOff->empleado->name,  // Usamos la relación "empleado" para obtener el nombre
            $solicitudDayOff->permiso->nombre, // Usamos la relación "permiso" para obtener la descripción
            $this->mapTipoPermisoStatus($solicitudDayOff->permiso->tipo_permiso),
            $solicitudDayOff->dias_solicitados,
            $solicitudDayOff->fecha_inicio,
            $solicitudDayOff->fecha_fin,
            $this->mapAprobacionStatus($solicitudDayOff->aprobacion),
        ];
    }

    public function headings(): array
    {
        return [
            'Solicitante',
            'Permiso',
            'Tipo de Permiso',
            'Días Solicitados',
            'Fecha de Inicio',
            'Fecha de Fin',
            'Estatus de Aprobación',
        ];
    }

    private function mapAprobacionStatus($value)
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

    private function mapTipoPermisoStatus($value)
    {
        switch ($value) {
            case 1:
                return 'Permiso conforme a la ley';
            case 2:
                return 'Permiso otorgado por la empresa';
            default:
                return 'No definido';
        }
    }
}
