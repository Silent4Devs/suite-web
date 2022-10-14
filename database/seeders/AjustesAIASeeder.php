<?php

namespace Database\Seeders;

use App\Models\AjustesAIA;
use Illuminate\Database\Seeder;

class AjustesAIASeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inputs = [
            [
                'id' => 1,
                'impacto_operativo' => 1,
                'impacto_regulatorio' => 1,
                'impacto_reputacion' => 1,
                'impacto_social' => 1,
            ],

        ];

        AjustesAIA::insert($inputs);
    }
}
