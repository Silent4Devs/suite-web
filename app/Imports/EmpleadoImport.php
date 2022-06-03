<?php

namespace App\Imports;

use App\Models\Empleado;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class EmpleadoImport implements ToModel,WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        // dd($row);
        $antiguedad = $this->obtenerFecha($row['fecha_ingreso_dd_mm_aaaa']);
        $birthday = $this->obtenerFecha($row['cumpleanos_dd_mm_aaaa']);

      
        return new Empleado([
                'name'=> isset($row['nombre']) ? $row['nombre'] : null,
                'n_empleado'=> isset($row['numero_empleado']) ? $row['numero_empleado'] : null,
                'area_id'=> isset($row['area_id']) ? $row['area_id'] : null,
                'supervisor_id'=> isset($row['jefe_inmediatoid']) ? $row['jefe_inmediatoid'] : null,
                'puesto_id'=> isset($row['puesto_id']) ? $row['puesto_id'] : null,
                'perfil_empleado_id'=> isset($row['nivel_jerarquico_id']) ? $row['nivel_jerarquico_id'] : null,
                // 'antiguedad'=> isset($row['fecha_ingreso_aaa_mm_dd']) ? $row['fecha_ingreso_aaa_mm_dd'] : null,
                'antiguedad'=>$antiguedad,
                'genero'=> isset($row['genero_hm']) ? $row['genero_hm'] : null,
                'email' => isset($row['email']) ? $row['email'] : null,
                'telefono_movil'=> isset($row['telefono_movil']) ? $row['telefono_movil'] : null,
                'telefono' => isset($row['telefono_fijo']) ? $row['telefono_fijo'] : null,
                'sede_id'=> isset($row['sede_id']) ? $row['sede_id'] : null,
                'direccion'=> isset($row['direccion']) ? $row['direccion'] : null,
                // 'cumpleaños'=> isset($row['cumpleanos_aaa_mm_dd']) ? $row['cumpleanos_aaa_mm_dd'] : null,
                'cumpleaños'=>$birthday,

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
        ];
    }

    private function obtenerFecha($fecha)
    {
        return Carbon::parse($fecha)->format('Y-m-d');
    }
}
