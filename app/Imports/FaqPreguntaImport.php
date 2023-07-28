<?php

namespace App\Imports;

use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use Maatwebsite\Excel\Concerns\ToModel;

class FaqPreguntaImport implements ToModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new FaqQuestion([
            'category_id' => $this->obtenerEmpleadoPorNombre($row[0]),
            'question' => $row[1],
            'answer' => $row[2],
        ]);
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|string|min:2|max:255',
            'question' => 'required|string|min:2|max:255',
            'answer' => 'required|string|min:1|max:255',
        ];
    }

    public function obtenerEmpleadoPorNombre($nombre)
    {
        $empleado_bd = FaqCategory::select('id', 'category')->where('category', $nombre)->first();

        return $empleado_bd->id;
    }
}
