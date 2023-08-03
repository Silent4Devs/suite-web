<?php

namespace App\Imports;

use App\Models\FaqCategory;
use Maatwebsite\Excel\Concerns\ToModel;

class FaqCategoriaImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new FaqCategory([
            'category' => $row[0],
        ]);
    }
}
