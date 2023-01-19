@extends('mails.template')
@section('content')
    <div style="margin-top:50px;">
        <strong
            style="color:#153643; padding-top:40px; margin:0 0 14px 0;font-size:17px;line-height:24px;font-family:Arial,sans-serif;">
            Estimado(a) {{ $empleado->supervisor->name }},
        </strong>
    </div>
    <div style="width: 100%; margin-top: 10px;">
        <p style="font-size:11pt; color:#153643;">
            Le informamos que {{ $empleado->name }}, ha solicitado la aprobación del siguiente objetivo estratégico:
        </p>
        <p class="m-0"><strong>Nombre: </strong>{{ $objetivo->nombre }}</p>
        <p class="m-0"><strong>KPI: </strong>{{ $objetivo->KPI }}</p>
        <p class="m-0"><strong>Meta: </strong>{{ $objetivo->meta }} {{ $objetivo->metrica->unidad }}</p>
        <br>
        <p style="font-size:11pt; color:#153643;">
            Para aceptar o rechazar el objetivo estratégico dé clic en el siguiente botón:
        </p>

        <div style="text-align:center; margin-top:20px">
            <span
                style="text-decoration:none;padding-top:15px; border-radius:4px; display:inline-block; min-width:300px; height:35px ;color:#fff; font-size:11pt; background-color:#345183">
                <a href="{{ route('admin.ev360-objetivos-empleado.create', $empleado) }}" style="color:#fff">
                    Revisar el objetivo estratégico
                </a>
            </span>
        </div>

    </div>
@endsection
