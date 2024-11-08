<?php

namespace Database\Seeders;

use App\Models\Organizacion;
use App\Models\Sede;
use Illuminate\Database\Seeder;

class SedeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sede::create([
            'sede' => 'Direccion General',
            'descripcion' => 'Direccion General',
            'organizacion_id' => Organizacion::first()->id,
            'direccion' => 'Direccion General'
        ]);
    }
}
// INSERT INTO public.sedes
// (
//     id, 
//     sede,
//     descripcion, 
//     created_at, 
//     updated_at, 
//     deleted_at, 
//     organizacion_id, 
//     team_id, 
//     direccion,
//     foto_sedes, 
//     latitude, 
//     longitud)
// VALUES(nextval('sedes_id_seq'::regclass), '', '', '', '', '', 0, 0, '', '', 0, 0);