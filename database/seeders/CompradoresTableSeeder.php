<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompradoresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('compradores')->delete();

        \DB::table('compradores')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nombre' => NULL,
                'clave' => '1',
                'estado' => 'AC',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'id_user' => 133,
            ),
            1 =>
            array (
                'id' => 2,
                'nombre' => NULL,
                'clave' => '2',
                'estado' => 'AC',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
                'archivo' => 0,
                'id_user' => 254,
            ),
        ));


    }
}
