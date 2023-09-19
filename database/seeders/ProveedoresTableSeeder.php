<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProveedoresTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        // \DB::table('proveedores')->delete();

        \DB::table('timesheet_clientes')->insert([
            0 => [
                'razon_social' => 'Silent4Business S.A de C.V',
                'nombre' => 'test',
                'rfc' => null,
                'calle' => 'Insurgentes Sur',
                'colonia' => 'Atizapan',
                'ciudad' => 'México',
                'codigo_postal' => '07850',
                'telefono' => null,
                'pagina_web' => null,
                'nombre_contacto' => 'Miguel Ángel Gaspar',
                'puesto_contacto' => null,
                'correo_contacto' => null,
                'celular_contacto' => null,
                'objeto_descripcion' => null,
                'cobertura' => null,
                'created_at' => '2022-02-15 15:22:01',
                'updated_at' => '2022-02-15 16:33:14',
                'id_fiscale' => null,
            ],
            1 => [

                'razon_social' => 'Secretaría de Energía',
                'nombre' => 'SENER',
                'rfc' => 'SEN9412287J6',
                'calle' => 'Vito Alesio Robles #147',
                'colonia' => 'Colonia Florida',
                'ciudad' => 'Álvaro Obregón, Ciudad de México',
                'codigo_postal' => '01030',
                'telefono' => null,
                'pagina_web' => 'https://www.gob.mx/sener',
                'nombre_contacto' => 'Lic. José Isabel Díaz Pérez',
                'puesto_contacto' => 'Director General de Recursos Humanos, Materiales y Servicios Generales',
                'correo_contacto' => null,
                'celular_contacto' => null,
                'objeto_descripcion' => 'Conducir la política energética del país, dentro del marco constitucional vigente, de alta calidad económicamente viable y ampliamente sustentable de energéticos  que requiere el  desarrollo de la vida nacional.',
                'cobertura' => 'República Mexicana',
                'created_at' => '2022-02-17 13:23:39',
                'updated_at' => '2022-02-17 13:23:39',
                'id_fiscale' => null,
            ],
            2 => [

                'razon_social' => 'Braskem Idesa S.A.P.I.',
                'nombre' => 'Brasken Idesa',
                'rfc' => 'BID100428IX6',
                'calle' => 'Periférico Blvd. Manuel Ávila Camacho #36',
                'colonia' => 'Lomas - Virreyes, Lomas de Chapultepec',
                'ciudad' => 'Miguel Hidalgo, Ciudad de México',
                'codigo_postal' => '11000',
                'telefono' => null,
                'pagina_web' => 'https://www.braskemidesa.com.mx',
                'nombre_contacto' => 'Jaime Flores Álvarez / Carlos Ernesto Ángeles Novoa',
                'puesto_contacto' => 'Representantes Legales',
                'correo_contacto' => null,
                'celular_contacto' => null,
                'objeto_descripcion' => null,
                'cobertura' => 'República Mexicana',
                'created_at' => '2022-02-17 13:48:04',
                'updated_at' => '2022-02-17 13:48:04',
                'id_fiscale' => null,
            ],
            3 => [

                'razon_social' => 'Instituto Nacional de Telecomunicaciones',
                'nombre' => 'IFT',
                'rfc' => 'IFD130924CX1',
                'calle' => 'Insurgentes Sur #1143',
                'colonia' => 'Colonia Nochebuena',
                'ciudad' => 'Benito Juárez, Ciudad de México',
                'codigo_postal' => '03720',
                'telefono' => null,
                'pagina_web' => 'http://www.ift.org.mx',
                'nombre_contacto' => 'Juan Carlos Jiménez Ángeles',
                'puesto_contacto' => 'Director General de Adquisiciones Recursos Materiales y Servicios Generales',
                'correo_contacto' => null,
                'celular_contacto' => null,
                'objeto_descripcion' => 'Desarrollo eficiente de la radio difusión y las telecomunicaciones a los dispuesto por la Ley Federal de Telecomunicaciones y Radiodifusión y tiene a su cargo la  regulación, promoción y supervisión del uso, aprovechamiento y explotación del espectro radioeléctrico, las redes y la prestación de los servicios de radiodifusión  y telecomunicaciones, además de ser la autoridad en materia de competencia económica en dichos sectores.',
                'cobertura' => 'República Mexicana',
                'created_at' => '2022-02-17 15:08:38',
                'updated_at' => '2022-02-17 15:08:38',
                'id_fiscale' => null,
            ],
        ]);
    }
}
