<?php

namespace App\Exports;

use App\Models\Empleado;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmpleadosExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Empleado::alta()->with('supervisor', 'area')->get();
    }

    public function map($empleado): array
    {
        $supervisor = 'Sin Supervisor';
        if (! is_null($empleado->supervisor)) {
            $supervisor = $empleado->supervisor->name;
        }
        $antiguedad = '';
        if (Carbon::parse($empleado->antiguedad)->diff()->y == 0) {
            if (Carbon::parse($empleado->antiguedad)->diff()->m == 0) {
                $antiguedad = Carbon::parse($empleado->antiguedad)->diff()->d.'día(s)';
            } else {
                $antiguedad = Carbon::parse($empleado->antiguedad)->diff()->m.'mes(es)'.Carbon::parse($empleado->antiguedad)->diff()->d.'día(s)';
            }
        } else {
            $antiguedad = Carbon::parse($empleado->antiguedad)->diff()->y.' año(s)'.Carbon::parse($empleado->antiguedad)->diff()->m.'mes(es)'.Carbon::parse($empleado->antiguedad)->diff()->d.' días';
        }

        return [
            $empleado->name,
            $empleado->puesto,
            $empleado->area->area,
            $empleado->antiguedad,
            $empleado->estatus,
            $empleado->email,
            $empleado->telefono,
            $empleado->n_empleado,
            $antiguedad,
            $supervisor,
        ];
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Puesto',
            'Area',
            'Fecha Ingreso',
            'Estatus',
            'Email',
            'Teléfono',
            'No. Empleado',
            'Antiguedad',
            'Supervisado Por',
        ];
    }
}
