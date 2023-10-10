<?php

namespace Database\Seeders;

use App\Models\Macroproceso;
use Illuminate\Database\Seeder;

class MacroprocesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Macroproceso::factory(10)->create();
    }
}
