<?php

foreach ($proveedor_seleccionado as $it_proveedor) {
    $reporte_generado =
        '

<div class="card-content">
    <table class="encabezado">
        <thead>
            <tr>
                <th>
                    <div class="logo_organizacion"></div>
                </th>
                <th>
                    <font style="font-weight: lighter;">Ficha de proveedor:</font> <br>
                    <font>' .
        $it_proveedor->nombre_comercial .
        '</font>
                </th>
                <th>' .
        $hoy .
        '</th>
            </tr>
        </thead>
    </table>

    <h1>DATOS GENERALES</h1>
    <table class="line_dato">
        <tr>
            <th>Razón social</th>
        </tr>
        <tr>
            <td>
                <div>' .
        $it_proveedor->razon_social .
        '</div>
            </td>
        </tr>
    </table>
    <table class="line_dato">
        <tr>
            <th> Nombre comercial del proveedor</th>
            <th> RFC persona moral o persona física</th>
        </tr>
        <tr>
            <td>
                <div>' .
        $it_proveedor->nombre_comercial .
        '</div>
            </td>
            <td>
                <div>' .
        $it_proveedor->rfc .
        '</div>
            </td>
        </tr>
    </table>

    <h1>DOMICILIO FISCAL</h1>
    <table class="line_dato">
        <tr>
            <th>Calle y número</th>
            <th>Colonia</th>
        </tr>
        <tr>
            <td>
                <div>' .
        $it_proveedor->calle .
        '</div>
            </td>
            <td>
                <div>' .
        $it_proveedor->colonia .
        '</div>
            </td>
        </tr>
    </table>

    <table class="line_dato">
        <tr>
            <th>Ciudad o municipio/ país</th>
            <th>Código postal</th>
        </tr>
        <tr>
            <td>
                <div>' .
        $it_proveedor->ciudad .
        '</div>
            </td>
            <td>
                <div>' .
        $it_proveedor->codigo_postal .
        '</div>
            </td>
        </tr>
    </table>

    <table class="line_dato">
        <tr>
            <th>Teléfono</th>
            <th>Página web</th>
        </tr>
        <tr>
            <td>
                <div>' .
        $it_proveedor->telefono .
        '</div>
            </td>
            <td>
                <div>' .
        $it_proveedor->pagina_web .
        '</div>
            </td>
        </tr>
    </table>

    <h1>DATOS DEL CONTACTO</h1>
    <table class="line_dato">
        <tr>
            <th>Nombre completo del contacto</th>
            <th>Puesto </th>
        </tr>
        <tr>
            <td>
                <div>' .
        $it_proveedor->nombre_completo .
        '</div>
            </td>
            <td>
                <div>' .
        $it_proveedor->puesto .
        ' </div>
            </td>
        </tr>
    </table>

    <table class="line_dato">
        <tr>
            <th> Correo electrónico</th>
            <th>Celular </th>
        </tr>
        <tr>
            <td>
                <div>' .
        $it_proveedor->correo .
        '</div>
            </td>
            <td>
                <div>' .
        $it_proveedor->celular .
        ' </div>
            </td>
        </tr>
    </table>

    <h1>DATOS COMPLEMENTARIOS</h1>
    <table class="line_dato">
        <tr>
            <th>Objeto social / descripción del servicio o producto</th>
        </tr>
        <tr>
            <td>
                <div>' .
        $it_proveedor->objeto_descripcion .
        '</div>
            </td>
        </tr>
    </table>

    <table class="line_dato">
        <tr>
            <th>Cobertura, rango geográfico en el cual presta los servicios</th>
        </tr>
        <tr>
            <td>
                <div>' .
        $it_proveedor->cobertura .
        '</div>
            </td>
        </tr>
    </table>



    <h1>CONTRATO</h1>
    <table class="tabla">
        <tr>
            <th>N° contrato</th>
            <th>Nombre del servicio</th>
            <th>Tipo de contrato</th>
            <th>Vigencia</th>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>
            <th>Estatus</th>
            <th>Fase</th>
            <th>Monto</th>
        </tr>';
    if (!empty($contratos_de_proveedor)) {
        foreach ($contratos_de_proveedor as $it_contrato_de_proveedor) {
            $r1 =
                '

                            <tr>
                                <td>' .
                $it_contrato_de_proveedor->no_contrato .
                '
        </td>
        <td>' .
                $it_contrato_de_proveedor->nombre_servicio .
                '</td>
        <td>' .
                $it_contrato_de_proveedor->tipo_contrato .
                '</td>
        <td>' .
                $it_contrato_de_proveedor->vigencia_contrato .
                '</td>
        <td>' .
                $it_contrato_de_proveedor->fecha_inicio .
                '</td>
        <td>' .
                $it_contrato_de_proveedor->fecha_fin .
                '</td>
        <td>' .
                $it_contrato_de_proveedor->estatus .
                '</td>
        <td>' .
                $it_contrato_de_proveedor->fase .
                '</td>
        <td>$' .
                number_format($it_contrato_de_proveedor->monto_pago, 2) .
                '</td>
        </tr>';
            $reporte_generado .= $r1;
        }
    } else {
        $r1_1 = '<tr>
                                    <td colspan="8">No hay contratos de este proveedor</td>
                                </tr>';
        $reporte_generado .= $r1_1;
    }
    $r2 = '
    </table>
</div>

';
    $reporte_generado .= $r2;
}
