<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <!--[if mso]>
  <noscript>
    <xml>
      <o:OfficeDocumentSettings>
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
  </noscript>
  <![endif]-->
    <style>
        table,
        td,
        div,
        h1,
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
    <table role="presentation"
        style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation"
                    style="width:602px;border-collapse:collapse;border:.5px solid #153643;border-spacing:0;text-align:left;">
                    <tr>
                        <td style="padding:36px 30px 42px 30px;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <div style="width: 100%; height: 30px; background-color: #1288b6;">
                                        &nbsp;
                                    </div>
                                    @php
                                        use App\Models\Organizacion;
                                        $organizacion = Organizacion::first();
                                        $logotipo = $organizacion->logotipo;
                                        $empresa = $organizacion->empresa;
                                    @endphp

                                    <td style="padding:0 0 36px 0;">

                                        <div class="caja_img_logo" style="margin-top:30px; text-align:center">
                                            <img src="{{ asset($logotipo) }}" class="mt-2 ml-4"
                                                style="width:160px;">
                                        </div>
                                        <div class="caja_img_logo" style="margin-top:20px; text-align:center">
                                            <img src="{{ $message->embed($pastel) }}" class="mt-2 ml-4"
                                                style="width:260px;">
                                        </div>

                                        <div style="margin-top:50px;">
                                            <strong
                                                style="color:#153643; padding-top:40px; margin:0 0 14px 0;font-size:17px;line-height:12px;font-family:Arial,sans-serif;">
                                                <h1 style="text-align: center;"> ¡¡Feliz cumpleaños!! </h1><br>
                                                <h3 style="text-align: center;"> {{ $empleado }}</h3>
                                            </strong>
                                        </div>

                                        <div style="width: 100%; margin-top: 10px;">
                                            <br>
                                            <p style="font-size:11pt; color:#153643;text-align: left;">

                                                <div>
                                                    A nombre de <span style="color:#4580ff;font-weight: bold;">{{$empresa}}</span>
                                                    te deseamos otro año
                                                    de grandes oportunidades, logros
                                                    y crecimiento personal.
                                                </div>

                                                <br>

                                                <div>
                                                    Que hoy sea un día lleno de alegría,
                                                    rodeado de tus seres queridos y que recibas muchos abrazos
                                                    y buenos deseos.
                                                </div>
                                            </p>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:10px;background:#fff;">
                            <div style="width: 100%; height: 80px; background-color: #1288b6;
                            text-align: center;">
                                &nbsp;
                                {{-- <label for="facebook"><i class="fab fa-facebook-square iconos-crear"></i></label>
                                <label  for="linkedln_id"><i class="fab fa-linkedin iconos-crear"></i></label>
                                <label for="twitter"><i class="fab fa-twitter-square iconos-crear"></i></label> --}}
                            </div>
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:30;font-size:9px;font-family:Arial,sans-serif;">
                                <tr>
                                    <td style="padding:0;width:30%;" align="left">
                                        <p style="text-align:center;font-size:10pt;font-weight: normal;color:#153643;">
                                            SISTEMA INTEGRAL DE GESTIÓN EMPRESARIAL TABANTAJ</p>
                                    </td>
                                </tr>
                            </table>
                            <div style="width: 100%; height: 30px; background-color: #1288b6;">
                                &nbsp;
                            </div>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
