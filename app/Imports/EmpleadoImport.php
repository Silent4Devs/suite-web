<?php

namespace App\Imports;

use App\Models\Empleado;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class EmpleadoImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $antiguedad = $this->obtenerFecha($row[6]);
        $birthday = $this->obtenerFecha($row[15]);

        return new Empleado([
                'name'=> isset($row[0]) ? $row[0] : null,
                'n_empleado'=> isset($row[1]) ? $row[1] : null,
                'area_id'=> isset($row[2]) ? $row[2] : null,
                'supervisor_id'=> isset($row[3]) ? $row[3] : null,
                'puesto_id'=> isset($row[4]) ? $row[4] : null,
                'perfil_empleado_id'=> isset($row[5]) ? $row[5] : null,
                'antiguedad'=> $antiguedad,
                'genero'=> isset($row[7]) ? $row[7] : null,
                'estatus'=> isset($row[8]) ? $row[8] : null,
                'email' => isset($row[9]) ? $row[9] : null,
                'telefono_movil'=> isset($row[10]) ? $row[10] : null,
                'telefono' => isset($row[11]) ? $row[11] : null,
                'extension'=> isset($row[12]) ? $row[12] : null,
                'sede_id'=> isset($row[13]) ? $row[13] : null,
                'direccion'=> isset($row[14]) ? $row[14] : null,
                'cumpleaños'=> $birthday,
                'resumen'=> isset($row[16]) ? $row[16] : null,

        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:255',
            'n_empleado' => 'required|string|min:2|max:255',
            'antiguedad'=> 'required|date',
            'genero'=>'required|string',
            'estatus'=>'required|string',
            'email'=>'required|email',
            'telefono'=>'string',
            'extension'=>'string',
            'telefono_movil'=>'string',
            'direccion'=>'string',
            'cumpleaños'=>'date',
            'resumen'=>'string',
        ];
    }

    private function obtenerFecha($fecha)
    {
        return Carbon::parse($fecha)->format('Y-m-d');
    }
}
