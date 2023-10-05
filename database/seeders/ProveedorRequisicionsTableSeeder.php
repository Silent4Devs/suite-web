<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProveedorRequisicionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('proveedor_requisicions')->delete();

        \DB::table('proveedor_requisicions')->insert(array(
            0 =>
            array(
                'proveedor' => 'otro',
                'detalles' => 'Certificación GIAC GPEN',
                'tipo' => 'online',
                'comentarios' => 'La certificación se adquiere de manera directa en el portal del proveedor https://www.giac.org/ con la cuenta del ingeniero',
                'contacto' => 'N/A',
                'contacto_telefono' => NULL,
                'contacto_correo' => 'info@giac.org',
                'url' => 'https://www.giac.org/certifications/penetration-tester-gpen/',
                'fecha_inicio' => '2023-08-18',
                'fecha_fin' => '2023-08-25',
                'requisiciones_id' => 9,
                'created_at' => '2023-08-18 14:02:54',
                'updated_at' => '2023-08-18 14:02:54',
                'deleted_at' => NULL,
                'cotizacion' => 'requisicion_9cotizazcion_0_64dfce6e5ab35.pdf',
                'cel' => '+13016547267',
            ),
            1 =>
            array(
                'proveedor' => 'otro',
                'detalles' => 'Certificación GIAC GPEN',
                'tipo' => 'online',
                'comentarios' => 'Compra directa en el sitio del proveedor de certificaciones GIAC',
                'contacto' => 'N/A',
                'contacto_telefono' => NULL,
                'contacto_correo' => 'info@giac.org',
                'url' => 'https://www.giac.org/certifications/penetration-tester-gpen/',
                'fecha_inicio' => '2023-08-18',
                'fecha_fin' => '2023-08-25',
                'requisiciones_id' => 10,
                'created_at' => '2023-08-18 16:49:54',
                'updated_at' => '2023-08-18 16:49:54',
                'deleted_at' => NULL,
                'cotizacion' => 'requisicion_10cotizazcion_0_64dff5920b8b9.pdf',
                'cel' => '+13016547267',
            ),
        ));
    }
}
