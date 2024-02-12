<?php

namespace App\Exports;

use App\Models\Empleado;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmpleadosGeneralExport implements FromCollection, ShouldAutoSize, WithColumnFormatting, WithHeadings, WithMapping
{
    public function collection()
    {
        return Empleado::getAllwithDeleted();
    }

    public function map($empleado): array
    {
        $supervisor = 'Sin Supervisor';
        $sede = 'Sin definir';
        $puesto = 'Indefinido';

        if (! is_null($empleado->supervisor)) {
            $supervisor = $empleado->supervisor->name;
        }

        if (! is_null($empleado->sede)) {
            $sede = $empleado->sede->sede;
        }

        if (isset($empleado->puestoRelacionado->puesto)) {
            $puesto = $empleado->puestoRelacionado->puesto;
        }

        // $antiguedad = '';
        // if (Carbon::parse($empleado->antiguedad)->diff()->y == 0) {
        //     if (Carbon::parse($empleado->antiguedad)->diff()->m == 0) {
        //         $antiguedad = Carbon::parse($empleado->antiguedad)->diff()->d . 'día(s)';
        //     } else {
        //         $antiguedad = Carbon::parse($empleado->antiguedad)->diff()->m . 'mes(es)' . Carbon::parse($empleado->antiguedad)->diff()->d . 'día(s)';
        //     }
        // } else {
        //     $antiguedad = Carbon::parse($empleado->antiguedad)->diff()->y . ' año(s)' . Carbon::parse($empleado->antiguedad)->diff()->m . 'mes(es)' . Carbon::parse($empleado->antiguedad)->diff()->d . ' días';
        // }

        return [
            $empleado->n_empleado,
            $empleado->name,
            $empleado->email,
            $empleado->telefono,
            $empleado->area->area,
            $puesto,
            // $antiguedad,
            $empleado->antiguedad,
            $supervisor,
            $empleado->estatus,
            $sede,
            $empleado->cumpleaños,
        ];
    }

    public function headings(): array
    {
        return [
            'No. Empleado',
            'Nombre',
            'Email',
            'Teléfono',
            'Area',
            'Puesto',
            'Antiguedad',
            // 'Fecha Ingreso',
            'Supervisor',
            'Estatus',
            'Sede',
            'Fecha de Nacimiento',
        ];
    }

    public function columnFormats(): array
    {
        return [
            // ... add more columns as needed
            'A' => '0.00', // Set the format of column A
            'B' => '0.00',
            'C' => '0.00',
            'D' => '0.00',
            'E' => '0.00',
            'F' => '0.00',
            'G' => '0.00',
            // 'Fecha Ingreso',
            'H' => '0.00',
            'I' => '0.00',
            'J' => '0.00',
            'K' => '0.00',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => '20', // Set the format of column A
            'B' => '20',
            'C' => '20',
            'D' => '20',
            'E' => '20',
            'F' => '20',
            'G' => '20',
            // 'Fecha Ingreso',
            'H' => '20',
            'I' => '20',
            'J' => '20',
            'K' => '20',
        ];
    }
    // public function headingsStyle(): array
    // {
    //     return [
    //         'font' => [
    //             'color' => ['rgb' => 'FFFFFF'], // Color del texto (blanco)
    //         ],
    //         'fill' => [
    //             'fillType' => 'solid',
    //             'startColor' => ['rgb' => '00FF00'], // Color de fondo (verde)
    //         ],
    //     ];
    // }
}
