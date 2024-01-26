@extends('layouts.admin')
@section('content')
    {{-- menus horizontales --}}

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

    <h5 class="titulo_general_funcion">Capacitaciones</h5>

    <div class="mt-5">
        <div class="card-body">
            @include('partials.flashMessages')
            @if (Auth::user()->can('mis_cursos_acceder'))
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane mb-4 fade show active" id="nav-contexto" role="tabpanel"
                        aria-labelledby="nav-contexto-tab">
                        <ul class="mt-4">

                            @can('escuela_estudiante')
                                <li>
                                    <a href="{{ route('admin.mis-cursos') }}">
                                        <div>
                                            <i class="material-symbols-outlined">
                                                book_3
                                            </i><br>
                                            Mis Cursos
                                        </div>
                                    </a>
                                </li>
                            @endcan
                            @can('mis_cursos_instructor')
                                <li>
                                    <a href="{{ route('admin.courses.index') }}">
                                        <div>
                                            <i class="material-symbols-outlined">
                                                badge
                                            </i><br>
                                            Instructor
                                        </div>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
