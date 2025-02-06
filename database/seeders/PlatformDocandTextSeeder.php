<?php

namespace Database\Seeders;

use App\Models\Escuela\Platform;
use Illuminate\Database\Seeder;

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
            ],
        ];

        Platform::insert($new_plataforms);
    }
}
