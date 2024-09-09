<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class HistorialEmpleadoExport implements FromCollection, ShouldAutoSize, WithHeadings, WithStyles
{
    protected $registrosHistorico;

    public function __construct(array $registrosHistorico)
    {
        $this->registrosHistorico = $registrosHistorico;
    }

    public function collection()
    {
        // Process data for each row of the Excel file
        $data = [];

        foreach ($this->registrosHistorico as $registro) {
            $campoModificado = $registro['campo_modificado'] ?? '';
            $fechaCambio = $registro['fecha_cambio'] ?? '';
            $descripcion = $this->formatDescripcion($registro['relacion'] ?? []);
            $responsable = $this->getResponsable($registro['user_id'] ?? '');

            $data[] = [
                $campoModificado,
                $fechaCambio,
                $descripcion,
                $responsable,
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        // Define column headers for the Excel file
        return [
            'Campo Modificado',
            'Fecha',
            'Descripción del Registro',
            'Responsable',
        ];
    }

    // Method to format the description of the record
    private function formatDescripcion($relaciones)
    {
        // Implement logic to format the description as needed
        $descripcion = '';

        foreach ($relaciones as $relacion) {
            if (isset($relacion['area'])) {
                $descripcion .= 'Área: '.$relacion['area']."\n";
            } elseif (isset($relacion['puesto'])) {
                $descripcion .= 'Puesto: '.$relacion['puesto']."\n";
            }
            // Add more logic as required
        }

        return $descripcion;
    }

    // Method to get the responsible person for the change
    private function getResponsable($userId)
    {
        // Implement logic to get the name of the responsible person based on $userId
        $responsable = '';

        if (! empty($userId)) {
            $user = User::find($userId);
            $responsable = $user ? $user->name : 'Desconocido';
        }

        return $responsable;
    }

    // Apply styles to the Excel file
    public function styles(Worksheet $sheet)
    {
        return [
            // Style header row
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'DDDDDD']]],

            // Example: Adjust column width for each column (optional)
            'B' => ['width' => 20],
            'C' => ['width' => 30],
            'D' => ['width' => 20],
        ];
    }
}
