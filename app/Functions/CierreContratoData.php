<?php

namespace App\Functions;

class CierreContratoData
{
    public function TraerDatos($contrato_id)
    {
        return [
            [
                'no' => 1,
                'contrato_id' => $contrato_id,
                'aspectos' => 'Liberación de fianza.',
                'created_by' => auth()->id(),
            ],
            [
                'no' => 2,
                'contrato_id' => $contrato_id,
                'aspectos' => 'Póliza de responsabilidad civil',
                'created_by' => auth()->id(),
            ],
            [
                'no' => 3,
                'contrato_id' => $contrato_id,
                'aspectos' => 'Pena convencional',
                'created_by' => auth()->id(),
            ],
            [
                'no' => 4,
                'contrato_id' => $contrato_id,
                'aspectos' => 'Defectos y Vicios ocultos',
                'created_by' => auth()->id(),
            ],
            [
                'no' => 5,
                'contrato_id' => $contrato_id,
                'aspectos' => 'Confidencialidad',
                'created_by' => auth()->id(),
            ],
            [
                'no' => 6,
                'contrato_id' => $contrato_id,
                'aspectos' => 'Cumplimiento del objeto del proyecto',
                'created_by' => auth()->id(),
            ],
            [
                'no' => 7,
                'contrato_id' => $contrato_id,
                'aspectos' => 'Aceptación del cliente sobre el entregable',
                'created_by' => auth()->id(),
            ],
            [
                'no' => 8,
                'contrato_id' => $contrato_id,
                'aspectos' => 'Formalización del cierre del contrato',
                'created_by' => auth()->id(),
            ],
            [
                'no' => 9,
                'contrato_id' => $contrato_id,
                'aspectos' => 'Pago de los servicios dentro de las fechas establecidas',
                'created_by' => auth()->id(),
            ],
        ];
    }
}
