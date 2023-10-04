<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MonedasTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {


        \DB::table('monedas')->delete();

        \DB::table('monedas')->insert(array(
            0 =>
            array(
                'nombre' => 'USD',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array(
                'nombre' => 'MXN',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
    }
}
