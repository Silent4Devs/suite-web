<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>

    <style>
        .center-h {
            display: flex;
            justify-content: center;
            color: red;
        }

        .algo {
            border: none;
            border-top-color: gray;
            border-top-style: dashed;
            border-top-width: 3px
        }

        table,
        td,
        div,
        h1,
        h3,
        p {
            font-family: Arial, sans-serif;
        }
    </style>
    <style>
        /* Remove space around the email design. */

        html,

        body {

            margin: 0 auto !important;

            padding: 0 !important;

            height: 100% !important;

            width: 100% !important;
        }

        /* Stop Outlook resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
        }


        /* Stop Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* Use a better rendering method when resizing images in Outlook IE. */

        img {
            -ms-interpolation-mode: bicubic;
        }


        /* Prevent Windows 10 Mail from underlining links. Styles for underlined links should be inline. */

        a {

            text-decoration: none;

        }
    </style>
</head>

<body style="margin:0;padding:0;">
    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation"
                    style="width:602px;border-collapse:collapse;border:.5px solid #153643;border-spacing:0;text-align:left;">
                    <tr>
                        <td>
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <div style="width: 100%; height: 30px; background-color: #1f69a7;">
                                        &nbsp;
                                    </div>
                                    @php
                                        use App\Models\Organizacion;
                                        $organizacion = Organizacion::getFirst();
                                        $logotipo = $organizacion->logotipo;
                                        $empresa = $organizacion->empresa;
                                    @endphp
                                    {{-- <h2 style="padding-top:3px; color:#153643; text-align:center">
                                        {{ $empresa }}</h2> --}}
                                    <div class="caja_img_logo" style="margin-top:30px; text-align:center">
                                        <img src="{{ asset($logotipo) }}" class="mt-2 ml-4" style="width:160px;">
                                    </div>
                                    <hr class="algo">
                                    &nbsp;
                                    </hr>

                                    <td style="padding:0 0 36px 0;">

                                        <div class="caja_img_logo" style="margin-top:30px; text-align:center">
                                            <img src="{{ asset('img/auditoria-rechazada.png') }}" class="mt-2 ml-4"
                                                style="width:160px;">
                                        </div>

                                        <div style="width: 100%;">
                                            <div class="center-h">
                                                <h2 style="text-align: center;">
                                                    Rechazada
                                                </h2>
                                            </div>
                                            <p
                                                style="text-align: center; font-size:11pt;
                                                color:#153643; margin-left:25px; margin-right:25px">
                                                La Politica: {{ $nombre_politica }} ha sido rechazada
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#fff;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:30;font-size:9px;font-family:Arial,sans-serif;">
                                <tr>
                                    <td>
                                        <div style="width: 100%; height: 60px; background-color: #1f69a7;">
                                            &nbsp;
                                        </div>

                                        <div class="row">
                                            <p
                                                style="text-align:center;font-size:10pt;font-weight: normal;color:#153643;">
                                                SISTEMA INTEGRAL DE GESTIÓN EMPRESARIAL TABANTAJ</p>
                                        </div>
                                        <div style="width: 100%; height: 30px; background-color: #1f69a7;">
                                            &nbsp;
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>



</html>
