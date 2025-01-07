<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\Puesto;
use App\Models\Sede;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EmpleadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empleado::create([
            'name' => 'Direccion General',
            'foto' => null,
            'puesto_id' => Puesto::first()->id,
            'antiguedad' => Carbon::now(),
            'estatus' => 'alta',
            'area_id' => Area::first()->id,
            'created_at' => Carbon::now(),
            'extension' => null,
            'telefono_movil' => null,
            'n_empleado' => 1,
            'direccion' => 'Not provided',
            'sede_id' => Sede::first()->id,
            'telefono' => null,
            'n_registro' => null,
            'genero' => null,
            'email' => 'example@example.com',
            'resumen' => '',
        ]);
    }
}
// name,
// area_id,
// puesto_id,
// supervisor_id ,
// perfil_empleado_id,
// genero,
// email ,
// sede_id,
// antiguedad
