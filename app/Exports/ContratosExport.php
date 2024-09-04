<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ContratosExport implements FromArray, ShouldAutoSize, WithHeadings, WithStyles
{
    use Exportable;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function array(): array
    {
        //Reporte de contratos
        $reporte = "
        SELECT distinct(f.no_factura) as numero_factura, f.monto_factura as importe_factura,
        (select sum(monto_factura) from facturacion where contrato_id = c.id group by contrato_id) as acumulado,
        (select sum(monto_factura) from facturacion where contrato_id = c.id group by contrato_id) - c.monto_pago as adeudo,
        c.monto_pago as total_contrato,
        if(e.nota_credito, 'Sin nota') as nota_credito,
        if(e.deductiva_penalizacion, 0) as penalizacion,
        f.monto_factura -  if(e.deductiva_penalizacion, 0) as monto_pagado
        FROM facturacion f inner join entregas_mensuales e
        on f.contrato_id = e.contrato_id
        inner join contratos c on f.contrato_id = c.id
        and c.id = $this->id
        order by f.no_factura asc;";
        $result1 = DB::SELECT($reporte);

        return $result1;
    }

    public function headings(): array
    {
        return [
            'Número de factura',
            'Importe de factura',
            'Acumulado',
            'Adeudo',
            'Total Contrato',
            'Nota de crédito',
            'Penalización',
            'Monto pagado',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
        ];
    }
}
