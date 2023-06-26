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

    <!--[if (gte mso 9)|(IE)]>
 <style type="text/css">
 table {
 border-collapse: collapse;
 border-spacing: 0;
 mso-table-lspace: 0pt !important;
 mso-table-rspace: 0pt !important; }
 </style>
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

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly;">
    <table role="presentation"
        style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation"
                    style="width:602px;border-collapse:collapse;border:.5px solid #153643;border-spacing:0;text-align:left;">
                    {{-- <tr>
                        <td align="center" style="padding:40px 0 30px 0;background:#358765;">
                            <img src="https://image.flaticon.com/icons/png/512/4786/4786029.png" alt="" width="100"
                                style="height:auto;display:block; margin-bottom: 10px;" />
                            <h3 class="p-0 m-0"
                                style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif; color:white">
                                Sistema de Gestión Normativa - Tabantaj</h3>
                        </td>
                    </tr> --}}

                    <tr>

                        <td style="padding:36px 30px 42px 30px;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <hr style="margin:0;width: 100%; height: 1.5px; background-color: #153643;">
                                    &nbsp;
                                    </hr>
                                    @php
                                        use App\Models\Organizacion;
                                        $organizacion = Organizacion::first();
                                        $logotipo = $organizacion->logotipo;
                                        $empresa = $organizacion->empresa;
                                    @endphp
                                    <h2 style="padding-top:3px; color:#153643; text-align:center">
                                        {{ $empresa }}</h2>
                                    <hr style="margin:0;width: 100%; height:1.5px; background-color: #153643;">
                                    &nbsp;
                                    </hr>

                                    <td style="padding:0 0 36px 0;">

                                        <div class="caja_img_logo" style="margin-top:30px; text-align:center">
                                            <img width="160" src="{{ asset($logotipo) }}" class="mt-2 ml-4"
                                                style="width:160px;">
                                        </div>

                                        <div style="margin-top:50px;">
                                            <strong
                                                style="color:#153643; padding-top:40px; margin:0 0 14px 0;font-size:17px;line-height:24px;font-family:Arial,sans-serif;">
                                                Estimado(a) {{ $responsable->name }},
                                            </strong>
                                        </div>

                                        <div style="width: 100%; margin-top: 10px;">
                                            <p style="font-size:11pt; color:#153643;">
                                                Le informamos que {{ $aprobador->name}}, ha
                                                @if ($control->estatus == 2)
                                                    aprobado su justificación.
                                                @elseif($control->estatus == 3)
                                                    rechazado su justificación.
                                                @endif
                                                del control {{$aplicabilidad->anexo_indice}}
                                            </p>
                                            <br>
                                            <div style="text-align:center; margin-top:20px">
                                                <a  href="{{route('admin.declaracion-aplicabilidad-2022.index') }}" style="text-decoration:none;padding-top:15px; border-radius:4px; display:inline-block; min-width:300px; height:35px ;color:#fff; font-size:11pt; background-color:#345183">
                                                    Revisar Control
                                                </a>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:10px;background:#fff;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:30;font-size:9px;font-family:Arial,sans-serif;">
                                <tr>
                                    <td style="padding:0;width:30%;" align="left">
                                        <p style="text-align:center; font-size:10pt; color:#153643;">Por favor no
                                            responda a este correo</p>
                                        <hr style="margin:0; width: 100%; height: 1.5px; background-color: #153643;">
                                        &nbsp;
                                        </hr>

                                        <p style="text-align:center;font-size:10pt;font-weight: normal;color:#153643;">
                                            SISTEMA INTEGRAL DE GESTIÓN EMPRESARIAL TABANTAJ</p>
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
