@extends('layouts.email')

@section('content')
    <div style="margin-top:50px;">
        <strong
            style="color:#153643; padding-top:40px; margin:0 0 14px 0;font-size:17px;line-height:24px;font-family:Arial,sans-serif;">
            Estimado(a) {{ $visitante->nombre }} {{ $visitante->apellidos }},
        </strong>
    </div>

    <div style="width: 100%; margin-top: 10px;">
        <p style="font-size:11pt; color:#153643;">
            Le informamos que su solicitud de ingreso se ha realizado correctamente, por favor siga las instrucciones que se
            le den en recepción.
        </p>
        <br>
        <br>
        <strong
            style="color:#345183;padding-top:10px; margin:0 0 14px 0;font-size:15px;line-height:24px;font-family:Arial,sans-serif;">
            Datos generales</strong>
        <ul style="font-size:11pt; color:#153643;">
            <li style="font-size:11pt;">Nombre: <strong style="font-size:10pt;">
                    {{ $visitante->nombre }} {{ $visitante->apellidos }}</strong>
            </li>
            <li style="font-size:11pt;">Fecha y hora de ingreso:<strong style="font-size:10pt;">
                    {{ \Carbon\Carbon::parse($visitante->created_at)->format('d-m-Y h:i A') }}</strong>
            </li>
            <li style="font-size:11pt;">Visito A:<strong style="font-size:10pt;">
                    @if ($visitante->tipo_visita == 'area')
                        {{ $visitante->area->area }}
                    @else
                        {{ $visitante->empleado->name }}
                    @endif
                </strong>
            </li>
            @if ($visitante->foto)
                <li style="font-size:11pt;">Foto: <strong style="font-size:10pt;">
                        <img src="{{ $visitante->foto }}" alt="" width="50px;">
                    </strong></li>
            @endif
            <li style="font-size:11pt;">Dispositivos:
                <ul>
                    @foreach ($visitante->dispositivos as $item)
                        <li>
                            <p style="margin: 0">{{ $item->dispositivo }}</p>
                            <p style="margin: 0">{{ $item->serie }}</p>
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>
        <p style="font-size:11pt; color:#153643;">
            Para registrar su salida de clic en el siguiente botón:
        </p>
        <div style="text-align:center; margin-top:20px">
            <a href="{{ route('visitantes.salida.registrar', $visitante->uuid) }}"
                style="text-decoration:none;padding-top:15px; border-radius:4px; display:inline-block; min-width:300px; height:35px ;color:#fff; font-size:11pt; background-color:#345183">
                Registrar Salida
            </a>
        </div>
        </p>
    </div>
@endsection
