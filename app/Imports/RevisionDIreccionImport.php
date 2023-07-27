<?php

namespace App\Imports;

use App\Models\RevisionDireccion;
use Maatwebsite\Excel\Concerns\ToModel;

class RevisionDIreccionImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new RevisionDireccion([
            'estadorevisionesprevias' => $row[0],
            'cambiosinternosexternos' => $row[1],
            'retroalimentaciondesempeno' => $row[2],
            'retroalimentacionpartesinteresadas' => $row[3],
            'resultadosriesgos' => $row[4],
            'oportunidadesmejoracontinua' => $row[5],
            'acuerdoscambios' => $row[6],

        ]);
    }
}
