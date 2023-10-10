@extends('layouts.email')
@section('content')
    <table>
        <tbody>
            <tr>
                <td style="padding:36px 30px 42px 30px;">
                    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                        <tr>
                            <td style="padding:0 0 36px 0;color:#153643;">
                                <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;color: #358765;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#FC0A0A"
                                        class="bi bi-x-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                    </svg> Documento No Publicado
                                </h1>
                                <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                    Información del documento:
                                <ul>
                                    <li>Tipo: <strong>{{ $documento->tipo }}</strong></li>
                                    <li>Código: <strong>{{ $documento->codigo }}</strong></li>
                                    <li>Nombre: <strong>{{ $documento->nombre }}</strong></li>
                                    <li>Estado: <div
                                            style="width: 10px; height: 10px; background-color: #FC0A0A; border-radius: 100%; display: inline-block; margin-right: 5px;">
                                        </div><strong>No Publicado</strong></li>
                                </ul>
                                </p>
                                <div style="width: 100%; height: 5px; background-color: rgb(53, 53, 53);">&nbsp;
                                </div>
                                <div style="width: 100%; margin-top: 10px;">
                                    <p>Descripción:</p>
                                    <p>Buen día {{ $documento->elaborador->name }}, </p>
                                    <p>Le informamos que el documento enviado a revisión <strong
                                            style="color: #FC0A0A; text-transform: uppercase;">no se ha
                                            publicado</strong>
                                    </p>
                                    <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-file-earmark-richtext" viewBox="0 0 16 16">
                                            <path
                                                d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
                                            <path
                                                d="M4.5 12.5A.5.5 0 0 1 5 12h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 10h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm1.639-3.708 1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V8.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V8s1.54-1.274 1.639-1.208zM6.25 6a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5z" />
                                        </svg> <span style="text-transform: capitalize">{{ $documento->tipo }}</span> -
                                        ({{ $documento->codigo }})
                                        {{ $documento->nombre }}</p>
                                    <a href="{{ route('admin.documentos.renderViewDocument', $documento) }}"
                                        style="outline: none; text-decoration: none; font-size: small; font-family: Arial, Helvetica, sans-serif; background-color: #0b89bb; padding: 10px; border-radius: 10px; color: white;">
                                        <span>Ver Documento</span>
                                    </a>
                                    <div style="width: 100%; margin-top: 30px;">
                                        <strong>NOTA:</strong>
                                        <p style="margin: 4px 0 0 0;">Vuelve a realizar la solicitud de
                                            aprobación atendiendo los motivos de rechazo que te hicieron los
                                            revisores.</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
