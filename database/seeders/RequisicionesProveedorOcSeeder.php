<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequisicionesProveedorOcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('requisiciones')->where('id', 615)->update([
            'proveedor_catalogo_oc' => 'ELVIRA MARTINEZ SANCHEZ',
        ]);
    }
}