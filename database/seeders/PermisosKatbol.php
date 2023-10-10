<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermisosKatbol extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = [
            //Acceso a Katbol
            [
                'title' => 'sistema_gestion_contratos_acceder',
                'name' => 'Permite Acceder al Sistema de Gestion de Contratos',
            ],
            [
                'title' => 'administracion_sistema_gestion_contratos_acceder',
                'name' => 'Permite Acceder a la Administracion del Sistema de Gestion de Contratos',
            ],
            //Contratos
            [
                'title' => 'katbol_contratos_acceso',
                'name' => 'Permite Acceder al modulo Contratos',
            ],
            [
                'title' => 'katbol_contratos_agregar',
                'name' => 'Permite Agregar registros al Modulo Contratos',
            ],
            [
                'title' => 'katbol_contratos_modificar',
                'name' => 'Permite Modificar registros del Modulo Contratos',
            ],
            [
                'title' => 'katbol_contratos_eliminar',
                'name' => 'Permite Eliminar registros del Modulo Contratos',
            ],
            //Requisiciones
            [
                'title' => 'katbol_requisiciones_acceso',
                'name' => 'Permite Acceder al Modulo Requisiciones',
            ],
            [
                'title' => 'katbol_requisiciones_agregar',
                'name' => 'Permite Agregar registros al Modulo Requisiciones',
            ],
            [
                'title' => 'katbol_requisiciones_modificar',
                'name' => 'Permite Modificar registros del Modulo Requisiciones',
            ],
            [
                'title' => 'katbol_requisiciones_archivar',
                'name' => 'Permite Archivar registros del Modulo Requisiciones',
            ],
            [
                'title' => 'katbol_requisiciones_imprimir',
                'name' => 'Permite Imprimir registros del Modulo Requisiciones',
            ],
            //Proveedores
            [
                'title' => 'katbol_proveedores_acceso',
                'name' => 'Permite Acceder al Modulo Proveedores',
            ],
            [
                'title' => 'katbol_proveedores_agregar',
                'name' => 'Permite Agregar registros al Modulo Proveedores',
            ],
            [
                'title' => 'katbol_proveedores_modificar',
                'name' => 'Permite Modificar registros del Modulo Proveedores',
            ],
            [
                'title' => 'katbol_proveedores_eliminar',
                'name' => 'Permite Eliminar registros del Modulo Proveedores',
            ],
            //Ordenes Compra
            [
                'title' => 'katbol_ordenes_compra_acceso',
                'name' => 'Permite Acceder al Modulo Ordenes de Compra',
            ],
            [
                'title' => 'katbol_ordenes_compra_modificar',
                'name' => 'Permite Modificar registros del Modulo Proveedores',
            ],
            //Proveedores Ordenes de Compra
            [
                'title' => 'katbol_proveedores_ordenes_compra_acceso',
                'name' => 'Permite Acceder al Modulo Proveedores Ordenes de Compra',
            ],
            [
                'title' => 'katbol_proveedores_ordenes_compra_agregar',
                'name' => 'Permite Agregar registros de Ordenes de Compra al Modulo Proveedores Ordenes de Compra',
            ],
            [
                'title' => 'katbol_proveedores_ordenes_compra_modificar',
                'name' => 'Permite Modificar registros de Ordenes de Compra del Modulo Proveedores Ordenes de Compra',
            ],
            [
                'title' => 'katbol_proveedores_ordenes_compra_archivar',
                'name' => 'Permite Archivar registros de Ordenes de Compra del Modulo Proveedores Ordenes de Compra',
            ],
            //Productos
            [
                'title' => 'katbol_producto_acceso',
                'name' => 'Permite Acceder al modulo Producto',
            ],
            [
                'title' => 'katbol_producto_agregar',
                'name' => 'Permite Agregar registros al Modulo Producto',
            ],
            [
                'title' => 'katbol_producto_modificar',
                'name' => 'Permite Modificar registros del Modulo Producto',
            ],
            [
                'title' => 'katbol_producto_archivar',
                'name' => 'Permite Archivar registros del Modulo Producto',
            ],
            //Compradores
            [
                'title' => 'katbol_compradores_acceso',
                'name' => 'Permite Acceder al modulo Compradores',
            ],
            [
                'title' => 'katbol_compradores_agregar',
                'name' => 'Permite Agregar registros al Modulo Compradores',
            ],
            [
                'title' => 'katbol_compradores_modificar',
                'name' => 'Permite Modificar registros del Modulo Compradores',
            ],
            [
                'title' => 'katbol_compradores_archivar',
                'name' => 'Permite Archivar registros del Modulo Compradores',
            ],
            //Centro Costos
            [
                'title' => 'katbol_centro_costos_acceso',
                'name' => 'Permite Acceder al modulo Centro de Costos',
            ],
            [
                'title' => 'katbol_centro_costos_agregar',
                'name' => 'Permite Agregar registros al Modulo Centro de Costos',
            ],
            [
                'title' => 'katbol_centro_costos_modificar',
                'name' => 'Permite Modificar registros del Modulo Centro de Costos',
            ],
            [
                'title' => 'katbol_centro_costos_archivar',
                'name' => 'Permite Archivar registros del Modulo Centro de Costos',
            ],
            //Sucursales
            [
                'title' => 'katbol_sucursales_acceso',
                'name' => 'Permite Acceder al modulo Sucursales',
            ],
            [
                'title' => 'katbol_sucursales_agregar',
                'name' => 'Permite Agregar registros al Modulo Sucursales',
            ],
            [
                'title' => 'katbol_sucursales_modificar',
                'name' => 'Permite Modificar registros del Modulo Sucursales',
            ],
            [
                'title' => 'katbol_sucursales_archivar',
                'name' => 'Permite Archivar registros del Modulo Sucursales',
            ],
            //Reportes Requisicion
            [
                'title' => 'katbol_reportes_requisicion_acceso',
                'name' => 'Permite Acceder al modulo Reportes Requisicion',
            ],
            //Dashboard Contratos
            [
                'title' => 'dashboard_gestion_contratos_acceder',
                'name' => 'Permite acceder el dashboard de gestion de contratos',
            ],
        ];

        Permission::insert($permissions);
    }
}
