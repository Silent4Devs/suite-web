<?php

namespace Database\Seeders;

use App\Models\PanelInicioRule;
use Illuminate\Database\Seeder;

class PanelInicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $panel = [
            [
                'nombre' => 'true',
                'area' => 'true',
                'nombre' => 'true',
                'nombre' => 'true',
                'nombre' => 'true',
                'nombre' => 'true',
                'nombre' => 'true',
                'nombre' => 'true',
                'nombre' => 'true',
            ],
        ];

        PanelInicioRule::insert($panel);
    }
}
