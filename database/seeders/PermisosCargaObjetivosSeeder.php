<?php

namespace Database\Seeders;

use App\Models\PermisosCargaObjetivos;
use Illuminate\Database\Seeder;

class PermisosCargaObjetivosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $perfiles = [
            [
                'perfil' => 'Administrador',
                'permisos_asignacion' => true,
            ],
            [
                'perfil' => 'Jefe Inmediato',
                'permisos_asignacion' => false,
            ],
            [
                'perfil' => 'Colaborador',
                'permisos_asignacion' => false,
            ],
        ];

        PermisosCargaObjetivos::insert($perfiles);
    }
}
