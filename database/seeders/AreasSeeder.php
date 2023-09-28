<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inputs = [
            [
                'area' => 'Admin',
                'id_grupo' => 1,
                'id_reporta' => 1,
                'descripcion' => 'Admin',
                'foto_area' => '',
                'team_id' => 1,
                'empleados_id' => 357,
            ],

        ];

        Area::insert($inputs);
    }
}
