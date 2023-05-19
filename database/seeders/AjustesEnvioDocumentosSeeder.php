<?php

namespace Database\Seeders;

use App\Models\EnvioDocumentosAjustes;
use Illuminate\Database\Seeder;

class AjustesEnvioDocumentosSeeder extends Seeder
{
    public function run()
    {
        $inputs = [
            [
                'id' => 1,
            ],

        ];

        EnvioDocumentosAjustes::insert($inputs);
    }
}
