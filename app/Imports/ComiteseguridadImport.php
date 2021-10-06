<?php

namespace App\Imports;

use App\Models\Comiteseguridad;
use Maatwebsite\Excel\Concerns\ToModel;

class ComiteseguridadImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Comiteseguridad([
            //
        ]);
    }
}
