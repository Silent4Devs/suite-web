<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompradoresTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('compradores')->delete();

        \DB::table('compradores')->insert([
            0 => [
                'id' => 1,
                'nombre' => null,
                'clave' => '1',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'id_user' => 133,
            ],
            1 => [
                'id' => 2,
                'nombre' => null,
                'clave' => '2',
                'estado' => 'AC',
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'archivo' => 0,
                'id_user' => 254,
            ],
        ]);
    }
}
