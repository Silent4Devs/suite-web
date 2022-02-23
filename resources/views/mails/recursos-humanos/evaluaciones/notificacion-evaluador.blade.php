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
</head>

<body style="margin:0;padding:0;">
    <table role="presentation"
        style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation"
                    style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                    <tr>
                        <td align="center" style="padding:40px 0 30px 0;background:#1D284B;">
                            <h3 class="p-0 m-0"
                                style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif; color:white">
                                Evaluación de Desempeño - Tabantaj</h3>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:40px 0 0 0">
                            <img src="{{ asset('img/logo_policromatico.png') }}" alt="" width="200"
                                style="height:auto;display:block; margin-bottom: 10px;" />
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:36px 30px 0px 30px;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <h1
                                            style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;color: #358765;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                                                <path
                                                    d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                                            </svg> Notificación de evaluador
                                        </h1>
                                        <p
                                            style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                            Información de la evaluación:
                                        <ul>
                                            <li>Nombre: <strong>{{ $evaluacion->nombre }}</strong></li>
                                            <li>Fecha
                                                Inicio:<strong>{{ \Carbon\Carbon::parse($evaluacion->fecha_inicio)->format('d-m-Y') }}</strong>
                                            </li>
                                            <li>Fecha
                                                Fin:<strong>{{ \Carbon\Carbon::parse($evaluacion->fecha_fin)->format('d-m-Y') }}</strong>
                                            </li>
                                            <li>Estatus: <div
                                                    style="width: 10px; height: 10px; background-color: {{ $evaluacion->color_estatus }}; color: {{ $evaluacion->color_estatus_text }}; border-radius: 100%; display: inline-block; margin-right: 5px;">
                                                </div><strong>{{ $evaluacion->estatus_formateado }}</strong></li>
                                        </ul>
                                        </p>
                                        <div style="width: 100%; height: 5px; background-color: rgb(53, 53, 53);">&nbsp;
                                        </div>
                                        <div style="width: 100%; margin-top: 10px;">
                                            <p>Buen día {{ $evaluador->name }}, </p>
                                            @php
                                                $autoevaluacion = $evaluados->filter(function ($evaluado) use ($evaluador) {
                                                    return $evaluador->id == $evaluado->id;
                                                });
                                                $exists_autoevaluacion = false;
                                                if ($autoevaluacion) {
                                                    $exists_autoevaluacion = true;
                                                }
                                            @endphp
                                            @if ($exists_autoevaluacion)
                                                <p>Ya se encuentra habilitada la <strong>Evaluación de
                                                        Desempeño</strong>
                                                    para su autoevaluación.
                                                </p>
                                            @endif
                                            <p>Así mismo le informamos que ha sido seleccionado para evaluar a los
                                                siguientes colaboradores:
                                            <ul>
                                                @foreach ($evaluados as $evaluado)
                                                    @if ($evaluador->id != $evaluado->id)
                                                        <li>{{ $evaluado->name }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            <p>Por favor dirijase a Tabantaj en la sección de "Mi Perfil" donde
                                                encontrará las respectivas evaluaciones a realizar</p>
                                            <br><br>
                                            <a href="{{ route('admin.inicio-Usuario.index') }}"
                                                style="outline: none; text-decoration: none; font-size: small; font-family: Arial, Helvetica, sans-serif; background-color: #358765; padding: 10px; border-radius: 10px; color: white;">
                                                <span>Ir a Tabantaj</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px;background:#1D284B;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                                <tr>
                                    <td style="padding:0;width:50%;" align="left">
                                        <p
                                            style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                                            &reg; Tabantaj, Silent For Business {{ date('Y') }}<br />
                                        </p>
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
