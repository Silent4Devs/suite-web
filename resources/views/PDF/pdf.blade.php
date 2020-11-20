<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="pdf-template/style.css" media="all" />
</head>
<body>
<header class="clearfix">
    <div id="logo">
        <img src="img/Silent4Business-Logo-Color.png">
    </div>
    <h1>DATOS FACTURA</h1>
    <h4 align="center">DATOS EMPRESA</h4>
    <table style="text-align:center;">
        <thead>
        <tr>
            <th>Razon social</th>
            <th>RFC</th>
            <th>Dirección</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="service"></td>
            <td class="desc"></td>
            <td class="unit"></td>
        </tr>
        </tbody>
    </table>
</header>
<h4 align="center">DATOS CLIENTE</h4>
<table style="text-align:center;">
    <thead>
    <tr>
        <th>Cliente</th>
        <th>RFC</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="service"></td>
        <td class="desc"></td>
    </tr>
    </tbody>
</table>
<h4 align="center">FACTURA TIPO (I)</h4>
<table style="text-align:center;">
    <thead>
    <tr>
        <th>Serie-folio</th>
        <th>Folio fiscal</th>
        <th>No.Serie del CSD Emisor</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>Fecha y Hora de emision</th>
        <th>Fecha y Hora de certificación</th>
        <th>No.Serie del CSD del SAT</th>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>

    </tr>
    </tbody>
</table>
<table style="text-align:center;">
    <thead>
    <tr>
        <th>Uso CFDI</th>
        <th>Metodo de Pago</th>
        <th>Forma de Pago</th>
        <th>Regimen fiscal</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>General de Ley Personas Morales(601)</td>
    </tr>
    </tbody>
</table>
<h4 align="center">CONCEPTOS</h4>
<main>
    <table style="text-align:center;">
        <thead>
        <tr>
            <th>Cantidad</th>
            <th>Unidad</th>
            <th>Precio Unitario</th>
            <th>Descuento</th>
            <th>Importe</th>
            <th>IVA</th>
            <th>IEPS</th>
            <th>IMP.EST.</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="service"></td>
            <td class="desc"></td>
            <td class="unit"></td>
            <td class="qty"></td>
            <td class="total"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>

    <table style="text-align:center;">
        <thead>
        <tr>
            <th>Total</th>
            <th>subTotal</th>
            <th>I.V.A. 16%</th>
            <th>Total IVA</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="service"></td>
            <td class="desc"></td>
            <td class="unit"></td>
            <td class="qty"></td>
            <td class="total"></td>
        </tr>
        <!--columnas extras-->
        <!-- <tr>
             <td class="service">Development</td>
             <td class="desc">Developing a Content Management System-based Website</td>
             <td class="unit">$40.00</td>
             <td class="qty">80</td>
             <td class="total">$3,200.00</td>
         </tr>
         <tr>
             <td class="service">SEO</td>
             <td class="desc">Optimize the site for search engines (SEO)</td>
             <td class="unit">$40.00</td>
             <td class="qty">20</td>
             <td class="total">$800.00</td>
         </tr>
         <tr>
             <td class="service">Training</td>
             <td class="desc">Initial training sessions for staff responsible for uploading web content</td>
             <td class="unit">$40.00</td>
             <td class="qty">4</td>
             <td class="total">$160.00</td>
         </tr>
         <tr>
             <td colspan="4">SUBTOTAL</td>
             <td class="total">$5,200.00</td>
         </tr>
         <tr>
             <td colspan="4">TAX 25%</td>
             <td class="total">$1,300.00</td>
         </tr>
         <tr>
             <td colspan="4" class="grand total">GRAND TOTAL</td>
             <td class="grand total">$6,500.00</td>
         </tr>-->
        </tbody>
    </table>

    <div id="notices">
        <div class="notice">"LA ALTERACIÓN, FALSIFICACIÓN O COMERCIALIZACIÓN ILEGAL DE ESTE DOCUMENTO ESTA PENADO POR LA LEY".</div>
        <table style="text-align:center;">
            <thead>
            <tr>
                <th></th>
                <th>Cadena original</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><img src="pdf-template/EEEEEEEE-9783-4886-8A51-6FA6B0774835qrcode.png" style="width: 140px;"></td>
                <td class="service"></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div>
        <p>Sello SAT</p>
        <p></p>
        <p>Sello CFD</p>
        <p></p>
        <p>"Este documento es una representación impresa de un CFDI"</p>
    </div>
</main>

</body>
</html>
