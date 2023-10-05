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

        \DB::table('monedas')->insert([
            0 => [
                'nombre' => 'USD',
                'created_at' => null,
                'updated_at' => null,
            ],
            1 => [
                'nombre' => 'MXN',
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
