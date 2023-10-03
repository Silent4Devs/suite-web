<?php

namespace Database\Seeders;

use App\Models\ContractManager\Comprador as ContractManagerComprador;
use Illuminate\Database\Seeder;

class CompradoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comprador = [

            [
                'clave' => 1,
                'id_user' => 133,
                'estado' => 'AC',
            ],
            [
                'clave' => 2,
                'id_user' => 254,
                'estado' => 'AC',
            ],
        ];
        ContractManagerComprador::insert($comprador);
    }
}
