<?php

namespace App\Exports\PanelDeclaracion2022;

use App\Models\Iso27\DeclaracionAplicabilidadConcentradoIso;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PanelDeclaracion2022Export implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DeclaracionAplicabilidadConcentradoIso::with([
            'gapdos.clasificacion',
            'responsables2022.responsable_declaracion:id,name,foto',
            'responsables2022.empleado:id,name',
            'aprobadores2022.aprobador_declaracion:id,name,foto',
            'aprobadores2022.empleado:id,name',
        ])->orderBy('id')->get();
    }

    public function map($as): array
    {

        return [
            $as->gapdos?->control_iso,
            $as->gapdos?->anexo_politica,
            $as->gapdos?->clasificacion?->nombre,
            $as->responsables2022?->empleado?->name ?? 'Sin Asignar',
            $as->aprobadores2022?->empleado?->name ?? 'Sin Asignar',
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Control',
            'Clasificación',
            'Responsable',
            'Aprobador'
        ];
    }
}
