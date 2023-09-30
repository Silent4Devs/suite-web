<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inputs = [
            [
                'area' => "Admin",
                'descripcion' => "Admin",
            ],

        ];

        Area::insert($inputs);
    }
}
