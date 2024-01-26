@extends('layouts.admin')
<link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet.css') }}?v=1.1">

<style type="text/css">
    .caja_botones_menu {
        display: flex;
    }

    .caja_botones_menu a {
        width: 33.33%;
        text-decoration: none;
        display: inline-block;
        color: #345183;
        padding: 5px 0px;
        border-top: 1px solid #ccc !important;
        border-right: 1px solid #ccc;
        background-color: #f9f9f9;
        margin: 0;
        text-align: center;
        align-items: center;
    }

    .caja_botones_menu a:first-child {
        border-left: 1px solid #ccc;
    }

    .caja_botones_menu a:not(.caja_botones_menu a.btn_activo) {
        border-bottom: 1px solid #ccc;
    }

    .caja_botones_menu a i {
        margin-right: 7px;
        font-size: 15pt;
    }

    .caja_botones_menu a.btn_activo,
    .caja_botones_menu a.btn_activo:hover {
        background-color: #fff;
    }

    .caja_botones_menu a:hover {
        background-color: #f1f1f1;
    }

    .caja_caja_secciones {
        width: 100%;
    }

    .caja_secciones {
        width: 100%;
        display: flex;
    }

    .caja_secciones section {
        width: 0px;
        overflow: hidden;
        transition: 0.4s;
        opacity: 0;
    }

    .caja_tab_reveldada {
        width: 100% !important;
        overflow: none;
        opacity: 1 !important;
    }



    .seccion_div {
        overflow: hidden;
        width: 990px;
    }

    .caja_tab_reveldada .seccion_div {
        overflow: hidden;
        transition-delay: 0.5s;
        width: 100%;
    }
</style>
<style type="text/css">
    .nav.nav-tabs .nav-link.active {
        background-color: rgba(0, 0, 0, 0.0) !important;
        color: #345183 !important;
    }

    div.nav .nav-link {
        color: #345183;
    }

    .nav-tabs .nav-link.active,
    .nav-tabs .nav-link:hover {
        border-color: rgba(0, 0, 0, 0.0);
    }

    .nav-link:first-child {
        border-radius: 0px !important;
        border-right: 2px solid #ccc !important;
    }

    div.tab-pane ul {
        padding: 0;
        margin: 0;
        text-align: center;
    }

    div.tab-pane li {
        list-style: none;
        width: 150px;
        height: 150px;
        box-sizing: border-box;
        position: relative;
        margin: 10px;
        display: inline-block;
    }

    div.tab-pane li i {
        font-size: 30pt;
        margin-bottom: 10px;
        width: 100%;
    }

    div.tab-pane a {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #fff;
        color: #345183;
        box-shadow: 0px 1px 4px #00000024;
        border-radius: 14px;
        transition: 0.1s;
        padding: 7px;
    }

    div.tab-pane a:hover {
        text-decoration: none !important;
        color: #345183;
        border: 1px solid #345183;
        box-shadow: 0px 2px 3px 1px rgba(0, 0, 0, 0.0);
        transform: scale(1.05);
    }

    a:hover {
        text-decoration: none !important;
    }



    @media(max-width: 648px) {
        .caja_secciones {
            min-height: 1000px;
        }
    }

    @media(max-width: 474px) {
        .caja_secciones {
            min-height: 2000px;
        }
    }

    .tabs {
        outline: none;
    }
</style>
<style>
    .ventana_menu {
        width: calc(100% - 40px);
        background-color: #fff;
        position: absolute;
        margin: auto;
        display: none;
        top: 35px;
        z-index: 3;
        height: calc(100% - 40px);

    }


    .btn_modal_video {
        width: 160px !important;
        transform: scale(0.7);
        position: absolute;
        right: 0;
        margin-top: -35px;
    }
</style>


<br>
<br>
<div class="card-body datatable-fix w-100">
    <div class="px-1 py-2 mb-4 rounded " style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
        <div class="row w-100">
            <div class="text-center col-1 align-items-center d-flex justify-content-center">
                <div class="w-100">
                    <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                </div>
            </div>
            <div class="col-11">
                <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                <p class="m-0" style="font-size: 14px; color:#1E3A8A ">En esta sección podrá hacer la solicitud de
                    Vacaciones, Day Off, Permisos y Mensajería.
                </p>

            </div>
        </div>
    </div>


    <div class="mt-5">
        <div class="card-body">
            @include('partials.flashMessages')
            @if (Auth::user()->can('mis_cursos_acceder'))
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane mb-4 fade show active" id="nav-contexto" role="tabpanel"
                        aria-labelledby="nav-contexto-tab">
                        <ul class="mt-4">

                            @can('mi_perfil_modulo_solicitud_ausencia')
                                <li>
                                    <a href="{{ asset('admin/solicitud-vacaciones') }}" class="btn_reporte">
                                        <div>
                                            <i class="bi bi-sun"></i><span>Vacaciones</span>
                                        </div>
                                    </a>
                                </li>
                            @endcan
                            @can('mi_perfil_modulo_solicitud_ausencia')
                                <li>
                                    <a href="{{ asset('admin/solicitud-dayoff') }}" class="btn_reporte">
                                        <i class="bi bi-bicycle"></i> <br><br><span
                                            style="position: relative; right: 1.2rem;">Day Off´s</span>
                                    </a>
                                </li>
                            @endcan
                            @can('mi_perfil_modulo_solicitud_ausencia')
                                <li>
                                    <a href="{{ asset('admin/solicitud-permiso-goce-sueldo') }}" class="btn_reporte">
                                        <i class="bi bi-coin"></i><span>Permisos</span>
                                    </a>
                                </li>
                            @endcan
                            @can('mi_perfil_modulo_solicitud_ausencia')
                                <li>
                                    <a href="{{ asset('admin/envio-documentos') }}" class="btn_reporte">
                                        <i class="bi bi-send"></i><span>Mensajería</span>
                                    </a>
                                </li>
                            @endcan
                            {{-- @php
                        if ($solicitudes_pendientes == 0) {
                            $mostrar_solicitudes = false;
                        } else {
                            $mostrar_solicitudes = true;
                        }
                    @endphp
                    @can('modulo_aprobacion_ausencia')
                        <div x-data="{ open: @js($mostrar_solicitudes) }">
                            <a href="{{ asset('admin/solicitud-vacaciones/menu') }}" class="btn_reporte"
                                style="position: relative; overflow: inherit !important">
                                <i class="bi bi-check-circle"></i><br>
                                Aprobaciones
                                <div id="circulo" style="display:inline-block;position:absolute; top:-60px; right:-13px;"
                                    class="offset-1 mt-5" x-show="open">
                                    <p> {{ $solicitudes_pendientes }}</p>
                                </div>
                            </a>
                        @endcan --}}


                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
