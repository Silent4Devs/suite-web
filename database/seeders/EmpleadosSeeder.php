<?php

namespace Database\Seeders;

use App\Models\Empleado;
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
        $empleados = Empleado::factory(7)->create();
        foreach ($empleados as $idx => $empleado) {
            if ($idx != 0) {
                $empleado->update([
                    'supervisor_id' => Empleado::all()->random()->id,
                ]);
            }
        }
    }
}
