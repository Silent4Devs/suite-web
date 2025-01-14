<?php

namespace Database\Seeders;

use App\Models\ClausulasOc;
use App\Models\Organizacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClausulaocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

$organizacion = Organizacion::first();

        $clausula = [
            'organizacion_id' => $organizacion->id,
            'sucursal_id' => null,
            'descripcion' => "Los términos y condiciones que se establecen a continuación regirán la relación con carácter de contrato comercial de la presente orden de compra (“OC”), entre SILENT4BUSINESS, S.A.
                            de C.V(“Cliente”) y la persona física o moral señalada en el anverso y/o anexo a la presente OC (“presentador”) por la prestación de cualquier tipo de servicios y/o entrega de bienes o productos (“los servicios”) de conformidad con las

                            <br<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CLAUSULAS

                            1.	Se entenderá que existe relación contractual entre el Prestador y el Cliente (“las Partes”) cuando en la OC medie la firma del Cliente a través de un representante o bien, mediante autorización previa y expresa de este.

                            2.	El prestador, manifiesta que para la prestación de los servicios cuenta con todo tipo de autorizaciones, permisos o licencias, así como recursos económicos, técnicos y humanos , proporcionado la totalidad de materiales y servicios en el lugar y tiempos previstos en la OC.

                            3.	Una vez que los servicios hayan sido prestados y/ o entregados a entera satisfacción del Cliente, este se pagará a favor del prestador las cantidades señaladas en la OC, dentro de los 20 (veinte) días naturales siguientes contados a partir de la entrega de la factura correspondiente y de entregables en el cual debe de proporcionar el número de recepción correspondiente, misma que deberá cumplir con todos los requisitos fiscales vigentes (la “Contraprestación”)

                            4.	La forma de pago de la Contraprestación será en tipo de moneda que se señale en el anverso en cualquiera de las siguientes formas; (i) mediante transferencia electrónica en la cuenta bancaria que para el efecto señale El prestador,
                            (ii) mediante cheque; o (iii) en el domicilio que para efecto señale El prestador al Cliente, en caso de cambio de datos bancario enviar correo a recepción.factura@silent4business.com con la actualización de datos solicitados.

                            5.	El prestador deberá de realizar, elaborar y/o entregar los servicios con los estándares mas altos de calidad en la industria, así como cumplir con todos y cada uno de los requerimientos del cliente a su entera satisfacción, por lo que garantiza que estos cumplirán con las especificaciones indicadas por el cliente tanto en la OC como en la documentación técnica e información adicional que proporcione. En caso de no cumplir con lo anterior, o si el Cliente manifiesta inconformidad en los servicios de manera total o parcial, el prestador deberá a elección del cliente; (i) Volverá a prestar el servicio o entregara el producto de manera inmediata y sin ningún cobro adicional; (ii) Hacer el reembolso total entregada al prestador o erogada con motivo de dicha inconformidad, o (iii) pago de una pena convencional ya sea (a) del (treinta por ciento) de la factura o (b) la pena convencional la que hay a la que haya sido acreedor el cliente por el retraso o incumplimiento por parte del prestador.

                            6.	El prestador manifiesta y acuerda conforme al Articulo 13 de la ley federal del Trabajo Vigente en México, cuenta con los elementos propios y suficientes para dar cumplimiento a sus obligaciones y llevar acabo sus actividades por lo que será el único responsable del debido cumplimiento de todas y cada una de sus obligaciones con respecto a sus trabajadores, empleados y agentes. No existirá relación laboral o de cualquier clase entre una de las partes con los empleados de la parte.

                            7.	La presente OC no implica el otorgamiento de una licencia o cualquier otro titulo que le permita al prestador utilizar las marcas, nombres y avisos comerciales, denominaciones de productos o cualquier otro derecho de propiedad industrial o intelectual o derecho de autor perteneciente al cliente sin su previo consentimiento por escrito.

                            8.	Las partes convienen en que por el pago de la contraprestación objeto del presente instrumento, cualquiera tipo de derechos de propiedad intelectual y/o industrial derivados de los productos y/o servicios, serán propiedad exclusiva del cliente.

                            9.	Las partes se obligan a utilizar la información confidencial que puedan llegar a proporcionar únicamente para la realización y cumplimiento de la presente OC, quedándole estrictamente prohibido divulgar por cualquier medio o terceros o darle cualquier uso diverso al establecido, obligándose a resguardarla como tal permaneciendo vigente como toda su valides y alcances aun después de terminada la vigencia del presente instrumento hasta por 3(tres) años y en el caso de servicios a gobierno hasta por 5(cinco) años. Se entenderá como información confidencial (de forma enunciativa, mas no limitada) toda aquella información oral, escrita, verbal o gráfica, así como la contenida en medios físicos, electrónicos o electromagnéticos, que se encuentren identificada claramente por la parte reveladora.

                            10.	Durante la vigencia de esta OC y después de concluida la misma, el prestador será responsable frente al cliente y frente a cualquier tercero de todos aquellos actos u omisiones que por culpa, negligencia, dolo o mala fe ,se cometa en la presentación de los servicios objeto de esta OC, que ponga o puedan poner en peligro, causen o puedan causar un daño y/o perjurio a los bienes, propiedades, posesiones, derechos reputación, imagen corporativa o buen nombre comercial del cliente o daños y/o prejuicios que se causen a terceros.

                            11.	Para cualquier notificación relacionada con la presente OC , las partes señalan como sus domicilios los establecidos en la OC, mismas que deberán ser hechas personalmente , por correo certificada o servicio de mensajería especializada en caso de que cualquiera de las partes cambie de domicilio deberá de notificarlo con anticipación a la otra parte, de no ser así cualquier notificación realizada en los domicilios antes señalados será considerado como efectivamente realizado.

                            12.	La invalidez de alguna cláusula del presente instrumento no afectara las demás disposiciones del mismo, las cuales continuara en plena fuerza y vigor y deberán interpretarse como si la cláusula o inciso respectivo no hubieran sido insertados.

                            13.	El presente se obliga o no ceder o subcontratar en todo o en parte los derechos y obligaciones que se deriven de esta OC, a menos que el cliente lo apruebe por escrito y en su caso el prestador será responsable de la relación con las compañías y/o terceros con los que contrate o subcontrate.

                            14.	Para la interpretación y cumplimiento de los términos y condiciones de la OC, las partes se someten a la jurisdicción de los tribunales de la ciudad de México, renunciando expresamente a cualquier otro fuero que pudiera corresponderles por razón de sus domicilios presentes o futuros.

                            15.	Temas relacionados con pagos facturas y de temas de OC al correo de recepción.factura@silent4business.com",
        ];

        ClausulasOc::insert($clausula);
    }
}
