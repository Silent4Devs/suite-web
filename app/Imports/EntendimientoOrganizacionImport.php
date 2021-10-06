<?php

namespace App\Imports;

use App\Models\EntendimientoOrganizacion;
use Maatwebsite\Excel\Concerns\ToModel;

class EntendimientoOrganizacionImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new EntendimientoOrganizacion([
            //
        ]);
    }
}
