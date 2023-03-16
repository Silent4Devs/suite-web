<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = Area::factory(10)->create();
        foreach ($areas as $idx => $area) {
            if ($idx != 0) {
                $area->update([
                    'id_reporta' => Area::all()->random()->id,
                ]);
            }
        }
    }
}
