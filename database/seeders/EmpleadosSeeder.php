<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\Puesto;
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
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'foto' => null,
            'puesto_id' => Puesto::first()->id,
            'antiguedad' => Carbon::now(),
            'estatus' => 'alta',
            'area_id' => Area::first()->id,
            'created_at' => Carbon::now(),
            'extension' => null,
            'telefono_movil' => null,
            'direccion' => 'Direccion General',
            'n_empleado' => 1,
        ]);
    }
}
