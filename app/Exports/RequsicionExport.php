<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


use function Laravel\Prompts\select;

class RequsicionExport implements  FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       return DB::table('requisiciones')
        ->select(
             DB::raw("CONCAT('OC-00-00-', requisiciones.id) as Folio"),
            'requisiciones.fecha as Fecha De Solicitud',
            'requisiciones.referencia as Referencia',
            'requisiciones.area as ÁreaQueSolicita',
            'users.name as Solicitante',
            'contratos.nombre_servicio as Proyecto',
            'proveedor_o_c_s.nombre as Proveedor',
            'requisiciones.moneda as Tipo de Moneda',
            'requisiciones.sub_total as SUBTOTAL',
            'requisiciones.iva as IVA',
            'requisiciones.total as Total'
        )
        ->join('contratos', 'requisiciones.contrato_id', '=', 'contratos.id')
        ->join('proveedores_requisiciones_catalogos', 'requisiciones.id', '=', 'proveedores_requisiciones_catalogos.requisicion_id')
        ->join('proveedor_o_c_s', 'proveedores_requisiciones_catalogos.proveedor_id', '=', 'proveedor_o_c_s.id') // Unión con la tabla de proveedores
        ->join('users', 'requisiciones.id_user', '=', 'users.id') // Agrega el join con la tabla usuarios
        ->whereNotNull('requisiciones.firma_solicitante')
        ->whereNotNull('requisiciones.firma_jefe')
        ->whereNotNull('requisiciones.firma_finanzas')
        ->whereNotNull('requisiciones.firma_compras')
        ->where('requisiciones.archivo', false)
        ->groupBy(
            'requisiciones.id',
            'requisiciones.fecha',
            'requisiciones.referencia',
            'requisiciones.area',
            'users.name',
            'contratos.nombre_servicio',
            'proveedor_o_c_s.nombre',
            'requisiciones.moneda',
        )
        ->orderByDesc('requisiciones.id')
        ->get();

    }

    public function headings(): array
    {
        return ['Folio', 'Fecha De Solicitud', 'Referencia', 'Área que Solicita', 'Solicitante','Proyecto','Proveedor','Tipo de Moneda', 'SUBTOTAL','IVA', 'Total'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [ // Aplica estilos al encabezado
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => '4CAF50']],
                'alignment' => ['horizontal' => 'center'],
            ],
            // Ajusta el ancho de las columnas
            'A' => ['width' => 20],
            'B' => ['width' => 25],
            'C' => ['width' => 20],
            'D' => ['width' => 25],
            'E' => ['width' => 20],
            'F' => ['width' => 20],
            'G' => ['width' => 20],
            'H' => ['width' => 20],
            'I' => ['width' => 20],
            'J' => ['width' => 20],
            'K' => ['width' => 20],
        ];
    }
}
