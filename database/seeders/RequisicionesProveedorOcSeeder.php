<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
