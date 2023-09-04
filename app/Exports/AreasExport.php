<?php

namespace App\Exports;

use App\Models\Area;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AreasExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Area::with('supervisor', 'grupo')->get();
    }

    public function map($area): array
    {
        $supervisor = 'Sin Supervisor';
        if (!is_null($area->supervisor)) {
            $supervisor = $area->supervisor->area;
        }
        if (!is_null($area->grupo)) {
            $grupo = $area->grupo->nombre;
        }

        return [
            $area->area,
            $area->descripcion,
            $supervisor,
            $grupo,
        ];
    }

    public function headings(): array
    {
        return [
            'Area',
            'Descripcion',
            'Reporta a ',
            'Grupo al que pertenece',
        ];
    }
}
