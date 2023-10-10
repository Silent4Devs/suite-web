<?php

namespace App\Imports;

use App\Models\Puesto;
use Maatwebsite\Excel\Concerns\ToModel;

class PuestoImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Puesto([
            'puesto' => $row[0],
            'descripcion' => isset($row[1]) ? $row[1] : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'puesto' => 'required|string|min:2|max:255',
            'descripcion' => 'required|string',
        ];
    }
}
