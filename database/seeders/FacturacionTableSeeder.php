<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FacturacionTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('facturacion')->delete();

        \DB::table('facturacion')->insert([
            0 => [
                'contrato_id' => 1,
                'no_factura' => '50',
                'concepto' => 'test',
                'fecha_recepcion' => '2022-02-16',
                'fecha_liberacion' => '2022-02-11',
                'no_revisiones' => 50,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '40.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => null,
                'conformidad' => null,
                'estatus' => 'pagada',
                'created_at' => '2022-02-15 15:23:32',
                'updated_at' => '2022-02-15 15:23:32',
                'deleted_at' => null,
                'created_by' => 1,
                'updated_by' => null,
            ],
            1 => [
                'contrato_id' => 9,
                'no_factura' => '560',
                'concepto' => 'concepto',
                'fecha_recepcion' => '2021-10-14',
                'fecha_liberacion' => '2021-04-15',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '20.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-03-31 18:12:57',
                'updated_at' => '2022-04-01 19:50:43',
                'deleted_at' => '2022-04-01 19:50:43',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            2 => [
                'contrato_id' => 9,
                'no_factura' => '700',
                'concepto' => 'concepto',
                'fecha_recepcion' => '2021-10-14',
                'fecha_liberacion' => '2021-04-15',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '800.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-03-31 18:21:10',
                'updated_at' => '2022-04-01 19:50:38',
                'deleted_at' => '2022-04-01 19:50:38',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            3 => [
                'contrato_id' => 9,
                'no_factura' => '333',
                'concepto' => 'sdasdasd',
                'fecha_recepcion' => '2022-03-01',
                'fecha_liberacion' => '2021-05-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '5000.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-03-31 18:30:35',
                'updated_at' => '2022-04-01 19:51:03',
                'deleted_at' => '2022-04-01 19:51:03',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            4 => [
                'contrato_id' => 9,
                'no_factura' => '1211',
                'concepto' => 'sdfsdfsdfsdf',
                'fecha_recepcion' => '2021-08-01',
                'fecha_liberacion' => '2021-08-31',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '50000.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-03-31 18:32:17',
                'updated_at' => '2022-04-01 19:14:25',
                'deleted_at' => '2022-04-01 19:14:25',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            5 => [
                'contrato_id' => 9,
                'no_factura' => 'S 224',
                'concepto' => 'Renovación de Licenciamiento Meraki',
                'fecha_recepcion' => '2019-05-17',
                'fecha_liberacion' => '2019-05-17',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '2436.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-08 08:59:57',
                'updated_at' => '2022-04-08 08:59:57',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            6 => [
                'contrato_id' => 9,
                'no_factura' => 'S 397',
                'concepto' => 'Servicio de FW ALTERNO (1 de 41.5 meses de servicio de Agosto 2019)
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24 (1 de 41.5 meses de servicio de Agosto 2019)
',
                'fecha_recepcion' => '2020-05-25',
                'fecha_liberacion' => '2020-05-25',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '40645.27',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-08 09:12:36',
                'updated_at' => '2022-04-08 09:12:36',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            7 => [
                'contrato_id' => 9,
                'no_factura' => 'S 398',
                'concepto' => 'Servicio FW ALTERNO (2 de 41.5 meses de servicio: Septiembre 2019)
Servicio Administrado de Centro  de Operaciones de Seguridad (SOC) 7X24 (septiembre 2019)',
                'fecha_recepcion' => '2020-05-25',
                'fecha_liberacion' => '2020-05-25',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '40645.27',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-08 09:22:50',
                'updated_at' => '2022-04-08 09:22:50',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            8 => [
                'contrato_id' => 9,
                'no_factura' => 'S 399',
                'concepto' => 'Servicio de FW SITIO CENTRAL (1 de 39 meses de servicio. Octubre 2019)
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24 (3 de 41.5 meses de servicio. Octubre 2019)
Servicio de FW ALTERNO (3 de 41.5 meses de servicio. Octubre 2019)',
                'fecha_recepcion' => '2020-05-25',
                'fecha_liberacion' => '2020-05-25',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '60018.26',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-08 09:31:51',
                'updated_at' => '2022-04-08 09:31:51',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            9 => [
                'contrato_id' => 9,
                'no_factura' => 'S 400',
                'concepto' => 'Servicio de FW ALTERNO (4 de 41.5 meses de servicio. Noviembre 2019)
Servicio de FW SITIO CENTRAL (2 de 39 meses de servicio. Noviembre 2019)
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24 (4 de 41.5 meses de servicio. Noviembre 2019)',
                'fecha_recepcion' => '2020-05-25',
                'fecha_liberacion' => '2020-05-25',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '60018.26',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-08 09:39:05',
                'updated_at' => '2022-04-08 09:48:35',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            10 => [
                'contrato_id' => 9,
                'no_factura' => 'S 401',
                'concepto' => 'Servicio de FW ALTERNO (5 de 41.5 meses de servicio. Diciembre 2019)
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24 (5 de 41.5 meses de servicio. Diciembre 2019)
Servicio FW SITIO CENTRAL (3 de 39 meses de servicio. Diciembre 2019)',
                'fecha_recepcion' => '2020-05-25',
                'fecha_liberacion' => '2020-05-25',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '60018.26',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-08 09:47:55',
                'updated_at' => '2022-04-08 09:47:55',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            11 => [
                'contrato_id' => 9,
                'no_factura' => 'S 402',
                'concepto' => 'Servicio de FW ALTERNO (6 DE 41.5 meses de servicio: Enero 2020
Servicio de FW SITIO CENTRAL (4 de 39 meses de servicio: Enero 2020
Servicio de WAF (1 de 36 meses de servicio: Enero 2020)
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7x24 (6 de 41.5 meses de servicios: Enero 2020)
',
                'fecha_recepcion' => '2020-05-25',
                'fecha_liberacion' => '2020-05-25',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-08 13:07:36',
                'updated_at' => '2022-04-08 13:08:05',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            12 => [
                'contrato_id' => 9,
                'no_factura' => 'S 403',
                'concepto' => 'Servicio de FW ALTERNO (7 de 41.5 meses de servicio: Febrero 2020)
Servicio de FW SITIO CENTRAL (5 de 39 meses de servicio: Febrero 2020)
Servicio WAF (2 de 36 meses de servicio: Febrero 2020)
Servicio Administrado de Centro de Operaciones de Seguridad (SOC)7x24 (7 de 41.5 meses de servicios: Febrero 2020',
                'fecha_recepcion' => '2020-05-25',
                'fecha_liberacion' => '2020-05-25',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-08 16:43:34',
                'updated_at' => '2022-04-08 16:43:34',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            13 => [
                'contrato_id' => 9,
                'no_factura' => 'S 404',
                'concepto' => 'Servicio de FW ALTERNO (8 de 41.5 meses de servicio: Marzo 2020)
Servicio de FW SITIO CENTRAL (6 de 39 meses de servicio: Marzo 2020)
Servicio WAF (3 de 36 meses de servicio: Marzo 2020)
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7x24 (8 de 41.5 meses de servicios: Marzo 2020)',
                'fecha_recepcion' => '2020-05-25',
                'fecha_liberacion' => '2020-05-25',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-08 16:50:42',
                'updated_at' => '2022-04-08 16:50:42',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            14 => [
                'contrato_id' => 9,
                'no_factura' => 'S 405',
                'concepto' => 'Servicio de FW ALTERNO (9 de 41.5 meses de servicio: Abril 2020)
Servicio de FW SITIO CENTRAL (7 de 39 meses de servicio: Abril 2020)
Servicio WAF (4 de 36 meses de servicios: Abril 2020)
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7x24 (9 de 41.5 meses de servicio: Abril 2020)',
                'fecha_recepcion' => '2020-05-25',
                'fecha_liberacion' => '2020-05-25',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-08 16:59:43',
                'updated_at' => '2022-04-08 16:59:43',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            15 => [
                'contrato_id' => 9,
                'no_factura' => 'S 411',
                'concepto' => 'Servicio de FW ALTERNO (10 de 41.5 meses de servicios: Mayo 2020)
Servicio de FW SITIO CENTRAL (8 de 39 meses de servicios: Mayo 2020)
Servicio de WAF (5 de 36 meses de servicio: Mayo 2020)
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24 (10 de 41.5 meses de servicio: Mayo 2020)',
                'fecha_recepcion' => '2020-06-09',
                'fecha_liberacion' => '2020-06-09',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-08 17:13:55',
                'updated_at' => '2022-04-08 17:13:55',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            16 => [
                'contrato_id' => 9,
                'no_factura' => 'S 413',
                'concepto' => 'Servicio de FW ALTERNO (11 de 41.5 meses de servicio: Junio 2020)
Servicio de FW SITIO CENTRAL (9 de 39 meses de servicios: Junio 2020)
Servicio de WAF (6 de 36 meses de servicio: Junio 2020)
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7x24 (10 de 41.5 meses de servicio: Junio 2020)',
                'fecha_recepcion' => '2020-07-06',
                'fecha_liberacion' => '2020-07-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-08 17:21:26',
                'updated_at' => '2022-04-08 17:21:26',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            17 => [
                'contrato_id' => 9,
                'no_factura' => 'S 418',
                'concepto' => 'Servicio FW ALTERNO (12 de 41.5 meses de servicio: Julio 2020)
Servicio FW SITIO CENTRAL (10 de 39 meses de servicio: Julio 2020)
Servicio WAF (7 de 36 meses de servicio: Julio 2020)
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7x24 (12 de 41.5 meses de servicio: Julio 2020)',
                'fecha_recepcion' => '2020-08-05',
                'fecha_liberacion' => '2020-08-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-08 17:28:19',
                'updated_at' => '2022-04-08 17:28:19',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            18 => [
                'contrato_id' => 9,
                'no_factura' => 'S 439',
                'concepto' => 'Servicio FW ALTERNO (13 de 41.5 meses de servicio: Agosto 2020)
Servicio FW SITIO CENTRAL (11de 39 meses de servicio: Agosto 2020)
Servicio WAF (8 de 36 meses de servicio: Agosto 2020)
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7x24 (13 de 41.5 meses de servicio: Agosto 2020)',
                'fecha_recepcion' => '2020-09-04',
                'fecha_liberacion' => '2020-09-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-08 17:33:22',
                'updated_at' => '2022-04-08 17:33:22',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            19 => [
                'contrato_id' => 9,
                'no_factura' => 'S 452',
                'concepto' => 'Servicio de FW ALTERNO (14 de 41.5 meses de servicio: Septiembre 2020)
Servicio de FW SITIO CENTRAL ( 12 de 39 meses de servicios: Septiembre 2020)
Servicio WAF (9 de 36 meses de servicios: Septiembre 2020)
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7x24 (14 de 41.5 meses de servicio: Septiembre 2020)',
                'fecha_recepcion' => '2020-10-05',
                'fecha_liberacion' => '2020-10-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-08 17:48:54',
                'updated_at' => '2022-04-08 17:48:54',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            20 => [
                'contrato_id' => 9,
                'no_factura' => 'S 463',
                'concepto' => 'Servicio FW ALTERNO (15 de 41.5 meses de servicio: Octubre 2020)
Servicio FW SITIO CENTRAL (13 de 39 meses de servicio: Octubre 2020)
Servicio WAF (10 de 36 meses servicio: Octubre 2020)
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24 (15 de 41.5 meses de servicio: Octubre 2020)',
                'fecha_recepcion' => '2020-11-02',
                'fecha_liberacion' => '2020-11-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-08 17:54:45',
                'updated_at' => '2022-04-08 17:54:45',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            21 => [
                'contrato_id' => 9,
                'no_factura' => 'S 481',
                'concepto' => 'Servicio FW ALTERNO (16 de 41.5 meses de servicio: Noviembre 2020)
Servicio FW SITIO CENTRAL ( 14 de 39 meses de servicio: Noviembre 2020)
Servicio WAF (11 de 36 meses de servicio: Noviembre 2020)
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7x24 ( 16 de 41.5 meses de servicio: Noviembre 2020)',
                'fecha_recepcion' => '2020-12-04',
                'fecha_liberacion' => '2020-12-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-08 18:11:49',
                'updated_at' => '2022-04-08 18:11:49',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            22 => [
                'contrato_id' => 9,
                'no_factura' => 'S 500',
                'concepto' => 'Servicio FW ALTERNO (17 de 41.5 meses de servicio: Diciembre 2020)
Servicio FW SITIO CENTRAL ( 15 de 39 meses de servicios: Diciembre 2020)
Servicio WAF (12 de 36 meses de servicio: Diciembre 2020)
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7x24 (17 de 41.5 meses de servicio: Diciembre 2021',
                'fecha_recepcion' => '2021-01-08',
                'fecha_liberacion' => '2021-01-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-08 18:24:03',
                'updated_at' => '2022-04-08 18:24:03',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            23 => [
                'contrato_id' => 9,
                'no_factura' => 'S 512',
                'concepto' => 'Servicio FW ALTERNO (18 de 41.5 meses de servicio: Enero 2021)
Servicio FW SITIO CENTRAL (16 de 39 meses de servicio: Enero 2021
Servicio WAF (13 de 36 meses de servicio: Enero 2021
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24 (18 de 41.5 meses de servicios: Enero 2021',
                'fecha_recepcion' => '2021-02-08',
                'fecha_liberacion' => '2021-02-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-11 17:09:31',
                'updated_at' => '2022-04-11 17:09:31',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            24 => [
                'contrato_id' => 9,
                'no_factura' => 'S 522',
                'concepto' => 'Servicio FW ALTERNO (19 de 41.5 meses de servicio: Febrero 20221
Servicio FW SITIO CENTRAL (17 de 39 meses de servicios: Febrero 2021
Servicio WAF (14 de 36 meses de servicio: Febrero 2021
Servicio Administrado de Centro de Operaciones de Seguridad 2021 (SOC) 7X24 (19 de 41.5 meses de servicio: Febrero 2021',
                'fecha_recepcion' => '2021-03-01',
                'fecha_liberacion' => '2021-03-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-11 17:23:55',
                'updated_at' => '2022-04-11 17:27:15',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            25 => [
                'contrato_id' => 9,
                'no_factura' => 'S 541',
                'concepto' => 'Servicio FW ALTERNO (20 de 41.5 meses de servicio: Marzo 20221
Servicio FW SITIO CENTRAL (18 de 39 meses de servicios: Marzo 2021
Servicio WAF (15 de 36 meses de servicio: Marzo 2021
Servicio Administrado de Centro de Operaciones de Seguridad 2021 (SOC) 7X24 (20 de 41.5 meses de servicio: Marzo 2021',
                'fecha_recepcion' => '2021-04-05',
                'fecha_liberacion' => '2021-04-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-11 17:26:49',
                'updated_at' => '2022-04-11 17:26:49',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            26 => [
                'contrato_id' => 9,
                'no_factura' => 'S 553',
                'concepto' => 'Servicio FW ALTERNO (21 de 41.5 meses de servicio: Abril 20221
Servicio FW SITIO CENTRAL (19 de 39 meses de servicios: Abril 2021
Servicio WAF (16 de 36 meses de servicio: Abril 2021
Servicio Administrado de Centro de Operaciones de Seguridad 2021 (SOC) 7X24 (21 de 41.5 meses de servicio: Abril 2021',
                'fecha_recepcion' => '2021-05-07',
                'fecha_liberacion' => '2021-05-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-11 17:30:15',
                'updated_at' => '2022-04-11 17:30:15',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            27 => [
                'contrato_id' => 9,
                'no_factura' => 'S 566',
                'concepto' => 'Servicio FW ALTERNO (22 de 41.5 meses de servicio: Mayo 20221
Servicio FW SITIO CENTRAL (20 de 39 meses de servicios: Mayo 2021
Servicio WAF (17 de 36 meses de servicio: Mayo 2021
Servicio Administrado de Centro de Operaciones de Seguridad 2021 (SOC) 7X24 (22 de 41.5 meses de servicio: Mayo 2021',
                'fecha_recepcion' => '2021-06-04',
                'fecha_liberacion' => '2021-06-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-11 17:37:48',
                'updated_at' => '2022-04-11 17:37:48',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            28 => [
                'contrato_id' => 9,
                'no_factura' => 'S 590',
                'concepto' => 'Servicio FW ALTERNO (23 de 41.5 meses de servicio: Junio 20221
Servicio FW SITIO CENTRAL (21 de 39 meses de servicios: Junio 2021
Servicio WAF (18 de 36 meses de servicio: Junio 2021
Servicio Administrado de Centro de Operaciones de Seguridad 2021 (SOC) 7X24 (23 de 41.5 meses de servicio: Julio 2021',
                'fecha_recepcion' => '2021-07-05',
                'fecha_liberacion' => '2021-07-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-11 17:43:36',
                'updated_at' => '2022-04-11 17:43:36',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            29 => [
                'contrato_id' => 9,
                'no_factura' => 'S 609',
                'concepto' => 'Servicio FW ALTERNO (24 de 41.5 meses de servicio:  Julio 2021
Servicio FW SITIO CENTRAL (22 de 39 meses de servicios: Julio 2021
Servicio WAF (19 de 36 meses de servicio: Julio 2021
Servicio Administrado de Centro de Operaciones de Seguridad 2021 (SOC) 7X24 (24 de 41.5 meses de servicio: Julio 2021',
                'fecha_recepcion' => '2021-08-05',
                'fecha_liberacion' => '2021-08-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-11 17:52:14',
                'updated_at' => '2022-04-11 17:52:14',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            30 => [
                'contrato_id' => 9,
                'no_factura' => 'S 623',
                'concepto' => 'Servicio FW ALTERNO (25 de 41.5 meses de servicio: Agosto 2021
Servicio FW SITIO CENTRAL (23 de 39 meses de servicios: Agosto 2021
Servicio WAF (20 de 36 meses de servicio: Agosto 2021
Servicio Administrado de Centro de Operaciones de Seguridad 2021 (SOC) 7X24 (25 de 41.5 meses de servicio: Agosto 2021',
                'fecha_recepcion' => '2021-09-03',
                'fecha_liberacion' => '2021-09-03',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-11 17:55:14',
                'updated_at' => '2022-04-11 17:55:14',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            31 => [
                'contrato_id' => 9,
                'no_factura' => 'S 642',
                'concepto' => 'Servicio FW ALTERNO (26 de 41.5 meses de servicio: Septiembre 20221
Servicio FW SITIO CENTRAL (24 de 39 meses de servicios: Septiembre 2021
Servicio WAF (21 de 36 meses de servicio: Septiembre 2021
Servicio Administrado de Centro de Operaciones de Seguridad 2021 (SOC) 7X24 (26 de 41.5 meses de servicio: Septiembre 2021',
                'fecha_recepcion' => '2021-10-04',
                'fecha_liberacion' => '2021-10-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-11 18:19:48',
                'updated_at' => '2022-04-11 18:19:48',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            32 => [
                'contrato_id' => 9,
                'no_factura' => 'S 660',
                'concepto' => 'Servicio FW ALTERNO (27 de 41.5 meses de servicio: Octubre 20221
Servicio FW SITIO CENTRAL (25 de 39 meses de servicios: Octubre 2021
Servicio WAF (22 de 36 meses de servicio: Octubre 2021
Servicio Administrado de Centro de Operaciones de Seguridad 2021 (SOC) 7X24 (27 de 41.5 meses de servicio: Octubre 2021',
                'fecha_recepcion' => '2021-11-04',
                'fecha_liberacion' => '2021-11-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-11 18:22:18',
                'updated_at' => '2022-04-11 18:22:18',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            33 => [
                'contrato_id' => 9,
                'no_factura' => 'S 693',
                'concepto' => 'Servicio FW ALTERNO (28 de 41.5 meses de servicio: Noviembre 20221
Servicio FW SITIO CENTRAL (26 de 39 meses de servicios: Noviembre 2021
Servicio WAF (23 de 36 meses de servicio: Noviembre 2021
Servicio Administrado de Centro de Operaciones de Seguridad 2021 (SOC) 7X24 (28 de 41.5 meses de servicio: Noviembre 2021',
                'fecha_recepcion' => '2021-12-08',
                'fecha_liberacion' => '2021-12-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-11 18:26:36',
                'updated_at' => '2022-04-11 18:26:36',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            34 => [
                'contrato_id' => 9,
                'no_factura' => 'S 714',
                'concepto' => 'Servicio FW ALTERNO (29 de 41.5 meses de servicio: Diciembre 2021
Servicio FW SITIO CENTRAL (27 de 39 meses de servicios: Diciembre 2021
Servicio WAF (24 de 36 meses de servicio: Diciembre 2021
Servicio Administrado de Centro de Operaciones de Seguridad 2021 (SOC) 7X24 (29 de 41.5 meses de servicio: Diciembre 2021',
                'fecha_recepcion' => '2022-01-06',
                'fecha_liberacion' => '2022-01-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-11 18:33:49',
                'updated_at' => '2022-04-11 18:33:49',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            35 => [
                'contrato_id' => 9,
                'no_factura' => 'S 723',
                'concepto' => 'Servicio FW ALTERNO (30 de 41.5 meses de servicio: Enero 2022
Servicio FW SITIO CENTRAL (28 de 39 meses de servicios: Enero 2022
Servicio WAF (25 de 36 meses de servicio: Enero 2022
Servicio Administrado de Centro de Operaciones de Seguridad 2021 (SOC) 7X24 (30 de 41.5 meses de servicio: Enero 2022',
                'fecha_recepcion' => '2022-02-08',
                'fecha_liberacion' => '2022-02-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-11 18:38:10',
                'updated_at' => '2022-04-11 18:38:10',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            36 => [
                'contrato_id' => 9,
                'no_factura' => 'S 742',
                'concepto' => 'Servicio FW ALTERNO (31 de 41.5 meses de servicio: Febrero 2022
Servicio FW SITIO CENTRAL (29 de 39 meses de servicios: Febrero 2022
Servicio WAF (26 de 36 meses de servicio: Febrero 2022
Servicio Administrado de Centro de Operaciones de Seguridad 2021 (SOC) 7X24 (31 de 41.5 meses de servicio: Febrero 2022',
                'fecha_recepcion' => '2022-03-07',
                'fecha_liberacion' => '2022-03-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.96',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-11 18:42:12',
                'updated_at' => '2022-04-11 18:42:12',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            37 => [
                'contrato_id' => 5,
                'no_factura' => 'S 581',
                'concepto' => '10 Servicios de Cyber Threat
10 Servicios de Simulación de Ataques de Seguridad',
                'fecha_recepcion' => '2021-06-28',
                'fecha_liberacion' => '2021-06-28',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '1997455.50',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-12 09:31:31',
                'updated_at' => '2022-04-12 09:31:31',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            38 => [
                'contrato_id' => 5,
                'no_factura' => 'S 732',
                'concepto' => '1 Servicio Cyber Threat
1 Servicio de Simulación de Ataques de Ciberseguridad ',
                'fecha_recepcion' => '2022-02-18',
                'fecha_liberacion' => '2022-02-18',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '199745.55',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-12 10:16:15',
                'updated_at' => '2022-04-12 10:16:15',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            39 => [
                'contrato_id' => 5,
                'no_factura' => 'S 749',
                'concepto' => '1 Servicio Cyber Threat
1 Servicio de Simulación de Ciberseguridad',
                'fecha_recepcion' => '2022-03-11',
                'fecha_liberacion' => '2022-03-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '199745.55',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-12 10:17:52',
                'updated_at' => '2022-04-12 10:17:52',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            40 => [
                'contrato_id' => 6,
                'no_factura' => 'S 689',
                'concepto' => '2 Servicios. Security Operation Center
Mensualidades 1 y 2
Contrato No. CTR-IEN-00014-21
Vigencia 11- Agosto-2021 a 11-Agosto-2022',
                'fecha_recepcion' => '2021-12-06',
                'fecha_liberacion' => '2021-12-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '567655.84',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-12 12:36:22',
                'updated_at' => '2022-04-12 12:36:22',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            41 => [
                'contrato_id' => 6,
                'no_factura' => 'S 717',
                'concepto' => '2 Servicios.  Security Operation Center
Mensualidades 3 y 4
Contrato No. CTR-IEN-00014-21
Vigencia 11-Agosto-2021 a 11-Agosto-2022
Número de recepción de servicios 5000055611',
                'fecha_recepcion' => '2022-01-17',
                'fecha_liberacion' => '2022-01-17',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '567655.87',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-12 13:11:27',
                'updated_at' => '2022-04-12 13:11:27',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            42 => [
                'contrato_id' => 6,
                'no_factura' => 'S 719',
                'concepto' => '2 Servicios. Security Operation Center
Mensualidades 3 y 4
Contrato CTR-IEN-00014-21
Vigencia 11-Agosto-2021 a 11-Agosto-2022
Número de recepción de servicios 500055611',
                'fecha_recepcion' => '2022-01-24',
                'fecha_liberacion' => '2022-01-24',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '567655.84',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-12 13:18:52',
                'updated_at' => '2022-04-12 13:18:52',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            43 => [
                'contrato_id' => 6,
                'no_factura' => 'S 735',
                'concepto' => '1 Hardware
Marca WD
Modelo  WDBVB20240JCH-NESN
N/S WDBVB2040JCH-20
WD Serial number WUBM31241986
Especificaciones: SIAM-577 NAS WD MY CLOUD EX2 ULTRA 24TB/ CON 2 DISCOS DE 12 TB
(NAS WD MY CLOUD EX 2 ULTRA 24TB / CON 2 DISCOS DE 12TB /BAHIAS /1.3GHZ /1GB / 1 ETHERNET/ 2USB3.0 / RAID 0-1)',
                'fecha_recepcion' => '2022-02-24',
                'fecha_liberacion' => '2022-02-24',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1484.45',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-12 13:42:44',
                'updated_at' => '2022-04-12 13:42:44',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            44 => [
                'contrato_id' => 6,
                'no_factura' => 'S 738',
                'concepto' => '1 Hardware
Marca WD
Modelo  WDBVB20240JCH-NESN
N/S WDBVB2040JCH-20
WD Serial number WUBM31241986
Especificaciones: SIAM-577 NAS WD MY CLOUD EX2 ULTRA 24TB/ CON 2 DISCOS DE 12 TB
(NAS WD MY CLOUD EX 2 ULTRA 24TB / CON 2 DISCOS DE 12TB /BAHIAS /1.3GHZ /1GB / 1 ETHERNET/ 2USB3.0 / RAID 0-1)',
                'fecha_recepcion' => '2022-03-03',
                'fecha_liberacion' => '2022-03-03',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1484.45',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-12 13:44:01',
                'updated_at' => '2022-04-12 13:44:01',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            45 => [
                'contrato_id' => 6,
                'no_factura' => 'S 739',
                'concepto' => '1 Servicio. Security Operation Center
Mensualidad 5
Contrato No. CTR-IEN-00014-21
Vigencia 11-Agosto-2021 a 11-Agosto-2022
Número de recepción: 5000063435 factura al 90%
',
                'fecha_recepcion' => '2022-03-04',
                'fecha_liberacion' => '2022-03-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '255445.13',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-12 13:54:31',
                'updated_at' => '2022-04-12 13:54:31',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            46 => [
                'contrato_id' => 6,
                'no_factura' => 'S 740',
                'concepto' => '1 Servicio. Security Operation Center
Mensualidad 6
Contrato CTR-IEN-00014-21
Vigencia 11-Agosto-2021 a 11-Agosto-2022
Número de recepción de servicios 500063435 factura al 90%
',
                'fecha_recepcion' => '2022-03-04',
                'fecha_liberacion' => '2022-03-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '255445.13',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-12 14:03:23',
                'updated_at' => '2022-04-12 14:03:23',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            47 => [
                'contrato_id' => 7,
                'no_factura' => 'S 585',
                'concepto' => '1 Servicio
Servicios profesionales para implantación de la solución.
Contrato "Servicio de SOC para el Grupo Financiero Ve por más"',
                'fecha_recepcion' => '2021-06-30',
                'fecha_liberacion' => '2021-06-30',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '234322.85',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-13 09:29:54',
                'updated_at' => '2022-04-13 09:29:54',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            48 => [
                'contrato_id' => 7,
                'no_factura' => 'S 586',
                'concepto' => '1 Servicio
Servicio de SOC para el Grupo Financiero Ve por más
Mensualidad 1 de 60',
                'fecha_recepcion' => '2021-06-30',
                'fecha_liberacion' => '2021-06-30',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '285644.29',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-13 09:34:27',
                'updated_at' => '2022-04-13 09:36:24',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            49 => [
                'contrato_id' => 7,
                'no_factura' => 'S 587',
                'concepto' => '1 Servicio
Servicios de Ciberseguridad
Análisis de vulnerabilidades, Pen Testing, Cyberdefense, Threat Hunting, Forense, Borrado Seguro, Phising, Ciber investigación.',
                'fecha_recepcion' => '2021-06-30',
                'fecha_liberacion' => '2021-06-30',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1392000.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-13 09:44:09',
                'updated_at' => '2022-04-13 09:44:09',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            50 => [
                'contrato_id' => 7,
                'no_factura' => 'S 636 ',
                'concepto' => '1 Servicio
Servicio de SOC para el Grupo Financiero Ve por más
Mensualidad 3 de 60',
                'fecha_recepcion' => '2021-09-29',
                'fecha_liberacion' => '2021-09-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '285644.29',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-13 09:50:43',
                'updated_at' => '2022-04-13 09:50:43',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            51 => [
                'contrato_id' => 7,
                'no_factura' => 'S 637',
                'concepto' => '1 Servicio
Servicio de SOC para el Grupo Financiero Ve por más
Mensualidad 4 de 60',
                'fecha_recepcion' => '2021-09-29',
                'fecha_liberacion' => '2021-09-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '285644.29',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-13 09:57:55',
                'updated_at' => '2022-04-13 09:57:55',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            52 => [
                'contrato_id' => 7,
                'no_factura' => 'S 638',
                'concepto' => '1 Servicio
Servicio de SOC para el Grupo Financiero Ve por más
Mensualidad 2 de 60 ',
                'fecha_recepcion' => '2021-09-29',
                'fecha_liberacion' => '2021-09-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '285644.29',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-13 10:05:57',
                'updated_at' => '2022-04-13 10:05:57',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            53 => [
                'contrato_id' => 7,
                'no_factura' => 'S 653',
                'concepto' => '1 Servicio
Servicio de SOC para el Grupo Financiero Ve por más
Mensualidad 5 de 60',
                'fecha_recepcion' => '2021-10-19',
                'fecha_liberacion' => '2021-10-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '285399.29',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-13 10:15:36',
                'updated_at' => '2022-04-13 10:15:36',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            54 => [
                'contrato_id' => 7,
                'no_factura' => 'S 669',
                'concepto' => '1 Servicio
Servicio de SOC para el Grupo Financiero Ve por más
Mensualidad 6 de 60',
                'fecha_recepcion' => '2021-11-22',
                'fecha_liberacion' => '2021-11-22',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '293329.35',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-13 10:21:36',
                'updated_at' => '2022-04-13 10:21:36',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            55 => [
                'contrato_id' => 7,
                'no_factura' => 'S 670',
                'concepto' => '1 Servicio
Servicio de SOC para el Grupo Financiero Ve por más
Mensualidad 7 de 60',
                'fecha_recepcion' => '2021-11-22',
                'fecha_liberacion' => '2021-11-22',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '293329.35',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-13 10:29:32',
                'updated_at' => '2022-04-13 10:29:32',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            56 => [
                'contrato_id' => 7,
                'no_factura' => 'S 671',
                'concepto' => '1 Servicio
Servicio de SOC para el Grupo Financiero Ve por más
Mensualidad 8 de 60',
                'fecha_recepcion' => '2021-11-22',
                'fecha_liberacion' => '2021-11-22',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '293329.35',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-13 10:33:07',
                'updated_at' => '2022-04-13 10:33:07',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            57 => [
                'contrato_id' => 7,
                'no_factura' => 'S 672',
                'concepto' => '1 Servicio
Servicio de SOC para el Grupo Financiero Ve por más
Complemento único por ajuste de prorrateo de la mensualidad de la 1 a la 5',
                'fecha_recepcion' => '2021-11-22',
                'fecha_liberacion' => '2021-11-22',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '38425.27',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-13 10:36:58',
                'updated_at' => '2022-04-13 10:36:58',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            58 => [
                'contrato_id' => 7,
                'no_factura' => 'S 673 ',
                'concepto' => '1 Servicio
Servicio de Pentest Spei $70,000

1 Servicio
Servicio de Pentest Appi $210,000.00',
                'fecha_recepcion' => '2021-11-22',
                'fecha_liberacion' => '2021-11-22',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '324800.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-13 10:40:06',
                'updated_at' => '2022-04-13 10:40:06',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            59 => [
                'contrato_id' => 7,
                'no_factura' => 'S 680',
                'concepto' => '1 Servicio
Servicio de Auditoría
Auditoría en Materia de Tecnología, Seguridad de la Información y Riesgo de Operaciones de los depositantes ',
                'fecha_recepcion' => '2021-12-01',
                'fecha_liberacion' => '2021-12-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '654581.83',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-13 10:44:54',
                'updated_at' => '2022-04-13 10:44:54',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            60 => [
                'contrato_id' => 7,
                'no_factura' => 'S 736',
                'concepto' => '1 Servicio
Servicio de SOC para el Grupo Financiero Ve por más
Mensualidad 9 de 60',
                'fecha_recepcion' => '2022-02-28',
                'fecha_liberacion' => '2022-02-28',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '293329.35',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-13 10:51:35',
                'updated_at' => '2022-04-13 10:51:35',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            61 => [
                'contrato_id' => 7,
                'no_factura' => 'S 747',
                'concepto' => '1 Servicio
Servicio de SOC para el Grupo Financiero Ve por más
Mensualidad 10 de 60',
                'fecha_recepcion' => '2022-03-10',
                'fecha_liberacion' => '2022-03-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '293329.35',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-13 10:55:45',
                'updated_at' => '2022-04-13 10:55:45',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            62 => [
                'contrato_id' => 13,
                'no_factura' => '1',
                'concepto' => 'test',
                'fecha_recepcion' => '2022-04-01',
                'fecha_liberacion' => '2022-04-30',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '5.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-19 12:24:24',
                'updated_at' => '2022-04-19 12:24:24',
                'deleted_at' => null,
                'created_by' => 1,
                'updated_by' => null,
            ],
            63 => [
                'contrato_id' => 3,
                'no_factura' => 'S 454',
                'concepto' => '1 Servicio
Servicio a Infraestructura de Sistemas Industriales
Estimación 1
del 12-05-2020 al 12-06-2020
Contrato 4600023294',
                'fecha_recepcion' => '2020-10-16',
                'fecha_liberacion' => '2020-10-16',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 11:12:38',
                'updated_at' => '2022-04-26 11:12:55',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            64 => [
                'contrato_id' => 3,
                'no_factura' => 'S 455',
                'concepto' => '1 Servicio
Soporte a Infraestructura de Sistemas Industriales
Estimación 2
del 13-06-2020 al 12-07-2020
Contrato 4600023294',
                'fecha_recepcion' => '2020-10-16',
                'fecha_liberacion' => '2020-10-16',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 11:18:40',
                'updated_at' => '2022-04-26 11:20:11',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            65 => [
                'contrato_id' => 3,
                'no_factura' => 'S 456',
                'concepto' => '1 Servicio
Soporte a Infraestructura de Sistemas Industriales
Estimación 3
del 13-07-2020 al 12-08-2020
Contrato 4600023294',
                'fecha_recepcion' => '2020-10-16',
                'fecha_liberacion' => '2020-10-16',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 11:25:41',
                'updated_at' => '2022-04-26 11:25:41',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            66 => [
                'contrato_id' => 3,
                'no_factura' => 'S 457',
                'concepto' => '1 Servicio
Soporte a Infraestructura de Sistemas Industriales
Estimación 4
del 13-08-2020 al 12-09-2020
Contrato 4600023294',
                'fecha_recepcion' => '2021-04-26',
                'fecha_liberacion' => '2021-04-26',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 11:35:18',
                'updated_at' => '2022-04-26 11:35:18',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            67 => [
                'contrato_id' => 3,
                'no_factura' => 'S 460',
                'concepto' => '1 Servicio
Soporte a Infraestructura de Sistemas Industriales
Estimación 5
del 13-09-2020 al 12-10-2020
Contrato 4600023294',
                'fecha_recepcion' => '2020-10-22',
                'fecha_liberacion' => '2020-10-22',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 11:40:29',
                'updated_at' => '2022-04-26 11:41:11',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            68 => [
                'contrato_id' => 3,
                'no_factura' => 'S 475',
                'concepto' => '1 Servicio
Soporte a Infraestructura de Sistemas Industriales
Estimación 6
del 13-10-2020 al 12-11-2020
Contrato 4600023294',
                'fecha_recepcion' => '2020-12-01',
                'fecha_liberacion' => '2020-12-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 11:53:02',
                'updated_at' => '2022-04-26 11:53:02',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            69 => [
                'contrato_id' => 3,
                'no_factura' => 'S 583',
                'concepto' => '1 Servicio
Soporte Infraestructura de Sistema Industriales
Estimación 7
de 13-11-20 al 12-12-20
Contrato 4600023294
Factura Cancelada',
                'fecha_recepcion' => '2020-12-15',
                'fecha_liberacion' => '2020-12-15',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 11:59:33',
                'updated_at' => '2023-04-17 12:44:26',
                'deleted_at' => '2023-04-17 12:44:26',
                'created_by' => 10,
                'updated_by' => 15,
            ],
            70 => [
                'contrato_id' => 3,
                'no_factura' => 'S 510',
                'concepto' => '1 Servicio
Soporte a infraestructura de Sistemas Industriales
Estimación 8
del 13-12-2020 al 12-01-2021
Contrato 4600023294',
                'fecha_recepcion' => '2021-02-04',
                'fecha_liberacion' => '2021-02-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 12:10:22',
                'updated_at' => '2022-04-26 12:10:22',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            71 => [
                'contrato_id' => 3,
                'no_factura' => 'S 518',
                'concepto' => '1 Servicio
Soporte a Infraestructura de Sistemas Industriales
Estimación 9
del 13-01-2021 al 12-02-2021
Contrato 4600023294',
                'fecha_recepcion' => '2021-02-24',
                'fecha_liberacion' => '2021-02-24',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 12:20:02',
                'updated_at' => '2022-04-26 12:20:02',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            72 => [
                'contrato_id' => 3,
                'no_factura' => 'S 532',
                'concepto' => '1 Servicio
Soporte a Infraestructura de Sistemas Industriales
Estimación 10
del 13-02-2021 al 12-03-2021
Contrato 4600023294',
                'fecha_recepcion' => '2021-03-25',
                'fecha_liberacion' => '2021-03-25',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 12:26:55',
                'updated_at' => '2022-04-26 12:26:55',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            73 => [
                'contrato_id' => 3,
                'no_factura' => 'S 533',
                'concepto' => '1 Servicio
Soporte a Infraestructura de Sistemas Industriales
Estimación 7
del 13-11-20 al 12-12-20
Contrato 4600023294
Factura Cancelada',
                'fecha_recepcion' => '2021-03-25',
                'fecha_liberacion' => '2021-03-25',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 12:33:38',
                'updated_at' => '2023-04-17 12:45:00',
                'deleted_at' => '2023-04-17 12:45:00',
                'created_by' => 10,
                'updated_by' => 15,
            ],
            74 => [
                'contrato_id' => 3,
                'no_factura' => 'S 547',
                'concepto' => '1 Servicio
Soporte a Infraestructura de Sistemas Industriales
Estimación 11
del 13-03-21 al 12-04-21
Contrato 4600023294',
                'fecha_recepcion' => '2021-04-26',
                'fecha_liberacion' => '2021-04-26',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 12:42:51',
                'updated_at' => '2022-04-26 12:42:51',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            75 => [
                'contrato_id' => 3,
                'no_factura' => 'S 559',
                'concepto' => '1 Servicio
Soporte a Infraestructura a Sistemas Industriales
Estimación 12
del 13-04-2021 al 12-05-2021
Contrato 4600023294',
                'fecha_recepcion' => '2021-05-21',
                'fecha_liberacion' => '2021-05-21',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 12:50:23',
                'updated_at' => '2022-04-26 12:50:23',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            76 => [
                'contrato_id' => 3,
                'no_factura' => 'S 578',
                'concepto' => '1 Servicio
Soporte a Infraestructura a Sistemas Industriales
Estimación 13
del 13-05-2021 al 12-06-2021
Contrato 4600023294',
                'fecha_recepcion' => '2021-06-23',
                'fecha_liberacion' => '2021-06-23',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 12:54:56',
                'updated_at' => '2022-04-26 12:54:56',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            77 => [
                'contrato_id' => 3,
                'no_factura' => 'S 605',
                'concepto' => '1 Servicio
Soporte a Infraestructura a Sistemas Industriales
Estimación 14
del 13-06-2021 al 12-07-2021
Contrato 4600023294',
                'fecha_recepcion' => '2021-08-02',
                'fecha_liberacion' => '2021-08-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 13:00:54',
                'updated_at' => '2022-04-26 13:00:54',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            78 => [
                'contrato_id' => 3,
                'no_factura' => 'S 614',
                'concepto' => '1 Servicio
Soporte a Infraestructura a Sistemas Industriales
Estimación 15
del 13-07-2021 al 12-08-2021
Contrato 4600023294',
                'fecha_recepcion' => '2021-08-19',
                'fecha_liberacion' => '2021-08-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 13:09:03',
                'updated_at' => '2022-04-26 13:09:03',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            79 => [
                'contrato_id' => 3,
                'no_factura' => 'S 631',
                'concepto' => '1 Servicio
Soporte a Infraestructura a Sistemas Industriales
Estimación 16
del 13-08-2021 al 12-09-21
Contrato 4600023294',
                'fecha_recepcion' => '2021-09-24',
                'fecha_liberacion' => '2021-09-24',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 13:35:18',
                'updated_at' => '2022-04-26 13:35:18',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            80 => [
                'contrato_id' => 3,
                'no_factura' => 'S 654',
                'concepto' => '1 Servicio
Soporte a Infraestructura a Sistemas Industriales
Estimación 17
del 13-09-2021 al 12-10-2021
Contrato 4600023294',
                'fecha_recepcion' => '2021-10-25',
                'fecha_liberacion' => '2021-10-25',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 13:52:44',
                'updated_at' => '2022-04-26 13:52:44',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            81 => [
                'contrato_id' => 3,
                'no_factura' => 'S 703',
                'concepto' => '1 Servicio
Soporte a Infraestructura a Sistemas Industriales
Estimación 19
del 13-11-2021 al 12-12-2021
Contrato 4600023294',
                'fecha_recepcion' => '2021-12-14',
                'fecha_liberacion' => '2021-12-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 13:58:27',
                'updated_at' => '2023-04-17 12:43:34',
                'deleted_at' => '2023-04-17 12:43:34',
                'created_by' => 10,
                'updated_by' => 15,
            ],
            82 => [
                'contrato_id' => 3,
                'no_factura' => 'S 720',
                'concepto' => '1 Servicio
Soporte a Infraestructura de Sistemas Industriales
Estimación 20
del 13-12-2021 al 12-01-2022
Contrato 4600023294',
                'fecha_recepcion' => '2022-01-24',
                'fecha_liberacion' => '2022-01-24',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 14:03:22',
                'updated_at' => '2023-04-17 12:43:19',
                'deleted_at' => '2023-04-17 12:43:19',
                'created_by' => 10,
                'updated_by' => 15,
            ],
            83 => [
                'contrato_id' => 3,
                'no_factura' => 'S 733',
                'concepto' => '1 Servicio
Soporte a Infraestructura a Sistemas Industriales
Estimación 21
del 13-01-2022 al 12-02-2022
Contrato 4600023294',
                'fecha_recepcion' => '2022-02-21',
                'fecha_liberacion' => '2022-02-21',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 14:06:51',
                'updated_at' => '2023-04-17 12:42:46',
                'deleted_at' => '2023-04-17 12:42:46',
                'created_by' => 10,
                'updated_by' => 15,
            ],
            84 => [
                'contrato_id' => 3,
                'no_factura' => 'S 757',
                'concepto' => '1 Servicio
Soporte a Infraestructura a Sistemas Industriales
Estimación 22
del 13-02-2022 al 12-03-2022
Contrato 4600023294',
                'fecha_recepcion' => '2022-03-30',
                'fecha_liberacion' => '2022-03-30',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.49',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 14:09:46',
                'updated_at' => '2022-04-26 14:09:46',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            85 => [
                'contrato_id' => 3,
                'no_factura' => 'S 758',
                'concepto' => '1 Servicio
Soporte a Infraestructura a Sistemas Industriales
Estimación 18
del 13-10-2021 al 12-11-2021
Contrato 4600023294

1 Servicio
Soporte a Infraestructura a Sistema Industriales
Estimación 19
del 13-11-2021 al 12-12-2021
Contrato 4600023294

1 Servicio
Soporte a Infraestructura a Sistemas Industriales
Estimación 20
del 13-12-2021 al 12-01-2022
Contrato 4600023294

1 Servicio
Soporte a Infraestructura a Sistemas Industriales
Estimación 21
del 13-01-2022 al 12-02-2022
Contrato 4600023294

',
                'fecha_recepcion' => '2022-04-04',
                'fecha_liberacion' => '2022-04-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '270541.97',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 14:19:59',
                'updated_at' => '2022-04-26 14:19:59',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            86 => [
                'contrato_id' => 3,
                'no_factura' => 'S 782',
                'concepto' => '1 Servicio
Soporte a Infraestructura a Sistema Industriales
Estimación 23
del 13-03-2022 al 12-04-22
Contrato 4600023294',
                'fecha_recepcion' => '2022-04-25',
                'fecha_liberacion' => '2022-04-25',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.49',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-26 14:23:49',
                'updated_at' => '2022-04-26 14:23:49',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            87 => [
                'contrato_id' => 2,
                'no_factura' => 'S 180',
                'concepto' => 'Mes: Febrero 2019

Sistema de Gestión de Seguridad de Seguridad de la Información
Sistema Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio Firewall
Servicio Navegación Seguro
Servicio de Protección de Perdida de Información y Fuga de la Información
Servicio de Prevención de Incidentes (IPS)
Servicio de Seguridad para el Correo Electrónico Institucional
Servicio de Antivirus a estaciones locales
',
                'fecha_recepcion' => '2019-03-11',
                'fecha_liberacion' => '2019-03-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '690883.76',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-29 09:03:45',
                'updated_at' => '2022-04-29 09:03:45',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            88 => [
                'contrato_id' => 2,
                'no_factura' => 'S 200',
                'concepto' => 'Mes: Marzo

Sistema de Gestión de Seguridad de la Información
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de Firewall
Servicio Navegación Segura
Servicio de Protección de Perdida de Información y Fuga de la Información
Servicio de Prevención de Incidentes (IPS)
Servicio de Seguridad para el Correo Electrónico Institucional
Servicio de Antivirus a estaciones locales',
                'fecha_recepcion' => '2019-04-08',
                'fecha_liberacion' => '2019-04-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '690883.76',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-29 09:31:08',
                'updated_at' => '2022-04-29 09:31:08',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            89 => [
                'contrato_id' => 2,
                'no_factura' => 'S 258',
                'concepto' => 'Mes: Abril 2019
Fecha de emisión: 15-07-2019

Sistema de Gestión de Seguridad de Seguridad de la Información
Sistema Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio Firewall
Servicio Navegación Seguro
Servicio de Protección de Perdida de Información y Fuga de la Información
Servicio de Prevención de Incidentes (IPS)
Servicio de Seguridad para el Correo Electrónico Institucional
Servicio de Antivirus a estaciones locales
',
                'fecha_recepcion' => '2019-07-15',
                'fecha_liberacion' => '2019-07-15',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '690883.76',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-29 09:46:19',
                'updated_at' => '2022-05-06 14:30:59',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            90 => [
                'contrato_id' => 2,
                'no_factura' => 'S 260',
                'concepto' => 'Mes: Mayo 2019
Fecha de emisión: 15-07-2019

Sistema de Gestión de Seguridad de Seguridad de la Información
Sistema Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio Firewall
Servicio Navegación Seguro
Servicio de Protección de Perdida de Información y Fuga de la Información
Servicio de Prevención de Incidentes (IPS)
Servicio de Seguridad para el Correo Electrónico Institucional
Servicio de Antivirus a estaciones locales
',
                'fecha_recepcion' => '2019-07-15',
                'fecha_liberacion' => '2019-07-15',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '690883.76',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-29 09:48:55',
                'updated_at' => '2022-05-06 14:35:51',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            91 => [
                'contrato_id' => 2,
                'no_factura' => 'S 259',
                'concepto' => 'Mes: Junio 2019 (1-11)
Fecha de emisión: 15-07-2019

Sistema de Gestión de Seguridad de Seguridad de la Información
Sistema Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio Firewall
Servicio Navegación Seguro
Servicio de Protección de Perdida de Información y Fuga de la Información
Servicio de Prevención de Incidentes (IPS)
Servicio de Seguridad para el Correo Electrónico Institucional
Servicio de Antivirus a estaciones locales
',
                'fecha_recepcion' => '2019-07-15',
                'fecha_liberacion' => '2019-07-15',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '253324.05',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-29 09:53:52',
                'updated_at' => '2022-05-06 14:35:13',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            92 => [
                'contrato_id' => 2,
                'no_factura' => 'S 279',
                'concepto' => 'Mes: Junio 2019 (12-31)
Fecha emisión: 19-08-2019

Sistema de Gestión de Seguridad de Seguridad de la Información
Sistema Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio Firewall
Servicio Navegación Seguro
Servicio de Protección de Perdida de Información y Fuga de la Información
Servicio de Prevención de Incidentes (IPS)
Servicio de Seguridad para el Correo Electrónico Institucional
Servicio de Antivirus a estaciones locales
',
                'fecha_recepcion' => '2019-08-19',
                'fecha_liberacion' => '2019-08-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '428078.72',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-29 10:08:14',
                'updated_at' => '2022-05-06 14:36:25',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            93 => [
                'contrato_id' => 2,
                'no_factura' => 'S 280',
                'concepto' => 'Mes: Julio 2019
Emisión: 19-08-2019

Sistema de Gestión de Seguridad de Seguridad de la Información
Sistema Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio Firewall
Servicio Navegación Seguro
Servicio de Protección de Perdida de Información y Fuga de la Información
Servicio de Prevención de Incidentes (IPS)
Servicio de Seguridad para el Correo Electrónico Institucional
Servicio de Antivirus a estaciones locales
',
                'fecha_recepcion' => '2019-08-19',
                'fecha_liberacion' => '2019-08-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '663522.03',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-29 10:17:30',
                'updated_at' => '2022-05-06 14:37:13',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            94 => [
                'contrato_id' => 2,
                'no_factura' => 'S 281',
                'concepto' => 'Mes: Agosto 2019 (1-11)
Fecha de emisión: 19-08-2019

Sistema de Gestión de Seguridad de Seguridad de la Información
Sistema Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio Firewall
Servicio Navegación Seguro
Servicio de Protección de Perdida de Información y Fuga de la Información
Servicio de Prevención de Incidentes (IPS)
Servicio de Seguridad para el Correo Electrónico Institucional
Servicio de Antivirus a estaciones locales
',
                'fecha_recepcion' => '2019-08-19',
                'fecha_liberacion' => '2019-08-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '235443.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-04-29 10:25:01',
                'updated_at' => '2022-05-06 14:37:54',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            95 => [
                'contrato_id' => 8,
                'no_factura' => 'S 295',
                'concepto' => 'Mes: Agosto 2019 (12-31)

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2019-09-27',
                'fecha_liberacion' => '2019-09-27',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '702823.53',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 13:06:47',
                'updated_at' => '2022-04-29 13:53:46',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            96 => [
                'contrato_id' => 8,
                'no_factura' => 'S 302',
                'concepto' => 'Mes: Septiembre 2019

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2019-10-07',
                'fecha_liberacion' => '2019-10-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 14:01:23',
                'updated_at' => '2022-04-29 14:01:23',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            97 => [
                'contrato_id' => 8,
                'no_factura' => 'S 317',
                'concepto' => 'Mes: Octubre 2019

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2019-11-07',
                'fecha_liberacion' => '2019-11-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 14:18:49',
                'updated_at' => '2022-04-29 14:18:49',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            98 => [
                'contrato_id' => 8,
                'no_factura' => 'S 332',
                'concepto' => 'Mes: Noviembre 2019

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2019-12-06',
                'fecha_liberacion' => '2019-12-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 14:23:20',
                'updated_at' => '2022-04-29 14:23:20',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            99 => [

                'contrato_id' => 8,
                'no_factura' => 'S 333',
                'concepto' => 'Mes: Diciembre 2019

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2019-12-06',
                'fecha_liberacion' => '2019-12-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 14:25:00',
                'updated_at' => '2022-04-29 14:25:00',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            100 => [

                'contrato_id' => 8,
                'no_factura' => 'S 359',
                'concepto' => 'Mes: Agosto Enero 2020

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2020-02-07',
                'fecha_liberacion' => '2020-02-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 14:29:41',
                'updated_at' => '2022-04-29 14:29:41',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            101 => [

                'contrato_id' => 8,
                'no_factura' => 'S 381',
                'concepto' => 'Mes: Febrero 2020

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2020-03-09',
                'fecha_liberacion' => '2020-03-09',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 14:31:25',
                'updated_at' => '2022-04-29 14:31:25',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            102 => [

                'contrato_id' => 8,
                'no_factura' => 'S 386',
                'concepto' => 'Mes: Marzo 2019

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2020-04-01',
                'fecha_liberacion' => '2020-04-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 14:39:58',
                'updated_at' => '2022-04-29 14:39:58',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            103 => [

                'contrato_id' => 8,
                'no_factura' => 'S 391',
                'concepto' => 'Mes: Abril 2020

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2020-04-27',
                'fecha_liberacion' => '2020-04-27',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 14:48:38',
                'updated_at' => '2022-04-29 14:48:38',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            104 => [

                'contrato_id' => 8,
                'no_factura' => 'S 409',
                'concepto' => 'Mes: Mayo 2020

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2020-06-05',
                'fecha_liberacion' => '2020-06-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 14:54:51',
                'updated_at' => '2022-04-29 14:54:51',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            105 => [

                'contrato_id' => 8,
                'no_factura' => 'S 414',
                'concepto' => 'Mes: Junio 2020

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2020-07-06',
                'fecha_liberacion' => '2020-07-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 14:59:53',
                'updated_at' => '2022-04-29 14:59:53',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            106 => [

                'contrato_id' => 8,
                'no_factura' => 'S 422',
                'concepto' => 'Mes: Julio 2020

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2020-08-07',
                'fecha_liberacion' => '2020-08-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 15:01:20',
                'updated_at' => '2022-04-29 15:01:20',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            107 => [

                'contrato_id' => 8,
                'no_factura' => 'S 442',
                'concepto' => 'Mes: Agosto 2020

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2020-09-04',
                'fecha_liberacion' => '2020-09-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 15:03:18',
                'updated_at' => '2022-04-29 15:03:18',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            108 => [

                'contrato_id' => 8,
                'no_factura' => 'S 450',
                'concepto' => 'Mes: Septiembre 2020

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2020-10-05',
                'fecha_liberacion' => '2020-10-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 15:08:39',
                'updated_at' => '2022-04-29 15:08:39',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            109 => [

                'contrato_id' => 8,
                'no_factura' => 'S 466',
                'concepto' => 'Mes: Octubre 2020

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2020-11-03',
                'fecha_liberacion' => '2020-11-03',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 15:10:21',
                'updated_at' => '2022-04-29 15:10:21',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            110 => [

                'contrato_id' => 8,
                'no_factura' => 'S 473',
                'concepto' => 'Mes: Noviembre 2020

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2020-12-01',
                'fecha_liberacion' => '2020-12-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.27',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 15:50:06',
                'updated_at' => '2022-04-29 15:50:06',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            111 => [

                'contrato_id' => 8,
                'no_factura' => 'S 479',
                'concepto' => 'Mes: Diciembre 2020

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2020-12-03',
                'fecha_liberacion' => '2020-12-03',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 15:51:52',
                'updated_at' => '2022-04-29 15:51:52',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            112 => [

                'contrato_id' => 8,
                'no_factura' => ' S 507',
                'concepto' => 'Mes: Enero 2021

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2022-02-04',
                'fecha_liberacion' => '2022-02-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 15:57:34',
                'updated_at' => '2022-04-29 16:05:41',
                'deleted_at' => '2022-04-29 16:05:41',
                'created_by' => 10,
                'updated_by' => 10,
            ],
            113 => [

                'contrato_id' => 8,
                'no_factura' => 'S 507',
                'concepto' => 'Mes: Enero 2021

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2021-02-04',
                'fecha_liberacion' => '2021-02-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 16:07:25',
                'updated_at' => '2022-04-29 16:07:25',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            114 => [

                'contrato_id' => 8,
                'no_factura' => 'S 529',
                'concepto' => 'Mes: Febrero 2021

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2021-03-05',
                'fecha_liberacion' => '2021-03-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 16:09:01',
                'updated_at' => '2022-04-29 16:09:01',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            115 => [

                'contrato_id' => 8,
                'no_factura' => 'S 544',
                'concepto' => 'Mes: Marzo 2021

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2021-04-08',
                'fecha_liberacion' => '2021-04-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 16:11:15',
                'updated_at' => '2022-04-29 16:11:15',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            116 => [

                'contrato_id' => 8,
                'no_factura' => 'S 551',
                'concepto' => 'Mes: Abril 2021

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2021-05-06',
                'fecha_liberacion' => '2021-05-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 16:17:40',
                'updated_at' => '2022-04-29 16:17:40',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            117 => [

                'contrato_id' => 8,
                'no_factura' => 'S 567',
                'concepto' => 'Mes: Mayo 2021

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2021-06-07',
                'fecha_liberacion' => '2021-06-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 16:21:45',
                'updated_at' => '2022-04-29 16:21:45',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            118 => [

                'contrato_id' => 8,
                'no_factura' => ' S 593',
                'concepto' => 'Mes: Junio 2021

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2021-07-08',
                'fecha_liberacion' => '2021-07-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 16:22:59',
                'updated_at' => '2022-04-29 16:23:28',
                'deleted_at' => '2022-04-29 16:23:28',
                'created_by' => 10,
                'updated_by' => 10,
            ],
            119 => [

                'contrato_id' => 8,
                'no_factura' => 'S 593',
                'concepto' => 'Mes: Junio 2021

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2021-07-08',
                'fecha_liberacion' => '2021-07-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 16:25:35',
                'updated_at' => '2022-04-29 16:25:35',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            120 => [

                'contrato_id' => 8,
                'no_factura' => 'S 607',
                'concepto' => 'Mes: Julio 2021

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2021-08-04',
                'fecha_liberacion' => '2021-08-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 16:27:21',
                'updated_at' => '2022-04-29 16:27:21',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            121 => [

                'contrato_id' => 8,
                'no_factura' => 'S 626',
                'concepto' => 'Mes: Agosto 2021

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2021-09-09',
                'fecha_liberacion' => '2021-09-09',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 16:30:42',
                'updated_at' => '2022-04-29 16:30:42',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            122 => [

                'contrato_id' => 8,
                'no_factura' => 'S 644',
                'concepto' => 'Mes: Septiembre 2021

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2021-10-08',
                'fecha_liberacion' => '2021-10-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 16:33:30',
                'updated_at' => '2022-04-29 16:33:30',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            123 => [

                'contrato_id' => 8,
                'no_factura' => 'S 666',
                'concepto' => 'Mes: Octubre 2021

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2021-11-10',
                'fecha_liberacion' => '2021-11-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 16:35:31',
                'updated_at' => '2022-04-29 16:35:31',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            124 => [

                'contrato_id' => 8,
                'no_factura' => 'S 678',
                'concepto' => 'Mes: Noviembre 2021

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2021-12-01',
                'fecha_liberacion' => '2021-12-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 16:36:54',
                'updated_at' => '2022-04-29 16:36:54',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            125 => [

                'contrato_id' => 8,
                'no_factura' => 'S 677',
                'concepto' => 'Mes: Diciembre 2021

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2021-12-01',
                'fecha_liberacion' => '2021-12-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 16:39:40',
                'updated_at' => '2022-04-29 16:39:40',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            126 => [

                'contrato_id' => 8,
                'no_factura' => 'S 727',
                'concepto' => 'Mes: Enero 2022

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2022-02-14',
                'fecha_liberacion' => '2022-02-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 16:42:43',
                'updated_at' => '2022-04-29 16:42:43',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            127 => [

                'contrato_id' => 8,
                'no_factura' => 'S 748',
                'concepto' => 'Mes: Febrero 2022

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2022-03-10',
                'fecha_liberacion' => '2022-03-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 16:44:19',
                'updated_at' => '2022-04-29 16:44:19',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            128 => [

                'contrato_id' => 8,
                'no_factura' => 'S 765',
                'concepto' => 'Mes:  Marzo 2022

Sistema de Gestión de Seguridad de la Información
Servicios BIA
Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de correlación de eventos y administración de bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam a estaciones locales',
                'fecha_recepcion' => '2022-04-08',
                'fecha_liberacion' => '2022-04-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-04-29 16:47:31',
                'updated_at' => '2022-04-29 16:47:31',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            129 => [

                'contrato_id' => 4,
                'no_factura' => 'S 511',
                'concepto' => 'Servicio A. Pruebas de Seguridad Externa
Servicio B. Pruebas de Seguridad Interna
Servicio C. Acompañamiento en la mitigación  de los hallazgos
Servicio D. Evaluación de Credenciales de identificación

Contrato IFT/LPN/025/20
Pruebas Técnicas de Seguridad a la Infraestructura Tecnológica  y Servicios Informáticos del Instituto Federal de Telecomunicaciones

Servicios devengados del 20 de octubre de 2020 al  18 de diciembre de 2020',
                'fecha_recepcion' => '2021-02-05',
                'fecha_liberacion' => '2021-02-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '370225.80',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-02 08:51:43',
                'updated_at' => '2022-05-02 08:51:43',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            130 => [

                'contrato_id' => 4,
                'no_factura' => 'S 513',
                'concepto' => 'Servicio
Análisis de vulnerabilidades a activos (Infraestructura y aplicaciones (Web)
(1 de 24) Enero 2021

Contrato IFT/LPN/004/21
Servicio de Análisis de Vulnerabilidades del Instituto Federal de Telecomunicaciones.

Servicios devengados en el mes de enero de 2021',
                'fecha_recepcion' => '2021-02-05',
                'fecha_liberacion' => '2021-02-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75174.30',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-02 09:00:44',
                'updated_at' => '2022-05-02 09:00:44',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            131 => [

                'contrato_id' => 4,
                'no_factura' => 'S 531',
                'concepto' => 'Servicio
Análisis de Vulnerabilidades a activos (Infraestructura y aplicaciones web)
(2-24)

Contrato IFT/LPN/004/21
Servicio de Análisis de Vulnerabilidades del Instituto Federal de Telecomunicaciones

Servicio devengado en el mes de febrero 2021',
                'fecha_recepcion' => '2021-03-11',
                'fecha_liberacion' => '2021-03-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75174.30',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-02 09:07:38',
                'updated_at' => '2022-05-02 09:21:23',
                'deleted_at' => '2022-05-02 09:21:23',
                'created_by' => 10,
                'updated_by' => 10,
            ],
            132 => [

                'contrato_id' => 4,
                'no_factura' => ' S 556',
                'concepto' => 'Servicio
Análisis de Vulnerabilidades a activos (Infraestructura y aplicaciones web)
(4-24)

Contrato IFT/LPN/004/21
Servicio de Análisis de Vulnerabilidades del Instituto Federal de Telecomunicaciones

Servicios Devengados en el mes de abril 2021
',
                'fecha_recepcion' => '2021-05-11',
                'fecha_liberacion' => '2021-05-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75174.30',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-02 09:18:14',
                'updated_at' => '2022-05-02 09:21:08',
                'deleted_at' => '2022-05-02 09:21:08',
                'created_by' => 10,
                'updated_by' => 10,
            ],
            133 => [

                'contrato_id' => 4,
                'no_factura' => 'S 531',
                'concepto' => 'Servicio
Análisis de Vulnerabilidades a activos (Infraestructura y aplicaciones web)
(2-24)

Contrato: IFT/LPN/004/21

Servicio de Análisis de Vulnerabilidades del Instituto Federal de Telecomunicaciones

Servicio devengado en el mes de febrerp 2021.',
                'fecha_recepcion' => '2021-03-11',
                'fecha_liberacion' => '2021-03-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75174.30',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-02 09:27:51',
                'updated_at' => '2022-05-02 09:27:51',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            134 => [

                'contrato_id' => 4,
                'no_factura' => 'S 556',
                'concepto' => 'Servicio
Análisis de vulnerabilidades a activos (Infraestructura y aplicaciones web)
(3-24)

Contrato: IFT/LPN/004/21
Servicio de Vulnerabilidades del Instituto Federal de Telecomunicaciones

Servicios devengados en el mes de marzo de 2021',
                'fecha_recepcion' => '2021-05-11',
                'fecha_liberacion' => '2021-05-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75174.30',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-02 09:35:44',
                'updated_at' => '2022-05-02 09:35:44',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            135 => [

                'contrato_id' => 4,
                'no_factura' => 'S 557',
                'concepto' => 'Servicio
Análisis de vulnerabilidades a activos (Infraestructura y aplicaciones web)
(4-24)

Contrato IFT/LPN/004/21
Servicio de Análisis de Vulnerabilidades del Instituto Federal de Telecomunicaciones.

Servicio devengado en el mes de abril de 2021',
                'fecha_recepcion' => '2021-05-11',
                'fecha_liberacion' => '2021-05-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75174.30',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-02 09:53:44',
                'updated_at' => '2022-05-02 09:53:44',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            136 => [

                'contrato_id' => 4,
                'no_factura' => 'S 570',
                'concepto' => 'Servicio
Análisis de vulnerabilidades a activos (Infraestructura  y aplicaciones web)
(5-24)

Contrato: IFT/LPN/004/21
Servicio de Vulnerabilidades del Instituto Federal de Telecomunicaciones

Servicios devengados en el mes de mayo 2021',
                'fecha_recepcion' => '2021-06-14',
                'fecha_liberacion' => '2021-06-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75174.30',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-02 10:01:12',
                'updated_at' => '2022-05-02 10:01:12',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            137 => [

                'contrato_id' => 4,
                'no_factura' => 'S 598',
                'concepto' => 'Servicio
Análisis de vulnerabilidades a activos (Infraestructura y aplicaciones web)
(6-24)

Contrato: IFT/LPN/004/21
Servicio de Análisis de Vulnerabilidades del Instituto Federal de Telecomunicaciones

Servicios devengados del mes de junio 2021

',
                'fecha_recepcion' => '2021-07-13',
                'fecha_liberacion' => '2021-07-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75174.30',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-02 10:15:27',
                'updated_at' => '2022-05-02 10:15:27',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            138 => [

                'contrato_id' => 4,
                'no_factura' => 'S 613',
                'concepto' => 'Servicio
Análisis de vulnerabilidades a activos (Infraestructura y aplicaciones web)
(7-24)

Contrato: IFT/LPN/004/21
Servicio de Análisis de Vulnerabilidades del Instituto Federal de Telecomunicaciones

Servicios devengados del mes de julio 2021

',
                'fecha_recepcion' => '2021-08-16',
                'fecha_liberacion' => '2021-08-16',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75174.30',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-02 10:17:43',
                'updated_at' => '2022-05-02 10:17:43',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            139 => [

                'contrato_id' => 4,
                'no_factura' => 'S 630',
                'concepto' => 'Servicio
Análisis de vulnerabilidades a activos (Infraestructura y aplicaciones web)
Respuesta a incidentes y análisis forense
(8-24)

Contrato: IFT/LPN/004/21
Servicio de Análisis de Vulnerabilidades del Instituto Federal de Telecomunicaciones

Servicios devengados del mes de agosto 2021

',
                'fecha_recepcion' => '2021-09-10',
                'fecha_liberacion' => '2021-09-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '230227.89',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-02 10:21:46',
                'updated_at' => '2022-05-02 10:21:46',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            140 => [

                'contrato_id' => 4,
                'no_factura' => 'S 647',
                'concepto' => 'Servicio
Análisis de vulnerabilidades a activos (Infraestructura y aplicaciones web)
(9-24)

Contrato: IFT/LPN/004/21
Servicio de Análisis de Vulnerabilidades del Instituto Federal de Telecomunicaciones

Servicios devengados del mes de septiembre 2021

',
                'fecha_recepcion' => '2021-10-15',
                'fecha_liberacion' => '2021-10-15',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75174.30',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-02 10:31:31',
                'updated_at' => '2022-05-02 10:31:31',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            141 => [

                'contrato_id' => 4,
                'no_factura' => 'S 667',
                'concepto' => 'Servicio
Análisis de vulnerabilidades a activos (Infraestructura y aplicaciones web)
(10-24)

Contrato: IFT/LPN/004/21
Servicio de Análisis de Vulnerabilidades del Instituto Federal de Telecomunicaciones

Servicios devengados del mes de  octubre 2021

',
                'fecha_recepcion' => '2021-11-12',
                'fecha_liberacion' => '2021-11-12',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75174.30',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-02 10:34:07',
                'updated_at' => '2022-05-02 10:34:07',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            142 => [

                'contrato_id' => 4,
                'no_factura' => 'S 706',
                'concepto' => 'Servicio
Análisis de vulnerabilidades a activos (Infraestructura y aplicaciones web)
(11-24)

Contrato: IFT/LPN/004/21
Servicio de Análisis de Vulnerabilidades del Instituto Federal de Telecomunicaciones

Servicios devengados del mes de  noviembre 2021

',
                'fecha_recepcion' => '2021-12-16',
                'fecha_liberacion' => '2021-12-16',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75174.30',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-02 10:37:49',
                'updated_at' => '2022-05-02 10:37:49',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            143 => [

                'contrato_id' => 4,
                'no_factura' => 'S 715',
                'concepto' => 'Servicio
Análisis de vulnerabilidades a activos (Infraestructura y aplicaciones web)
(12-24)

Contrato: IFT/LPN/004/21
Servicio de Análisis de Vulnerabilidades del Instituto Federal de Telecomunicaciones

Servicios devengados del mes de diciembre 2021

',
                'fecha_recepcion' => '2022-01-10',
                'fecha_liberacion' => '2022-01-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75174.30',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-02 10:39:08',
                'updated_at' => '2022-05-02 10:39:08',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            144 => [

                'contrato_id' => 4,
                'no_factura' => 'S 724',
                'concepto' => 'Servicio
Análisis de vulnerabilidades a activos (Infraestructura y aplicaciones web)
(13-24)

Contrato: IFT/LPN/004/21
Servicio de Análisis de Vulnerabilidades del Instituto Federal de Telecomunicaciones

Servicios devengados del mes de enero 2022

',
                'fecha_recepcion' => '2022-02-02',
                'fecha_liberacion' => '2022-02-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75174.30',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-02 10:45:17',
                'updated_at' => '2022-05-02 10:45:17',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            145 => [

                'contrato_id' => 4,
                'no_factura' => 'S 746',
                'concepto' => 'Servicio
Análisis de vulnerabilidades a activos (Infraestructura y aplicaciones web)
(14-24)

Contrato: IFT/LPN/004/21
Servicio de Análisis de Vulnerabilidades del Instituto Federal de Telecomunicaciones

Servicios devengados del mes de febrero 2022

',
                'fecha_recepcion' => '2022-03-09',
                'fecha_liberacion' => '2022-03-09',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75174.30',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-02 10:47:47',
                'updated_at' => '2022-05-02 10:47:47',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            146 => [

                'contrato_id' => 4,
                'no_factura' => 'S 771',
                'concepto' => 'Servicio
Análisis de vulnerabilidades a activos (Infraestructura y aplicaciones web)
(15-24)

Contrato: IFT/LPN/004/21
Servicio de Análisis de Vulnerabilidades del Instituto Federal de Telecomunicaciones

Servicios devengados del mes de marzo 2022

',
                'fecha_recepcion' => '2022-04-09',
                'fecha_liberacion' => '2022-04-09',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75174.30',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-02 10:50:41',
                'updated_at' => '2022-05-02 10:50:41',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            147 => [

                'contrato_id' => 28,
                'no_factura' => 'S 710',
                'concepto' => '1 Servicio
Auditoría de cumplimiento al estándar de normas de seguridad de datos para la industria de tarjetas de pago.

1 Servicio
Auditoría para la evaluación y funcionalidad de los canales electrónicos del servicio de banca electrónica (Banjenet y Banjecel)

Contrato cerrado número DABS-SRM-GA-DPC-115-2021
Relativo a los servicios para realizar auditorías normativas especializadas (Partida 2 y 3)',
                'fecha_recepcion' => '2021-12-19',
                'fecha_liberacion' => '2021-12-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '3909942.40',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-05-19 17:38:27',
                'updated_at' => '2022-05-19 17:38:27',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            148 => [

                'contrato_id' => 29,
                'no_factura' => 'S 711',
                'concepto' => '1 Servicio (Partida 6)
Auditoría en materia de administración de riesgo tecnológico

1 Servicio (Partida8)
Auditoría al sistema de pagos electrónicos interbancarios (SPEI)

1 Servicio (Partida 7)
Auditoría de seguridad informática de banca electrónica (Banjenet y Banjecel)

1 Servicio (Partida 1)
Auditoría de vulnerabilidades a cajeros automáticos

Contrato cerrado número DABS-SRM-GA-DPC-116-2021
Servicios para realizar auditorías normativas especializadas (partida 1,6,7 y 8)

',
                'fecha_recepcion' => '2021-12-29',
                'fecha_liberacion' => '2021-12-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '9623947.42',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-05-19 18:12:36',
                'updated_at' => '2022-05-19 18:12:36',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            149 => [

                'contrato_id' => 26,
                'no_factura' => '4343',
                'concepto' => 'asdasdasd',
                'fecha_recepcion' => '2022-05-18',
                'fecha_liberacion' => '2022-05-27',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '5000.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-20 09:41:23',
                'updated_at' => '2022-05-20 09:42:55',
                'deleted_at' => '2022-05-20 09:42:55',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            150 => [

                'contrato_id' => 18,
                'no_factura' => 'CPB 275',
                'concepto' => '1 Servicio
Servicio de Revisión de Centro de Operaciones de Seguridad

Número de PO 21004006314',
                'fecha_recepcion' => '2021-11-26',
                'fecha_liberacion' => '2021-11-26',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '808279.73',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-20 11:46:04',
                'updated_at' => '2022-05-20 11:46:04',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            151 => [

                'contrato_id' => 20,
                'no_factura' => 'S 628',
                'concepto' => '1 Partida 1 Especialista en Seguridad y Continuidad de Riesgo
1 Partida 1 Hacker Ético
8 Partida 2 Licencias de Antivirus

Servicio de Seguridad de la Información correspondiente a los ejercicios fiscales 2021, 2022 y 2023
Contrato número S-079- 2021

Servicio Agosto 2021

',
                'fecha_recepcion' => '2021-09-10',
                'fecha_liberacion' => '2021-09-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-20 14:29:41',
                'updated_at' => '2022-05-20 14:29:41',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            152 => [

                'contrato_id' => 20,
                'no_factura' => 'S 646',
                'concepto' => '1 Partida 1 Especialista en Seguridad y Continuidad de Riesgo
1 Partida 1 Hacker Ético
8 Partida 2 Licencias de Antivirus

Servicio de Seguridad de la Información correspondiente a los ejercicios fiscales 2021, 2022 y 2023
Contrato número S-079- 2021

Servicio Septiembre 2021

',
                'fecha_recepcion' => '2021-10-15',
                'fecha_liberacion' => '2021-10-15',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-20 14:31:09',
                'updated_at' => '2022-05-20 14:31:09',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            153 => [

                'contrato_id' => 20,
                'no_factura' => 'S 668',
                'concepto' => '1 Partida 1 Especialista en Seguridad y Continuidad de Riesgo
1 Partida 1 Hacker Ético
8 Partida 2 Licencias de Antivirus

Servicio de Seguridad de la Información correspondiente a los ejercicios fiscales 2021, 2022 y 2023
Contrato número S-079- 2021

Servicio Octubre 2021

',
                'fecha_recepcion' => '2021-11-12',
                'fecha_liberacion' => '2021-11-12',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-20 14:38:21',
                'updated_at' => '2022-05-20 14:38:21',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            154 => [

                'contrato_id' => 20,
                'no_factura' => 'S 688',
                'concepto' => '1 Partida 1 Especialista en Seguridad y Continuidad de Riesgo
1 Partida 1 Hacker Ético
8 Partida 2 Licencias de Antivirus

Servicio de Seguridad de la Información correspondiente a los ejercicios fiscales 2021, 2022 y 2023
Contrato número S-079- 2021

Servicio Diciembre 2021

',
                'fecha_recepcion' => '2021-12-06',
                'fecha_liberacion' => '2021-12-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-20 14:41:31',
                'updated_at' => '2022-05-20 14:41:31',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            155 => [

                'contrato_id' => 20,
                'no_factura' => 'S 690',
                'concepto' => '1 Partida 1 Especialista en Seguridad y Continuidad de Riesgo
1 Partida 1 Hacker Ético
8 Partida 2 Licencias de Antivirus

Servicio de Seguridad de la Información correspondiente a los ejercicios fiscales 2021, 2022 y 2023
Contrato número S-079- 2021

Servicio Noviembre 2021

',
                'fecha_recepcion' => '2021-12-06',
                'fecha_liberacion' => '2021-12-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-20 14:43:20',
                'updated_at' => '2022-05-20 14:43:20',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            156 => [

                'contrato_id' => 20,
                'no_factura' => 'S 729',
                'concepto' => '1 Partida 1 Especialista en Seguridad y Continuidad de Riesgo
1 Partida 1 Hacker Ético
8 Partida 2 Licencias de Antivirus

Servicio de Seguridad de la Información correspondiente a los ejercicios fiscales 2021, 2022 y 2023
Contrato número S-079- 2021

Servicio Enero 2022

',
                'fecha_recepcion' => '2022-02-14',
                'fecha_liberacion' => '2022-02-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-20 14:48:03',
                'updated_at' => '2022-05-20 14:48:03',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            157 => [

                'contrato_id' => 20,
                'no_factura' => 'S 745',
                'concepto' => '1 Partida 1 Especialista en Seguridad y Continuidad de Riesgo
1 Partida 1 Hacker Ético
8 Partida 2 Licencias de Antivirus

Servicio de Seguridad de la Información correspondiente a los ejercicios fiscales 2021, 2022 y 2023
Contrato número S-079- 2021

Servicio Febrero 2022

',
                'fecha_recepcion' => '2022-03-08',
                'fecha_liberacion' => '2022-03-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-20 14:51:58',
                'updated_at' => '2022-05-20 14:51:58',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            158 => [

                'contrato_id' => 20,
                'no_factura' => 'S 767',
                'concepto' => '1 Partida 1 Especialista en Seguridad y Continuidad de Riesgo
1 Partida 1 Hacker Ético
8 Partida 2 Licencias de Antivirus

Servicio de Seguridad de la Información correspondiente a los ejercicios fiscales 2021, 2022 y 2023
Contrato número S-079- 2021

Servicio Marzo 2022

',
                'fecha_recepcion' => '2022-04-08',
                'fecha_liberacion' => '2022-04-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-20 14:53:35',
                'updated_at' => '2022-05-20 14:53:35',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            159 => [

                'contrato_id' => 27,
                'no_factura' => 'C 59',
                'concepto' => 'Servicio de Prueba de Penetración a aplicaciones móviles

Pedido 5500248874
',
                'fecha_recepcion' => '2021-12-01',
                'fecha_liberacion' => '2021-12-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '289850.36',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-05-20 17:39:11',
                'updated_at' => '2022-05-20 17:39:11',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            160 => [

                'contrato_id' => 31,
                'no_factura' => 'CPB 276',
                'concepto' => '1 Servicio
Servicio de Pruebas de Penetración
Orden de Servicio # 03',
                'fecha_recepcion' => '2021-11-29',
                'fecha_liberacion' => '2021-11-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '235006.35',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-05-25 10:50:21',
                'updated_at' => '2022-05-25 10:50:21',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            161 => [

                'contrato_id' => 9,
                'no_factura' => 'S 761',
                'concepto' => 'Servicio correspondiente al mes de Marzo 2022

1 Servicio
Servicio de FW ALTERNO (32 de 41.5 meses de servicio)

1 Servicio
Servicio de FW SITIO CENTRAL (30 de 39 meses de servicio)

1 Servicio
Servicio Administrado de Centro de Operaciones de Seguridad (7x24) (32 de 41.5 meses de servicio)

1 Servicio
Servicio de WAF (27 de 36 meses de servicio)',
                'fecha_recepcion' => '2022-04-22',
                'fecha_liberacion' => '2022-04-22',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-27 11:37:24',
                'updated_at' => '2022-05-27 11:37:24',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            162 => [

                'contrato_id' => 17,
                'no_factura' => 'S 374',
                'concepto' => 'Mes Enero 2020

Servicio
Soporte técnico de la solución en un horario de 24x7x365. Contrato número ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2020-02-25',
                'fecha_liberacion' => '2020-02-25',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 11:39:32',
                'updated_at' => '2022-05-31 11:39:32',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            163 => [

                'contrato_id' => 17,
                'no_factura' => 'S 375',
                'concepto' => 'Renovación de licencias 2020

Servicio
11. Renovación de la licencia Mcaffe Enterprise Threat Protection. Contrato No. ASF-UGA-DAJ-DGS-003/2020

Servicio
2. Renovación de la licencia Mcaffe Virus Scan for Storage. Contrato No. ASF-UGA-DAJ-DGS-003/2020',
                'fecha_recepcion' => '2020-02-25',
                'fecha_liberacion' => '2020-02-25',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '28348.68',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 11:49:12',
                'updated_at' => '2022-05-31 11:56:37',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            164 => [

                'contrato_id' => 17,
                'no_factura' => 'S 382',
                'concepto' => 'Mes Febrero 2020

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2020-03-09',
                'fecha_liberacion' => '2020-03-09',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 12:24:11',
                'updated_at' => '2022-05-31 12:24:11',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            165 => [

                'contrato_id' => 17,
                'no_factura' => 'S 387',
                'concepto' => 'Mes Marzo 020

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2020-04-06',
                'fecha_liberacion' => '2020-04-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 12:25:25',
                'updated_at' => '2022-05-31 12:25:25',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            166 => [

                'contrato_id' => 17,
                'no_factura' => 'S 393',
                'concepto' => 'Mes Abril  2020

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2020-05-14',
                'fecha_liberacion' => '2020-05-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 12:26:25',
                'updated_at' => '2022-05-31 12:26:25',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            167 => [

                'contrato_id' => 17,
                'no_factura' => ' S 406',
                'concepto' => 'Mes Mayo 2020

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2020-06-03',
                'fecha_liberacion' => '2020-06-03',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 12:27:48',
                'updated_at' => '2022-05-31 12:27:48',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            168 => [

                'contrato_id' => 17,
                'no_factura' => 'S 412',
                'concepto' => 'Mes Junio 2020

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2020-07-02',
                'fecha_liberacion' => '2020-07-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 12:29:18',
                'updated_at' => '2022-05-31 12:29:18',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            169 => [

                'contrato_id' => 17,
                'no_factura' => 'S 417',
                'concepto' => 'Mes Julio 2020

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2020-08-04',
                'fecha_liberacion' => '2020-08-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 12:30:53',
                'updated_at' => '2022-05-31 12:41:26',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            170 => [

                'contrato_id' => 17,
                'no_factura' => 'S 440',
                'concepto' => 'Mes Agosto 2020

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2020-09-04',
                'fecha_liberacion' => '2020-09-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 12:32:38',
                'updated_at' => '2022-05-31 12:32:38',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            171 => [

                'contrato_id' => 17,
                'no_factura' => 'S 447',
                'concepto' => 'Mes Septiembre 2020

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2020-10-02',
                'fecha_liberacion' => '2020-10-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 12:38:31',
                'updated_at' => '2022-05-31 12:38:31',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            172 => [

                'contrato_id' => 17,
                'no_factura' => 'S 464',
                'concepto' => 'Mes Octubre 2020

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2020-11-02',
                'fecha_liberacion' => '2022-11-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 12:39:37',
                'updated_at' => '2022-05-31 12:39:37',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            173 => [

                'contrato_id' => 17,
                'no_factura' => 'S 474',
                'concepto' => 'Mes Noviembre 2020

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2020-12-01',
                'fecha_liberacion' => '2020-12-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 12:40:55',
                'updated_at' => '2022-05-31 12:40:55',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            174 => [

                'contrato_id' => 17,
                'no_factura' => 'S 497',
                'concepto' => 'Mes Diciembre 2020

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2020-12-30',
                'fecha_liberacion' => '2020-12-30',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 12:43:06',
                'updated_at' => '2022-05-31 12:43:06',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            175 => [

                'contrato_id' => 17,
                'no_factura' => 'S 501',
                'concepto' => 'Renovación Licencias 2021

11 Renovación de la licencia de Mcaffe Threat Protection
2 Renovación de la licencia de Mcaffe Virus Scan for Storage',
                'fecha_recepcion' => '2021-01-11',
                'fecha_liberacion' => '2021-01-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '28348.68',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 13:05:44',
                'updated_at' => '2022-05-31 13:05:44',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            176 => [

                'contrato_id' => 17,
                'no_factura' => 'S 508',
                'concepto' => 'Mes Enero 2021

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2021-02-04',
                'fecha_liberacion' => '2021-02-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 13:07:03',
                'updated_at' => '2022-05-31 13:07:03',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            177 => [

                'contrato_id' => 17,
                'no_factura' => 'S 521',
                'concepto' => 'Mes Febrero 2021

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2021-03-01',
                'fecha_liberacion' => '2021-03-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 13:08:30',
                'updated_at' => '2022-05-31 13:08:30',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            178 => [

                'contrato_id' => 17,
                'no_factura' => 'S 539',
                'concepto' => 'Mes Marzo 2021

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2021-04-01',
                'fecha_liberacion' => '2021-04-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 13:13:44',
                'updated_at' => '2022-05-31 13:13:44',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            179 => [

                'contrato_id' => 17,
                'no_factura' => 'S 549',
                'concepto' => 'Mes Abril 2021

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2021-05-03',
                'fecha_liberacion' => '2021-05-03',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 13:15:02',
                'updated_at' => '2022-05-31 13:15:02',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            180 => [

                'contrato_id' => 17,
                'no_factura' => 'S 564',
                'concepto' => 'Mes Mayo 2021

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2021-06-01',
                'fecha_liberacion' => '2021-06-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 13:16:12',
                'updated_at' => '2022-05-31 13:16:12',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            181 => [

                'contrato_id' => 17,
                'no_factura' => 'S 588',
                'concepto' => 'Mes Junio 2021

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2021-07-01',
                'fecha_liberacion' => '2021-07-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 13:24:05',
                'updated_at' => '2022-05-31 13:24:05',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            182 => [

                'contrato_id' => 17,
                'no_factura' => 'S 604',
                'concepto' => 'Mes Julio 2021

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2021-08-02',
                'fecha_liberacion' => '2021-08-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 13:26:28',
                'updated_at' => '2022-05-31 13:26:28',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            183 => [

                'contrato_id' => 17,
                'no_factura' => 'S 618',
                'concepto' => 'Mes Agosto 2021

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2021-09-01',
                'fecha_liberacion' => '2021-09-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 13:27:52',
                'updated_at' => '2022-05-31 13:27:52',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            184 => [

                'contrato_id' => 17,
                'no_factura' => 'S 640',
                'concepto' => 'Mes Septiembre 2021

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2021-10-01',
                'fecha_liberacion' => '2021-10-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 13:30:35',
                'updated_at' => '2022-05-31 13:30:35',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            185 => [

                'contrato_id' => 17,
                'no_factura' => 'S 657',
                'concepto' => 'Mes Octubre 2021

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2021-11-02',
                'fecha_liberacion' => '2021-11-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 13:32:05',
                'updated_at' => '2022-05-31 13:32:05',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            186 => [

                'contrato_id' => 17,
                'no_factura' => 'S 687',
                'concepto' => 'Mes Noviembre 2021

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2021-12-03',
                'fecha_liberacion' => '2021-12-03',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 13:33:23',
                'updated_at' => '2022-05-31 13:33:23',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            187 => [

                'contrato_id' => 17,
                'no_factura' => 'CPB 329',
                'concepto' => 'Mes Diciembre 2021

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2021-12-30',
                'fecha_liberacion' => '2021-12-30',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.54',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 13:34:40',
                'updated_at' => '2022-05-31 13:34:40',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            188 => [

                'contrato_id' => 17,
                'no_factura' => 'S 712',
                'concepto' => 'Renovación licencias 2022

11. Renovación de la licencia de Mcaffe Enterprise Threat Protection. Contrato No. ASF-UGA-DAJ-DGS-003-2020

2. Renovación de la licencia de Mcaffe Virus Scan Storage. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2022-01-04',
                'fecha_liberacion' => '2022-01-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '28348.68',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 13:39:59',
                'updated_at' => '2022-05-31 13:39:59',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            189 => [

                'contrato_id' => 17,
                'no_factura' => 'CPB 344',
                'concepto' => 'Mes Enero 2022

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2022-02-02',
                'fecha_liberacion' => '2022-02-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 13:43:02',
                'updated_at' => '2022-05-31 13:43:02',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            190 => [

                'contrato_id' => 17,
                'no_factura' => 'S 737',
                'concepto' => 'Mes Febrero 2022

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2022-03-01',
                'fecha_liberacion' => '2022-03-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 13:44:18',
                'updated_at' => '2022-05-31 13:44:18',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            191 => [

                'contrato_id' => 17,
                'no_factura' => 'S 759',
                'concepto' => 'Mes Marzo 2022

Servicio de Soporte Técnico de la solución en un horario de 24x7x365. Contrato No. ASF-UGA-DAJ-DGS-003-2020',
                'fecha_recepcion' => '2022-04-04',
                'fecha_liberacion' => '2022-04-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 13:45:26',
                'updated_at' => '2022-05-31 13:45:26',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            192 => [

                'contrato_id' => 22,
                'no_factura' => 'S 655',
                'concepto' => 'Julio 2021

Servicio Mensual del SOC
Servicio del 7 al 31 de julio de 2021',
                'fecha_recepcion' => '2021-10-27',
                'fecha_liberacion' => '2021-10-27',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '44630.43',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 14:30:19',
                'updated_at' => '2022-05-31 14:30:19',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            193 => [

                'contrato_id' => 22,
                'no_factura' => 'S 622',
                'concepto' => 'Agosto 2021

Servicio Mensual del SOC
Servicio Agosto (1 de 6)',
                'fecha_recepcion' => '2021-09-02',
                'fecha_liberacion' => '2021-09-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '55341.73',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 14:32:08',
                'updated_at' => '2022-05-31 14:32:08',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            194 => [

                'contrato_id' => 22,
                'no_factura' => 'S 643',
                'concepto' => 'Septiembre 2021

Servicio Mensual de SOC
Servicio Septiembre (2-6)',
                'fecha_recepcion' => '2021-10-05',
                'fecha_liberacion' => '2021-10-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '55341.73',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 14:34:58',
                'updated_at' => '2022-05-31 14:34:58',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            195 => [

                'contrato_id' => 22,
                'no_factura' => 'S 662',
                'concepto' => 'Octubre 2021

Servicio Mensual SOC
Servicio Octubre (3-6)
',
                'fecha_recepcion' => '2021-11-08',
                'fecha_liberacion' => '2021-11-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '55341.73',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 14:41:06',
                'updated_at' => '2022-05-31 14:41:06',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            196 => [

                'contrato_id' => 26,
                'no_factura' => 'S 674',
                'concepto' => 'Servicio Noviembre 2021
Contrato No. 2021-A-L-NAC-P-C-06-HKA-0000461

Servicio administrado de monitoreo y correlación de eventos de seguridad (S1)
Equipo de respuesta ante incidentes de seguridad computacional (S2)
Servicio administrado de una solución de seguridad para equipos (S3)
Servicio de Ciberinteligencia, análisis de vulnerabilidades, pruebas de penetración y verificación de suficiencia de controles de seguridad (S4)
Servicio de despliegue y monitoreo de una consola de antivirus de tipo Enterprise (S5)',
                'fecha_recepcion' => '2021-12-01',
                'fecha_liberacion' => '2021-12-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '225277.25',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 15:09:35',
                'updated_at' => '2022-05-31 15:09:35',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            197 => [

                'contrato_id' => 26,
                'no_factura' => 'S 675',
                'concepto' => 'Servicio Diciembre 2021
Contrato No. 2021-A-L-NAC-P-C-06-HKA-0000461

Servicio administrado de monitoreo y correlación de eventos de seguridad (S1)
Equipo de respuesta ante incidentes de seguridad computacional (S2)
Servicio administrado de una solución de seguridad para equipos (S3)
Servicio de Ciberinteligencia, análisis de vulnerabilidades, pruebas de penetración y verificación de suficiencia de controles de seguridad (S4)
Servicio de despliegue y monitoreo de una consola de antivirus de tipo Enterprise (S5)',
                'fecha_recepcion' => '2021-12-01',
                'fecha_liberacion' => '2021-12-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '225277.25',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 15:16:17',
                'updated_at' => '2022-05-31 15:16:17',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            198 => [

                'contrato_id' => 26,
                'no_factura' => 'S 728',
                'concepto' => 'Servicio Enero 2022
Contrato No. 2021-A-L-NAC-P-C-06-HKA-0000461

Servicio administrado de monitoreo y correlación de eventos de seguridad (S1)
Equipo de respuesta ante incidentes de seguridad computacional (S2)
Servicio administrado de una solución de seguridad para equipos (S3)
Servicio de Ciberinteligencia, análisis de vulnerabilidades, pruebas de penetración y verificación de suficiencia de controles de seguridad (S4)
Servicio de despliegue y monitoreo de una consola de antivirus de tipo Enterprise (S5)',
                'fecha_recepcion' => '2022-02-14',
                'fecha_liberacion' => '2022-02-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '225277.25',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 15:17:37',
                'updated_at' => '2022-05-31 15:17:37',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            199 => [

                'contrato_id' => 26,
                'no_factura' => 'S 750',
                'concepto' => 'Servicio Febrero 2022
Contrato No. 2021-A-L-NAC-P-C-06-HKA-0000461

Servicio administrado de monitoreo y correlación de eventos de seguridad (S1)
Equipo de respuesta ante incidentes de seguridad computacional (S2)
Servicio administrado de una solución de seguridad para equipos (S3)
Servicio de Ciberinteligencia, análisis de vulnerabilidades, pruebas de penetración y verificación de suficiencia de controles de seguridad (S4)
Servicio de despliegue y monitoreo de una consola de antivirus de tipo Enterprise (S5)',
                'fecha_recepcion' => '2022-03-11',
                'fecha_liberacion' => '2022-03-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '225277.25',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 15:21:32',
                'updated_at' => '2022-05-31 15:21:32',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            200 => [

                'contrato_id' => 26,
                'no_factura' => 'S 768',
                'concepto' => 'Servicio Marzo 2022
Contrato No. 2021-A-L-NAC-P-C-06-HKA-0000461

Servicio administrado de monitoreo y correlación de eventos de seguridad (S1)
Equipo de respuesta ante incidentes de seguridad computacional (S2)
Servicio administrado de una solución de seguridad para equipos (S3)
Servicio de Ciberinteligencia, análisis de vulnerabilidades, pruebas de penetración y verificación de suficiencia de controles de seguridad (S4)
Servicio de despliegue y monitoreo de una consola de antivirus de tipo Enterprise (S5)',
                'fecha_recepcion' => '2022-04-12',
                'fecha_liberacion' => '2022-04-12',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '225277.25',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 15:22:47',
                'updated_at' => '2022-05-31 15:22:47',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            201 => [

                'contrato_id' => 26,
                'no_factura' => 'S 800',
                'concepto' => 'Servicio Abril 2022
Contrato No. 2021-A-L-NAC-P-C-06-HKA-0000461

Servicio administrado de monitoreo y correlación de eventos de seguridad (S1)
Equipo de respuesta ante incidentes de seguridad computacional (S2)
Servicio administrado de una solución de seguridad para equipos (S3)
Servicio de Ciberinteligencia, análisis de vulnerabilidades, pruebas de penetración y verificación de suficiencia de controles de seguridad (S4)
Servicio de despliegue y monitoreo de una consola de antivirus de tipo Enterprise (S5)',
                'fecha_recepcion' => '2022-05-13',
                'fecha_liberacion' => '2022-05-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '225277.25',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 15:24:12',
                'updated_at' => '2022-05-31 15:24:12',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            202 => [

                'contrato_id' => 21,
                'no_factura' => 'S 801',
                'concepto' => 'Póliza de licenciamiento, soporte y mantenimiento que ampara la vigencia del contrato número CT-0758-21 (2).

Partida 2.- Licenciamiento, soporte y mantenimiento para plataforma IMPERVA.
Núm.. pago 1 de 1
Periodo 24-12-2021 al 23-12-2022

Entregable:
Póliza que ampara el licenciamiento, soporte y mantenimiento que amparen la vigencia del contrato.
Plan de trabajo autorizado',
                'fecha_recepcion' => '2022-05-16',
                'fecha_liberacion' => '2022-05-16',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '4842468.54',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 15:44:19',
                'updated_at' => '2022-05-31 15:44:19',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            203 => [

                'contrato_id' => 19,
                'no_factura' => 'S 731',
                'concepto' => 'Enero 2022
Mensualidad 1 de 12

Consecutivo 1.- Servicio de Ciberamenazas avanzadas y visibilidad en la red a través de la red del engaño.
Consecutivo 2.- Servicio de correlación de eventos de seguridad.
Consecutivo 3.- Servicio de Ciber inteligencia de amenazas.
Consecutivo 4.- Servicio Administrado de Centro de Operaciones de Seguridad (SOC) y Centro de Operaciones de Red (NOC) 7X24X365.
Consecutivo 5.- Servicio de análisis de vulnerabilidades y pruebas de penetración.',
                'fecha_recepcion' => '2022-02-17',
                'fecha_liberacion' => '2022-02-17',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '6413350.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 17:09:10',
                'updated_at' => '2022-05-31 17:09:10',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            204 => [

                'contrato_id' => 19,
                'no_factura' => 'S 755',
                'concepto' => 'Febrero 2022
Mensualidad 2 de 12

Consecutivo 1.- Servicio de Ciberamenazas avanzadas y visibilidad en la red a través de la red del engaño.
Consecutivo 2.- Servicio de correlación de eventos de seguridad.
Consecutivo 3.- Servicio de Ciber inteligencia de amenazas.
Consecutivo 4.- Servicio Administrado de Centro de Operaciones de Seguridad (SOC) y Centro de Operaciones de Red (NOC) 7X24X365.
Consecutivo 5.- Servicio de análisis de vulnerabilidades y pruebas de penetración.',
                'fecha_recepcion' => '2022-03-23',
                'fecha_liberacion' => '2022-03-23',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '6413350.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 17:14:09',
                'updated_at' => '2022-05-31 17:14:09',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            205 => [

                'contrato_id' => 19,
                'no_factura' => 'S 773',
                'concepto' => 'Marzo 2022
Mensualidad 3 de 12

Consecutivo 1.- Servicio de Ciberamenazas avanzadas y visibilidad en la red a través de la red del engaño.
Consecutivo 2.- Servicio de correlación de eventos de seguridad.
Consecutivo 3.- Servicio de Ciber inteligencia de amenazas.
Consecutivo 4.- Servicio Administrado de Centro de Operaciones de Seguridad (SOC) y Centro de Operaciones de Red (NOC) 7X24X365.
Consecutivo 5.- Servicio de análisis de vulnerabilidades y pruebas de penetración.',
                'fecha_recepcion' => '2022-04-19',
                'fecha_liberacion' => '2022-04-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '6413350.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 17:15:38',
                'updated_at' => '2022-05-31 17:15:38',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            206 => [

                'contrato_id' => 19,
                'no_factura' => 'S 803',
                'concepto' => 'Abril 2022
Mensualidad 4 de 12

Consecutivo 1.- Servicio de Ciberamenazas avanzadas y visibilidad en la red a través de la red del engaño.
Consecutivo 2.- Servicio de correlación de eventos de seguridad.
Consecutivo 3.- Servicio de Ciber inteligencia de amenazas.
Consecutivo 4.- Servicio Administrado de Centro de Operaciones de Seguridad (SOC) y Centro de Operaciones de Red (NOC) 7X24X365.
Consecutivo 5.- Servicio de análisis de vulnerabilidades y pruebas de penetración.',
                'fecha_recepcion' => '2022-05-17',
                'fecha_liberacion' => '2022-05-17',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '6413350.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 17:17:16',
                'updated_at' => '2022-05-31 17:17:16',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            207 => [

                'contrato_id' => 30,
                'no_factura' => 'S 722',
                'concepto' => 'Enero 2022

5 Servicio
Póliza de servicio de mantenimiento para 2 (dos) balanceadores configurados en HA',
                'fecha_recepcion' => '2022-02-02',
                'fecha_liberacion' => '2022-02-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '236751.36',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 17:58:02',
                'updated_at' => '2022-05-31 17:58:02',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            208 => [

                'contrato_id' => 30,
                'no_factura' => 'S 751',
                'concepto' => 'Febrero  2022

5 Servicio
Póliza de servicio de mantenimiento para 2 (dos) balanceadores configurados en HA',
                'fecha_recepcion' => '2022-03-14',
                'fecha_liberacion' => '2022-03-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '236751.36',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 17:59:52',
                'updated_at' => '2022-05-31 17:59:52',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            209 => [

                'contrato_id' => 30,
                'no_factura' => 'S 760',
                'concepto' => 'Marzo 2022

5 Servicio
Póliza de servicio de mantenimiento para 2 (dos) balanceadores configurados en HA',
                'fecha_recepcion' => '2022-04-05',
                'fecha_liberacion' => '2022-04-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '236751.36',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-05-31 18:01:12',
                'updated_at' => '2022-05-31 18:01:12',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            210 => [

                'contrato_id' => 20,
                'no_factura' => 'S 792',
                'concepto' => 'Servicio Abril

Partida 1. Especialista en Seguridad y Continuidad de Riesgo
Partida 1. Hacker ético
Partida 2. Licencias de Antivirus.',
                'fecha_recepcion' => '2022-05-06',
                'fecha_liberacion' => '2022-05-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-06-03 10:35:41',
                'updated_at' => '2022-06-03 10:35:41',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            211 => [

                'contrato_id' => 2,
                'no_factura' => 'S 12',
                'concepto' => 'Servicio correspondiente al mes de abril 2018

1 Servicio. Sistema de Gestión de la Seguridad de la Información
1 Servicio. Servicios Administrado de Centro de Operaciones de Seguridad (SOC) 7x24 durante la vigencia del contrato.
1 Servicio. Servicio de Firewall
1 Servicio. Servicio de Navegación Segura
1 Servicio. Servicio de Prevención de Incidentes (IPS)
1 Servicio. Servicio de Seguridad para el electrónico institucional
1 Servicio. Servicio de Antivirus a locales.

Contrato Número SE-25/2018',
                'fecha_recepcion' => '2018-06-06',
                'fecha_liberacion' => '2018-06-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '629319.85',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-06 12:43:49',
                'updated_at' => '2022-06-06 12:54:04',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            212 => [

                'contrato_id' => 2,
                'no_factura' => 'S 14',
                'concepto' => 'Servicio correspondiente al mes de mayo 2018.

1 Servicio. Sistema Gestión de Seguridad de la Información.
1 Servicio. Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7x24 durante la vigencia del contrato.
1 Servicio. Servicio de Firewall.
1 Servicio. Servicio de Navegación Segura.
1 Servicio. Servicio de Protección de Pérdida de la información  y Fuga de la Información.
1 Servicio. Servicio de Prevención de Incidentes (IPS).
1 Servicio. Servicio de Seguridad para el correo electrónico institucional.
1 Servicio de Antivirus a estaciones locales.

Contrato número SE-25/2018',
                'fecha_recepcion' => '2018-06-20',
                'fecha_liberacion' => '2018-06-20',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '690883.75',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-06 12:51:24',
                'updated_at' => '2022-06-06 12:52:40',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            213 => [

                'contrato_id' => 2,
                'no_factura' => 'S 15',
                'concepto' => 'Nota de crédito al contrato SE-25/2018 correspondiente del mes de mayo de 2018 por los siguientes servicios:

1 Servicio. Servicio de Firewall
1 Servicio. Servicio de Servicio para el correo electrónico institucional',
                'fecha_recepcion' => '2018-06-20',
                'fecha_liberacion' => '2018-06-20',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '68883.16',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-06 12:58:54',
                'updated_at' => '2022-06-06 13:41:20',
                'deleted_at' => '2022-06-06 13:41:20',
                'created_by' => 10,
                'updated_by' => 10,
            ],
            214 => [

                'contrato_id' => 2,
                'no_factura' => 'S 17',
                'concepto' => 'Servicio correspondiente al mes de junio 2018

1 Servicio. Servicio de Gestión de Seguridad de la Información
1 Servicio. Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7x24 durante la vigencia del contrato
1 Servicio. Servicio de Firewall
1 Servicio. Servicio de Navegación Segura.
1 Servicio. Servicio de Protección de Perdida de Información y fuga de la información
1 Servicio.  Servicio de Prevención de Incidentes (IPS)
1 Servicio.  Servicio de Seguridad para el correo electrónico institucional.
1 Servicio. Servicio de Antivirus a estaciones locales.

Contrato número SE-25/2018
',
                'fecha_recepcion' => '2018-07-05',
                'fecha_liberacion' => '2018-07-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '690883.75',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-06 13:07:38',
                'updated_at' => '2022-06-06 13:07:38',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            215 => [

                'contrato_id' => 2,
                'no_factura' => 'S 13',
                'concepto' => 'Nota de Crédito al contrato número SE-25/2018 correspondiente al mes de abril de 2018, por lo siguientes servicios:

1 Servicio Servicio de Navegación Segura',
                'fecha_recepcion' => '2018-06-20',
                'fecha_liberacion' => '2018-06-20',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '8099.07',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-06 13:17:14',
                'updated_at' => '2022-06-06 13:42:17',
                'deleted_at' => '2022-06-06 13:42:17',
                'created_by' => 10,
                'updated_by' => 10,
            ],
            216 => [

                'contrato_id' => 2,
                'no_factura' => 'S 25',
                'concepto' => 'Servicio correspondiente al mes de julio 2018

1 Servicio. Servicio de Gestión de Seguridad de la Información
1 Servicio. Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7x24 durante la vigencia del contrato
1 Servicio. Servicio de Firewall
1 Servicio. Servicio de Navegación Segura.
1 Servicio. Servicio de Protección de Perdida de Información y fuga de la información
1 Servicio.  Servicio de Prevención de Incidentes (IPS)
1 Servicio.  Servicio de Seguridad para el correo electrónico institucional.
1 Servicio. Servicio de Antivirus a estaciones locales.

Contrato número SE-25/2018',
                'fecha_recepcion' => '2018-10-08',
                'fecha_liberacion' => '2018-10-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '690883.75',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-06 13:25:19',
                'updated_at' => '2022-06-06 13:25:19',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            217 => [

                'contrato_id' => 2,
                'no_factura' => 'S 77',
                'concepto' => 'Servicio correspondiente al mes de septiembre 2018

1 Servicio. Servicio de Gestión de Seguridad de la Información
1 Servicio. Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7x24 durante la vigencia del contrato
1 Servicio. Servicio de Firewall
1 Servicio. Servicio de Navegación Segura.
1 Servicio. Servicio de Protección de Perdida de Información y fuga de la información
1 Servicio.  Servicio de Prevención de Incidentes (IPS)
1 Servicio.  Servicio de Seguridad para el correo electrónico institucional.
1 Servicio. Servicio de Antivirus a estaciones locales.

Contrato número SE-25/2018',
                'fecha_recepcion' => '2018-09-10',
                'fecha_liberacion' => '2018-09-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '690883.75',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-06 13:29:07',
                'updated_at' => '2022-06-06 13:29:07',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            218 => [

                'contrato_id' => 2,
                'no_factura' => 'S 176',
                'concepto' => 'Servicio correspondiente al mes de enero 2019

1 Servicio. Sistema de Gestión de Seguridad de la Información
1 Servicio. Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24 durante la vigencia del contrato
1 Servicio. Servicio Firewall
1 Servicio. Servicio de Navegación Segura
1 Servicio. Servicio de Protección de Perdida de Información y Fuga de la Información
1 Servicio. Servicio de Prevención de Incidentes (IPS)
1 Servicio. Servicio de Seguridad para el correo electrónico institucional
1 Servicio. Servicio de Archivos a estaciones locales

Contrato número SE-25/2018',
                'fecha_recepcion' => '2019-02-08',
                'fecha_liberacion' => '2019-02-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '690883.75',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-06 16:29:49',
                'updated_at' => '2022-06-06 16:29:49',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            219 => [

                'contrato_id' => 2,
                'no_factura' => 'S 32',
                'concepto' => 'Servicio correspondiente al mes de agosto 2019

1 Servicio. Sistema de Gestión de Seguridad de la Información
1 Servicio. Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24 durante la vigencia del contrato
1 Servicio. Servicio Firewall
1 Servicio. Servicio de Navegación Segura
1 Servicio. Servicio de Protección de Perdida de Información y Fuga de la Información
1 Servicio. Servicio de Prevención de Incidentes (IPS)
1 Servicio. Servicio de Seguridad para el correo electrónico institucional
1 Servicio. Servicio de Archivos a estaciones locales

Contrato número SE-25/2018',
                'fecha_recepcion' => '2018-09-10',
                'fecha_liberacion' => '2018-09-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '690883.75',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-06 16:33:35',
                'updated_at' => '2022-06-06 16:33:35',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            220 => [

                'contrato_id' => 3,
                'no_factura' => 'S 562',
                'concepto' => 'ESTIMACIÓN 7:DEL 13 DE NOVIEMBRE AL 12 DE DICIEMBRE 2020.',
                'fecha_recepcion' => '2021-05-21',
                'fecha_liberacion' => '2021-05-21',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '67635.51',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-06-07 09:03:39',
                'updated_at' => '2022-06-07 09:03:39',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            221 => [

                'contrato_id' => 17,
                'no_factura' => 'S 785',
                'concepto' => 'Periodo: Abril 2022.',
                'fecha_recepcion' => '2022-05-02',
                'fecha_liberacion' => '2022-05-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-06-07 10:12:16',
                'updated_at' => '2022-06-07 10:12:16',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            222 => [

                'contrato_id' => 17,
                'no_factura' => 'S 813',
                'concepto' => 'Periodo: Mayo 2022.',
                'fecha_recepcion' => '2022-06-02',
                'fecha_liberacion' => '2022-06-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-06-07 10:13:26',
                'updated_at' => '2022-06-07 10:13:26',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            223 => [

                'contrato_id' => 3,
                'no_factura' => 'S 806',
                'concepto' => 'Estimación: Del 13 de abril al 12 mayo 2022.',
                'fecha_recepcion' => '2022-05-23',
                'fecha_liberacion' => '2022-05-23',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '67635.49',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-06-07 10:16:26',
                'updated_at' => '2022-06-07 10:16:26',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            224 => [

                'contrato_id' => 5,
                'no_factura' => 'S 774',
                'concepto' => 'Servicio 3 de 26

122_BMV_SERVICIOS DE CYBER THREAT Y ATAQUES DE SEGURID',
                'fecha_recepcion' => '2022-04-19',
                'fecha_liberacion' => '2022-04-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '199745.55',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-06-07 10:19:59',
                'updated_at' => '2022-06-07 10:19:59',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            225 => [

                'contrato_id' => 5,
                'no_factura' => 'S 812',
                'concepto' => 'Servicio 4 de 26

122_BMV_SERVICIOS DE CYBER THREAT Y ATAQUES DE SEGURID',
                'fecha_recepcion' => '2022-05-27',
                'fecha_liberacion' => '2022-05-27',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '199745.55',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-06-07 10:20:57',
                'updated_at' => '2022-06-07 10:20:57',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            226 => [

                'contrato_id' => 9,
                'no_factura' => 'S 795',
                'concepto' => 'Servicio abril 2022.

56_ROYAL HOLIDAY -IMPLEMENTACIÓN MACFEE Y F5',
                'fecha_recepcion' => '2022-05-09',
                'fecha_liberacion' => '2022-05-09',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-06-07 10:24:23',
                'updated_at' => '2022-06-07 10:24:23',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            227 => [

                'contrato_id' => 9,
                'no_factura' => 'S 819',
                'concepto' => 'Servicio mayo 2022.

56_ROYAL HOLIDAY -IMPLEMENTACIÓN MACFEE Y F5',
                'fecha_recepcion' => '2022-06-06',
                'fecha_liberacion' => '2022-06-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-06-07 10:25:29',
                'updated_at' => '2022-06-07 10:25:29',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            228 => [

                'contrato_id' => 41,
                'no_factura' => 'S 543',
                'concepto' => 'Servicio Profesional, Asesoría Técnica Aspel

Servicio de Seguridad, Pentest y Vulnerabilidades

Orden número 388
Proveedor 274',
                'fecha_recepcion' => '2021-04-07',
                'fecha_liberacion' => '2021-04-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '185079.28',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-10 10:23:31',
                'updated_at' => '2022-06-15 11:36:21',
                'deleted_at' => '2022-06-15 11:36:21',
                'created_by' => 10,
                'updated_by' => 10,
            ],
            229 => [

                'contrato_id' => 36,
                'no_factura' => 'S 524',
                'concepto' => 'Servicio 1 de 12

2 Póliza se servicio de mantenimiento para 2 balanceadores configuradas en HA
1 Póliza de servicio de mantenimiento para 2 servidores de la marca DELL
2 Póliza de servicio de mantenimiento para 2 pólizas de servicio de mantenimiento para 2 equipos de la marca RADWARE configuradas en HA',
                'fecha_recepcion' => '2021-03-02',
                'fecha_liberacion' => '2021-03-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '229960.24',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-16 08:37:19',
                'updated_at' => '2022-06-16 08:38:27',
                'deleted_at' => '2022-06-16 08:38:27',
                'created_by' => 10,
                'updated_by' => 10,
            ],
            230 => [

                'contrato_id' => 33,
                'no_factura' => 'S 524',
                'concepto' => 'Servicio 1 de 12

2 Póliza se servicio de mantenimiento para 2 balanceadores configuradas en HA
1 Póliza de servicio de mantenimiento para 2 servidores de la marca DELL
2 Póliza de servicio de mantenimiento para 2 pólizas de servicio de mantenimiento para 2 equipos de la marca RADWARE configuradas en HA',
                'fecha_recepcion' => '2021-03-02',
                'fecha_liberacion' => '2021-03-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '229960.24',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-16 08:40:01',
                'updated_at' => '2022-06-16 08:40:01',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            231 => [

                'contrato_id' => 33,
                'no_factura' => 'S 525',
                'concepto' => 'Servicio 2 de 12

2 Póliza se servicio de mantenimiento para 2 balanceadores configuradas en HA
1 Póliza de servicio de mantenimiento para 2 servidores de la marca DELL
2 Póliza de servicio de mantenimiento para 2 pólizas de servicio de mantenimiento para 2 equipos de la marca RADWARE configuradas en HA',
                'fecha_recepcion' => '2021-03-02',
                'fecha_liberacion' => '2021-03-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '229960.24',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-16 08:41:08',
                'updated_at' => '2022-06-16 08:41:08',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            232 => [

                'contrato_id' => 33,
                'no_factura' => 'S 540',
                'concepto' => 'Servicio 3 de 12

2 Póliza se servicio de mantenimiento para 2 balanceadores configuradas en HA
1 Póliza de servicio de mantenimiento para 2 servidores de la marca DELL
2 Póliza de servicio de mantenimiento para 2 pólizas de servicio de mantenimiento para 2 equipos de la marca RADWARE configuradas en HA',
                'fecha_recepcion' => '2021-04-05',
                'fecha_liberacion' => '2021-04-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '229960.24',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-16 08:42:22',
                'updated_at' => '2022-06-16 08:42:22',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            233 => [

                'contrato_id' => 33,
                'no_factura' => 'S 550',
                'concepto' => 'Servicio 4 de 12

2 Póliza se servicio de mantenimiento para 2 balanceadores configuradas en HA
1 Póliza de servicio de mantenimiento para 2 servidores de la marca DELL
2 Póliza de servicio de mantenimiento para 2 pólizas de servicio de mantenimiento para 2 equipos de la marca RADWARE configuradas en HA',
                'fecha_recepcion' => '2021-05-05',
                'fecha_liberacion' => '2021-05-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '229960.24',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-16 08:44:09',
                'updated_at' => '2022-06-16 08:44:09',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            234 => [

                'contrato_id' => 33,
                'no_factura' => 'S 565',
                'concepto' => 'Servicio 5 de 12

2 Póliza se servicio de mantenimiento para 2 balanceadores configuradas en HA
1 Póliza de servicio de mantenimiento para 2 servidores de la marca DELL
2 Póliza de servicio de mantenimiento para 2 pólizas de servicio de mantenimiento para 2 equipos de la marca RADWARE configuradas en HA',
                'fecha_recepcion' => '2021-06-02',
                'fecha_liberacion' => '2021-06-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '229960.24',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-16 08:46:21',
                'updated_at' => '2022-06-16 08:46:21',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            235 => [

                'contrato_id' => 33,
                'no_factura' => 'S 589',
                'concepto' => 'Servicio 6 de 12

2 Póliza se servicio de mantenimiento para 2 balanceadores configuradas en HA
1 Póliza de servicio de mantenimiento para 2 servidores de la marca DELL
2 Póliza de servicio de mantenimiento para 2 pólizas de servicio de mantenimiento para 2 equipos de la marca RADWARE configuradas en HA',
                'fecha_recepcion' => '2021-07-02',
                'fecha_liberacion' => '2021-07-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '229960.24',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-16 08:47:33',
                'updated_at' => '2022-06-16 08:47:33',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            236 => [

                'contrato_id' => 33,
                'no_factura' => 'S 608',
                'concepto' => 'Servicio 7 de 12

2 Póliza se servicio de mantenimiento para 2 balanceadores configuradas en HA
1 Póliza de servicio de mantenimiento para 2 servidores de la marca DELL
2 Póliza de servicio de mantenimiento para 2 pólizas de servicio de mantenimiento para 2 equipos de la marca RADWARE configuradas en HA',
                'fecha_recepcion' => '2021-08-04',
                'fecha_liberacion' => '2021-08-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '229960.24',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-16 08:49:03',
                'updated_at' => '2022-06-16 08:49:03',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            237 => [

                'contrato_id' => 33,
                'no_factura' => 'S 621',
                'concepto' => 'Servicio 8 de 12

2 Póliza se servicio de mantenimiento para 2 balanceadores configuradas en HA
1 Póliza de servicio de mantenimiento para 2 servidores de la marca DELL
2 Póliza de servicio de mantenimiento para 2 pólizas de servicio de mantenimiento para 2 equipos de la marca RADWARE configuradas en HA',
                'fecha_recepcion' => '2021-09-02',
                'fecha_liberacion' => '2021-09-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '229960.24',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-16 08:50:33',
                'updated_at' => '2022-06-16 08:50:33',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            238 => [

                'contrato_id' => 33,
                'no_factura' => 'S 641',
                'concepto' => 'Servicio 9 de 12

2 Póliza se servicio de mantenimiento para 2 balanceadores configuradas en HA
1 Póliza de servicio de mantenimiento para 2 servidores de la marca DELL
2 Póliza de servicio de mantenimiento para 2 pólizas de servicio de mantenimiento para 2 equipos de la marca RADWARE configuradas en HA',
                'fecha_recepcion' => '2021-10-04',
                'fecha_liberacion' => '2021-10-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '229960.24',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-16 08:51:56',
                'updated_at' => '2022-06-16 08:51:56',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            239 => [

                'contrato_id' => 33,
                'no_factura' => 'S 659',
                'concepto' => 'Servicio 10 de 12

2 Póliza se servicio de mantenimiento para 2 balanceadores configuradas en HA
1 Póliza de servicio de mantenimiento para 2 servidores de la marca DELL
2 Póliza de servicio de mantenimiento para 2 pólizas de servicio de mantenimiento para 2 equipos de la marca RADWARE configuradas en HA',
                'fecha_recepcion' => '2021-11-04',
                'fecha_liberacion' => '2021-11-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '229960.24',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-16 08:53:16',
                'updated_at' => '2022-06-16 08:53:16',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            240 => [

                'contrato_id' => 33,
                'no_factura' => 'CPB 278',
                'concepto' => 'Servicio 11 de 12

2 Póliza se servicio de mantenimiento para 2 balanceadores configuradas en HA
1 Póliza de servicio de mantenimiento para 2 servidores de la marca DELL
2 Póliza de servicio de mantenimiento para 2 pólizas de servicio de mantenimiento para 2 equipos de la marca RADWARE configuradas en HA',
                'fecha_recepcion' => '2021-11-29',
                'fecha_liberacion' => '2021-11-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '229960.24',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-16 08:54:36',
                'updated_at' => '2022-06-16 08:54:36',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            241 => [

                'contrato_id' => 33,
                'no_factura' => 'S 699',
                'concepto' => 'Servicio 12 de 12

2 Póliza se servicio de mantenimiento para 2 balanceadores configuradas en HA
1 Póliza de servicio de mantenimiento para 2 servidores de la marca DELL
2 Póliza de servicio de mantenimiento para 2 pólizas de servicio de mantenimiento para 2 equipos de la marca RADWARE configuradas en HA',
                'fecha_recepcion' => '2021-12-13',
                'fecha_liberacion' => '2021-12-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '229960.24',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-16 08:55:59',
                'updated_at' => '2022-06-16 08:55:59',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            242 => [

                'contrato_id' => 34,
                'no_factura' => 'S 526',
                'concepto' => 'Servicio  Diciembre 2020, Enero y Febrero 2021

2 Servicios Administrados Firewall USG HUAWEI
4 Servicios Administrados Firewall USG HUAWEI (Monitoreo de 2 equipos del 14 al 31 de diciembre 2020)
4 Servicios Administrados Firewall USG HUAWEI (Monitoreo de 4 equipos en el mes de enero 2021 y Febrero 2021)',
                'fecha_recepcion' => '2021-03-04',
                'fecha_liberacion' => '2021-03-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '4030.65',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-06-16 09:04:01',
                'updated_at' => '2022-06-16 09:04:01',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            243 => [

                'contrato_id' => 34,
                'no_factura' => 'S 582',
                'concepto' => 'Servicio marzo 2021

4 Servicios Administrados Firewall USG HUAWEI (Monitoreo de 4 equipos en el mes de marzo 2021)',
                'fecha_recepcion' => '2021-06-29',
                'fecha_liberacion' => '2021-06-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1612.26',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-06-16 09:06:15',
                'updated_at' => '2022-06-16 09:12:44',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            244 => [

                'contrato_id' => 34,
                'no_factura' => 'S 583',
                'concepto' => 'Servicio Abril 2021

5 Servicios Administrados Firewall HUAWEI (Monitoreo de 5 equipos en el mes de abril 2021)',
                'fecha_recepcion' => '2021-06-29',
                'fecha_liberacion' => '2021-06-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '2015.33',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-06-16 09:11:55',
                'updated_at' => '2022-06-16 09:11:55',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            245 => [

                'contrato_id' => 34,
                'no_factura' => 'S 584',
                'concepto' => 'Servicio Mayo 2021

6 Servicios Administrados Firewall USG HUAWEI (Monitoreo de 6 equipos en el mes de mayo 2021)',
                'fecha_recepcion' => '2021-06-29',
                'fecha_liberacion' => '2021-06-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '2418.39',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-06-16 09:15:11',
                'updated_at' => '2022-06-16 09:15:11',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            246 => [

                'contrato_id' => 34,
                'no_factura' => 'S 664',
                'concepto' => 'Servicio octubre 2021

43 Servicios Administrados Firewall USG HUAWEI (Monitoreo de 43 equipos en el mes de octubre 2021)',
                'fecha_recepcion' => '2021-11-08',
                'fecha_liberacion' => '2021-11-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '17331.80',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-06-16 09:17:48',
                'updated_at' => '2022-06-16 09:17:48',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            247 => [

                'contrato_id' => 35,
                'no_factura' => 'S 697',
                'concepto' => 'Servicio para realizar análisis de vulnerabilidades a los sistemas de la Comisión Nacional de Seguros y Fianzas',
                'fecha_recepcion' => '2021-12-09',
                'fecha_liberacion' => '2021-12-09',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '1085330.90',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-16 10:31:32',
                'updated_at' => '2022-06-16 10:31:32',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            248 => [

                'contrato_id' => 41,
                'no_factura' => 'S 543',
                'concepto' => 'Servicios profesionales asesoría técnica aspel.
Servicio de seguridad, pentest y vulnerabilidades
Orden número 388
Proveedor 274',
                'fecha_recepcion' => '2021-04-07',
                'fecha_liberacion' => '2021-04-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '185079.28',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-16 10:48:52',
                'updated_at' => '2022-06-16 10:48:52',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            249 => [

                'contrato_id' => 43,
                'no_factura' => 'C 76',
                'concepto' => 'Servicio Pentest Anual Coltomex 2022',
                'fecha_recepcion' => '2022-03-17',
                'fecha_liberacion' => '2022-03-17',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '246639.54',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-16 10:53:21',
                'updated_at' => '2022-06-16 10:53:21',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            250 => [

                'contrato_id' => 39,
                'no_factura' => 'S 796',
                'concepto' => 'Servicio 1 de 12

1 Servicio de SOC y NOC
Periodo de 19 al 28 de febrero 2022',
                'fecha_recepcion' => '2022-05-10',
                'fecha_liberacion' => '2022-05-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '62488.10',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-06-16 10:59:13',
                'updated_at' => '2022-06-16 11:01:47',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            251 => [

                'contrato_id' => 39,
                'no_factura' => 'S 797',
                'concepto' => 'Servicio 2 de 12

1 Servicio de SOC y NOC
Periodo del 01 al 31 marzo 2022',
                'fecha_recepcion' => '2022-05-10',
                'fecha_liberacion' => '2022-05-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '174966.66',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-06-16 11:00:58',
                'updated_at' => '2022-06-16 11:01:30',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            252 => [

                'contrato_id' => 39,
                'no_factura' => 'S 798',
                'concepto' => 'Servicio 3- 12

Servicio de SOC y NOC
Periodo 01 al 30 de abril 2022',
                'fecha_recepcion' => '2022-05-10',
                'fecha_liberacion' => '2022-05-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '174966.66',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-06-16 11:03:36',
                'updated_at' => '2022-06-16 11:03:36',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            253 => [

                'contrato_id' => 36,
                'no_factura' => 'S 488',
                'concepto' => 'Licenciamiento por 12 meses

Licenciamiento PAM para 70 servidores
Licenciamiento Single Sing On
Licenciamiento eDirectory para 150 usuarios',
                'fecha_recepcion' => '2020-12-22',
                'fecha_liberacion' => '2022-12-22',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '15035.75',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-16 11:10:28',
                'updated_at' => '2022-09-12 08:50:40',
                'deleted_at' => '2022-09-12 08:50:40',
                'created_by' => 10,
                'updated_by' => 15,
            ],
            254 => [

                'contrato_id' => 37,
                'no_factura' => 'C 75',
                'concepto' => 'Servicio de Pruebas de Penetración',
                'fecha_recepcion' => '2022-03-14',
                'fecha_liberacion' => '2022-03-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '284551.41',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-06-16 11:15:18',
                'updated_at' => '2022-06-16 11:15:18',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            255 => [

                'contrato_id' => 44,
                'no_factura' => 'S 348',
                'concepto' => 'Partida 1. Auditoría en continuidad de negocio.
Partida 2.  Auditoría consistente en un análisis de vulnerabilidades a cajeros automáticos.
Partida 3. Auditoría especializada en materia de Seguridad de la información.

Contrato 148/2019 relativo a la contratación de servicios de auditoría (Partida 1,2 y 3) derivado del procedimiento de licitación pública nacional electrónica No. LA-006G1H001-E51-2019 para el ejercicio fiscal 2019, validación presupuestal No. 3492 y en la partida 33104.',
                'fecha_recepcion' => '2019-12-31',
                'fecha_liberacion' => '2019-12-31',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '7359005.87',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-29 12:26:16',
                'updated_at' => '2022-06-29 12:27:29',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            256 => [

                'contrato_id' => 46,
                'no_factura' => 'S 407',
                'concepto' => 'Servicio de Análisis Forense para Base de Datos
Dirección de Sistemas CC 6058040011002
Cuenta Contable, Centro de Costo.',
                'fecha_recepcion' => '2020-06-03',
                'fecha_liberacion' => '2020-06-03',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '201854.64',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-06-29 13:11:50',
                'updated_at' => '2022-06-29 13:11:50',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            257 => [

                'contrato_id' => 47,
                'no_factura' => 'S 396',
                'concepto' => 'Identificación y Análisis de Mejoras en los servicios de los sistemas
Administración de Redes y Comunicaciones CC 6058010011009 ',
                'fecha_recepcion' => '2020-05-25',
                'fecha_liberacion' => '2020-05-25',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '29945.19',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-29 13:38:28',
                'updated_at' => '2022-06-29 13:38:28',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            258 => [

                'contrato_id' => 48,
                'no_factura' => 'S 467',
                'concepto' => 'Servicio de análisis de vulnerabilidades
Gcia Soporte Técnico CC 6058040011002',
                'fecha_recepcion' => '2020-11-12',
                'fecha_liberacion' => '2020-11-12',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '213444.30',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-29 15:31:24',
                'updated_at' => '2022-06-29 15:31:24',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            259 => [

                'contrato_id' => 49,
                'no_factura' => 'S 704',
                'concepto' => 'Servicio Read Team
Fase 1 Evaluación Web
Fase 2 Pruebas Wireless

Sitio Observatorio
Sitio Santa Fe',
                'fecha_recepcion' => '2021-12-14',
                'fecha_liberacion' => '2021-12-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '225040.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-29 16:36:28',
                'updated_at' => '2022-06-29 16:36:28',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            260 => [

                'contrato_id' => 50,
                'no_factura' => 'S 511',
                'concepto' => 'Servicio A - Pruebas de Seguridad Externa
Servicio B - Pruebas de Seguridad Interna
Servicio C - Acompañamiento de credenciales de autentificación
Servicio D - Evaluación de credenciales de autentificación.

Contrato IFT-LPN-025-20
Pruebas técnicas de seguridad a la infraestructura tecnológica y servicios informáticos del Instituto Federal de Telecomunicaciones.
Servicios devengados del 20-10-20 al 18-12-20',
                'fecha_recepcion' => '2021-02-05',
                'fecha_liberacion' => '2021-02-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '370225.80',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-30 10:00:19',
                'updated_at' => '2022-06-30 10:00:19',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            261 => [

                'contrato_id' => 45,
                'no_factura' => 'S 496',
                'concepto' => 'Servicio Partida 2. Auditoría al Sistema de Pagos Electrónicos Interbancarios (SPEI)
Servicio Partida 3. Auditoría al Sistema de Pagos Interbancarios en Dólares (SPID)
Servicio Partida 4. Auditoría las Vulnerabilidades a Cajeros Automáticos
Servicio Partida 5. Auditoría en Materia de Seguridad de la Información
Servicio Partida 6. Auditoría en Materia de Administración de Riesgo Tecnológico
Servicio Partida 7. Auditoría en Apego de la Institución al Manual Administrativo de Aplicación General en Materia de Tecnologías de la Información  y Comunicaciones
Servicio Partida 8. Auditoría en Materia de Seguridad Informática en Canales Electrónicos. ',
                'fecha_recepcion' => '2020-12-30',
                'fecha_liberacion' => '2020-12-30',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '15015734.84',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-30 12:48:04',
                'updated_at' => '2022-06-30 12:48:04',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            262 => [

                'contrato_id' => 51,
                'no_factura' => 'S 554',
                'concepto' => 'Servicio de Revisión de Incidentes de Seguridad.',
                'fecha_recepcion' => '2021-05-07',
                'fecha_liberacion' => '2021-05-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '158021.92',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-06-30 15:11:24',
                'updated_at' => '2022-06-30 15:11:24',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            263 => [

                'contrato_id' => 52,
                'no_factura' => 'S 484',
                'concepto' => 'Servicio de Pruebas de Penetración',
                'fecha_recepcion' => '2020-12-16',
                'fecha_liberacion' => '2020-12-16',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '154077.70',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-06-30 17:11:35',
                'updated_at' => '2022-06-30 17:11:35',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            264 => [

                'contrato_id' => 24,
                'no_factura' => 'S 471',
                'concepto' => '6 Meses de Servicio SOC

',
                'fecha_recepcion' => '2020-11-18',
                'fecha_liberacion' => '2020-11-18',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '557323.01',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-07-01 10:20:08',
                'updated_at' => '2022-07-01 10:20:08',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            265 => [

                'contrato_id' => 25,
                'no_factura' => ' C 54',
                'concepto' => '1 Servicio NOC desde Centro de Operaciones Julio 2021
Folio HB21-179-04 para  el julio de 2021',
                'fecha_recepcion' => '2021-10-29',
                'fecha_liberacion' => '2021-10-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '49590.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-07-01 12:25:15',
                'updated_at' => '2022-07-01 12:27:05',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            266 => [

                'contrato_id' => 25,
                'no_factura' => 'C 55',
                'concepto' => '2 Servicio NOC desde Centro de Operaciones Agosto - Septiembre 21
Folio HB21-179-05 en la factura para SYCOD del mes de Agosto - Septiembre 2021.
',
                'fecha_recepcion' => '2021-10-29',
                'fecha_liberacion' => '2021-10-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '99180.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-07-01 12:30:11',
                'updated_at' => '2022-07-01 12:30:11',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            267 => [

                'contrato_id' => 25,
                'no_factura' => 'C 67',
                'concepto' => '3 Servicios NOC desde Centro de Operaciones Octubre - Diciembre.
Folio HB21-179-03 en la factura para SYCOD mes Octubre - Diciembre 2021',
                'fecha_recepcion' => '2021-12-10',
                'fecha_liberacion' => '2021-12-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '148770.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-07-01 12:35:18',
                'updated_at' => '2022-07-01 12:35:18',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            268 => [

                'contrato_id' => 25,
                'no_factura' => 'C 74',
                'concepto' => '3 Servicios NOC desde Centro de Operaciones Enero - Marzo 2022
Order Sycod: HB22-007
Servicio Dentegra',
                'fecha_recepcion' => '2022-03-11',
                'fecha_liberacion' => '2022-03-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '148770.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-07-01 12:37:55',
                'updated_at' => '2022-07-01 12:37:55',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            269 => [

                'contrato_id' => 25,
                'no_factura' => 'C 92',
                'concepto' => '3 Servicios NOC desde Centro de Operaciones Abril . Junio 2022
Order Sycod: HB22-007-2
',
                'fecha_recepcion' => '2022-06-29',
                'fecha_liberacion' => '2022-06-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '148770.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-07-01 12:41:45',
                'updated_at' => '2022-07-01 12:41:45',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            270 => [

                'contrato_id' => 25,
                'no_factura' => 'S 516',
                'concepto' => '3 Servicios de NOC desde el Centro de Operaciones de S4B
Pedido HB21-001-01 (3 meses)
13 noviembre 2020 al 13 febrero de 2021',
                'fecha_recepcion' => '2021-02-18',
                'fecha_liberacion' => '2021-02-18',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '148770.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-07-01 12:48:16',
                'updated_at' => '2022-07-01 12:48:16',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            271 => [

                'contrato_id' => 25,
                'no_factura' => 'S 580',
                'concepto' => '4.5 Servicios de NOC desde el Centro de Operaciones Q2
OC HB21-091 Servicio por 4.5 meses
14 febrero al 30 de junio de 2021',
                'fecha_recepcion' => '2021-06-25',
                'fecha_liberacion' => '2021-06-25',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '223155.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-07-01 12:53:22',
                'updated_at' => '2022-07-01 12:53:22',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            272 => [

                'contrato_id' => 34,
                'no_factura' => 'S 741',
                'concepto' => 'Servicio Enero 2022
EM - 195924 y 19649

50 Servicios Administrados Firewall USG HUAWEI
Monitoreo de 50 equipos en el mes de enero 2022
',
                'fecha_recepcion' => '2022-03-07',
                'fecha_liberacion' => '2022-03-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '20153.26',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-01 11:18:56',
                'updated_at' => '2022-08-01 11:18:56',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            273 => [

                'contrato_id' => 34,
                'no_factura' => 'S 752',
                'concepto' => 'Servicio Febrero 2022
OC 18421
EM 19778

51 Servicios Administrados Firewall USG HUAWEI
Monitoreo de 51 equipos en el mes de febrero 2022',
                'fecha_recepcion' => '2022-03-16',
                'fecha_liberacion' => '2022-03-16',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '20556.33',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-01 11:27:09',
                'updated_at' => '2022-08-01 11:27:09',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            274 => [

                'contrato_id' => 34,
                'no_factura' => 'S 769',
                'concepto' => 'Servicio Marzo 2022
OC 18643
EM 20045

51 Servicios Administrados Firewall USG HUAWEI
Monitoreo de 51 equipos en el mes de marzo de 2022',
                'fecha_recepcion' => '2022-04-12',
                'fecha_liberacion' => '2022-04-12',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '20556.33',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-01 11:33:28',
                'updated_at' => '2022-08-01 11:33:28',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            275 => [

                'contrato_id' => 34,
                'no_factura' => 'S 809',
                'concepto' => 'Servicio abril 2022
OC 19032
EM 20648

51 Servicios Administrados Firewall USG HUAWEI
Monitoreo de 51 equipos en el mes abril 2022',
                'fecha_recepcion' => '2022-05-24',
                'fecha_liberacion' => '2022-05-24',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '20556.33',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-01 11:37:10',
                'updated_at' => '2022-08-01 11:37:10',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            276 => [

                'contrato_id' => 53,
                'no_factura' => 'S 615',
                'concepto' => '1 Servicio de Assessment de Seguridad.',
                'fecha_recepcion' => '2021-08-24',
                'fecha_liberacion' => '2021-08-24',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '508005.67',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-08-01 12:40:44',
                'updated_at' => '2022-08-01 12:40:44',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            277 => [

                'contrato_id' => 54,
                'no_factura' => 'S 571',
                'concepto' => 'Servicio mes de mayo 2021

Servicio de Ciberinteligencia
Servicio de Hackeo Ético',
                'fecha_recepcion' => '2021-06-14',
                'fecha_liberacion' => '2021-06-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '75655.79',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-01 15:24:50',
                'updated_at' => '2022-08-01 15:24:50',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            278 => [

                'contrato_id' => 54,
                'no_factura' => 'S 601',
                'concepto' => 'Servicio mes de junio 2021

Servicio de Ciberinteligencia
Servicio de Hackeo Ético',
                'fecha_recepcion' => '2021-07-23',
                'fecha_liberacion' => '2021-07-23',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75655.79',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-01 15:26:48',
                'updated_at' => '2022-08-01 15:26:48',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            279 => [

                'contrato_id' => 54,
                'no_factura' => 'S 611',
                'concepto' => 'Servicio del mes de julio 2021

Servicio de Ciberinteligencia',
                'fecha_recepcion' => '2021-08-11',
                'fecha_liberacion' => '2021-08-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '55583.85',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-01 15:28:45',
                'updated_at' => '2022-08-01 15:28:45',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            280 => [

                'contrato_id' => 54,
                'no_factura' => 'S 620',
                'concepto' => 'Servicio del mes de agosto 2021

Servicio de Ciberinteligencia
Servicio de Hackeo Ético',
                'fecha_recepcion' => '2021-09-01',
                'fecha_liberacion' => '2021-09-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75655.79',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-01 15:31:24',
                'updated_at' => '2022-08-01 15:31:24',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            281 => [

                'contrato_id' => 54,
                'no_factura' => 'S 658',
                'concepto' => 'Servicio del mes de octubre',
                'fecha_recepcion' => '2021-11-04',
                'fecha_liberacion' => '2021-11-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75655.79',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-01 15:32:58',
                'updated_at' => '2022-08-01 15:32:58',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            282 => [

                'contrato_id' => 54,
                'no_factura' => 'S 684',
                'concepto' => 'Servicio del mes de noviembre de 2021

1 Servicio de Ciberinteligencia
2 Servicio de Hackeo Ético',
                'fecha_recepcion' => '2021-12-03',
                'fecha_liberacion' => '2021-12-03',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '95727.74',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-01 15:34:51',
                'updated_at' => '2022-08-01 15:34:51',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            283 => [

                'contrato_id' => 54,
                'no_factura' => 'S 713',
                'concepto' => 'Servicio del mes de diciembre 2021

Servicio de Ciberinteligencia
Servicio de Hackeo Ética',
                'fecha_recepcion' => '2022-01-04',
                'fecha_liberacion' => '2022-01-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75655.79',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-01 15:37:43',
                'updated_at' => '2022-08-01 15:38:51',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            284 => [

                'contrato_id' => 54,
                'no_factura' => 'S 734',
                'concepto' => 'Servicio del mes de enero 2022

1 Servicio de Ciberinteligencia
2 Servicio de Hackeo Ético',
                'fecha_recepcion' => '2022-02-21',
                'fecha_liberacion' => '2022-02-21',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '95727.74',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-01 15:43:48',
                'updated_at' => '2022-08-01 15:43:48',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            285 => [

                'contrato_id' => 54,
                'no_factura' => 'S 753',
                'concepto' => 'Servicio del mes de febrero 2022

Servicio de Ciberinteligencia',
                'fecha_recepcion' => '2022-03-16',
                'fecha_liberacion' => '2022-03-16',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '55583.85',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-01 15:46:36',
                'updated_at' => '2022-08-01 15:46:36',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            286 => [

                'contrato_id' => 54,
                'no_factura' => 'S 777',
                'concepto' => 'Servicio del mes de marzo de 2022

Servicio de Ciberinteligencia
Servicio de Hackeo Ético',
                'fecha_recepcion' => '2022-04-19',
                'fecha_liberacion' => '2022-04-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75655.79',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-01 15:49:08',
                'updated_at' => '2022-08-01 15:49:08',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            287 => [

                'contrato_id' => 54,
                'no_factura' => 'S 802',
                'concepto' => 'Servicio del mes de abril 2022

Servicio de Ciberinteligencia',
                'fecha_recepcion' => '2022-05-17',
                'fecha_liberacion' => '2022-05-17',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '55583.85',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-01 15:52:10',
                'updated_at' => '2022-08-01 15:52:10',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            288 => [

                'contrato_id' => 54,
                'no_factura' => 'S 825',
                'concepto' => 'Servicio del mes de mayo 2022

Servicio de Ciberinteligencia',
                'fecha_recepcion' => '2022-06-20',
                'fecha_liberacion' => '2022-06-20',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '55583.83',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-01 15:55:22',
                'updated_at' => '2022-08-01 15:55:22',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            289 => [

                'contrato_id' => 54,
                'no_factura' => 'S 856',
                'concepto' => 'Servicio de mes de junio de 2022

Servicio de Ciberinteligencia
Servicio de Hackeo Ético',
                'fecha_recepcion' => '2022-07-26',
                'fecha_liberacion' => '2022-07-26',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75655.79',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-01 15:57:36',
                'updated_at' => '2022-08-01 15:57:36',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            290 => [

                'contrato_id' => 55,
                'no_factura' => 'S 572',
                'concepto' => 'Servicio de Pruebas de Penetración de Seguridad de la Información de CMM',
                'fecha_recepcion' => '2021-06-21',
                'fecha_liberacion' => '2021-06-21',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '648150.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-08-01 16:12:02',
                'updated_at' => '2022-08-01 16:12:02',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            291 => [

                'contrato_id' => 56,
                'no_factura' => 'C 48',
                'concepto' => 'No. de pedido 4100617333

193 Vulnerabilidades altas/criticas - autenticado
88  Vulnerabilidades medias - autenticado
4 Vulnerabilidades bajas - autenticado
206 Vulnerabilidades altas/criticas - no autenticado',
                'fecha_recepcion' => '2021-09-21',
                'fecha_liberacion' => '2021-09-21',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '156820.24',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-08-01 17:01:25',
                'updated_at' => '2022-08-03 09:39:41',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            292 => [

                'contrato_id' => 56,
                'no_factura' => 'C 57',
                'concepto' => 'No. de pedido 4100640441

34 Vulnerabilidades altas/criticas - autenticado
550 Vulnerabilidades medias - autenticado
44 Vulnerabilidades bajas - autenticado
187 Vulnerabilidades altas/criticas - no autenticado',
                'fecha_recepcion' => '2021-11-22',
                'fecha_liberacion' => '2021-11-22',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '655863.93',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-08-01 17:06:57',
                'updated_at' => '2022-08-03 09:39:02',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            293 => [

                'contrato_id' => 56,
                'no_factura' => 'C 66',
                'concepto' => 'No. de pedido 4100642595

100 Vulnerabilidades altas/críticas - autenticado
150 Vulnerabilidades altos/críticos - no autenticado
2 Vulnerabilidades bajas - no autenticados',
                'fecha_recepcion' => '2021-12-07',
                'fecha_liberacion' => '2021-12-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '278061.30',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-02 08:07:04',
                'updated_at' => '2022-08-03 09:38:19',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            294 => [

                'contrato_id' => 56,
                'no_factura' => 'C 72',
                'concepto' => 'No. de pedido 4100642595

333 Vulnerabilidades altas/críticas - autenticado
218 Vulnerabilidades medias - autenticado
33 Vulnerabilidades bajas - autenticado
266 Vulnerabilidades altas/críticas - no autenticado',
                'fecha_recepcion' => '2022-03-04',
                'fecha_liberacion' => '2022-03-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '208559.53',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-02 08:36:50',
                'updated_at' => '2022-08-03 09:36:01',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            295 => [

                'contrato_id' => 56,
                'no_factura' => 'C 79 ',
                'concepto' => 'No. de pedido 4100642595

30 Vulnerabilidades altas-criticas - no autenticado
64 Vulnerabilidades  medias - no autenticado
709 Vulnerabilidades altas/críticas - autenticado
302 Vulnerabilidades medias - autenticado
21 Vulnerabilidades bajas - autenticado
',
                'fecha_recepcion' => '2022-04-26',
                'fecha_liberacion' => '2022-04-26',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '215593.38',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-02 08:46:17',
                'updated_at' => '2022-08-03 09:35:29',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            296 => [

                'contrato_id' => 56,
                'no_factura' => 'C 87',
                'concepto' => ' No. de pedido 4100617333

18 Vulnerabilidades alta/crítica - autenticado
286 Vulnerabilidades media -autenticado
28 Vulnerabilidades bajas - autenticado',
                'fecha_recepcion' => '2022-06-21',
                'fecha_liberacion' => '2022-06-21',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '73744.96',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-08-02 08:51:22',
                'updated_at' => '2022-08-03 09:34:27',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            297 => [

                'contrato_id' => 57,
                'no_factura' => 'C 51',
                'concepto' => 'Capacitación de Ciberseguridad Ethical Hacking.',
                'fecha_recepcion' => '2021-10-14',
                'fecha_liberacion' => '2021-10-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '58000.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-08-02 09:23:04',
                'updated_at' => '2022-08-02 09:23:04',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            298 => [

                'contrato_id' => 57,
                'no_factura' => 'C 56',
                'concepto' => 'Servicio Pruebas Caja Negra (Red Externa)
Servicio Pruebas Caja Gris (Red Interna
a) Fase 1 - Revisión de Seguridad VLAN´s
b) Fase 2 - Pruebas de Penetración Interna

Servicio de Ingeniería Social
- Ataque por correo electrónico
- Ataque por redes sociales ',
                'fecha_recepcion' => '2021-11-03',
                'fecha_liberacion' => '2021-11-03',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '299028.42',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-08-02 09:31:21',
                'updated_at' => '2022-08-02 09:31:21',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            299 => [

                'contrato_id' => 59,
                'no_factura' => 'S 692',
                'concepto' => 'Servicio de análisis de vulnerabilidades de TI incluir pruebas de penetración.',
                'fecha_recepcion' => '2021-12-07',
                'fecha_liberacion' => '2021-12-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '76331.55',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-08-02 10:09:37',
                'updated_at' => '2022-08-02 10:09:37',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            300 => [

                'contrato_id' => 60,
                'no_factura' => 'C 73',
                'concepto' => 'Servicio de Análisis de Vulnerabilidades en aplicaciones móviles',
                'fecha_recepcion' => '2022-03-07',
                'fecha_liberacion' => '2022-03-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '174004.52',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-08-02 10:24:06',
                'updated_at' => '2022-08-02 10:25:42',
                'deleted_at' => '2022-08-02 10:25:42',
                'created_by' => 10,
                'updated_by' => 10,
            ],
            301 => [

                'contrato_id' => 60,
                'no_factura' => 'C 73',
                'concepto' => 'Servicio de análisis de vulnerabilidades en aplicaciones móviles ',
                'fecha_recepcion' => '2022-03-07',
                'fecha_liberacion' => '2022-03-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '174004.52',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-08-02 10:27:43',
                'updated_at' => '2022-08-02 10:27:43',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            302 => [

                'contrato_id' => 62,
                'no_factura' => 'S 624',
                'concepto' => 'Servicios Penetration Test

Servicios de Pruebas de Penetración
OC 4801001125
Date 13-07-21
Vendor:  51004623',
                'fecha_recepcion' => '2021-09-07',
                'fecha_liberacion' => '2021-09-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '89927.84',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-08-02 12:10:02',
                'updated_at' => '2022-08-02 12:10:02',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            303 => [

                'contrato_id' => 63,
                'no_factura' => '987',
                'concepto' => 'Servicio Mayo 2018

Servicio de implementación de un modulo de Gobierno de Tecnologías de Información y un Sistema de Gestión de Seguridad de la Información.',
                'fecha_recepcion' => '2018-06-29',
                'fecha_liberacion' => '2018-06-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '334950.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 14:42:18',
                'updated_at' => '2023-01-24 14:00:51',
                'deleted_at' => '2023-01-24 14:00:51',
                'created_by' => 10,
                'updated_by' => 20,
            ],
            304 => [

                'contrato_id' => 63,
                'no_factura' => '1021',
                'concepto' => 'Servicio Junio

Servicio de Implementación de un modulo de Gobierno de Tecnologías de Información de un modulo de Gobierno de Tecnologías de la  Información  y un Sistema de Gestión de Seguridad de la Información .',
                'fecha_recepcion' => '2018-07-25',
                'fecha_liberacion' => '2018-07-25',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '334950.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 14:48:46',
                'updated_at' => '2023-01-24 14:01:00',
                'deleted_at' => '2023-01-24 14:01:00',
                'created_by' => 10,
                'updated_by' => 20,
            ],
            305 => [

                'contrato_id' => 63,
                'no_factura' => '1073',
                'concepto' => 'Servicio Julio

Servicio de Implementación de Modelo de Gobierno de Tecnologías de la Información  y un Sistema de Gestión de Seguridad de la Información.',
                'fecha_recepcion' => '2018-08-27',
                'fecha_liberacion' => '2018-08-27',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '334950.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 15:16:28',
                'updated_at' => '2023-01-24 14:00:55',
                'deleted_at' => '2023-01-24 14:00:55',
                'created_by' => 10,
                'updated_by' => 20,
            ],
            306 => [

                'contrato_id' => 65,
                'no_factura' => 'S 290',
                'concepto' => 'Servicio Agosto 2019

Servicio de monitoreo, medición y control del Modelo de Gobierno de TI

Sistema de Gestión de Seguridad de la Información  y Niveles de Servicios.',
                'fecha_recepcion' => '2019-09-09',
                'fecha_liberacion' => '2019-09-09',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '801397.60',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 15:42:30',
                'updated_at' => '2022-09-09 15:42:30',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            307 => [

                'contrato_id' => 65,
                'no_factura' => 'S 305',
                'concepto' => 'Servicio Septiembre 2019

Sistema de monitoreo, medición y control del Modelo de Gobierno de TI

Sistema de Gestión de Seguridad de la Información y Niveles de Servicio.',
                'fecha_recepcion' => '2019-10-08',
                'fecha_liberacion' => '2019-10-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '801397.60',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 15:56:31',
                'updated_at' => '2022-09-09 15:56:31',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            308 => [

                'contrato_id' => 17,
                'no_factura' => 'S 839',
                'concepto' => '6.3 SOPORTE TÉCNICO DE LA SOLUCIÓN EN UN HORARIO DE 24x27X365
',
                'fecha_recepcion' => '2022-07-07',
                'fecha_liberacion' => '2022-07-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-09 16:32:23',
                'updated_at' => '2022-09-09 16:32:49',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            309 => [

                'contrato_id' => 17,
                'no_factura' => 'S 862',
                'concepto' => '6.3 SOPORTE TÉCNICO DE LA SOLUCIÓN EN UN HORARIO DE 24X7X365.',
                'fecha_recepcion' => '2022-08-01',
                'fecha_liberacion' => '2022-08-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-09 16:35:25',
                'updated_at' => '2022-09-09 16:35:25',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            310 => [

                'contrato_id' => 17,
                'no_factura' => 'S 897',
                'concepto' => '6.3 SOPORTE TÉCNICO DE LA SOLUCIÓN EN HORARIO DE 24X7X365.',
                'fecha_recepcion' => '2022-09-01',
                'fecha_liberacion' => '2022-09-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-09 16:37:08',
                'updated_at' => '2022-09-09 16:37:08',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            311 => [

                'contrato_id' => 65,
                'no_factura' => 'S 319',
                'concepto' => 'Servicio Octubre 2019

Servicio de monitoreo, medición y control del Modelo de Gobierno TI

Sistema de Gestión de Seguridad de la Información y Niveles de Servicio.',
                'fecha_recepcion' => '2019-11-11',
                'fecha_liberacion' => '2019-11-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '801397.60',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 16:39:34',
                'updated_at' => '2022-09-09 16:39:34',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            312 => [

                'contrato_id' => 38,
                'no_factura' => 'S 594',
                'concepto' => 'SERVICIO DE MONITOREO SOC/NOC',
                'fecha_recepcion' => '2021-07-12',
                'fecha_liberacion' => '2021-07-12',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '176916.66',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 16:40:53',
                'updated_at' => '2022-09-09 16:40:53',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            313 => [

                'contrato_id' => 38,
                'no_factura' => 'S 595',
                'concepto' => 'SERVICIO DE MONITOREO SOC/NOC',
                'fecha_recepcion' => '2021-07-12',
                'fecha_liberacion' => '2021-07-12',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '176916.66',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 16:42:37',
                'updated_at' => '2022-09-09 16:42:37',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            314 => [

                'contrato_id' => 38,
                'no_factura' => 'S 596',
                'concepto' => 'SERVICIO DE MONITOREO SOC/NOC',
                'fecha_recepcion' => '2021-07-12',
                'fecha_liberacion' => '2021-07-12',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '0.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 16:44:00',
                'updated_at' => '2022-09-09 16:44:00',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            315 => [

                'contrato_id' => 38,
                'no_factura' => 'S 597',
                'concepto' => 'SERVICIO DE MONITOREO SOC/NOC',
                'fecha_recepcion' => '2021-07-12',
                'fecha_liberacion' => '2021-07-12',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '176916.66',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 16:45:10',
                'updated_at' => '2022-09-09 16:45:10',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            316 => [

                'contrato_id' => 38,
                'no_factura' => 'S 634',
                'concepto' => 'SERVICIO DE MONITOREO SCO/NOC',
                'fecha_recepcion' => '2021-09-29',
                'fecha_liberacion' => '2021-09-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '453978.88',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 16:47:05',
                'updated_at' => '2022-09-09 16:47:05',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            317 => [

                'contrato_id' => 38,
                'no_factura' => 'S 661',
                'concepto' => 'SERVICIO DE MONITOREO SCO/NOC',
                'fecha_recepcion' => '2021-11-08',
                'fecha_liberacion' => '2021-11-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '186566.66',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 16:48:43',
                'updated_at' => '2022-09-09 16:48:43',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            318 => [

                'contrato_id' => 38,
                'no_factura' => 'S 694',
                'concepto' => 'SERVICIO DE MONITOREO SOC/NOC',
                'fecha_recepcion' => '2021-12-08',
                'fecha_liberacion' => '2021-12-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '186566.66',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 16:50:22',
                'updated_at' => '2022-09-09 16:50:22',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            319 => [

                'contrato_id' => 38,
                'no_factura' => 'S 635',
                'concepto' => 'SERVICIO DE MONITOREO SOC/NOC',
                'fecha_recepcion' => '2021-09-29',
                'fecha_liberacion' => '2021-09-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '186566.66',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 16:51:46',
                'updated_at' => '2022-09-09 16:51:46',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            320 => [

                'contrato_id' => 65,
                'no_factura' => 'S 336',
                'concepto' => 'Servicio Noviembre 2019

Servicio de monitoreo, medición y control del Modelo de Gobierno de TI

Sistema de Gestión de Seguridad de la Información y Niveles de Servicios.',
                'fecha_recepcion' => '2019-12-10',
                'fecha_liberacion' => '2019-12-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '801397.60',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 16:51:55',
                'updated_at' => '2022-09-09 16:51:55',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            321 => [

                'contrato_id' => 38,
                'no_factura' => 'S 695',
                'concepto' => 'SERVICIO DE MONITOREO DE SOC/NOC',
                'fecha_recepcion' => '2021-12-08',
                'fecha_liberacion' => '2021-12-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '186566.66',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 16:53:11',
                'updated_at' => '2022-09-09 16:53:11',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            322 => [

                'contrato_id' => 38,
                'no_factura' => 'S 708',
                'concepto' => 'SERVICIO DE MONITOREO SOC/NOC',
                'fecha_recepcion' => '2021-12-23',
                'fecha_liberacion' => '2021-12-23',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '186566.66',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 16:54:14',
                'updated_at' => '2022-09-09 16:54:14',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            323 => [

                'contrato_id' => 38,
                'no_factura' => 'S 709',
                'concepto' => 'SERVICIO DE MONITOREO SOC/NOC',
                'fecha_recepcion' => '2021-12-23',
                'fecha_liberacion' => '2021-12-23',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '105721.16',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 16:55:11',
                'updated_at' => '2022-09-09 16:55:11',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            324 => [

                'contrato_id' => 39,
                'no_factura' => 'S 826',
                'concepto' => 'SERVICIO SOC, NOC Y SIEM.',
                'fecha_recepcion' => '2022-06-20',
                'fecha_liberacion' => '2022-06-20',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '184718.66',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-09 16:57:32',
                'updated_at' => '2022-09-09 16:57:32',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            325 => [

                'contrato_id' => 65,
                'no_factura' => 'S 338',
                'concepto' => 'Servicio Diciembre 2019

Sistemas de Gestión de Seguridad de la Información y Niveles de Servicio',
                'fecha_recepcion' => '2019-12-11',
                'fecha_liberacion' => '2019-12-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '801397.60',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 16:57:36',
                'updated_at' => '2022-09-09 16:57:36',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            326 => [

                'contrato_id' => 39,
                'no_factura' => 'S 848',
                'concepto' => 'SERVICIO SOC, NOC Y SIEM',
                'fecha_recepcion' => '2022-07-12',
                'fecha_liberacion' => '2022-07-12',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '250544.62',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-09 16:58:23',
                'updated_at' => '2022-09-09 16:58:23',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            327 => [

                'contrato_id' => 39,
                'no_factura' => 'S 864',
                'concepto' => 'SERVICIO SOC/NOC Y SIEM',
                'fecha_recepcion' => '2022-08-02',
                'fecha_liberacion' => '2022-08-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '250544.62',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-09 16:59:13',
                'updated_at' => '2022-09-09 16:59:13',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            328 => [

                'contrato_id' => 39,
                'no_factura' => 'S 902',
                'concepto' => 'SERVICIO SOC/NOC Y SIEM',
                'fecha_recepcion' => '2022-09-09',
                'fecha_liberacion' => '2022-09-09',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '250544.62',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-09 17:00:02',
                'updated_at' => '2022-09-09 17:00:02',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            329 => [

                'contrato_id' => 9,
                'no_factura' => 'S 846',
                'concepto' => 'SERVICIO FW ALTERNO
35 DE 41.5 mes de servicio: Junio 2022
SERVICIO DE FW SITIO CENTRAL
33 de 39 mes de servicio: Junio 2022
SERVICIO ADMINTIRADO DE CENTRO DE OPERACIONES DE SEGURIDAD (SOC) 7X24
34 de 41.5 mes de servicio: Junio 2022
SERVICIO WAF
30 de 36 mes de servicio: Junio 2022',
                'fecha_recepcion' => '2022-07-08',
                'fecha_liberacion' => '2022-07-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-09 17:04:31',
                'updated_at' => '2022-09-09 17:04:31',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            330 => [

                'contrato_id' => 9,
                'no_factura' => 'S 868',
                'concepto' => 'SERVICIO FW ALTERNO
36 DE 41.5 mes de servicio: Julio 2022
SERVICIO DE FW SITIO CENTRAL
34 de 39 mes de servicio: Julio 2022
SERVICIO ADMINTIRADO DE CENTRO DE OPERACIONES DE SEGURIDAD (SOC) 7X24
35 de 41.5 mes de servicio: Julio 2022
SERVICIO WAF
31 de 36 mes de servicio: Julio 2022
',
                'fecha_recepcion' => '2022-09-07',
                'fecha_liberacion' => '2022-09-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75972.48',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-09 17:05:57',
                'updated_at' => '2022-09-09 17:05:57',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            331 => [

                'contrato_id' => 66,
                'no_factura' => 'S 477',
                'concepto' => 'Servicio Noviembre 2020

Servicio de Mejora Continua del Gobierno de TI

Entregables:
1.-Plan de Trabajo Integral
2.-Metodología de Análisis de Riesgo
3.-Metodología de Monitoreo y Seguimiento de Niveles de Servicio
4.-Metodología de Análisis de Impacto al Negocio,
5.-Análisis de Contrato (Linea base)
6.-Análisis de Impacto al Negocio, Análisis del Impacto de los Aplicativos, Análisis de Riesgo (Avance)',
                'fecha_recepcion' => '2020-12-02',
                'fecha_liberacion' => '2020-12-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '3491600.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 17:32:24',
                'updated_at' => '2022-09-09 17:32:24',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            332 => [

                'contrato_id' => 66,
                'no_factura' => 'S 489',
                'concepto' => 'Servicio Diciembre 2020

Servicio de mejora continua del Gobierno de TI

Entregables:
1.- Actualización de Análisis de Riesgo 2020
2.- Reporte de Auditoría Inicial
3.- Tablero de Indicadores de Modelo de Gobierno de TI
4.- Cédulas de revisión del cumplimiento (etapa 2)
5.-  Análisis de Impacto al Negocio, Análisis de Impacto a los Aplicativos, Análisis de Riesgo (Avance).


',
                'fecha_recepcion' => '2020-12-22',
                'fecha_liberacion' => '2020-12-22',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '3491600.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 17:39:26',
                'updated_at' => '2022-09-09 17:39:26',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            333 => [

                'contrato_id' => 66,
                'no_factura' => 'S 527',
                'concepto' => 'Servicios Enero y Febrero 2021

Servicio de mejora continua de Gobierno de TI

Entregables:
1.- Reporte de Auditoría Inicial
2.- Auditoría Interna Enero
3.- Acciones correctivas y acciones de mejora continua del SGSI y del Gobierno TI
4.- Cédulas de revisión de cumplimiento
5.- Análisis de Impacto al Negocio, Análisis  de Impacto a los Aplicativos , Análisis de Riesgo
6.- Escenarios de Riesgo
7.- Estrategia de recuperación
8.- Planes de continuidad y recuperación ante desastres.',
                'fecha_recepcion' => '2021-03-04',
                'fecha_liberacion' => '2021-03-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1479000.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 17:46:15',
                'updated_at' => '2022-09-09 17:46:15',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            334 => [

                'contrato_id' => 64,
                'no_factura' => 'CPB 10',
                'concepto' => 'Entregable 1: Plan de Trabajo y Metodología 20%

Prestación de Servicios Profesiones de Consultoría.
Actualización del Análisis de Impacto al Negocio (BIA), Análisis de Riesgo (AR) e Informe con transferencia de conocimiento en ISO 22301

',
                'fecha_recepcion' => '2019-08-16',
                'fecha_liberacion' => '2019-08-16',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '553088.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 17:53:58',
                'updated_at' => '2022-09-09 17:53:58',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            335 => [

                'contrato_id' => 64,
                'no_factura' => 'S 308',
                'concepto' => 'Entregable 2. Análisis de Riesgo (AR)

Prestación de Servicios Profesionales de Consultoría

Actualización del Análisis de Impacto al Negocio (BIA), Análisis de Riesgo (AR) e Informe con transferencia de conocimiento en el ISO 22301.',
                'fecha_recepcion' => '2019-08-28',
                'fecha_liberacion' => '2019-08-28',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '829632.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 18:00:43',
                'updated_at' => '2022-09-09 18:00:43',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            336 => [

                'contrato_id' => 64,
                'no_factura' => 'S 324',
                'concepto' => 'Entregables 3: Informe BIA, Recomendaciones y Transferencia de Conocimientos 50%

Actualización  del Análisis de Impacto al Negocio (BIA), Análisis de Riesgo (AR) e Informe con transferencia de conocimientos en ISO 22301.',
                'fecha_recepcion' => '2019-11-29',
                'fecha_liberacion' => '2019-11-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1382720.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 18:09:17',
                'updated_at' => '2022-09-09 18:09:17',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            337 => [

                'contrato_id' => 70,
                'no_factura' => 'S 370',
                'concepto' => 'Curso ITIL V4 Fundamentos',
                'fecha_recepcion' => '2020-02-21',
                'fecha_liberacion' => '2020-02-21',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '53542.50',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 18:15:42',
                'updated_at' => '2022-09-09 18:15:42',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            338 => [

                'contrato_id' => 69,
                'no_factura' => 'S 448',
                'concepto' => 'Servicio 1 de 3

Servicio para mantenimiento del Sistema de Gestión de Seguridad de la Información (SGSI) de NUBAJ',
                'fecha_recepcion' => '2020-10-02',
                'fecha_liberacion' => '2020-10-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '62640.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 18:21:39',
                'updated_at' => '2022-09-09 18:21:39',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            339 => [

                'contrato_id' => 69,
                'no_factura' => 'S 449',
                'concepto' => 'Servicio 2 de 3

Servicio para mantenimiento del Sistema de Gestión de Seguridad de la Información (SGSI) de NUBAJ',
                'fecha_recepcion' => '2020-10-02',
                'fecha_liberacion' => '2020-10-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '62640.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 18:23:37',
                'updated_at' => '2022-09-09 18:23:37',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            340 => [

                'contrato_id' => 69,
                'no_factura' => 'S 468',
                'concepto' => 'Servicio 3 de 3

Servicio para mantenimiento del Sistema de Gestión de Seguridad de la Información (SGSI)',
                'fecha_recepcion' => '2020-11-17',
                'fecha_liberacion' => '2020-11-17',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '62640.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 18:27:24',
                'updated_at' => '2022-09-09 18:27:24',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            341 => [

                'contrato_id' => 74,
                'no_factura' => 'S 498',
                'concepto' => 'Auditoría 2020

Servicio de Auditoria de recertificación para MCM Telecom de México S.A. de C.V. con número de servicio QS-1611 durante los días 17  y 18 de diciembre de 2020',
                'fecha_recepcion' => '2020-12-30',
                'fecha_liberacion' => '2020-12-30',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '8120.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 18:38:53',
                'updated_at' => '2022-09-09 18:38:53',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            342 => [

                'contrato_id' => 72,
                'no_factura' => 'S 343',
                'concepto' => 'Servicio de Auditoría ISO 27001:2013

Servicio de auditoría 27001:2013 MCM Telecom Megacable Comunicaciones por el servicio QS-1464',
                'fecha_recepcion' => '2019-12-19',
                'fecha_liberacion' => '2019-12-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '8120.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 18:42:20',
                'updated_at' => '2022-09-09 18:42:20',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            343 => [

                'contrato_id' => 73,
                'no_factura' => 'S 344',
                'concepto' => 'Servicio de Auditoría ISO 27001:2013

Servicio de Auditoria  ISO 27001:2013 para de la Riva Group con número de servicio QS-1491',
                'fecha_recepcion' => '2019-12-19',
                'fecha_liberacion' => '2019-12-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '10440.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-09 18:54:33',
                'updated_at' => '2022-09-09 18:54:33',
                'deleted_at' => null,
                'created_by' => 10,
                'updated_by' => null,
            ],
            344 => [

                'contrato_id' => 5,
                'no_factura' => 'S 827',
                'concepto' => 'Servicio Cyber Threat
Servicio Simulación de Ataques de Ciberseguridad',
                'fecha_recepcion' => '2022-06-22',
                'fecha_liberacion' => '2022-06-22',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '199745.55',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 07:50:09',
                'updated_at' => '2022-09-12 07:50:09',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            345 => [

                'contrato_id' => 5,
                'no_factura' => 'S 867',
                'concepto' => 'Servicio Cyber Threat
Servicio Simulación de Ataques de Ciberseguridad
',
                'fecha_recepcion' => '2022-08-03',
                'fecha_liberacion' => '2022-08-03',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '199745.55',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 07:51:12',
                'updated_at' => '2022-09-12 07:51:12',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            346 => [

                'contrato_id' => 5,
                'no_factura' => 'S 887',
                'concepto' => 'Servicio Cyber Threat
Servicio Simulación de Ataques de Ciberseguridad
',
                'fecha_recepcion' => '2022-08-30',
                'fecha_liberacion' => '2022-08-30',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '199745.55',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 07:52:03',
                'updated_at' => '2022-09-12 07:52:03',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            347 => [

                'contrato_id' => 26,
                'no_factura' => 'S 822',
                'concepto' => 'S1.-Servicio administrado de monitoreo y correlación de eventos de seguridad.
S2. Equipo de respuesta de incidentes de seguridad computacional.
S3. Servicio administrado de una solución de seguridad para equipos de cómputo de escritorio (EDR-Endpoint Detection and Response).
S4. Servicio de ciber inteligencia, análisis de vulnerabilidades, pruebas de penetración y verificación de suficiencia de controles de seguridad.
S5. Servicio de despliegue y monitoreo de una consola de antivius de tipo Enterprise.
',
                'fecha_recepcion' => '2022-06-13',
                'fecha_liberacion' => '2022-06-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '225277.25',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 07:58:20',
                'updated_at' => '2022-09-12 07:58:20',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            348 => [

                'contrato_id' => 26,
                'no_factura' => 'S 849',
                'concepto' => 'S1.-Servicio administrado de monitoreo y correlación de eventos de seguridad.
S2. Equipo de respuesta de incidentes de seguridad computacional.
S3. Servicio administrado de una solución de seguridad para equipos de cómputo de escritorio (EDR-Endpoint Detection and Response).
S4. Servicio de ciber inteligencia, análisis de vulnerabilidades, pruebas de penetración y verificación de suficiencia de controles de seguridad.
S5. Servicio de despliegue y monitoreo de una consola de antivius de tipo Enterprise.
',
                'fecha_recepcion' => '2022-07-12',
                'fecha_liberacion' => '2022-07-12',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '225277.25',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 07:59:15',
                'updated_at' => '2022-09-12 07:59:15',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            349 => [

                'contrato_id' => 26,
                'no_factura' => 'S 878',
                'concepto' => 'S1.-Servicio administrado de monitoreo y correlación de eventos de seguridad.
S2. Equipo de respuesta de incidentes de seguridad computacional.
S3. Servicio administrado de una solución de seguridad para equipos de cómputo de escritorio (EDR-Endpoint Detection and Response).
S4. Servicio de ciber inteligencia, análisis de vulnerabilidades, pruebas de penetración y verificación de suficiencia de controles de seguridad.
S5. Servicio de despliegue y monitoreo de una consola de antivius de tipo Enterprise.
',
                'fecha_recepcion' => '2022-08-11',
                'fecha_liberacion' => '2022-08-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '225277.25',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 08:00:11',
                'updated_at' => '2022-09-12 08:00:11',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            350 => [

                'contrato_id' => 3,
                'no_factura' => 'S 830',
                'concepto' => 'SOPROTE A INFRAESTRUCTURA DE SISEMAS INDUSTRIALES
ESTIMACIÓN 25: DEL 13 DE MAYO DE 2022 AL 12 DE JUNIO 2022.
NÚMERO DE CONTRATO: 4600023294',
                'fecha_recepcion' => '2022-06-24',
                'fecha_liberacion' => '2022-06-24',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '67635.49',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 08:06:23',
                'updated_at' => '2022-09-12 08:06:23',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            351 => [

                'contrato_id' => 3,
                'no_factura' => 'S 855',
                'concepto' => 'SOPORTE A INFRAESTRUCTURA DE SISTEMAS INDUSTRIALES
ESTIMACIÓN 26: DEL 13 DE JUNIO DE 2022 AL 13 DE JULIO 2022.
NÚMERO DE CONTRATO: 4600023294
',
                'fecha_recepcion' => '2022-07-22',
                'fecha_liberacion' => '2022-07-22',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.49',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 08:07:43',
                'updated_at' => '2022-09-12 08:11:06',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            352 => [

                'contrato_id' => 3,
                'no_factura' => 'S 889',
                'concepto' => 'SOPORTE A INFRAESTRUCTURA DE SISTEMAS INDUSTRIALES
ESTIMACIÓN 27: DEL 13 DE JULIO DE 2022 AL 12 DE AGOSTO 2022.
NÚMERO DE CONTRATO: 4600023294
',
                'fecha_recepcion' => '2022-09-08',
                'fecha_liberacion' => '2022-09-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.49',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 08:10:56',
                'updated_at' => '2022-09-12 08:10:56',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            353 => [

                'contrato_id' => 54,
                'no_factura' => 'S 558',
                'concepto' => 'A)CIBER INTELIGENCIA',
                'fecha_recepcion' => '2021-05-13',
                'fecha_liberacion' => '2021-05-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '55583.85',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 08:26:58',
                'updated_at' => '2022-09-12 08:26:58',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            354 => [

                'contrato_id' => 54,
                'no_factura' => 'S 652',
                'concepto' => 'A)CIBER INTELIGENCIA
B)HACKEO ÉTICO',
                'fecha_recepcion' => '2021-10-19',
                'fecha_liberacion' => '2021-10-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75655.79',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 08:28:10',
                'updated_at' => '2022-09-12 08:28:10',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            355 => [

                'contrato_id' => 54,
                'no_factura' => 'S 684',
                'concepto' => 'A)CIBER INTELIGENCIA
B)HACKEO ÉTICO',
                'fecha_recepcion' => '2021-12-03',
                'fecha_liberacion' => '2021-12-03',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '95727.74',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 08:30:20',
                'updated_at' => '2022-09-12 08:30:20',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            356 => [

                'contrato_id' => 54,
                'no_factura' => 'S 883',
                'concepto' => 'A)CIBER INTELIGENCIA',
                'fecha_recepcion' => '2022-08-17',
                'fecha_liberacion' => '2022-08-18',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '55583.85',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 08:31:25',
                'updated_at' => '2022-09-12 08:31:25',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            357 => [

                'contrato_id' => 56,
                'no_factura' => 'C-1',
                'concepto' => 'Vulnerabilidades Altas/Críticas
Vulnerabilidades Medias-No
Vulnerabilidades Bajas-No
',
                'fecha_recepcion' => '2022-09-07',
                'fecha_liberacion' => '2022-09-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '108836.43',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 08:34:52',
                'updated_at' => '2022-09-12 08:34:52',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            358 => [

                'contrato_id' => 34,
                'no_factura' => 'S 649',
                'concepto' => 'INTEGRA_SERVICIOS ADMINISTRADOS FW HUAWEI',
                'fecha_recepcion' => '2021-10-18',
                'fecha_liberacion' => '2021-10-18',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '3627.59',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 08:40:18',
                'updated_at' => '2022-09-12 08:40:18',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            359 => [

                'contrato_id' => 34,
                'no_factura' => 'S 650',
                'concepto' => 'INTEGRA_SERVICIOS ADMINISTRADOS FW HUAWEI',
                'fecha_recepcion' => '2021-10-18',
                'fecha_liberacion' => '2021-10-18',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '4030.65',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 08:41:31',
                'updated_at' => '2022-09-12 08:41:31',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            360 => [

                'contrato_id' => 34,
                'no_factura' => 'S 651',
                'concepto' => 'INTEGRA_SERVICIOS ADMINISTRADOS FW HUAWEI',
                'fecha_recepcion' => '2021-10-18',
                'fecha_liberacion' => '2021-10-18',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '10479.70',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 08:42:44',
                'updated_at' => '2022-09-12 08:42:44',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            361 => [

                'contrato_id' => 34,
                'no_factura' => 'S 663',
                'concepto' => 'INTEGRA_SERVICIOS ADMINISTRADOS FW HUAWEI',
                'fecha_recepcion' => '2021-11-08',
                'fecha_liberacion' => '2021-11-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '17331.80',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 08:43:39',
                'updated_at' => '2022-09-12 08:43:39',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            362 => [

                'contrato_id' => 34,
                'no_factura' => 'S 700',
                'concepto' => 'INTEGRA_SERVICIOS ADMINISTRADOS FW HUAWEI',
                'fecha_recepcion' => '2021-12-13',
                'fecha_liberacion' => '2021-12-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '18541.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 08:44:32',
                'updated_at' => '2022-09-12 08:44:32',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            363 => [

                'contrato_id' => 34,
                'no_factura' => 'S 716',
                'concepto' => 'INTEGRA_SERVICIOS ADMINISTRADOS FW HUAWI',
                'fecha_recepcion' => '2022-01-12',
                'fecha_liberacion' => '2022-01-12',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '20153.26',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 08:45:39',
                'updated_at' => '2022-09-12 08:45:39',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            364 => [

                'contrato_id' => 34,
                'no_factura' => 'S 828',
                'concepto' => 'INTEGRA_SERVICIOS ADMINISTRADOS FW HUAWEI',
                'fecha_recepcion' => '2022-06-22',
                'fecha_liberacion' => '2022-06-22',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '20556.33',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-12 08:46:58',
                'updated_at' => '2022-09-12 08:46:58',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            365 => [

                'contrato_id' => 36,
                'no_factura' => 'S 491',
                'concepto' => 'Licenciamiento PAM para 70 Servidores
Licenciamiento Single Sing On
Licenciamiento eDirectory para 150 usuarios',
                'fecha_recepcion' => '2020-12-23',
                'fecha_liberacion' => '2020-12-23',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '15035.75',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2022-09-12 08:50:31',
                'updated_at' => '2022-09-12 08:50:31',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            366 => [

                'contrato_id' => 82,
                'no_factura' => 'c5',
                'concepto' => 'Servicios de consultoria
SERVICIOS DE SIBERSEGURIDAD',
                'fecha_recepcion' => '2022-09-29',
                'fecha_liberacion' => '2022-09-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '256102.16',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2022-09-29 10:13:19',
                'updated_at' => '2022-09-29 10:13:19',
                'deleted_at' => null,
                'created_by' => 13,
                'updated_by' => null,
            ],
            367 => [

                'contrato_id' => 108,
                'no_factura' => 'S 863',
                'concepto' => 'Migración de Equipos Fortinet-Palo Alto
Equipos Palo Alto 820 con licenciamiento  Advanced URL Filtering, Threat prevition, Wildfire, GlobalProtect y soporte con el fabricante por 3 años.
Servicio de instalación por parte de S4B',
                'fecha_recepcion' => '2022-08-01',
                'fecha_liberacion' => '2022-08-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '8568.58',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-23 12:01:25',
                'updated_at' => '2023-01-23 12:01:25',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            368 => [

                'contrato_id' => 108,
                'no_factura' => 'S 884',
                'concepto' => 'Servicios de Instalación.
Migración de Equipos Fortinet‐Palo Alto, Equipos Palo Alto 820 con licenciamiento Advanced URL Filtering, Threat prevention, WildFire, GlobalProtect y soporte con el fabricante por 3 años.
Servicio de instalación por parte de S4B.',
                'fecha_recepcion' => '2022-08-25',
                'fecha_liberacion' => '2022-08-25',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '8568.58',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-23 12:06:17',
                'updated_at' => '2023-01-23 12:06:17',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            369 => [

                'contrato_id' => 108,
                'no_factura' => 'S 885',
                'concepto' => 'Servicios de Instalación
Migración de Equipos Fortinet‐Palo Alto Equipos PaloAlto 820 con licenciamiento Advanced URL Filtering, Threat prevention, WildFire, GlobalProtect y soporte con el fabricante por 3 años
Servicio de instalación por parte de S4B',
                'fecha_recepcion' => '2022-09-05',
                'fecha_liberacion' => '2022-09-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '8568.58',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-23 12:08:38',
                'updated_at' => '2023-01-23 12:08:38',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            370 => [

                'contrato_id' => 108,
                'no_factura' => 'S 954',
                'concepto' => 'Servicios de Instalación
Migración de Equipos Fortinet‐Palo Alto Equipos PaloAlto 820 con licenciamiento Advanced URL Filtering, Threat prevention, WildFire, GlobalProtect y soporte con el fabricante por 3 años
Servicio de instalación por parte de S4B',
                'fecha_recepcion' => '2022-10-10',
                'fecha_liberacion' => '2022-10-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '8568.58',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-23 12:10:43',
                'updated_at' => '2023-01-23 12:10:43',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            371 => [

                'contrato_id' => 108,
                'no_factura' => 'S 970',
                'concepto' => 'Servicios de Instalación
Migración de Equipos Fortinet‐Palo Alto Equipos PaloAlto 820 con licenciamiento Advanced URL Filtering, Threat prevention, WildFire, GlobalProtect y soporte con el fabricante por 3 años
Servicio de instalación por parte de S4B',
                'fecha_recepcion' => '2022-11-02',
                'fecha_liberacion' => '2022-11-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '8568.58',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-23 12:12:52',
                'updated_at' => '2023-01-26 10:39:24',
                'deleted_at' => '2023-01-26 10:39:24',
                'created_by' => 20,
                'updated_by' => 20,
            ],
            372 => [

                'contrato_id' => 108,
                'no_factura' => 'S 1011',
                'concepto' => 'Servicios de Instalación
Migración de Equipos Fortinet‐Palo Alto Equipos PaloAlto 820 con licenciamiento Advanced URL Filtering, Threat prevention, WildFire, GlobalProtect y soporte con el fabricante por 3 años
Servicio de instalación por parte de S4B',
                'fecha_recepcion' => '2022-12-01',
                'fecha_liberacion' => '2022-12-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '8568.58',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-23 12:15:19',
                'updated_at' => '2023-01-23 12:15:19',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            373 => [

                'contrato_id' => 108,
                'no_factura' => 'S 1055',
                'concepto' => 'Servicios de Instalación
Migración de Equipos Fortinet‐Palo Alto Equipos PaloAlto 820 con licenciamiento Advanced URL Filtering, Threat prevention, WildFire, GlobalProtect y soporte con el fabricante por 3 años.
Servicio de instalación por parte de S4B',
                'fecha_recepcion' => '2022-12-22',
                'fecha_liberacion' => '2022-12-22',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '8568.58',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-23 12:25:15',
                'updated_at' => '2023-01-23 12:25:15',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            374 => [

                'contrato_id' => 119,
                'no_factura' => 'S 345',
                'concepto' => 'Equipamiento F5 Network
Servicio de Implementación de los 3 equipos
Adquisición de póliza de soporte del fabricante para los 3 equipos del 2019',
                'fecha_recepcion' => '2019-12-26',
                'fecha_liberacion' => '2019-12-26',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '4796917.74',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 12:35:19',
                'updated_at' => '2023-01-24 12:37:14',
                'deleted_at' => '2023-01-24 12:37:14',
                'created_by' => 20,
                'updated_by' => 20,
            ],
            375 => [

                'contrato_id' => 119,
                'no_factura' => 'S 345',
                'concepto' => 'Equipamiento de F5 Networks
Servicio de Implementación de los 3 equipos
Adquisición de póliza de soporte del fabricante para los 3 equipos del 2019',
                'fecha_recepcion' => '2019-12-26',
                'fecha_liberacion' => '2019-12-26',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '4796917.74',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 12:39:17',
                'updated_at' => '2023-01-24 12:39:17',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            376 => [

                'contrato_id' => 119,
                'no_factura' => 'S 384',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2020-03-19',
                'fecha_liberacion' => '2020-03-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 12:40:56',
                'updated_at' => '2023-01-24 12:40:56',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            377 => [

                'contrato_id' => 119,
                'no_factura' => 'S 385',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2020-03-19',
                'fecha_liberacion' => '2020-03-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 12:43:31',
                'updated_at' => '2023-01-24 12:43:31',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            378 => [

                'contrato_id' => 119,
                'no_factura' => 'S 390',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2020-04-08',
                'fecha_liberacion' => '2020-04-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 12:44:31',
                'updated_at' => '2023-01-24 12:44:31',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            379 => [

                'contrato_id' => 119,
                'no_factura' => 'S 395',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2020-05-22',
                'fecha_liberacion' => '2020-05-22',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 12:45:48',
                'updated_at' => '2023-01-24 12:45:48',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            380 => [

                'contrato_id' => 119,
                'no_factura' => 'S 410',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2020-06-08',
                'fecha_liberacion' => '2020-06-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 12:47:18',
                'updated_at' => '2023-01-24 12:47:18',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            381 => [

                'contrato_id' => 119,
                'no_factura' => 'S 415',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2020-07-13',
                'fecha_liberacion' => '2020-07-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 12:48:28',
                'updated_at' => '2023-01-24 12:49:11',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            382 => [

                'contrato_id' => 119,
                'no_factura' => 'S 421',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2020-08-05',
                'fecha_liberacion' => '2020-08-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 12:51:56',
                'updated_at' => '2023-01-24 12:51:56',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            383 => [

                'contrato_id' => 119,
                'no_factura' => 'S 451',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2020-10-05',
                'fecha_liberacion' => '2020-10-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 12:53:41',
                'updated_at' => '2023-01-24 12:53:41',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            384 => [

                'contrato_id' => 119,
                'no_factura' => 'S 465',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2020-11-03',
                'fecha_liberacion' => '2020-11-03',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 13:01:20',
                'updated_at' => '2023-01-24 13:01:20',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            385 => [

                'contrato_id' => 119,
                'no_factura' => 'S 503',
                'concepto' => 'Adquisición de póliza de soporte del fabricante para los 3 equipos del 2020
Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2021-01-19',
                'fecha_liberacion' => '2021-01-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '507652.10',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 13:03:57',
                'updated_at' => '2023-01-26 10:11:54',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            386 => [

                'contrato_id' => 119,
                'no_factura' => 'S 514',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2021-02-17',
                'fecha_liberacion' => '2021-02-17',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 13:05:42',
                'updated_at' => '2023-01-24 13:05:42',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            387 => [

                'contrato_id' => 119,
                'no_factura' => 'S 542',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2021-04-07',
                'fecha_liberacion' => '2021-04-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 13:07:10',
                'updated_at' => '2023-01-24 13:07:10',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            388 => [

                'contrato_id' => 119,
                'no_factura' => 'S 610',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2021-08-10',
                'fecha_liberacion' => '2021-08-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 13:08:20',
                'updated_at' => '2023-01-24 13:08:20',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            389 => [

                'contrato_id' => 119,
                'no_factura' => 'S 645',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2021-10-11',
                'fecha_liberacion' => '2021-11-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 13:12:33',
                'updated_at' => '2023-01-26 09:53:03',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            390 => [

                'contrato_id' => 119,
                'no_factura' => 'S 665',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2021-11-09',
                'fecha_liberacion' => '2021-11-09',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 13:13:51',
                'updated_at' => '2023-01-24 13:13:51',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            391 => [

                'contrato_id' => 119,
                'no_factura' => 'S 676',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2021-12-01',
                'fecha_liberacion' => '2021-12-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 13:15:04',
                'updated_at' => '2023-01-24 13:15:04',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            392 => [

                'contrato_id' => 119,
                'no_factura' => 'S 696',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2021-12-09',
                'fecha_liberacion' => '2021-12-09',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 13:18:18',
                'updated_at' => '2023-01-24 13:18:18',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            393 => [

                'contrato_id' => 119,
                'no_factura' => 'S 701',
                'concepto' => 'Adquisición de póliza de soporte del fabricante para los 3 equipos del 2021',
                'fecha_recepcion' => '2021-12-13',
                'fecha_liberacion' => '2021-12-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '461969.95',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 13:19:09',
                'updated_at' => '2023-01-26 10:16:49',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            394 => [

                'contrato_id' => 119,
                'no_factura' => 'S 726',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2022-02-14',
                'fecha_liberacion' => '2022-02-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 13:20:36',
                'updated_at' => '2023-01-24 13:20:36',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            395 => [

                'contrato_id' => 119,
                'no_factura' => 'S 743',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2022-03-08',
                'fecha_liberacion' => '2022-03-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 13:22:34',
                'updated_at' => '2023-01-24 13:22:34',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            396 => [

                'contrato_id' => 119,
                'no_factura' => 'S 766',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2022-04-08',
                'fecha_liberacion' => '2022-04-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 13:24:25',
                'updated_at' => '2023-01-24 13:24:25',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            397 => [

                'contrato_id' => 119,
                'no_factura' => 'S 790',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2022-05-06',
                'fecha_liberacion' => '2022-05-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 13:27:14',
                'updated_at' => '2023-01-24 13:27:14',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            398 => [

                'contrato_id' => 119,
                'no_factura' => 'S 816',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2022-06-02',
                'fecha_liberacion' => '2022-06-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 13:28:27',
                'updated_at' => '2023-01-24 13:28:27',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            399 => [

                'contrato_id' => 119,
                'no_factura' => 'S 871',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2022-08-04',
                'fecha_liberacion' => '2022-08-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 13:44:59',
                'updated_at' => '2023-01-24 13:44:59',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            400 => [

                'contrato_id' => 119,
                'no_factura' => 'S 913',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2022-09-08',
                'fecha_liberacion' => '2022-09-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 13:45:43',
                'updated_at' => '2023-01-26 09:46:20',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            401 => [

                'contrato_id' => 119,
                'no_factura' => 'S 950',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2022-10-06',
                'fecha_liberacion' => '2022-10-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 13:47:14',
                'updated_at' => '2023-01-24 13:47:14',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            402 => [

                'contrato_id' => 119,
                'no_factura' => 'S 983',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2022-11-09',
                'fecha_liberacion' => '2022-11-09',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 13:49:05',
                'updated_at' => '2023-01-24 13:49:05',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            403 => [

                'contrato_id' => 119,
                'no_factura' => 'S 1012',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución',
                'fecha_recepcion' => '2022-12-01',
                'fecha_liberacion' => '2022-12-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-24 13:50:51',
                'updated_at' => '2023-01-24 13:50:51',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            404 => [

                'contrato_id' => 119,
                'no_factura' => 'S 441',
                'concepto' => 'Servicio de Soporte Técnico mensual de la solución',
                'fecha_recepcion' => '2020-09-04',
                'fecha_liberacion' => '2020-09-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-26 09:44:58',
                'updated_at' => '2023-01-26 09:44:58',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            405 => [

                'contrato_id' => 108,
                'no_factura' => 'S 989',
                'concepto' => 'Servicios de Instalación
Migración de Equipos Fortinet‐Palo Alto Equipos PaloAlto 820 con licenciamiento Advanced URL Filtering, Threat prevention, WildFire, GlobalProtect y soporte con el fabricante por 3 años
Servicio de instalación por parte de S4B',
                'fecha_recepcion' => '2022-11-15',
                'fecha_liberacion' => '2022-11-15',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '8568.58',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-26 10:49:20',
                'updated_at' => '2023-01-26 10:49:20',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            406 => [

                'contrato_id' => 80,
                'no_factura' => 'S 599',
                'concepto' => 'Fase de evaluación, definición, análisis e implementación.',
                'fecha_recepcion' => '2021-07-14',
                'fecha_liberacion' => '2021-07-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '315779.84',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-26 12:28:29',
                'updated_at' => '2023-01-26 12:28:29',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            407 => [

                'contrato_id' => 119,
                'no_factura' => 'S 478',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución (hardware y software)',
                'fecha_recepcion' => '2020-12-03',
                'fecha_liberacion' => '2020-12-03',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-26 14:27:44',
                'updated_at' => '2023-01-26 14:27:44',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            408 => [

                'contrato_id' => 119,
                'no_factura' => 'S 528',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución (hardware y software)',
                'fecha_recepcion' => '2021-03-04',
                'fecha_liberacion' => '2021-03-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-26 14:30:25',
                'updated_at' => '2023-01-26 14:30:25',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            409 => [

                'contrato_id' => 63,
                'no_factura' => '6df1d481-f16e-4083-b12f-d62868061944',
                'concepto' => 'Servicio de Implementación de un Modelo de Gobierno de Tecnologías de la Información y Comunicaciones de un Sistema de Gestión de Seguridad de la Información. SENADO',
                'fecha_recepcion' => '2018-12-11',
                'fecha_liberacion' => '2018-12-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '243600.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-30 10:06:05',
                'updated_at' => '2023-01-30 10:06:05',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            410 => [

                'contrato_id' => 63,
                'no_factura' => '7e4e9be5-2fc7-45ac-b64b-a8ecb36d3093',
                'concepto' => 'Servicio de Implementación de un Modelo de Gobierno de Tecnologías de la Información y Comunicaciones de un Sistema de Gestión de Seguridad de la Información. SENADO',
                'fecha_recepcion' => '2018-12-11',
                'fecha_liberacion' => '2018-12-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '243600.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-30 10:07:41',
                'updated_at' => '2023-01-30 10:07:41',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            411 => [

                'contrato_id' => 63,
                'no_factura' => '9d8481b8-4db4-4470-a94b-14328552cb1f',
                'concepto' => 'Servicio de Implementación de un Modelo de Gobierno de Tecnologías de la Información y Comunicaciones de un Sistema de Gestión de Seguridad de la Información. SENADO',
                'fecha_recepcion' => '2018-12-14',
                'fecha_liberacion' => '2018-12-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '243600.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-30 10:09:50',
                'updated_at' => '2023-01-30 10:09:50',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            412 => [

                'contrato_id' => 63,
                'no_factura' => '69b1c7af-10af-4ed5-9f9d-53fa4124fe12',
                'concepto' => 'Servicio de Implementación de un Modelo de Gobierno de Tecnologías de la Información y Comunicaciones de un Sistema de Gestión de Seguridad de la Información. SENADO',
                'fecha_recepcion' => '2018-12-11',
                'fecha_liberacion' => '2018-12-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '243600.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-30 10:16:48',
                'updated_at' => '2023-01-30 10:16:48',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            413 => [

                'contrato_id' => 63,
                'no_factura' => '193a43b3-01a0-4f88-aa27-9895719e8f9b',
                'concepto' => 'Servicio de Implementación de un Modelo de Gobierno de Tecnologías de la Información y Comunicaciones de un Sistema de Gestión de Seguridad de la Información. SENADO',
                'fecha_recepcion' => '2018-12-14',
                'fecha_liberacion' => '2018-12-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '243600.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-30 10:19:33',
                'updated_at' => '2023-01-30 10:19:33',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            414 => [

                'contrato_id' => 63,
                'no_factura' => '3725590b-9d55-4870-a7aa-47417a663908',
                'concepto' => 'Servicio de Implementación de un Modelo de Gobierno de Tecnologías de la Información y Comunicaciones de un Sistema de Gestión de Seguridad de la Información. SENADO',
                'fecha_recepcion' => '2018-12-11',
                'fecha_liberacion' => '2018-12-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '243600.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-30 10:27:23',
                'updated_at' => '2023-01-30 10:27:23',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            415 => [

                'contrato_id' => 63,
                'no_factura' => 'cffd9006-25de-4a5a-836b-53fd7b18a212',
                'concepto' => 'Servicio de Implementación de un Modelo de Gobierno de Tecnologías de la Información y Comunicaciones de un Sistema de Gestión de Seguridad de la Información. SENADO',
                'fecha_recepcion' => '2018-12-11',
                'fecha_liberacion' => '2018-12-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '243600.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-30 10:29:02',
                'updated_at' => '2023-01-30 10:29:02',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            416 => [

                'contrato_id' => 63,
                'no_factura' => 'd316481d-816f-4f3c-9bdb-0d1ed5ec7d79',
                'concepto' => 'Servicio de Implementación de un Modelo de Gobierno de Tecnologías de la Información y Comunicaciones de un Sistema de Gestión de Seguridad de la Información. SENADO',
                'fecha_recepcion' => '2018-12-11',
                'fecha_liberacion' => '2018-12-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '243600.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-30 10:30:53',
                'updated_at' => '2023-01-30 10:30:53',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            417 => [

                'contrato_id' => 119,
                'no_factura' => 'S 552',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución (hardware y software)
Servicio Abril 2021 (16 de 35)',
                'fecha_recepcion' => '2021-05-06',
                'fecha_liberacion' => '2021-05-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-30 13:29:18',
                'updated_at' => '2023-01-30 13:29:18',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            418 => [

                'contrato_id' => 119,
                'no_factura' => 'S 568',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución (hardware y software)
Servicio Mayo 2021 (17 de 35)',
                'fecha_recepcion' => '2021-06-07',
                'fecha_liberacion' => '2021-06-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-30 13:34:00',
                'updated_at' => '2023-01-30 13:34:00',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            419 => [

                'contrato_id' => 119,
                'no_factura' => 'S 592',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución (hardware y software)
Servicio Junio 2021 (18 de 35)',
                'fecha_recepcion' => '2021-07-05',
                'fecha_liberacion' => '2021-07-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-30 13:36:27',
                'updated_at' => '2023-01-30 13:36:27',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            420 => [

                'contrato_id' => 119,
                'no_factura' => 'S 627',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución (hardware y software)
Servicio Agosto 2021 (20 de 35)',
                'fecha_recepcion' => '2021-09-09',
                'fecha_liberacion' => '2021-09-09',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-30 13:39:11',
                'updated_at' => '2023-01-30 13:39:11',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            421 => [

                'contrato_id' => 119,
                'no_factura' => 'S 850',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución (hardware y software)
Servicio Junio 2022 (30 de 35)',
                'fecha_recepcion' => '2022-07-18',
                'fecha_liberacion' => '2022-07-18',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '45682.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-01-30 13:41:37',
                'updated_at' => '2023-01-30 13:41:37',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            422 => [

                'contrato_id' => 121,
                'no_factura' => 'S334',
                'concepto' => 'Módulo DLP
Módulo AP eMAIL
SERVICIO DE SEGURIDAD PERIMETRAL EN LA RED DE DATOS LOCAL - "DLP FORCEPOINT"
2019 N°. IA-010K2O001-E111-2019',
                'fecha_recepcion' => '2019-12-06',
                'fecha_liberacion' => '2019-12-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '1.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => null,
                'created_at' => '2023-02-02 13:57:49',
                'updated_at' => '2023-02-02 14:00:16',
                'deleted_at' => '2023-02-02 14:00:16',
                'created_by' => 20,
                'updated_by' => 20,
            ],
            423 => [

                'contrato_id' => 121,
                'no_factura' => 'S 334',
                'concepto' => 'Módulo DLP
Módulo AP eMAIL
SERVICIO DE SEGURIDAD PERIMETRAL EN LA RED DE DATOS LOCAL - "DLP FORCEPOINT" 2019 N°. IA-010K2O001-E111-2019',
                'fecha_recepcion' => '2019-12-06',
                'fecha_liberacion' => '2019-12-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '733992.74',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-02-02 14:01:45',
                'updated_at' => '2023-02-02 14:01:45',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            424 => [

                'contrato_id' => 122,
                'no_factura' => 'S 420',
                'concepto' => 'Servicio de Pruebas de Penetración de Caja Negra
Servicio de Ingeniería Social',
                'fecha_recepcion' => '2020-08-05',
                'fecha_liberacion' => '2020-08-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '145501.24',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => null,
                'created_at' => '2023-02-02 14:22:05',
                'updated_at' => '2023-02-02 14:22:05',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            425 => [

                'contrato_id' => 124,
                'no_factura' => 'S 458',
                'concepto' => 'Servicio de Seguridad Avanzada para Correo Electrónico, Endpoints y Servidores, para la SEDATU',
                'fecha_recepcion' => '2020-10-16',
                'fecha_liberacion' => '2020-10-16',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '7999268.40',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-02-02 14:58:28',
                'updated_at' => '2023-02-02 14:58:28',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            426 => [

                'contrato_id' => 25,
                'no_factura' => 'C 52',
                'concepto' => 'Servicio NOC desde Centro de Operaciones Julio 2021
Folio HB21-179-04 para el mes de julio del 2021',
                'fecha_recepcion' => '2021-10-28',
                'fecha_liberacion' => '2021-10-28',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '49590.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-02-07 14:28:23',
                'updated_at' => '2023-02-07 14:28:23',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            427 => [

                'contrato_id' => 25,
                'no_factura' => 'C 53',
                'concepto' => 'Servicio NOC desde Centro de Operaciones Ago-Sept
Folio HB21-179-05 en la factura para SYCOD del mes AGOS-SEP del 2021',
                'fecha_recepcion' => '2021-10-28',
                'fecha_liberacion' => '2021-10-28',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '99180.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-02-07 14:30:25',
                'updated_at' => '2023-02-07 14:30:25',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            428 => [

                'contrato_id' => 25,
                'no_factura' => 'C 7',
                'concepto' => 'Servicio de monitoreo de red
Servicio DENTEGRA jul‐sep22
(OC HB22‐007‐03)',
                'fecha_recepcion' => '2022-10-05',
                'fecha_liberacion' => '2022-10-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '148770.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-02-07 14:35:55',
                'updated_at' => '2023-02-07 14:35:55',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            429 => [

                'contrato_id' => 25,
                'no_factura' => 'C 23',
                'concepto' => 'Servicio de monitoreo de red
Servicio DENTEGRA octubre a diciembre 2022
OC HB22‐007‐Q4 KIO',
                'fecha_recepcion' => '2022-12-22',
                'fecha_liberacion' => '2022-12-22',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '148770.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-02-07 14:37:34',
                'updated_at' => '2023-02-07 14:37:34',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            430 => [

                'contrato_id' => 139,
                'no_factura' => 'S 702',
                'concepto' => 'Servicio para el establecimiento del Marco de Gobierno de cuentas privilegiadas ',
                'fecha_recepcion' => '2021-12-13',
                'fecha_liberacion' => '2021-12-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '228364.35',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => null,
                'created_at' => '2023-02-15 10:26:04',
                'updated_at' => '2023-02-15 10:26:04',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            431 => [

                'contrato_id' => 143,
                'no_factura' => 'S 784',
                'concepto' => 'Palo Alto Networks PA-220
Threat Prevention subscription for device in an HA
WildFire subscription year 1 for device in HA pair
Premium support year 1, PA-220',
                'fecha_recepcion' => '2022-04-26',
                'fecha_liberacion' => '2022-04-26',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '3680.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => null,
                'created_at' => '2023-03-07 11:58:28',
                'updated_at' => '2023-03-07 11:58:28',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            432 => [

                'contrato_id' => 144,
                'no_factura' => 'S 738',
                'concepto' => 'Pedido de compra: 4110004391
Marca: WD
Modelo: WDBVBZ0240JCH-NESN
WD Serial number: WUBM31241986
Especificaciones: SAM-577 NAS WD MY CLOUD EX2 ULTRA 24TB/CON 2 DISCOS DE 12 TB
(NAS WD MY CLOUD EX2 ULTRA 24TB/CON 2 DISCOS DE 12TB/2BAHIAS/1.3GHZ/1gb/1ETHERNET/2USB3.0/RAID 0-1)',
                'fecha_recepcion' => '2022-03-03',
                'fecha_liberacion' => '2022-03-03',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '1484.45',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => null,
                'created_at' => '2023-03-07 13:12:39',
                'updated_at' => '2023-03-07 13:12:39',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            433 => [

                'contrato_id' => 146,
                'no_factura' => 'C 25',
                'concepto' => 'Servicios de consultoria
SERVICIOS DE CIBERSEGURIDAD
(Análisis de Vulnerabilidades)',
                'fecha_recepcion' => '2023-01-19',
                'fecha_liberacion' => '2023-01-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '84329.60',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => null,
                'created_at' => '2023-03-07 14:00:54',
                'updated_at' => '2023-03-07 14:00:54',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            434 => [

                'contrato_id' => 85,
                'no_factura' => 'S 959',
                'concepto' => 'Servicios de consultoría
IMPLEMENTACIÓN DE PROCESOS DE GESTIÓN ITIL Y MEJORA CONTINUA DURACIÓN DEL PROYECTO DE JULIO 2022 A DICIEMBRE 2022 CONFORME A PROPUESTA TECNICA
ORDEN DE COMPRA 01‐ 0000220',
                'fecha_recepcion' => '2022-12-06',
                'fecha_liberacion' => '2022-12-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '438886.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-03-15 13:20:16',
                'updated_at' => '2023-03-15 13:21:11',
                'deleted_at' => '2023-03-15 13:21:11',
                'created_by' => 20,
                'updated_by' => 20,
            ],
            435 => [

                'contrato_id' => 85,
                'no_factura' => 'S 959',
                'concepto' => 'Servicios de consultoria
IMPLEMENTACIÓN DE PROCESOS DE GESTIÓN ITIL Y MEJORA CONTINUA DURACIÓN DEL PROYECTO DE JULIO 2022 A DICIEMBRE 2022 CONFORME A PROPUESTA TECNICA
ORDEN DE COMPRA 01‐ 0000220',
                'fecha_recepcion' => '2022-12-06',
                'fecha_liberacion' => '2022-12-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '438886.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-03-15 13:23:01',
                'updated_at' => '2023-03-15 13:23:01',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            436 => [

                'contrato_id' => 7,
                'no_factura' => 'S 775',
                'concepto' => 'Servicio de Ciberseguridad
Análisis de Vulnerabilidades, Pentesting, Cyberdefense, Threat Hunting, Forense. Borrado seguro. Phishing, Ciber investigación.',
                'fecha_recepcion' => '2022-04-19',
                'fecha_liberacion' => '2022-04-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '2088000.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-05 13:28:43',
                'updated_at' => '2023-04-05 13:28:43',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            437 => [

                'contrato_id' => 7,
                'no_factura' => 'S 776',
                'concepto' => 'LogRhythm DetectX software subscription license
LogRhythm RespondX software subscription license
LogRhythm System Monitor Pro Subscription para 50 dispositivos',
                'fecha_recepcion' => '2022-04-19',
                'fecha_liberacion' => '2022-04-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '75632.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-05 14:43:02',
                'updated_at' => '2023-04-05 14:43:02',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            438 => [

                'contrato_id' => 7,
                'no_factura' => 'S 778',
                'concepto' => 'Servicio de SOC para el Grupo Financiero VE POR MAS',
                'fecha_recepcion' => '2022-04-20',
                'fecha_liberacion' => '2022-04-20',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '293329.35',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-05 14:45:01',
                'updated_at' => '2023-04-05 14:45:01',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            439 => [

                'contrato_id' => 7,
                'no_factura' => 'S 793',
                'concepto' => 'Servicio de SOC para el Grupo Financiero VE POR MAS',
                'fecha_recepcion' => '2022-05-09',
                'fecha_liberacion' => '2022-05-09',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '293329.35',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-05 14:52:41',
                'updated_at' => '2023-04-05 14:52:41',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            440 => [

                'contrato_id' => 7,
                'no_factura' => 'S 794',
                'concepto' => 'LogRhythm DetectX software subscription license
LogRhythm RespondX software subscription license
LogRhythm System Monitor Pro Subscription para 50 dispositivos',
                'fecha_recepcion' => '2022-05-09',
                'fecha_liberacion' => '2022-05-09',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '75632.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 09:18:10',
                'updated_at' => '2023-04-06 09:18:10',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            441 => [

                'contrato_id' => 7,
                'no_factura' => 'S 814',
                'concepto' => 'LogRhythm DetectX software subscription license
LogRhythm RespondX software subscription license
LogRhythm System Monitor Pro Subscription para 50 dispositivos',
                'fecha_recepcion' => '2022-06-02',
                'fecha_liberacion' => '2022-06-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75632.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'recibido',
                'created_at' => '2023-04-06 09:23:53',
                'updated_at' => '2023-04-06 09:23:53',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            442 => [

                'contrato_id' => 7,
                'no_factura' => 'S 815',
                'concepto' => 'Servicio de SOC para el Grupo Financiero VE POR MAS',
                'fecha_recepcion' => '2022-06-02',
                'fecha_liberacion' => '2022-06-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '293329.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 09:27:04',
                'updated_at' => '2023-04-06 09:27:04',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            443 => [

                'contrato_id' => 7,
                'no_factura' => 'S 836',
                'concepto' => 'LogRhythm DetectX software subscription license
LogRhythm RespondX software subscription license
LogRhythm System Monitor Pro Subscription para 50 dispositivos',
                'fecha_recepcion' => '2022-07-05',
                'fecha_liberacion' => '2022-07-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75632.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 09:29:57',
                'updated_at' => '2023-04-06 09:29:57',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            444 => [

                'contrato_id' => 7,
                'no_factura' => 'S 836',
                'concepto' => 'Servicio de SOC para el Grupo Financiero VE POR MAS',
                'fecha_recepcion' => '2022-07-05',
                'fecha_liberacion' => '2022-07-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '293329.25',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 09:31:51',
                'updated_at' => '2023-04-06 09:32:05',
                'deleted_at' => '2023-04-06 09:32:05',
                'created_by' => 20,
                'updated_by' => 20,
            ],
            445 => [

                'contrato_id' => 7,
                'no_factura' => 'S 837',
                'concepto' => 'Servicio de SOC para el Grupo Financiero VE POR MAS',
                'fecha_recepcion' => '2022-07-05',
                'fecha_liberacion' => '2022-07-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '293329.25',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 09:33:55',
                'updated_at' => '2023-04-06 09:33:55',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            446 => [

                'contrato_id' => 7,
                'no_factura' => 'S 870',
                'concepto' => 'LogRhythm DetectX software subscription license
LogRhythm RespondX software subscription license
LogRhythm System Monitor Pro subscription para 50 dispositivos',
                'fecha_recepcion' => '2022-08-04',
                'fecha_liberacion' => '2022-08-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75632.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 09:36:18',
                'updated_at' => '2023-04-06 09:36:18',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            447 => [

                'contrato_id' => 7,
                'no_factura' => 'S 872',
                'concepto' => 'Servicio de SOC para el Grupo Financiero VE POR MAS',
                'fecha_recepcion' => '2022-08-04',
                'fecha_liberacion' => '2022-08-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '293329.35',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 09:41:36',
                'updated_at' => '2023-04-06 09:41:36',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            448 => [

                'contrato_id' => 7,
                'no_factura' => 'S 933',
                'concepto' => 'Servicios administrados
Servicio de SOC para el Grupo Financiero VE POR MAS',
                'fecha_recepcion' => '2022-09-13',
                'fecha_liberacion' => '2022-09-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '293329.35',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 09:46:11',
                'updated_at' => '2023-04-06 09:46:11',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            449 => [

                'contrato_id' => 7,
                'no_factura' => 'S 934',
                'concepto' => 'LogRhythm DetectX software subscription license
LogRhythm RespondX software subscription license
LogRhythm System Monitor Pro Subscription para 50 dispositivo',
                'fecha_recepcion' => '2022-09-13',
                'fecha_liberacion' => '2022-09-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75632.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 09:50:36',
                'updated_at' => '2023-04-06 09:50:36',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            450 => [

                'contrato_id' => 7,
                'no_factura' => 'S 943',
                'concepto' => 'Servicio de SOC para el Grupo Financiero VE POR MAS',
                'fecha_recepcion' => '2022-10-04',
                'fecha_liberacion' => '2022-10-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '293329.35',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 09:56:02',
                'updated_at' => '2023-04-06 09:56:02',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            451 => [

                'contrato_id' => 7,
                'no_factura' => 'S 944',
                'concepto' => 'LogRhythm DetectX software subscription license
LogRhythm RespondX software subscription license
LogRhythm System Monitor Pro Subscription para 50 dispositivos',
                'fecha_recepcion' => '2022-10-04',
                'fecha_liberacion' => null,
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '0.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 10:05:02',
                'updated_at' => '2023-04-06 10:05:02',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            452 => [

                'contrato_id' => 7,
                'no_factura' => 'S 974',
                'concepto' => 'Servicio de SOC para el Grupo Financiero VE POR MAS',
                'fecha_recepcion' => '2022-11-04',
                'fecha_liberacion' => '2022-11-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '293329.35',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 10:12:36',
                'updated_at' => '2023-04-06 10:12:36',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            453 => [

                'contrato_id' => 7,
                'no_factura' => 'S 975',
                'concepto' => 'Licenciamiento LogRhythm DetectX software subscription license
Licenciamiento LogRhythm RespondX software subscription license
Licenciamiento LogRhythm System Monitor Pro Subscription para 50 dispositivos
',
                'fecha_recepcion' => '2022-11-04',
                'fecha_liberacion' => '2022-11-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75632.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 10:15:08',
                'updated_at' => '2023-04-06 10:15:08',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            454 => [

                'contrato_id' => 7,
                'no_factura' => 'S 1024',
                'concepto' => 'Servicio de SOC para el Grupo Financiero VE POR MAS',
                'fecha_recepcion' => '2022-12-05',
                'fecha_liberacion' => '2022-12-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '293329.35',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 10:16:40',
                'updated_at' => '2023-04-06 10:16:40',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            455 => [

                'contrato_id' => 7,
                'no_factura' => 'S 1025',
                'concepto' => 'Licencimiento LogRhythm DetectX software subscription license
Licencimiento LogRhythm RespondX software subscription license
Licencimiento LogRhythm System Monitor Pro Subscription para 50 dispositivos',
                'fecha_recepcion' => '2022-12-05',
                'fecha_liberacion' => '2022-12-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75632.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 10:20:00',
                'updated_at' => '2023-04-06 10:20:00',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            456 => [

                'contrato_id' => 7,
                'no_factura' => 'S 1026',
                'concepto' => 'Licenciamiento LogRhythm DetectX software subscription license
Licenciamiento LogRhythm RespondX software subscription license
Licenciamiento LogRhythm System Monitor Pro Subscription para 50 dispositivos',
                'fecha_recepcion' => '2022-12-05',
                'fecha_liberacion' => '2022-12-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75632.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 10:21:56',
                'updated_at' => '2023-04-06 10:21:56',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            457 => [

                'contrato_id' => 7,
                'no_factura' => 'S 1027',
                'concepto' => 'Servicio del SOC para el Grupo Financiero VE POR MAS',
                'fecha_recepcion' => '2022-12-05',
                'fecha_liberacion' => '2022-12-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '293329.35',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 10:23:19',
                'updated_at' => '2023-04-06 10:23:19',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            458 => [

                'contrato_id' => 116,
                'no_factura' => 'C-26',
                'concepto' => 'Servicios de Consultoría',
                'fecha_recepcion' => '2023-01-19',
                'fecha_liberacion' => '2023-01-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '28998.05',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-04-06 11:28:48',
                'updated_at' => '2023-04-06 11:28:48',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            459 => [

                'contrato_id' => 118,
                'no_factura' => 'C-30',
                'concepto' => 'Servicios de Pruebas de Penetración de Cana Negra a Aplicaciones Web y Aplicaciones Móviles.',
                'fecha_recepcion' => '2023-03-07',
                'fecha_liberacion' => '2023-03-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '185600.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 11:35:41',
                'updated_at' => '2023-04-06 11:35:41',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            460 => [

                'contrato_id' => 105,
                'no_factura' => 'S 1101',
                'concepto' => 'Póliza de mantenimiento preventivo, correctivo y soporte técnico para los equipos del Core de la red de datos inalámbrica de PEMEX.',
                'fecha_recepcion' => '2023-03-22',
                'fecha_liberacion' => '2023-03-22',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '2264673.51',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 11:48:02',
                'updated_at' => '2023-04-06 11:48:02',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            461 => [

                'contrato_id' => 105,
                'no_factura' => 'S 1102',
                'concepto' => 'Servicio de soporte técnico Póliza de mantenimiento preventivo, correctivo y soporte técnico para los equipos del Core de la red de datos inalámbrica de PEMEX.',
                'fecha_recepcion' => '2023-03-23',
                'fecha_liberacion' => '2023-03-23',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '2264673.51',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 11:50:05',
                'updated_at' => '2023-04-06 11:50:05',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            462 => [

                'contrato_id' => 145,
                'no_factura' => 'S 1061',
                'concepto' => 'Servicio Evento 1‐E01 Reporte ejecutivo de resultados de pruebas de penetración.
Servicio Evento 1‐E02 Reporte técnico detallado de Pruebas de Penetración (incluir herramientas empleadas junto con la evidencia de los hallazgos obtenidos)',
                'fecha_recepcion' => '2022-12-29',
                'fecha_liberacion' => '2022-12-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '153144.16',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 12:08:46',
                'updated_at' => '2023-04-06 12:09:35',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            463 => [

                'contrato_id' => 145,
                'no_factura' => 'S 1063',
                'concepto' => 'Servicio Evento 2‐E01 Reporte ejecutivo de resultados de pruebas de penetración Banca Electrónica
Servicio Evento 2‐E02 Reporte técnico detallado de Pruebas de Penetración (incluir herramientas empleadas junto con la evidencia de los hallazgos obtenidos) Banca Electrónica',
                'fecha_recepcion' => '2022-12-29',
                'fecha_liberacion' => '2022-12-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '153144.16',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 12:10:52',
                'updated_at' => '2023-04-06 12:10:52',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            464 => [

                'contrato_id' => 145,
                'no_factura' => 'S 1064',
                'concepto' => 'Servicio Evento 1‐E03 Reporte ejecutivo de resultados ejecutivo del Análisis de Vulnerabilidades SIA
Servicio Evento 1‐E04 Reporte técnico detallado del Análisis de Vulnerabilidades (incluir herramientas empleadas junto con la evidencia de los hallazgos obtenidos) SIA
Servicio Evento 1‐E05 Reporte de resultados ejecutivo de las pruebas dinámicas ‐ reporte ejecutivo de resultados del incumplimiento de normas, reglas y mejores prácticas en programación, y brechas de seguridad
Servicio Evento 1‐E06 Reporte técnico detallado del incumplimiento de normas, y brechas de seguridad',
                'fecha_recepcion' => '2022-12-29',
                'fecha_liberacion' => '2022-12-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '122515.32',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 12:14:25',
                'updated_at' => '2023-04-06 12:14:25',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            465 => [

                'contrato_id' => 145,
                'no_factura' => 'S 1065',
                'concepto' => 'Servicio Evento 2‐E03 Reporte ejecutivo de resultados ejecutivo del Análisis de Vulnerabilidades Terminal Financiera
Servicio Evento 2‐E04 Reporte técnico detallado del Análisis de Vulnerabilidades (incluir herramientas empleadas junto con la evidencia de los hallazgos obtenidos) Terminal Financiera
Servicio Evento 2‐E05 Reporte de resultados ejecutivo de las pruebas dinámicas ‐ reporte ejecutivo de resultados del incumplimiento de normas, reglas y mejores prácticas en programación, y brechas de seguridad.
Servicio Evento 2‐E06 Reporte técnico detallado del incumplimiento de normas, y brechas de seguridad',
                'fecha_recepcion' => '2022-12-29',
                'fecha_liberacion' => '2022-12-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '122515.32',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 12:18:41',
                'updated_at' => '2023-04-06 12:18:41',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            466 => [

                'contrato_id' => 145,
                'no_factura' => 'S 1066',
                'concepto' => 'Servicio Certificado de borrado seguro (documento generado por la herramienta empleada, incluir al menos fecha y hora de inicio del proceso, dispositivo, producto, información del sistema y hardware, método de borrado ‐patrones empleados‐ verificación y estado
Servicio Acta de cierre del proyecto',
                'fecha_recepcion' => '2022-12-29',
                'fecha_liberacion' => '2022-12-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '61257.66',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 12:20:24',
                'updated_at' => '2023-04-06 12:20:24',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            467 => [

                'contrato_id' => 91,
                'no_factura' => 'C 18',
                'concepto' => 'Servicio de toma de imágenes forense
Servicio de análisis forense',
                'fecha_recepcion' => '2022-12-05',
                'fecha_liberacion' => '2022-12-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '196667.31',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-04-06 12:28:21',
                'updated_at' => '2023-04-06 12:28:21',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            468 => [

                'contrato_id' => 97,
                'no_factura' => 'C-11',
                'concepto' => 'MADUREZ DE PROCESOS ITIL V4',
                'fecha_recepcion' => '2022-11-15',
                'fecha_liberacion' => '2022-11-15',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '306803.76',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 12:34:30',
                'updated_at' => '2023-04-06 12:34:30',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            469 => [

                'contrato_id' => 98,
                'no_factura' => 'S 1060',
                'concepto' => 'Servicios de consultoría Partida 1 Auditoría en materia de Evaluación de Servicios en BANJETEL
Servicios de consultoría. Partida 2 Auditoría en materia de implementación de Biométricos
Servicios de consultoría. Partida 3 Auditoría de Vulnerabilidades a Cajeros Automáticos
Servicios de consultoría. Partida 4 Auditoría de Cumplimiento Normas PCI (Industria de Tarjeta de Pago)
Servicios de consultoría. Partida 5 Auditoría en materia de Continuidad de Negocio
Servicios de consultoría. Partida 6 Auditoría de cumplimiento a los requisitos del INDEVAL
Servicios de consultoría. Partida 7 Auditoría al Sistema de Pagos Electrónicos Interbancarios SPEI
Servicios de consultoría. Partida 8 Auditoría al Sistema de Pagos Interbancarios en dólares SPID',
                'fecha_recepcion' => '2022-12-28',
                'fecha_liberacion' => '2022-12-28',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '13924060.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 14:38:15',
                'updated_at' => '2023-04-06 14:38:15',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            470 => [

                'contrato_id' => 86,
                'no_factura' => 'S 1052',
                'concepto' => 'Servicios de consultoría. SERVICIO DE ANÁLISIS FORENSE
Servicios de consultoría. SERVICIO DE DICTAMEN FORENSE',
                'fecha_recepcion' => '2022-12-20',
                'fecha_liberacion' => '2022-12-20',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '691243.77',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-06 14:54:25',
                'updated_at' => '2023-04-06 14:54:25',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            471 => [

                'contrato_id' => 103,
                'no_factura' => 'C-20',
                'concepto' => 'PT Caja Negra y Concientización en materia de seguridad de la información ',
                'fecha_recepcion' => '2022-12-12',
                'fecha_liberacion' => '2022-12-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '50403.83',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 09:17:17',
                'updated_at' => '2023-04-14 15:30:33',
                'deleted_at' => '2023-04-14 15:30:33',
                'created_by' => 18,
                'updated_by' => 19,
            ],
            472 => [

                'contrato_id' => 103,
                'no_factura' => 'C-24',
                'concepto' => 'PT Caja negra y concientización en materia de seguridad de la información ',
                'fecha_recepcion' => '2023-01-12',
                'fecha_liberacion' => '2023-01-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '50403.83',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 09:18:57',
                'updated_at' => '2023-04-14 15:30:28',
                'deleted_at' => '2023-04-14 15:30:28',
                'created_by' => 18,
                'updated_by' => 19,
            ],
            473 => [

                'contrato_id' => 104,
                'no_factura' => 'C-20',
                'concepto' => 'PT Caja Negra y Concientización en materia de seguridad de la información',
                'fecha_recepcion' => '2022-12-19',
                'fecha_liberacion' => '2022-12-20',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '50403.83',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 10:34:40',
                'updated_at' => '2023-04-11 10:34:40',
                'deleted_at' => null,
                'created_by' => 18,
                'updated_by' => null,
            ],
            474 => [

                'contrato_id' => 104,
                'no_factura' => 'C-24',
                'concepto' => 'PT Caja Negra y Concientización en materia de seguridad de la información',
                'fecha_recepcion' => '2023-01-12',
                'fecha_liberacion' => '2023-01-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '50403.83',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 10:36:31',
                'updated_at' => '2023-04-11 10:36:31',
                'deleted_at' => null,
                'created_by' => 18,
                'updated_by' => null,
            ],
            475 => [

                'contrato_id' => 8,
                'no_factura' => 'S 817',
                'concepto' => 'Sistema de Gestión de Seguridad de la Información
Servicio BIA
Servicio Administrativo de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de Correlación de Eventos y Administración de Bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam para el correo electrónico
Servicio de Antivirus a estaciones locales',
                'fecha_recepcion' => '2022-06-03',
                'fecha_liberacion' => '2022-06-03',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 10:38:41',
                'updated_at' => '2023-04-11 10:38:41',
                'deleted_at' => null,
                'created_by' => 18,
                'updated_by' => null,
            ],
            476 => [

                'contrato_id' => 8,
                'no_factura' => 'CPB 451',
                'concepto' => 'Sistema de Gestión de Seguridad de la Información
Servicio BIA
Servicio Administrativo de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de Correlación de Eventos y Administración de Bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam para el correo electrónico
Servicio de Antivirus a estaciones locales.
',
                'fecha_recepcion' => '2022-07-07',
                'fecha_liberacion' => '2022-07-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '2530.17',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 10:40:17',
                'updated_at' => '2023-04-11 10:40:17',
                'deleted_at' => null,
                'created_by' => 18,
                'updated_by' => null,
            ],
            477 => [

                'contrato_id' => 8,
                'no_factura' => 'S 840',
                'concepto' => 'Sistema de Gestión de Seguridad de la Información
Servicio BIA
Servicio Administrativo de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de Correlación de Eventos y Administración de Bitácoras
Servicio DNS Seguro
Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam para el correo electrónico
Servicio de Antivirus a estaciones locales.',
                'fecha_recepcion' => '2022-07-07',
                'fecha_liberacion' => '2022-07-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 10:41:12',
                'updated_at' => '2023-04-11 10:41:12',
                'deleted_at' => null,
                'created_by' => 18,
                'updated_by' => null,
            ],
            478 => [

                'contrato_id' => 155,
                'no_factura' => 'S 1073',
                'concepto' => 'Consecutivo 1. Servicio Gestión de Vulnerabilidades para los Activos de TI
Consecutivo 2. Servicio de Correlación de Eventos de Seguridad
Consecutivo 3. Servicio de Ciber Inteligencia de Amenazas Institucionales
Consecutivo 4. Servicio Administrado de Centro de Operaciones de seguridad (SOC) y Centro de Operaciones de Red (NOC) 7x24x365
Consecutivo 5. Servicio de Filtrado de Contenido
Consecutivo 6. Servicio de Claves Privilegiadas
Consecutivo 7. Servicio de Ciber Amenazas Avanzadas y Visibilidad en la Red a Través del Engaño',
                'fecha_recepcion' => '2023-03-10',
                'fecha_liberacion' => '2023-03-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '3722086.88',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 10:45:35',
                'updated_at' => '2023-04-11 10:45:35',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            479 => [

                'contrato_id' => 155,
                'no_factura' => 'S 1093',
                'concepto' => 'Consecutivo 1. Servicio Gestión de Vulnerabilidades para los Activos de TI
Consecutivo 2. Servicio de Correlación de Eventos de Seguridad
Consecutivo 3. Servicio de Ciber Inteligencia de Amenazas Institucionales
Consecutivo 4. Servicio Administrado de Centro de Operaciones de seguridad (SOC) y Centro de Operaciones de Red (NOC) 7x24x365
Consecutivo 5. Servicio de Filtrado de Contenido
Consecutivo 6. Servicio de Claves Privilegiadas
Consecutivo 7. Servicio de Ciber Amenazas Avanzadas y Visibilidad en la Red a Través del Engaño',
                'fecha_recepcion' => '2023-03-10',
                'fecha_liberacion' => '2023-03-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '7444173.91',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 10:49:18',
                'updated_at' => '2023-04-11 10:49:18',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            480 => [

                'contrato_id' => 20,
                'no_factura' => 'S 820',
                'concepto' => '1 Partida 1 Especialista en Seguridad y Continuidad de Riesgo
1 Partida 1 Hacker Ético
8 Partida 2 Licencias de Antivirus

Servicio de Seguridad de la Información correspondiente a los ejercicios fiscales 2021, 2022 y 2023
Contrato número S-079- 2021

Servicio mayo 2022',
                'fecha_recepcion' => '2022-06-06',
                'fecha_liberacion' => '2022-06-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 10:59:00',
                'updated_at' => '2023-04-11 10:59:37',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            481 => [

                'contrato_id' => 20,
                'no_factura' => 'S 838',
                'concepto' => '1 Partida 1 Especialista en Seguridad y Continuidad de Riesgo
1 Partida 1 Hacker Ético
8 Partida 2 Licencias de Antivirus

Servicio de Seguridad de la Información correspondiente a los ejercicios fiscales 2021, 2022 y 2023
Contrato número S-079- 2021

Servicio Junio 2022',
                'fecha_recepcion' => '2022-07-05',
                'fecha_liberacion' => '2022-07-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 11:02:12',
                'updated_at' => '2023-04-11 11:02:12',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            482 => [

                'contrato_id' => 20,
                'no_factura' => 'S 869',
                'concepto' => '1 Partida 1 Especialista en Seguridad y Continuidad de Riesgo
1 Partida 1 Hacker Ético
8 Partida 2 Licencias de Antivirus

Servicio de Seguridad de la Información correspondiente a los ejercicios fiscales 2021, 2022 y 2023
Contrato número S-079- 2021

Servicio Julio 2022',
                'fecha_recepcion' => '2022-08-04',
                'fecha_liberacion' => '2022-08-04',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 11:03:13',
                'updated_at' => '2023-04-11 11:03:13',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            483 => [

                'contrato_id' => 20,
                'no_factura' => 'S 927',
                'concepto' => '1 Partida 1 Especialista en Seguridad y Continuidad de Riesgo
1 Partida 1 Hacker Ético
8 Partida 2 Licencias de Antivirus

Servicio de Seguridad de la Información correspondiente a los ejercicios fiscales 2021, 2022 y 2023
Contrato número S-079- 2021

Servicio agosto 2022',
                'fecha_recepcion' => '2022-09-09',
                'fecha_liberacion' => '2022-09-09',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 11:28:39',
                'updated_at' => '2023-04-11 11:28:39',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            484 => [

                'contrato_id' => 20,
                'no_factura' => 'S 947',
                'concepto' => '1 Partida 1 Especialista en Seguridad y Continuidad de Riesgo
1 Partida 1 Hacker Ético
8 Partida 2 Licencias de Antivirus

Servicio de Seguridad de la Información correspondiente a los ejercicios fiscales 2021, 2022 y 2023
Contrato número S-079- 2021

Servicio septiembre 2022',
                'fecha_recepcion' => '2022-10-06',
                'fecha_liberacion' => '2022-10-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 11:31:58',
                'updated_at' => '2023-04-11 11:31:58',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            485 => [

                'contrato_id' => 20,
                'no_factura' => 'S 987',
                'concepto' => '1 Partida 1 Especialista en Seguridad y Continuidad de Riesgo
1 Partida 1 Hacker Ético
8 Partida 2 Licencias de Antivirus

Servicio de Seguridad de la Información correspondiente a los ejercicios fiscales 2021, 2022 y 2023
Contrato número S-079- 2021

Servicio Octubre 2022',
                'fecha_recepcion' => '2022-11-11',
                'fecha_liberacion' => '2022-11-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 11:33:08',
                'updated_at' => '2023-04-11 11:33:08',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            486 => [

                'contrato_id' => 20,
                'no_factura' => 'A 1014',
                'concepto' => '1 Partida 1 Especialista en Seguridad y Continuidad de Riesgo
1 Partida 1 Hacker Ético
8 Partida 2 Licencias de Antivirus

Servicio de Seguridad de la Información correspondiente a los ejercicios fiscales 2021, 2022 y 2023
Contrato número S-079- 2021

Servicio noviembre 2022',
                'fecha_recepcion' => '2022-12-01',
                'fecha_liberacion' => '2022-12-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 11:33:52',
                'updated_at' => '2023-04-11 11:33:52',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            487 => [

                'contrato_id' => 20,
                'no_factura' => 'S 1047',
                'concepto' => '1 Partida 1 Especialista en Seguridad y Continuidad de Riesgo
1 Partida 1 Hacker Ético
8 Partida 2 Licencias de Antivirus

Servicio de Seguridad de la Información correspondiente a los ejercicios fiscales 2021, 2022 y 2023
Contrato número S-079- 2021

Servicio diciembre 2022',
                'fecha_recepcion' => '2022-12-12',
                'fecha_liberacion' => '2022-12-12',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 11:34:54',
                'updated_at' => '2023-04-11 11:34:54',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            488 => [

                'contrato_id' => 20,
                'no_factura' => 'S 925',
                'concepto' => '1 Partida 1 Especialista en Seguridad y Continuidad de Riesgo
1 Partida 1 Hacker Ético
8 Partida 2 Licencias de Antivirus

Servicio de Seguridad de la Información correspondiente a los ejercicios fiscales 2021, 2022 y 2023
Contrato número S-079- 2021

Servicio enero 2023',
                'fecha_recepcion' => '2023-02-13',
                'fecha_liberacion' => '2023-02-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 11:36:41',
                'updated_at' => '2023-04-11 11:36:41',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            489 => [

                'contrato_id' => 20,
                'no_factura' => 'S 1079',
                'concepto' => '1 Partida 1 Especialista en Seguridad y Continuidad de Riesgo
1 Partida 1 Hacker Ético
8 Partida 2 Licencias de Antivirus

Servicio de Seguridad de la Información correspondiente a los ejercicios fiscales 2021, 2022 y 2023
Contrato número S-079- 2021

Servicio febrero 2023',
                'fecha_recepcion' => '2023-03-03',
                'fecha_liberacion' => '2023-03-03',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 11:38:54',
                'updated_at' => '2023-04-11 11:38:54',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            490 => [

                'contrato_id' => 19,
                'no_factura' => 'S 821',
                'concepto' => 'mayo 2022
Mensualidad 5 de 12

Consecutivo 1.- Servicio de Ciberamenazas avanzadas y visibilidad en la red a través de la red del engaño.
Consecutivo 2.- Servicio de correlación de eventos de seguridad.
Consecutivo 3.- Servicio de Ciber inteligencia de amenazas.
Consecutivo 4.- Servicio Administrado de Centro de Operaciones de Seguridad (SOC) y Centro de Operaciones de Red (NOC) 7X24X365.
Consecutivo 5.- Servicio de análisis de vulnerabilidades y pruebas de penetración.',
                'fecha_recepcion' => '2022-06-09',
                'fecha_liberacion' => '2022-06-09',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '6413350.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 12:23:03',
                'updated_at' => '2023-04-11 12:23:41',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            491 => [

                'contrato_id' => 19,
                'no_factura' => 'S 847',
                'concepto' => 'junio 2022
Mensualidad 6 de 12

Consecutivo 1.- Servicio de Ciberamenazas avanzadas y visibilidad en la red a través de la red del engaño.
Consecutivo 2.- Servicio de correlación de eventos de seguridad.
Consecutivo 3.- Servicio de Ciber inteligencia de amenazas.
Consecutivo 4.- Servicio Administrado de Centro de Operaciones de Seguridad (SOC) y Centro de Operaciones de Red (NOC) 7X24X365.
Consecutivo 5.- Servicio de análisis de vulnerabilidades y pruebas de penetración.',
                'fecha_recepcion' => '2022-07-11',
                'fecha_liberacion' => '2022-07-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '6413350.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 12:25:42',
                'updated_at' => '2023-04-11 12:25:42',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            492 => [

                'contrato_id' => 19,
                'no_factura' => 'S 874',
                'concepto' => 'julio 2022
Mensualidad 7 de 12

Consecutivo 1.- Servicio de Ciberamenazas avanzadas y visibilidad en la red a través de la red del engaño.
Consecutivo 2.- Servicio de correlación de eventos de seguridad.
Consecutivo 3.- Servicio de Ciber inteligencia de amenazas.
Consecutivo 4.- Servicio Administrado de Centro de Operaciones de Seguridad (SOC) y Centro de Operaciones de Red (NOC) 7X24X365.
Consecutivo 5.- Servicio de análisis de vulnerabilidades y pruebas de penetración.',
                'fecha_recepcion' => '2022-08-05',
                'fecha_liberacion' => '2022-08-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '6413350.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 12:26:59',
                'updated_at' => '2023-04-11 12:26:59',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            493 => [

                'contrato_id' => 19,
                'no_factura' => 'S 932',
                'concepto' => 'Agosto 2022
Mensualidad 8 de 12

Consecutivo 1.- Servicio de Ciberamenazas avanzadas y visibilidad en la red a través de la red del engaño.
Consecutivo 2.- Servicio de correlación de eventos de seguridad.
Consecutivo 3.- Servicio de Ciber inteligencia de amenazas.
Consecutivo 4.- Servicio Administrado de Centro de Operaciones de Seguridad (SOC) y Centro de Operaciones de Red (NOC) 7X24X365.
Consecutivo 5.- Servicio de análisis de vulnerabilidades y pruebas de penetración.',
                'fecha_recepcion' => '2022-09-12',
                'fecha_liberacion' => '2022-09-12',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '6413350.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 12:28:48',
                'updated_at' => '2023-04-11 12:28:48',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            494 => [

                'contrato_id' => 19,
                'no_factura' => 'S 958',
                'concepto' => 'Septiembre 2022
Mensualidad 9 de 12

Consecutivo 1.- Servicio de Ciberamenazas avanzadas y visibilidad en la red a través de la red del engaño.
Consecutivo 2.- Servicio de correlación de eventos de seguridad.
Consecutivo 3.- Servicio de Ciber inteligencia de amenazas.
Consecutivo 4.- Servicio Administrado de Centro de Operaciones de Seguridad (SOC) y Centro de Operaciones de Red (NOC) 7X24X365.
Consecutivo 5.- Servicio de análisis de vulnerabilidades y pruebas de penetración.',
                'fecha_recepcion' => '2022-10-18',
                'fecha_liberacion' => '2022-10-18',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '6413350.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 12:30:13',
                'updated_at' => '2023-04-11 12:30:13',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            495 => [

                'contrato_id' => 19,
                'no_factura' => 'S 990',
                'concepto' => 'Octubre 2022
Mensualidad 10 de 12

Consecutivo 1.- Servicio de Ciberamenazas avanzadas y visibilidad en la red a través de la red del engaño.
Consecutivo 2.- Servicio de correlación de eventos de seguridad.
Consecutivo 3.- Servicio de Ciber inteligencia de amenazas.
Consecutivo 4.- Servicio Administrado de Centro de Operaciones de Seguridad (SOC) y Centro de Operaciones de Red (NOC) 7X24X365.
Consecutivo 5.- Servicio de análisis de vulnerabilidades y pruebas de penetración.',
                'fecha_recepcion' => '2022-11-16',
                'fecha_liberacion' => '2022-11-16',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '6413350.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 12:31:14',
                'updated_at' => '2023-04-11 12:31:14',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            496 => [

                'contrato_id' => 19,
                'no_factura' => 'S 1029',
                'concepto' => 'Noviembre 2022
Mensualidad 11 de 12

Consecutivo 1.- Servicio de Ciberamenazas avanzadas y visibilidad en la red a través de la red del engaño.
Consecutivo 2.- Servicio de correlación de eventos de seguridad.
Consecutivo 3.- Servicio de Ciber inteligencia de amenazas.
Consecutivo 4.- Servicio Administrado de Centro de Operaciones de Seguridad (SOC) y Centro de Operaciones de Red (NOC) 7X24X365.
Consecutivo 5.- Servicio de análisis de vulnerabilidades y pruebas de penetración.',
                'fecha_recepcion' => '2022-12-06',
                'fecha_liberacion' => '2022-12-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '6413350.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 12:32:57',
                'updated_at' => '2023-04-11 12:32:57',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            497 => [

                'contrato_id' => 19,
                'no_factura' => 'S 1030',
                'concepto' => 'Diciembre 2022
Mensualidad 12 de 12

Consecutivo 1.- Servicio de Ciberamenazas avanzadas y visibilidad en la red a través de la red del engaño.
Consecutivo 2.- Servicio de correlación de eventos de seguridad.
Consecutivo 3.- Servicio de Ciber inteligencia de amenazas.
Consecutivo 4.- Servicio Administrado de Centro de Operaciones de Seguridad (SOC) y Centro de Operaciones de Red (NOC) 7X24X365.
Consecutivo 5.- Servicio de análisis de vulnerabilidades y pruebas de penetración.
',
                'fecha_recepcion' => '2022-12-06',
                'fecha_liberacion' => '2022-12-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '6413350.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 12:33:41',
                'updated_at' => '2023-04-11 12:33:41',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            498 => [

                'contrato_id' => 75,
                'no_factura' => 'S 854',
                'concepto' => 'SERVICIO "LICENCIAMIENTO DE LA SOLUCIÓN DE SEGURIDAD FIREEYE"',
                'fecha_recepcion' => '2022-07-21',
                'fecha_liberacion' => '2022-07-21',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '2682479.26',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 13:12:35',
                'updated_at' => '2023-04-11 13:12:35',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            499 => [

                'contrato_id' => 90,
                'no_factura' => 'S 1041',
                'concepto' => 'Venta de Equipo Firewall Especializado en Servicios Web (WAF)
IMPERVA Modelo X10K2, serie:2227BA1574, Modelo X6520 Serie:2221BA2332. Modelo M170, serie: 2232BA0370, 2227BA2223 y 2227BA2213,Lenovo Modelo THINKSYSTEM6B650421482GB serie:J1025PVP, Modelo THINKSYSTEMSR630421032GB serie:J1023XX2, Modelo THINKSYSTEMSR650 42L6 serie:J1023ZHY Modelo THINKSYSTEMSR6504216 serie:J1021R2P, Modelo THINKSYSTEMSR654214
serie:J1021ECT, Modelo THINKSYSTEMSR6304210 serie:J1023XWZ

Venta de Equipo Firewall Especializado en Servicios Web (WAF)
IMPERVA Modelo:X10K2 serie:2227BA1577, Modelo X6520 serie:2221BA2319, Modelo M170 serie: 2227BA2218, 2227BA2221 y
2227BA2225 Lenovo Modelo THINKSYSTEMSR6504216 serie:J1021R2L, Modelo THINKSYSTEMSR6357262 serie:J1020KD6, Modelo THINKSYSTEMSR6504216 serie:J1023ZHZ.Modelo THINKSYSTEMSR6357262
serie:J1020KD5, Modelo THINKSYSTEMSR6501216 serie:J1021R2M, Modelo THINKSYSTEMSR6304210 serie:J1023XX0

Correlación de Eventos ‐Implementación MCAFEE Modelo ETM‐5775 serie:A0D2243025, Modelo ERC‐1275 serie:A0D2152008, Modelo ACE‐2675 serie:A0D2238969

Venta de Equipo Licenciamiento Correlación de Eventos ‐
Implementación MCAFEE Modelo ELM‐5775 serie:A0D2238956, Modelo ERC‐1275 serie:A0D2201012, Modelo DAS‐120serie: A0D3241010',
                'fecha_recepcion' => '2022-12-07',
                'fecha_liberacion' => '2022-12-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '491884.82',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 13:37:22',
                'updated_at' => '2023-04-11 13:37:22',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
        ]);
        \DB::table('facturacion')->insert([
            0 => [

                'contrato_id' => 90,
                'no_factura' => 'S 1042',
                'concepto' => '
Licenciamiento Firewall Especializado en Servicios Web (WAF) ‐ Renovación
Firewall Especializado en Base de Datos (DBF)
Licenciamiento Firewall Especializado en Base de
Datos (DBF) ‐ Renovación
Correlación de Eventos',
                'fecha_recepcion' => '2022-12-08',
                'fecha_liberacion' => '2022-12-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '2488176.42',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 15:28:08',
                'updated_at' => '2023-04-11 15:28:08',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            1 => [

                'contrato_id' => 90,
                'no_factura' => 'S 1081',
                'concepto' => 'Servicios de Instalación Borrado Seguro de información
Servicios de Instalación Servicio de Antivirus
Orden de compra 4500644094 ',
                'fecha_recepcion' => '2023-03-07',
                'fecha_liberacion' => '2023-03-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '141401.68',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 15:29:27',
                'updated_at' => '2023-04-11 15:29:27',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            2 => [

                'contrato_id' => 90,
                'no_factura' => 'S 1106',
                'concepto' => 'Servicios de Instalación, Servicio de Antivirus, enero 2023
OC 4500670833',
                'fecha_recepcion' => null,
                'fecha_liberacion' => null,
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '181729.29',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 15:31:00',
                'updated_at' => '2023-04-11 15:31:47',
                'deleted_at' => '2023-04-11 15:31:47',
                'created_by' => 17,
                'updated_by' => 17,
            ],
            3 => [

                'contrato_id' => 90,
                'no_factura' => 'S 1106',
                'concepto' => 'Servicios de Instalación, Servicio de Antivirus enero 2023
OC 4500670833',
                'fecha_recepcion' => '2023-04-05',
                'fecha_liberacion' => '2023-04-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '181729.29',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 15:32:41',
                'updated_at' => '2023-04-11 15:32:41',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            4 => [

                'contrato_id' => 90,
                'no_factura' => 'S 1107',
                'concepto' => 'Servicios de Instalación, Servicio de Antivirus febrero 2023
OC 4500670843',
                'fecha_recepcion' => '2023-04-05',
                'fecha_liberacion' => '2023-04-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '348450.90',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 15:34:01',
                'updated_at' => '2023-04-11 15:34:01',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            5 => [

                'contrato_id' => 90,
                'no_factura' => 'S 1108',
                'concepto' => 'Servicios de Instalación, Servicio de Antivirus marzo 2023
OC 4500670529',
                'fecha_recepcion' => '2023-04-05',
                'fecha_liberacion' => '2023-04-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '61940.76',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 15:35:40',
                'updated_at' => '2023-04-11 15:35:40',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            6 => [

                'contrato_id' => 90,
                'no_factura' => 'S 1110',
                'concepto' => 'Servicios de Instalación Borrado Seguro de Información
OC 4500670758
',
                'fecha_recepcion' => '2023-04-05',
                'fecha_liberacion' => '2023-04-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '3152.88',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 15:38:33',
                'updated_at' => '2023-04-11 15:38:33',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            7 => [

                'contrato_id' => 89,
                'no_factura' => 'C 17',
                'concepto' => 'Servicios de consultoría Pruebas Caja Negra (Externo)
Servicios de consultoría Pruebas Caja Gris (Interno)
Servicios de consultoría Servicio de Ingeniería Social',
                'fecha_recepcion' => '2022-11-23',
                'fecha_liberacion' => '2022-11-23',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '414741.40',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 15:45:38',
                'updated_at' => '2023-04-11 15:45:38',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            8 => [

                'contrato_id' => 99,
                'no_factura' => 'S 995',
                'concepto' => 'Servicios administrados Protección de la Navegacion Internet
Servicios administrados Centro de Operaciones de Seguridad (SOC)
Servicios administrados Centro de Operaciones de Comunicación (NOC)
Servicios administrados Detección de Intrusos en la red a través del engaño
CRE/39/2022, mensualidad 1/12, enero 2023',
                'fecha_recepcion' => '2023-02-16',
                'fecha_liberacion' => '2023-02-16',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '550039.78',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 15:52:32',
                'updated_at' => '2023-04-11 15:52:32',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            9 => [

                'contrato_id' => 99,
                'no_factura' => 'S 1091',
                'concepto' => 'Servicios administrados Protección de la Navegacion Internet
Servicios administrados Centro de Operaciones de Seguridad (SOC)
Servicios administrados Centro de Operaciones de Comunicación (NOC)
Servicios administrados Detección de Intrusos en la red a través del engaño
CRE/39/2022, mensualidad 2/12, febrero 2023',
                'fecha_recepcion' => '2023-03-08',
                'fecha_liberacion' => '2023-03-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '550039.78',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 15:54:07',
                'updated_at' => '2023-04-11 15:54:07',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            10 => [

                'contrato_id' => 106,
                'no_factura' => 'S 918',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución Póliza de Servicio de Mantenimiento para 1 (un) equipo Firewall de Base de Datos Imperva X6510 para Sala Superior
Servicio de Soporte Técnico mensual para la solución Póliza de Servicio de Mantenimiento para 1 (un) equipo Consola de Base de
Datos Imperva M160 para Sala Superior.
Contrato SS/116‐23. Servicio enero 2023.',
                'fecha_recepcion' => '2023-02-22',
                'fecha_liberacion' => '2023-02-22',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '86939.45',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 16:11:43',
                'updated_at' => '2023-04-11 16:11:43',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            11 => [

                'contrato_id' => 106,
                'no_factura' => 'S 1078',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución Póliza de Servicio de Mantenimiento para 1 (un) equipo Firewall de Base de Datos Imperva X6510 para Sala Superior

Servicio de Soporte Técnico mensual para la solución Póliza de Servicio de Mantenimiento para 1 (un) equipo Consola de Base de
Datos Imperva M160 para Sala Superior.
Contrato SS/116‐23. Servicio febrero 2023.',
                'fecha_recepcion' => '2023-03-08',
                'fecha_liberacion' => '2023-03-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '86939.45',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 16:13:45',
                'updated_at' => '2023-04-11 16:13:45',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            12 => [

                'contrato_id' => 106,
                'no_factura' => 'S 1111',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución Póliza de Servicio de Mantenimiento para 1 (un) equipo Firewall de Base de Datos Imperva X6510 para Sala Superior

Servicio de Soporte Técnico mensual para la solución Póliza de Servicio de Mantenimiento para 1 (un) equipo Consola de Base de
Datos Imperva M160 para Sala Superior.
Contrato SS/116‐23. Servicio marzo 2023.',
                'fecha_recepcion' => '2023-04-10',
                'fecha_liberacion' => '2023-04-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '86939.45',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-11 16:14:26',
                'updated_at' => '2023-04-11 16:14:26',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            13 => [

                'contrato_id' => 76,
                'no_factura' => 'S 835',
                'concepto' => 'Servicio de Pruebas de Penetración Caja Negra',
                'fecha_recepcion' => '2022-07-01',
                'fecha_liberacion' => '2022-07-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '44803.54',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-12 14:05:08',
                'updated_at' => '2023-04-12 14:05:08',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            14 => [

                'contrato_id' => 76,
                'no_factura' => 'S 879',
                'concepto' => 'Servicio de Pruebas de Penetración de Caja Negra',
                'fecha_recepcion' => '2022-08-11',
                'fecha_liberacion' => '2022-08-11',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '44803.54',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-12 14:10:53',
                'updated_at' => '2023-04-12 14:10:53',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            15 => [

                'contrato_id' => 67,
                'no_factura' => 'S 775',
                'concepto' => 'Análisis de Vulnerabilidades, Pen Testing, Cyberdefense, Threat Hunting, Forense, Borrado seguro, Phishing, Ciber investigación',
                'fecha_recepcion' => '2022-04-19',
                'fecha_liberacion' => '2022-04-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '2088000.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-04-12 14:26:52',
                'updated_at' => '2023-04-24 11:24:12',
                'deleted_at' => '2023-04-24 11:24:12',
                'created_by' => 20,
                'updated_by' => 18,
            ],
            16 => [

                'contrato_id' => 157,
                'no_factura' => 'C 97',
                'concepto' => 'Servicio de Pruebas de Penetración',
                'fecha_recepcion' => '2022-07-28',
                'fecha_liberacion' => '2022-07-28',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '129838.27',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => null,
                'created_at' => '2023-04-12 14:57:38',
                'updated_at' => '2023-04-12 14:57:38',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            17 => [

                'contrato_id' => 158,
                'no_factura' => 'S 505',
                'concepto' => 'Infoblox Premuim Maintenance - Entreprise for TE-1
Números de serie: 1405201610700052 y 1405201610700058

Infoblox Premuim Maintenance - Entreprise for TE-1HW
Números de serie: 1405201610700052 y 1405201610700058',
                'fecha_recepcion' => '2021-01-29',
                'fecha_liberacion' => '2021-01-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '10409.79',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => null,
                'created_at' => '2023-04-13 10:08:53',
                'updated_at' => '2023-04-13 10:08:53',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            18 => [

                'contrato_id' => 103,
                'no_factura' => 'TEST',
                'concepto' => 'test',
                'fecha_recepcion' => '2023-04-13',
                'fecha_liberacion' => '2022-12-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '1.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-13 13:13:36',
                'updated_at' => '2023-04-13 13:14:04',
                'deleted_at' => '2023-04-13 13:14:04',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            19 => [

                'contrato_id' => 93,
                'no_factura' => '1028',
                'concepto' => 'Servicios de consultoria
SERVICIO DE EVALUACIÓN DE RIESGO TECNOLÓGICO Y VULNERABILIDADES ',
                'fecha_recepcion' => '2022-12-05',
                'fecha_liberacion' => '2022-12-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '591600.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-14 10:11:20',
                'updated_at' => '2023-04-14 10:49:35',
                'deleted_at' => '2023-04-14 10:49:35',
                'created_by' => 19,
                'updated_by' => 19,
            ],
            20 => [

                'contrato_id' => 93,
                'no_factura' => 'S 1028',
                'concepto' => 'Servicios de consultoria
SERVICIO DE EVALUACIÓN DE RIESGO TECNOLÓGICO Y VULNERABILIDADES',
                'fecha_recepcion' => '2022-12-05',
                'fecha_liberacion' => '2022-10-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '591600.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-14 10:55:39',
                'updated_at' => '2023-04-26 11:52:10',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            21 => [

                'contrato_id' => 17,
                'no_factura' => 'S 721',
                'concepto' => 'Soporte Técnico de la Solución en un horario de 24x7x365 Contrato número ASF-UGA-DAJ-DGS-003/2020 de fecha 17 de enero de 2020 y su Convenio Modificatorio de fecha 11 de marzo de 2021.',
                'fecha_recepcion' => '2022-02-02',
                'fecha_liberacion' => '2022-02-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-14 11:18:06',
                'updated_at' => '2023-04-14 11:18:06',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            22 => [

                'contrato_id' => 17,
                'no_factura' => 'S 903',
                'concepto' => 'Soporte Técnico de la Solución en un horario de 24x7x365 Contrato número ASF-UGA-DAJ-DGS-003/2020 de fecha 17 de enero de 2020 y su Convenio Modificatorio de fecha 11 de marzo de 2021.',
                'fecha_recepcion' => '2022-10-03',
                'fecha_liberacion' => '2022-10-03',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-14 11:22:30',
                'updated_at' => '2023-04-14 11:22:30',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            23 => [

                'contrato_id' => 17,
                'no_factura' => 'S 969',
                'concepto' => 'Soporte Técnico de la Solución en un horario de 24x7x365 Contrato número ASF-UGA-DAJ-DGS-003/2020 de fecha 17 de enero de 2020 y su Convenio Modificatorio de fecha 11 de marzo de 2021.',
                'fecha_recepcion' => '2022-11-01',
                'fecha_liberacion' => '2022-11-01',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-14 11:24:29',
                'updated_at' => '2023-04-14 11:24:29',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            24 => [

                'contrato_id' => 17,
                'no_factura' => 'S 1031',
                'concepto' => 'Soporte Técnico de la Solución en un horario de 24x7x365 Contrato número ASF-UGA-DAJ-DGS-003/2020 de fecha 17 de enero de 2020 y su Convenio Modificatorio de fecha 11 de marzo de 2021.',
                'fecha_recepcion' => '2022-12-06',
                'fecha_liberacion' => '2022-12-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-14 11:32:09',
                'updated_at' => '2023-04-14 11:32:09',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            25 => [

                'contrato_id' => 7,
                'no_factura' => 'S 920',
                'concepto' => 'SERVICIO DE SOC PARA EL
GRUPO FINANCIERO VE POR
MAS',
                'fecha_recepcion' => '2023-02-08',
                'fecha_liberacion' => '2023-02-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '293329.35',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-14 15:52:03',
                'updated_at' => '2023-04-14 15:52:03',
                'deleted_at' => null,
                'created_by' => 19,
                'updated_by' => null,
            ],
            26 => [

                'contrato_id' => 7,
                'no_factura' => 'S 919',
                'concepto' => 'Licenciamiento LogRhythm DetectX software subscription license
Licenciamiento LogRhythm DetectX software subscription license
Licenciamiento LogRhythm System Monitor Pro Subscription para 50 dispositivos',
                'fecha_recepcion' => '2023-02-08',
                'fecha_liberacion' => '2023-02-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75632.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-14 15:53:41',
                'updated_at' => '2023-04-14 15:53:41',
                'deleted_at' => null,
                'created_by' => 19,
                'updated_by' => null,
            ],
            27 => [

                'contrato_id' => 7,
                'no_factura' => 'S 1085',
                'concepto' => 'Licenciamiento LogRhythm DetectX software subscription license
Licenciamiento LogRhythm DetectX software subscription license
Licenciamiento LogRhythm
System Monitor Pro Subscription para 50 dispositivos
Extensión Licenciamiento LOGRHYTHM Mensualidad 12',
                'fecha_recepcion' => '2023-03-06',
                'fecha_liberacion' => '2023-03-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75632.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-14 15:55:51',
                'updated_at' => '2023-04-14 15:55:51',
                'deleted_at' => null,
                'created_by' => 19,
                'updated_by' => null,
            ],
            28 => [

                'contrato_id' => 7,
                'no_factura' => 'S 1086',
                'concepto' => 'Servicios administrados SERVICIO DE SOC PARA EL GRUPO FINANCIERO VE POR MAS',
                'fecha_recepcion' => '2023-03-06',
                'fecha_liberacion' => '2023-03-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '293329.35',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-14 15:56:43',
                'updated_at' => '2023-04-14 15:56:43',
                'deleted_at' => null,
                'created_by' => 19,
                'updated_by' => null,
            ],
            29 => [

                'contrato_id' => 7,
                'no_factura' => 'S 1103',
                'concepto' => 'Servicios administrados
SERVICIO DE SOC PARA EL GRUPO FINANCIERO VE POR MAS',
                'fecha_recepcion' => '2023-04-05',
                'fecha_liberacion' => '2023-04-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '293329.35',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-14 15:58:28',
                'updated_at' => '2023-04-14 15:58:28',
                'deleted_at' => null,
                'created_by' => 19,
                'updated_by' => null,
            ],
            30 => [

                'contrato_id' => 7,
                'no_factura' => 'S 1104',
                'concepto' => 'Licenciamiento LogRhythm DetectX software subscription license
Licenciamiento LogRhythm DetectX software subscription license
Licenciamiento LogRhythm
System Monitor Pro Subscription para 50 dispositivos
Extensión Licenciamiento LOGRHYTHM Mensualidad 13',
                'fecha_recepcion' => '2023-04-05',
                'fecha_liberacion' => '2023-04-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75632.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-14 16:00:24',
                'updated_at' => '2023-04-14 16:00:24',
                'deleted_at' => null,
                'created_by' => 19,
                'updated_by' => null,
            ],
            31 => [

                'contrato_id' => 140,
                'no_factura' => '1090',
                'concepto' => 'Servicio de SOC, NOC y SIEM.

Del 19 al 28 de febrero 2023
Del 01 al 31 de marzo del 2023.',
                'fecha_recepcion' => '2023-03-07',
                'fecha_liberacion' => '2023-03-24',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '340045.72',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 12:17:05',
                'updated_at' => '2023-04-17 12:17:05',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            32 => [

                'contrato_id' => 3,
                'no_factura' => 'S 906',
                'concepto' => '13 de agosto al 12 septiembre 2022',
                'fecha_recepcion' => '2022-09-05',
                'fecha_liberacion' => '2022-09-21',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '67635.49',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 12:33:52',
                'updated_at' => '2023-04-17 12:33:52',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            33 => [

                'contrato_id' => 3,
                'no_factura' => 'S 962',
                'concepto' => '13 de septiembre al 12 octubre 2022',
                'fecha_recepcion' => '2022-10-17',
                'fecha_liberacion' => '2022-10-17',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.49',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 12:36:51',
                'updated_at' => '2023-04-17 12:36:51',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            34 => [

                'contrato_id' => 3,
                'no_factura' => 'S 980',
                'concepto' => '13 de octubre al 12 noviembre 2022',
                'fecha_recepcion' => '2022-11-22',
                'fecha_liberacion' => '2022-11-22',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '0.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 12:37:47',
                'updated_at' => '2023-04-17 12:37:47',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            35 => [

                'contrato_id' => 3,
                'no_factura' => 'S 1019',
                'concepto' => '13 de noviembre al 12 diciembre 2022',
                'fecha_recepcion' => '2022-12-13',
                'fecha_liberacion' => '2022-12-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.49',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 12:38:42',
                'updated_at' => '2023-04-17 12:38:42',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            36 => [

                'contrato_id' => 3,
                'no_factura' => 'S 914',
                'concepto' => '13 de diciembre al 12 enero 2023',
                'fecha_recepcion' => '2023-01-26',
                'fecha_liberacion' => '2023-01-26',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.49',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 12:39:58',
                'updated_at' => '2023-04-17 12:39:58',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            37 => [

                'contrato_id' => 3,
                'no_factura' => 'S 991',
                'concepto' => '13 de enero al 12 de febrero 2023',
                'fecha_recepcion' => '2023-02-16',
                'fecha_liberacion' => '2023-02-16',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '67635.49',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 12:47:10',
                'updated_at' => '2023-04-17 12:47:10',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            38 => [

                'contrato_id' => 5,
                'no_factura' => 'S 891',
                'concepto' => '8 de 26
',
                'fecha_recepcion' => '2022-09-12',
                'fecha_liberacion' => '2022-09-12',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '199745.55',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 12:50:53',
                'updated_at' => '2023-04-17 12:50:53',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            39 => [

                'contrato_id' => 5,
                'no_factura' => 'S 907',
                'concepto' => '9 de 26',
                'fecha_recepcion' => '2022-10-14',
                'fecha_liberacion' => '2022-10-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '199745.55',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 12:52:07',
                'updated_at' => '2023-04-17 12:52:07',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            40 => [

                'contrato_id' => 5,
                'no_factura' => 'S 977',
                'concepto' => '10 de 26',
                'fecha_recepcion' => '2022-11-30',
                'fecha_liberacion' => '2022-11-30',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '199745.55',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 12:53:03',
                'updated_at' => '2023-04-17 12:53:03',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            41 => [

                'contrato_id' => 5,
                'no_factura' => 'S 1020',
                'concepto' => '11 de 26',
                'fecha_recepcion' => '2022-12-13',
                'fecha_liberacion' => '2022-12-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '199745.55',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 12:53:39',
                'updated_at' => '2023-04-17 12:53:39',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            42 => [

                'contrato_id' => 5,
                'no_factura' => 'S 1034',
                'concepto' => '12 de 26',
                'fecha_recepcion' => '2022-12-13',
                'fecha_liberacion' => '2022-12-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '199745.55',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 12:54:19',
                'updated_at' => '2023-04-17 12:54:19',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            43 => [

                'contrato_id' => 5,
                'no_factura' => 'S 940',
                'concepto' => '13 de 26',
                'fecha_recepcion' => '2023-03-07',
                'fecha_liberacion' => '2023-03-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '199745.55',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 12:55:00',
                'updated_at' => '2023-04-17 12:55:00',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            44 => [

                'contrato_id' => 5,
                'no_factura' => 'S 921',
                'concepto' => '14 de 26',
                'fecha_recepcion' => '2023-04-06',
                'fecha_liberacion' => '2023-04-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '199745.55',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 12:55:41',
                'updated_at' => '2023-04-17 12:55:41',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            45 => [

                'contrato_id' => 54,
                'no_factura' => 'S 938',
                'concepto' => 'Agosto 2022',
                'fecha_recepcion' => '2022-09-20',
                'fecha_liberacion' => '2022-09-20',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '95727.74',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 13:02:50',
                'updated_at' => '2023-04-17 13:02:50',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            46 => [

                'contrato_id' => 54,
                'no_factura' => 'S 966',
                'concepto' => 'Septiembre 2022',
                'fecha_recepcion' => '2022-10-24',
                'fecha_liberacion' => '2022-10-24',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '135871.62',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 13:03:45',
                'updated_at' => '2023-04-17 13:03:45',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            47 => [

                'contrato_id' => 54,
                'no_factura' => 'S 978',
                'concepto' => 'Octubre 2022',
                'fecha_recepcion' => '2022-11-16',
                'fecha_liberacion' => '2022-11-16',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75655.79',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 13:04:40',
                'updated_at' => '2023-04-17 13:04:40',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            48 => [

                'contrato_id' => 54,
                'no_factura' => 'S 1021',
                'concepto' => 'Noviembre 2022',
                'fecha_recepcion' => '2022-12-05',
                'fecha_liberacion' => '2022-12-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '55583.85',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 13:06:08',
                'updated_at' => '2023-04-17 13:06:08',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            49 => [

                'contrato_id' => 54,
                'no_factura' => 'S 1070',
                'concepto' => 'Enero 2023',
                'fecha_recepcion' => '2023-01-02',
                'fecha_liberacion' => '2023-01-02',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '135871.62',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 13:06:47',
                'updated_at' => '2023-04-17 13:06:47',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            50 => [

                'contrato_id' => 54,
                'no_factura' => 'S 993',
                'concepto' => 'Enero 2023',
                'fecha_recepcion' => '2023-02-16',
                'fecha_liberacion' => '2023-02-16',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '95727.74',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 13:07:33',
                'updated_at' => '2023-04-17 13:07:33',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            51 => [

                'contrato_id' => 54,
                'no_factura' => 'S 1095',
                'concepto' => 'Febrero 2023',
                'fecha_recepcion' => '2023-03-13',
                'fecha_liberacion' => '2023-03-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '95727.74',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 13:08:10',
                'updated_at' => '2023-04-17 13:08:10',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            52 => [

                'contrato_id' => 54,
                'no_factura' => 'S 1112',
                'concepto' => 'Marzo 2023',
                'fecha_recepcion' => '2023-04-17',
                'fecha_liberacion' => '2023-04-17',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75655.79',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 13:10:36',
                'updated_at' => '2023-04-17 13:10:36',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            53 => [

                'contrato_id' => 151,
                'no_factura' => 'C 31',
                'concepto' => '1)Servicio de renovación SOC, Correlación de Eventos, Monitoreo de desempeño de Infraestructura y de Portales.
2)Penalización por renovación tardía Forcepoint.
',
                'fecha_recepcion' => '2023-03-07',
                'fecha_liberacion' => '2023-03-07',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '175943.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 13:53:14',
                'updated_at' => '2023-04-17 13:53:14',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            54 => [

                'contrato_id' => 151,
                'no_factura' => 'C 34',
                'concepto' => 'Servicio de renovación SOC, Correlación de Eventos, Monitoreo de desempeño de Infraestructura y de Portales.',
                'fecha_recepcion' => '2023-03-17',
                'fecha_liberacion' => '2023-03-17',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '125251.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 13:53:52',
                'updated_at' => '2023-04-17 13:53:52',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            55 => [

                'contrato_id' => 151,
                'no_factura' => 'C 41',
                'concepto' => 'Servicio de renovación SOC, Correlación de Eventos, Monitoreo de desempeño de Infraestructura y de Portales.',
                'fecha_recepcion' => '2023-04-17',
                'fecha_liberacion' => '2023-04-17',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '125251.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 13:54:26',
                'updated_at' => '2023-04-17 13:54:26',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            56 => [

                'contrato_id' => 56,
                'no_factura' => 'C -09',
                'concepto' => 'Número de pedido:4100617333.RFP VULNERABILIDADES.',
                'fecha_recepcion' => '2022-10-28',
                'fecha_liberacion' => '2022-10-28',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '602359.05',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 17:48:13',
                'updated_at' => '2023-04-17 17:48:13',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            57 => [

                'contrato_id' => 56,
                'no_factura' => 'C-10',
                'concepto' => 'Número de pedido:4100617333.RFP
VULNERABILIDADES.',
                'fecha_recepcion' => '2022-11-09',
                'fecha_liberacion' => '2022-11-09',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '816229.94',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 17:49:14',
                'updated_at' => '2023-04-17 17:49:14',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            58 => [

                'contrato_id' => 56,
                'no_factura' => 'C-32',
                'concepto' => 'Número de pedido:4100617333.RFP VULNERABILIDADES.',
                'fecha_recepcion' => '2023-03-09',
                'fecha_liberacion' => '2022-03-31',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '497288.15',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 17:52:36',
                'updated_at' => '2023-04-17 17:52:36',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            59 => [

                'contrato_id' => 56,
                'no_factura' => 'C-39',
                'concepto' => 'Número de pedido:4100617333.RFP VULNERABILIDADES.',
                'fecha_recepcion' => '2023-04-04',
                'fecha_liberacion' => '2022-03-31',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '599562.50',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-17 17:54:35',
                'updated_at' => '2023-04-17 17:54:35',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            60 => [

                'contrato_id' => 26,
                'no_factura' => 'S 892',
                'concepto' => 'Agosto 2022.',
                'fecha_recepcion' => '2022-08-30',
                'fecha_liberacion' => '2022-08-30',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '225277.25',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-18 10:31:15',
                'updated_at' => '2023-04-18 10:31:15',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            61 => [

                'contrato_id' => 26,
                'no_factura' => 'S 910',
                'concepto' => 'Octubre 2022.',
                'fecha_recepcion' => '2022-10-18',
                'fecha_liberacion' => '2022-10-18',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '225277.25',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-18 10:32:17',
                'updated_at' => '2023-04-18 10:32:17',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            62 => [

                'contrato_id' => 26,
                'no_factura' => 'S 979',
                'concepto' => 'Noviembre 2022',
                'fecha_recepcion' => '2022-11-14',
                'fecha_liberacion' => '2022-11-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '225277.25',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-18 10:33:16',
                'updated_at' => '2023-04-18 10:33:16',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            63 => [

                'contrato_id' => 26,
                'no_factura' => 'S 1003',
                'concepto' => 'Noviembre 2022.',
                'fecha_recepcion' => '2022-11-29',
                'fecha_liberacion' => '2022-11-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '225277.25',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-18 10:34:36',
                'updated_at' => '2023-04-18 10:34:36',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            64 => [

                'contrato_id' => 26,
                'no_factura' => 'S 1004',
                'concepto' => 'Diciembre 2022.',
                'fecha_recepcion' => '2022-11-29',
                'fecha_liberacion' => '2022-11-29',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '225277.25',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-18 10:35:19',
                'updated_at' => '2023-04-18 10:35:19',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            65 => [

                'contrato_id' => 26,
                'no_factura' => 'S 1006',
                'concepto' => 'Enero 2023',
                'fecha_recepcion' => '2023-02-17',
                'fecha_liberacion' => '2023-02-17',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '225277.25',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-18 10:35:58',
                'updated_at' => '2023-04-18 10:35:58',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            66 => [

                'contrato_id' => 26,
                'no_factura' => 'S 1100',
                'concepto' => 'Febrero 2023',
                'fecha_recepcion' => '2023-03-21',
                'fecha_liberacion' => '2023-03-21',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '225277.25',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-18 10:36:40',
                'updated_at' => '2023-04-18 10:36:40',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            67 => [

                'contrato_id' => 26,
                'no_factura' => 'S 1117',
                'concepto' => 'Marzo 2023.',
                'fecha_recepcion' => '2023-04-14',
                'fecha_liberacion' => '2023-04-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '225277.25',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-18 10:37:25',
                'updated_at' => '2023-04-18 10:37:25',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            68 => [

                'contrato_id' => 159,
                'no_factura' => '1',
                'concepto' => 'test',
                'fecha_recepcion' => '2022-04-14',
                'fecha_liberacion' => '2022-04-22',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '6788889.78',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-18 10:40:09',
                'updated_at' => '2023-04-18 10:40:09',
                'deleted_at' => null,
                'created_by' => 2,
                'updated_by' => null,
            ],
            69 => [

                'contrato_id' => 159,
                'no_factura' => '2',
                'concepto' => 'test',
                'fecha_recepcion' => '2022-05-03',
                'fecha_liberacion' => '2022-04-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '5000.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-18 10:41:59',
                'updated_at' => '2023-04-18 10:41:59',
                'deleted_at' => null,
                'created_by' => 2,
                'updated_by' => null,
            ],
            70 => [

                'contrato_id' => 17,
                'no_factura' => 'S 1023',
                'concepto' => 'Servicio diciembre 2022.',
                'fecha_recepcion' => '2022-12-30',
                'fecha_liberacion' => '2022-12-30',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '12083.34',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-18 11:18:16',
                'updated_at' => '2023-04-18 11:18:16',
                'deleted_at' => null,
                'created_by' => 15,
                'updated_by' => null,
            ],
            71 => [

                'contrato_id' => 20,
                'no_factura' => 'S 1113',
                'concepto' => '1 Partida 1 Especialista en Seguridad y Continuidad de Riesgo
1 Partida 1 Hacker Ético
8 Partida 2 Licencias de Antivirus

Servicio de Seguridad de la Información correspondiente a los ejercicios fiscales 2021, 2022 y 2023
Contrato número S-079- 2021
Servicio marzo 2023',
                'fecha_recepcion' => '2023-04-13',
                'fecha_liberacion' => '2023-04-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-18 16:40:26',
                'updated_at' => '2023-04-18 16:40:26',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            72 => [

                'contrato_id' => 99,
                'no_factura' => 'S 1114',
                'concepto' => 'Servicios administrados Protección de la Navegacion Internet
Servicios administrados Centro de Operaciones de Seguridad (SOC)
Servicios administrados Centro de Operaciones de Comunicación (NOC)
Servicios administrados Detección de Intrusos en la red a través del engaño
CRE/39/2022, mensualidad 3/12, marzo 2023',
                'fecha_recepcion' => '2023-04-13',
                'fecha_liberacion' => '2023-04-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '550039.78',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-18 16:42:41',
                'updated_at' => '2023-04-18 16:42:41',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            73 => [

                'contrato_id' => 155,
                'no_factura' => 'S 1118',
                'concepto' => 'Consecitivo 1 - Corregido, listo para segunda revisión
Consecitivo 2 - Pendiente de comentarios
Consecitivo 3 - Corregido, listo para segunda revisión
Consecitivo 4 - Corregido, listo para segunda revisión
Consecutivo 5 - Se agregaron las gráficas con rango de fecha
Consecutivo 6 - Pendiente de comentarios
Consecutivo 7 - Corregido, listo para segunda revisión
Consideraciones generales: Corregido, listo para segunda revisión
Marzo 2023',
                'fecha_recepcion' => '2023-04-18',
                'fecha_liberacion' => '2023-04-18',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '7444173.91',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-18 16:44:34',
                'updated_at' => '2023-04-18 16:44:34',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            74 => [

                'contrato_id' => 156,
                'no_factura' => 'S 1077',
                'concepto' => 'Licenciamiento TRX DeceptionGrid Sensor Bundle between 10 ‐ 50 sensors 1 Year Suscription
Servicios de Instalación Instalación, Configuración y puesta en Punto
Servicio de soporte técnico Soporte técnico 1 año
Venta de Equipo Servidor Dell Power Edge Rack R250
Servicios de Instalación Instalación física de servidores en los 3 sitios (1 Querétaro y 2 en CDMX)',
                'fecha_recepcion' => '2023-03-13',
                'fecha_liberacion' => '2023-03-13',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '1538292.03',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-20 13:08:37',
                'updated_at' => '2023-04-20 13:08:37',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            75 => [

                'contrato_id' => 8,
                'no_factura' => 'S 875',
                'concepto' => 'Sistema de Gestión de Seguridad de la Información
Servicio BIA                                                                                                                                                                 Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de Correlación de Eventos y Administración de Bitácoras                                                                          Servicios DNS                                                                                                                                                                 Seguro Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam para el correo electrónico                                                                                                        Servicio de Antivirus a estaciones locales',
                'fecha_recepcion' => '2022-08-09',
                'fecha_liberacion' => '2022-08-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '1054235.31',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-24 09:47:06',
                'updated_at' => '2023-04-24 09:47:06',
                'deleted_at' => null,
                'created_by' => 18,
                'updated_by' => null,
            ],
            76 => [

                'contrato_id' => 8,
                'no_factura' => 'S - 936',
                'concepto' => 'Sistema de Gestión de Seguridad de la Información
Servicio BIA                                                                                                                                                                 Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de Correlación de Eventos y Administración de Bitácoras                                                                          Servicios DNS                                                                                                                                                                 Seguro Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam para el correo electrónico                                                                                                        Servicio de Antivirus a estaciones locales',
                'fecha_recepcion' => '2022-09-19',
                'fecha_liberacion' => '2022-09-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.30',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-24 09:55:23',
                'updated_at' => '2023-04-24 09:55:23',
                'deleted_at' => null,
                'created_by' => 18,
                'updated_by' => null,
            ],
            77 => [

                'contrato_id' => 8,
                'no_factura' => 'S 952',
                'concepto' => 'Sistema de Gestión de Seguridad de la Información
Servicio BIA                                                                                                                                                                 Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de Correlación de Eventos y Administración de Bitácoras                                                                          Servicios DNS                                                                                                                                                                 Seguro Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam para el correo electrónico                                                                                                        Servicio de Antivirus a estaciones locales',
                'fecha_recepcion' => '2022-10-10',
                'fecha_liberacion' => '2022-10-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.30',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-24 09:56:24',
                'updated_at' => '2023-04-24 09:56:24',
                'deleted_at' => null,
                'created_by' => 18,
                'updated_by' => null,
            ],
            78 => [

                'contrato_id' => 8,
                'no_factura' => 'S-981',
                'concepto' => 'Sistema de Gestión de Seguridad de la Información
Servicio BIA                                                                                                                                                                 Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de Correlación de Eventos y Administración de Bitácoras                                                                          Servicios DNS                                                                                                                                                                 Seguro Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam para el correo electrónico                                                                                                        Servicio de Antivirus a estaciones locales',
                'fecha_recepcion' => '2022-11-09',
                'fecha_liberacion' => '2022-11-10',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.30',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-24 09:57:33',
                'updated_at' => '2023-04-24 09:57:33',
                'deleted_at' => null,
                'created_by' => 18,
                'updated_by' => null,
            ],
            79 => [

                'contrato_id' => 8,
                'no_factura' => 'S - 1013',
                'concepto' => 'Sistema de Gestión de Seguridad de la Información
Servicio BIA                                                                                                                                                                 Servicio Administrado de Centro de Operaciones de Seguridad (SOC) 7X24
Servicio de Correlación de Eventos y Administración de Bitácoras                                                                          Servicios DNS                                                                                                                                                                 Seguro Servicio de Protección Perimetral
Servicio de Navegación Segura
Servicio de Antispam para el correo electrónico                                                                                                        Servicio de Antivirus a estaciones locales',
                'fecha_recepcion' => '2022-12-05',
                'fecha_liberacion' => '2022-12-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '1054235.30',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-24 09:58:27',
                'updated_at' => '2023-04-24 09:58:27',
                'deleted_at' => null,
                'created_by' => 18,
                'updated_by' => null,
            ],
            80 => [

                'contrato_id' => 156,
                'no_factura' => 'S - 1121',
                'concepto' => 'Servicios de Instalación
Señuelos de Seguridad',
                'fecha_recepcion' => '2023-04-24',
                'fecha_liberacion' => '2023-04-24',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '1538292.03',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-24 11:11:56',
                'updated_at' => '2023-04-24 11:11:56',
                'deleted_at' => null,
                'created_by' => 18,
                'updated_by' => null,
            ],
            81 => [

                'contrato_id' => 93,
                'no_factura' => 'S 877',
                'concepto' => 'SERVICIO DE EVALUACIÓN DE RIESGO TECNOLÓGICO Y
VULNERABILIDADES
Convenio Modificatorio al Contrato PENSIONISSSTE AD‐ 043/2022',
                'fecha_recepcion' => '2023-01-03',
                'fecha_liberacion' => '2022-10-14',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '118320.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-04-24 13:01:48',
                'updated_at' => '2023-04-24 13:01:48',
                'deleted_at' => null,
                'created_by' => 19,
                'updated_by' => null,
            ],
            82 => [

                'contrato_id' => 67,
                'no_factura' => 'S 775',
                'concepto' => 'Análisis de Vulnerabilidades, Pen Testing, Cyberdefense, Threat Hunting, Forense, Borrado seguro, Phishing, Ciber investigación',
                'fecha_recepcion' => '2022-04-19',
                'fecha_liberacion' => '2022-04-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '2088000.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-04-26 12:45:13',
                'updated_at' => '2023-04-26 12:45:13',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            83 => [

                'contrato_id' => 162,
                'no_factura' => 'S 632',
                'concepto' => 'Orden de Servicio Número 4 (Cuatro) (La orden de servicio) del Contrato de Prestación de Servicios de fecha 28-12-2020 (El Contrato)',
                'fecha_recepcion' => '2021-09-27',
                'fecha_liberacion' => '2021-09-27',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '544662.76',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => null,
                'created_at' => '2023-04-27 15:44:49',
                'updated_at' => '2023-04-27 15:44:49',
                'deleted_at' => null,
                'created_by' => 20,
                'updated_by' => null,
            ],
            84 => [

                'contrato_id' => 103,
                'no_factura' => 'S 1096',
                'concepto' => 'SERVICIO DE EVALUACIÓN DEL  CUMPLIMIENTO DE LOS REQUISITOS ESTABLECIDOS EN LAS REGLAS DEL SISTEMA DE PAGOS ELECTRÓNICOS INTERBANCARIOS (SPEI AMPLIADO, PARTICIPACIÓN INDIRECTA
EN EL SPEI Y TEMAS',
                'fecha_recepcion' => '2023-01-10',
                'fecha_liberacion' => '2023-02-17',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '602953.64',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-05-09 09:35:43',
                'updated_at' => '2023-05-09 09:35:43',
                'deleted_at' => null,
                'created_by' => 19,
                'updated_by' => null,
            ],
            85 => [

                'contrato_id' => 106,
                'no_factura' => 'S-1126',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución Póliza de Servicio de Mantenimiento para 1 (un) equipo Firewall de Base de Datos Imperva X6510 para Sala Superior

Servicio de Soporte Técnico mensual para la solución Póliza de Servicio de Mantenimiento para 1 (un) equipo Consola de Base de
Datos Imperva M160 para Sala Superior.
Contrato SS/116‐23. Servicio abril 2023.',
                'fecha_recepcion' => '2023-05-03',
                'fecha_liberacion' => '2023-05-03',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '86939.45',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-05-16 16:26:33',
                'updated_at' => '2023-05-16 16:26:33',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            86 => [

                'contrato_id' => 99,
                'no_factura' => 'S-1128',
                'concepto' => 'Servicios administrados Protección de la Navegacion Internet
Servicios administrados Centro de Operaciones de Seguridad (SOC)
Servicios administrados Centro de Operaciones de Comunicación (NOC)
Servicios administrados Detección de Intrusos en la red a través del engaño
CRE/39/2022, mensualidad 1/12, abril 2023',
                'fecha_recepcion' => '2023-11-09',
                'fecha_liberacion' => '2023-11-09',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '550039.78',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-05-16 16:37:13',
                'updated_at' => '2023-05-16 16:41:55',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            87 => [

                'contrato_id' => 20,
                'no_factura' => 'S 1130',
                'concepto' => '1 Partida 1 Especialista en Seguridad y Continuidad de Riesgo
1 Partida 1 Hacker Ético
8 Partida 2 Licencias de Antivirus
Servicio de Seguridad de la Información correspondiente a los ejercicios fiscales 2021, 2022 y 2023
Contrato número S-079- 2021
Servicio abril 2023',
                'fecha_recepcion' => '2023-05-12',
                'fecha_liberacion' => '2023-05-12',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-05-16 16:40:40',
                'updated_at' => '2023-06-20 13:09:19',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            88 => [

                'contrato_id' => 155,
                'no_factura' => 'S-1131',
                'concepto' => 'Consecutivo 1. Servicio Gestión de Vulnerabilidades para los Activos de TI
Consecutivo 2. Servicio de Correlación de Eventos de Seguridad
Consecutivo 3. Servicio de Ciber Inteligencia de Amenazas Institucionales
Consecutivo 4. Servicio Administrado de Centro de Operaciones de seguridad (SOC) y Centro de Operaciones de Red (NOC) 7x24x365
Consecutivo 5. Servicio de Filtrado de Contenido
Consecutivo 6. Servicio de Claves Privilegiadas
Consecutivo 7. Servicio de Ciber Amenazas Avanzadas y Visibilidad en la Red a Través del Engaño
Abril 2023',
                'fecha_recepcion' => '2023-05-12',
                'fecha_liberacion' => '2023-05-16',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '7444173.91',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-05-16 16:46:08',
                'updated_at' => '2023-05-16 16:46:08',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            89 => [

                'contrato_id' => 67,
                'no_factura' => 'S  776',
                'concepto' => 'LogRhythm DetectX software subscription license
LogRhythm RespondX software subscription license
LogRhythm System Monitor Pro Subscription para 50 dispositivos',
                'fecha_recepcion' => '2022-04-19',
                'fecha_liberacion' => '2022-04-19',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '75632.00',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'Cerrado',
                'created_at' => '2023-05-31 12:27:00',
                'updated_at' => '2023-05-31 12:27:00',
                'deleted_at' => null,
                'created_by' => 18,
                'updated_by' => null,
            ],
            90 => [

                'contrato_id' => 20,
                'no_factura' => 'S 1141',
                'concepto' => '1 Servicio de Gestión de Vulnerabilidades para los Activos de TI
2 Servicio de Correlación de Eventos de Seguridad
3 Servicio de Ciber Inteligencia de Amenazas Institucionales
4 Servicio Administrado de Centro de Operaciones de Seguridad (SOC) y Centro de Operaciones de Red (NOC) 7x24x365.
5 Servicio de Filtrado de Contenido
6 Servicio de Claves Privilegiadas
7 Servicio de Ciber amenazas avanzadas y visibilidad en la red a través del engaño',
                'fecha_recepcion' => '2023-06-08',
                'fecha_liberacion' => '2023-06-08',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '239714.81',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-06-20 13:07:49',
                'updated_at' => '2023-06-20 13:09:05',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            91 => [

                'contrato_id' => 99,
                'no_factura' => 'S 1140',
                'concepto' => 'Servicios administrados Protección de la Navegacion Internet
Servicios administrados Centro de Operaciones de Seguridad (SOC)
Servicios administrados Centro de Operaciones de Comunicación (NOC)
Servicios administrados Detección de Intrusos en la red a través del engaño
CRE/39/2022, mensualidad  4/12, mayo 2023',
                'fecha_recepcion' => '2023-06-06',
                'fecha_liberacion' => '2023-06-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '550039.78',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-06-20 15:46:32',
                'updated_at' => '2023-06-20 15:46:32',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            92 => [

                'contrato_id' => 106,
                'no_factura' => 'S 1139',
                'concepto' => 'Servicio de Soporte Técnico mensual para la solución Póliza de Servicio de Mantenimiento para 1 (un) equipo Firewall de Base de Datos Imperva X6510 para Sala Superior

Servicio de Soporte Técnico mensual para la solución Póliza de Servicio de Mantenimiento para 1 (un) equipo Consola de Base de
Datos Imperva M160 para Sala Superior.
Contrato SS/116‐23. Servicio mayo 2023.',
                'fecha_recepcion' => '2023-06-06',
                'fecha_liberacion' => '2023-06-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '86939.45',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-06-20 15:49:26',
                'updated_at' => '2023-06-20 15:49:42',
                'deleted_at' => null,
                'created_by' => 17,
                'updated_by' => null,
            ],
            93 => [

                'contrato_id' => 105,
                'no_factura' => 'S-1119',
                'concepto' => 'Servicio de soporte técnico Póliza de mantenimiento preventivo, correctivo y soporte técnico para los equipos del Core de la red de datos inalámbrica de PEMEX
Servicio marzo 2023',
                'fecha_recepcion' => '2023-04-18',
                'fecha_liberacion' => '2023-04-18',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '2264673.51',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-07-11 12:10:04',
                'updated_at' => '2023-07-11 12:10:04',
                'deleted_at' => null,
                'created_by' => 19,
                'updated_by' => null,
            ],
            94 => [

                'contrato_id' => 105,
                'no_factura' => 'S-1134',
                'concepto' => 'Servicio de soporte técnico Póliza de mantenimiento preventivo, correctivo y soporte técnico para los equipos del Core de la red de datos inalámbrica de PEMEX.
Servicio abril 2023',
                'fecha_recepcion' => '2023-05-23',
                'fecha_liberacion' => '2023-05-23',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '2264673.51',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-07-11 12:11:23',
                'updated_at' => '2023-07-11 12:11:23',
                'deleted_at' => null,
                'created_by' => 19,
                'updated_by' => null,
            ],
            95 => [

                'contrato_id' => 105,
                'no_factura' => 'S-1147',
                'concepto' => 'Servicio de soporte técnico Póliza de mantenimiento preventivo, correctivo y soporte técnico para los equipos del Core de la red de datos inalámbrica de PEMEX.
mayo 2023',
                'fecha_recepcion' => '2023-06-20',
                'fecha_liberacion' => '2023-06-20',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '2264673.80',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-07-11 12:12:43',
                'updated_at' => '2023-07-11 12:12:43',
                'deleted_at' => null,
                'created_by' => 19,
                'updated_by' => null,
            ],
            96 => [

                'contrato_id' => 7,
                'no_factura' => 'S-1137',
                'concepto' => 'Servicios administrados SERVICIO DE SOC PARA EL GRUPO FINANCIERO VE POR MAS
MAYO 2023',
                'fecha_recepcion' => '2023-06-06',
                'fecha_liberacion' => '2023-06-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => null,
                'monto_factura' => '293329.35',
                'observaciones' => null,
                'n_cxl' => null,
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-07-11 12:22:55',
                'updated_at' => '2023-07-11 12:22:55',
                'deleted_at' => null,
                'created_by' => 19,
                'updated_by' => null,
            ],
            97 => [

                'contrato_id' => 7,
                'no_factura' => 'S-1138',
                'concepto' => 'Licenciamiento LogRhythm DetectX software subscription license

Licenciamiento LogRhythm DetectX software subscription license

Licenciamiento LogRhythm System Monitor Pro Subscription para 50 dispositivos

mayo 2023
',
                'fecha_recepcion' => '2023-06-06',
                'fecha_liberacion' => '2023-06-06',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75632.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-07-11 12:24:50',
                'updated_at' => '2023-07-11 12:24:50',
                'deleted_at' => null,
                'created_by' => 19,
                'updated_by' => null,
            ],
            98 => [

                'contrato_id' => 7,
                'no_factura' => 'S-1154',
                'concepto' => 'Servicios administrados  SERVICIO DE SOC PARA EL GRUPO FINANCIERO VE POR MAS
junio 2023',
                'fecha_recepcion' => '2023-07-05',
                'fecha_liberacion' => '2023-07-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '293329.35',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-07-11 12:26:23',
                'updated_at' => '2023-07-11 12:26:23',
                'deleted_at' => null,
                'created_by' => 19,
                'updated_by' => null,
            ],
            99 => [

                'contrato_id' => 7,
                'no_factura' => 'S-1155',
                'concepto' => 'Licenciamiento LogRhythm  DetectX software subscription license

Licenciamiento LogRhythm DetectX software subscription license

Licenciamiento LogRhythm System Monitor Pro Subscription para 50 dispositivos

junio 2023',
                'fecha_recepcion' => '2023-07-05',
                'fecha_liberacion' => '2023-07-05',
                'no_revisiones' => 0,
                'cumple' => 1,
                'hallazgos_comentarios' => '',
                'monto_factura' => '75632.00',
                'observaciones' => null,
                'n_cxl' => '0',
                'firma' => 1,
                'conformidad' => 1,
                'estatus' => 'vigentes',
                'created_at' => '2023-07-11 12:28:17',
                'updated_at' => '2023-07-11 12:28:17',
                'deleted_at' => null,
                'created_by' => 19,
                'updated_by' => null,
            ],
        ]);
    }
}
