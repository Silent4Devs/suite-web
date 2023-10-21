<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MonedaSeedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('monedas')->delete();

        \DB::table('monedas')->insert([
            0 => [

                'nombre' => 'MXN',
            ],
            1 => [

                'nombre' => 'USD',
            ],
        ]);
    }
}
