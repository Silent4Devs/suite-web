<?php

namespace Database\Seeders;

use App\Models\SubcategoriaActivo;
use App\Models\Tipoactivo;
use Illuminate\Database\Seeder;



class SubcategoriaActivosSeeder extends Seeder
{

    public function run()
    {
        $categoria=Tipoactivo::where('tipo','=','Hardware')

        $subcategorias = [
            [
                'subcategoria' => 'Laptop',
                'categoria_id' => '1',
            ],
            [
                'subcategoria' => 'Servidor',
                'categoria_id' => '1',
            ],
            [
                'subcategoria' => 'Balanceador',
                'categoria_id' => '1',
            ],
            [
                'subcategoria' => 'NAS',
                'categoria_id' => '1',
            ],
            [
                'subcategoria' => 'Switch',
                'categoria_id' => '1',
            ],
            [
                'subcategoria' => 'UPS',
                'categoria_id' => '1',
            ],
            [
                'subcategoria' => 'Monitor',
                'categoria_id' => '1',
            ],
            [
                'subcategoria' => 'Proyector',
                'categoria_id' => '1',
            ],
            [
                'subcategoria' => 'MODEM',
                'categoria_id' => '1',
            ],
            [
                'subcategoria' => 'Lector de disco',
                'categoria_id' => '1',
            ],
            [
                'subcategoria' => 'Disco duro',
                'categoria_id' => '1',
            ],
            [
                'subcategoria' => 'Memoria RAM',
                'categoria_id' => '1',
            ],
            [
                'subcategoria' => 'Memoria USB',
                'categoria_id' => '1',
            ],

            [
                'subcategoria' => 'Memoria RAM',
                'categoria_id' => '1',
            ],
            [
                'subcategoria' => 'Licencia',
                'categoria_id' => '2',
            ],
            [
                'subcategoria' => 'EPO',
                'categoria_id' => '2',
            ],
            [
                'subcategoria' => 'Credenciales Administrador',
                'categoria_id' => '2',
            ],
            [
                'subcategoria' => 'Escritorio',
                'categoria_id' => '3',
            ],
            [
                'subcategoria' => 'Pizarron',
                'categoria_id' => '3',
            ],
            [
                'subcategoria' => 'Sillon',
                'categoria_id' => '3',
            ],
            [
                'subcategoria' => 'Mesa',
                'categoria_id' => '3',
            ],
            [
                'subcategoria' => 'Silla',
                'categoria_id' => '3',
            ],
            [
                'subcategoria' => 'Banco',
                'categoria_id' => '3',
            ],
            [
                'subcategoria' => 'Charola Rack',
                'categoria_id' => '3',
            ],
            [
                'subcategoria' => 'Rack',
                'categoria_id' => '3',
            ],
            [
                'subcategoria' => 'Mouse',
                'categoria_id' => '4',
            ],
            [
                'subcategoria' => 'HUB',
                'categoria_id' => '4',
            ],
            [
                'subcategoria' => 'Teclado',
                'categoria_id' => '4',
            ],
            [
                'subcategoria' => 'Audifonos',
                'categoria_id' => '4',
            ],
            [
                'subcategoria' => 'Bocinas',
                'categoria_id' => '4',
            ],
            [
                'subcategoria' => 'Antena WIFI',
                'categoria_id' => '4',
            ],
            [
                'subcategoria' => 'Receptor Bluetooth',
                'categoria_id' => '4',
            ],
            [
                'subcategoria' => 'PLUG',
                'categoria_id' => '4',
            ],
            [
                'subcategoria' => 'Adaptador',
                'categoria_id' => '4',
            ],
            [
                'subcategoria' => 'Tóner',
                'categoria_id' => '5',
            ],
            [
                'subcategoria' => 'Toallas',
                'categoria_id' => '5',
            ],
            [
                'subcategoria' => 'Liquido limpiador',
                'categoria_id' => '5',
            ],
            [
                'subcategoria' => 'Liquido limpiador',
                'categoria_id' => '5',
            ],
            [
                'subcategoria' => 'Pasta térmica',
                'categoria_id' => '5',
            ],
            [
                'subcategoria' => 'Velcro',
                'categoria_id' => '5',
            ],
            [
                'subcategoria' => 'Cinchos',
                'categoria_id' => '5',
            ],
            [
                'subcategoria' => 'Grapas',
                'categoria_id' => '5',
            ],
            [
                'subcategoria' => 'Tornillos',
                'categoria_id' => '5',
            ],
            [
                'subcategoria' => 'Playo',
                'categoria_id' => '5',
            ],
            [
                'subcategoria' => 'Caja de Herraminetas',
                'categoria_id' => '6',
            ],
            [
                'subcategoria' => 'Taladro',
                'categoria_id' => '6',
            ],
            [
                'subcategoria' => 'Desarmador',
                'categoria_id' => '6',
            ],
            [
                'subcategoria' => 'LLaves',
                'categoria_id' => '6',
            ],
            [
                'subcategoria' => 'Escalera',
                'categoria_id' => '6',
            ],
            [
                'subcategoria' => 'Matraca',
                'categoria_id' => '6',
            ],
            [
                'subcategoria' => 'Pinza',
                'categoria_id' => '6',
            ],
            [
                'subcategoria' => 'Extención',
                'categoria_id' => '6',
            ],
            [
                'subcategoria' => 'Control de Alarma',
                'categoria_id' => '7',
            ],
            [
                'subcategoria' => 'Control de Acceso',
                'categoria_id' => '7',
            ],
            [
                'subcategoria' => 'Control de Cámaras',
                'categoria_id' => '7',
            ],
            [
                'subcategoria' => 'Control de Ductos',
                'categoria_id' => '7',
            ],


        ];

        SubcategoriaActivo::insert($subcategorias);

    }
}
