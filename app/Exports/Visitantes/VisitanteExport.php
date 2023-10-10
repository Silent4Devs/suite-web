<?php

namespace App\Exports\Visitantes;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VisitanteExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles
{
    public $visitantes;

    public function __construct($visitantes)
    {
        $this->visitantes = $visitantes;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->visitantes;
    }

    public function map($visitante): array
    {
        $dispositivos = '';
        $visitaA = '';
        foreach ($visitante->dispositivos as $dispositivo) {
            $dispositivos .= "Dispositivo: {$dispositivo->dispositivo} Serie: {$dispositivo->serie} | ";
        }
        if ($visitante->tipo_visita == 'area') {
            $visitaA = $visitante->area->area;
        } else {
            $visitaA = $visitante->empleado->name;
        }

        return [
            $visitante->nombre,
            $visitante->apellidos,
            $dispositivos,
            $visitante->motivo,
            $visitaA,
            $this->obtenerFechaIngresoPorFormato($visitante, 'd-m-Y'),
            $this->obtenerFechaIngresoPorFormato($visitante, 'h:i A'),
            $this->obtenerFechaSalidaPorFormato($visitante, 'd-m-Y'),
            $this->obtenerFechaSalidaPorFormato($visitante, 'h:i A'),
        ];
    }

    public function headings(): array
    {
        return [
            'Nombre(s)',
            'Apellido(s)',
            'Dispositivos',
            'Motivo',
            'Visita a',
            'Fecha Entrada',
            'Hora Entrada',
            'Fecha Salida',
            'Hora Salida',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 35,
            'B' => 35,
            'C' => 45,
            'D' => 45,
            'E' => 45,
            'F' => 20,
            'G' => 20,
            'H' => 20,
            'I' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true, 'color' => ['argb' => Color::COLOR_WHITE]], 'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => Color::COLOR_BLUE]]],
        ];
    }

    // public function drawings()
    // {
    //     $drawing = new Drawing();
    //     $drawing->setName('Logo');
    //     $drawing->setDescription('This is my logo');
    //     $drawing->setPath(public_path('img/logo_monocromatico.png'));
    //     $drawing->setHeight(90);
    //     $drawing->setCoordinates('A1');

    //     return $drawing;
    // }

    private function obtenerFechaIngresoPorFormato($visitante, $formato)
    {
        return $visitante->created_at->format($formato);
    }

    private function obtenerFechaSalidaPorFormato($visitante, $formato)
    {
        return $visitante->fecha_salida ? Carbon::parse($visitante->fecha_salida)->format($formato) : 'N/A';
    }
}
