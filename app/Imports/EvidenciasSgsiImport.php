<?php

namespace App\Imports;

use App\Models\EvidenciasSgsi;
use Maatwebsite\Excel\Concerns\ToModel;

class EvidenciasSgsiImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new EvidenciasSgsi([
            //
        ]);
    }
}
