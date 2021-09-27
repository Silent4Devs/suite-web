<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsuarioImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Vulnerabilidad([
            'name' => $row[0],
            'n_empleado' => $row[1],
            'email', => $row[2],
            'password', => $row[3],
        ]);
    }
}
