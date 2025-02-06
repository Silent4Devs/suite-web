@extends('layouts.admin')
@section('content')

    <style>
        :root {
            --color-menu-modulo: #ffd9ed;
        }

        ul.menu-modulos li a,
        ul.menu-modulos li a::before {
            background-image: url("{{ asset('img/menu-modulos/menu-grafis-4.png') }}");
        }
    </style>

    <h5 class="titulo_general_funcion">Visitantes</h5>

    <ul class="menu-modulos">
        <li style="position: relative">
            <a href="{{ route('admin.visitantes.aviso-privacidad.index') }}">
                <i class="bi bi-file-earmark-lock"></i><br>
                <span>
                    Aviso de Privacidad
                </span>
            </a>
            @if (!$existsAvisoPrivacidad)
                <span style="position: absolute;top:-8px;right: -10px;color: var(--color-tbj)">
                    <i style="font-size: 25px !important;" class="far fa-bell"></i>
                </span>
            @endif
        </li>
        <li style="position: relative">
            <a href="{{ route('admin.visitantes.cita-textual.index') }}">
                <i class="bi bi-quote"></i><br>
                <span>
                    Cita Textual
                </span>
            </a>
            @if (!$existsCitaTextual)
                <span style="position: absolute;top:-8px;right: -10px;color: var(--color-tbj)">
                    <i style="font-size: 25px !important;" class="far fa-bell"></i>
                </span>
            @endif
        </li>
        <li style="position: relative">
            <a href="{{ route('admin.visitantes.autorizar') }}">
                <i class="bi bi-file-lock"></i><br>
                <span>
                    Autorizar Salidas
                </span>
            </a>
            @if (!$existsResponsable)
                <div class="p-1"
                    style="position: absolute; background: rgba(75, 75, 75, 0.144);height: 100%;width: 100%">
                    <span class="badge-danger">No se ha configurado el módulo de visitante</span>
                </div>
            @else
                @if ($cantidadAutorizacion)
                    <span style="position: absolute;top:-8px;right: -9px;color: var(--color-tbj)">
                        <i style="font-size: 25px !important;" class="far fa-bell"></i>
                    </span>
                    <span style="position: absolute;top:-8px;right: -3px;color: var(--color-tbj)">
                        {{ $cantidadAutorizacion }}
                    </span>
                @endif
            @endif
        </li>
        <li style="position: relative">
            <a href="{{ route('admin.visitantes.index') }}">
                <i class="bi bi-clipboard-data"></i><br>
                <span>
                    Bitácora de Accesos
                </span>
            </a>
            @if (!$existsResponsable)
                <div class="p-1"
                    style="position: absolute; background: rgba(75, 75, 75, 0.144);height: 100%;width: 100%">
                    <span class="badge-danger">No se ha configurado el módulo de visitante</span>
                </div>
            @endif
        </li>
        <li style="position: relative">
            <a href="{{ route('admin.visitantes.configuracion') }}">
                <i class="bi bi-gear"></i><br>
                <span>
                    Configuración
                </span>
            </a>
            @if (!$existsResponsable)
                <span style="position: absolute;top:-8px;right: -10px;color: var(--color-tbj)">
                    <i style="font-size: 25px !important;" class="far fa-bell"></i>
                </span>
            @endif
        </li>
    </ul>

    <div class="modal fade" id="modal_guia_general" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document" style="margin-top:150px;">
            <div class="modal-content"
                style="background-color: #1C274A; position:relative; min-width: 600px; width: 90% !important; border:1px solid rgba(255, 255, 255, 0.3);">
                <div class="text-right p-3" data-dismiss="modal" style="font-size: 20px; color:#fff; cursor: pointer;"><i
                        class="fas fa-times"></i></div>
                <div class="modal-body">
                    <video src="{{ asset('img/videos_guia/guia_general.mp4') }}" controls style="width:100%;"></video>
                </div>
            </div>
        </div>
    </div>
@endsection
