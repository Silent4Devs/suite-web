<?php

namespace Database\Seeders;

use App\Models\VersionesIso;
use Illuminate\Database\Seeder;

class VersionIsoHistoricoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $version = [
            [
                'version_historico' => 'false',
            ],
        ];

        VersionesIso::insert($version);
    }
}
