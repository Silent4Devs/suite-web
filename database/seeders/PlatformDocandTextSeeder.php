<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Escuela\Platform;

class PlatformDocandTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $new_plataforms = [
            [
                'name' => 'Texto',
            ],
            [
                'name' => 'Documento',
            ]
        ];

        Platform::insert($new_plataforms);
    }
}
