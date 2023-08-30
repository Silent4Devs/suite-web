@extends('layouts.admin')
@section('content')
    {{-- menus horizontales --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet.css') }}">

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
        div.nav .nav-link {
            color: #345183;
        }

        .nav-tabs .nav-link.active {
            border-top: 2px solid #345183;
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
            background-color: #eee;
            color: #345183;
            border-radius: 6px;
            box-shadow: 0px 2px 3px 1px rgba(0, 0, 0, 0.2);
            transition: 0.1s;
            padding: 7px;
        }

        div.tab-pane a:hover {
            text-decoration: none !important;
            color: #345183;
            border: 1px solid #345183;
            box-shadow: 0px 2px 3px 1px rgba(0, 0, 0, 0.0);
            background-color: #fff;
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


    {{-- {{ Breadcrumbs::render('admin.iso27001.index') }} --}}
    <h5 class="titulo_general_funcion">Timesheet</h5>
    <div class="mt-5 card">
        <div class="card-body">
            @include('partials.flashMessages')
            <nav>
                <div class="nav nav-tabs" id="tabsIso27001" role="tablist">
                    <a class="nav-link active" id="nav-contexto-tab" data-type="contexto" data-toggle="tab"
                        href="#nav-contexto" role="tab" aria-controls="nav-contexto" aria-selected="true">
                        <i class="bi bi-calendar4"></i>
                        Mi Timesheet
                    </a>
                    @if(auth()->user()->empleado)
                        @if(auth()->user()->empleado->es_supervisor)
                        <a class="nav-link" id="nav-gerente-tab" data-type="gerente" data-toggle="tab"
                            href="#nav-gerente" role="tab" aria-controls="nav-gerente" aria-selected="false" style="position: relative;">
                            <i class="bi bi-person-video2"></i>
                            Aprobador

                            @if($aprobar_contador > 0)
                                <span class="indicador_numero">{{ $aprobar_contador }}</span>
                            @endif
                        </a>
                        @endif
                    @endif

                    @if(Auth::user()->can('timesheet_administrador_proyectos_access') || Auth::user()->can('timesheet_administrador_tareas_proyectos_access') || Auth::user()->can('timesheet_administrador_clientes_access') || Auth::user()->can('timesheet_administrador_dashboard_access'))
                        <a class="nav-link" id="nav-liderazgo-tab" data-type="liderazgo" data-toggle="tab"
                            href="#nav-liderazgo" role="tab" aria-controls="nav-liderazgo" aria-selected="false">
                            <i class="bi bi-person-lines-fill"></i>
                            Administrador
                        </a>
                    @endif
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane mb-4 fade show active" id="nav-contexto" role="tabpanel"
                    aria-labelledby="nav-contexto-tab">
                    <ul class="mt-4">

                        @can('timesheet_create')
                            <li>
                                <a href="{{ route('admin.timesheet-create') }}">
                                    <div>
                                        <i class="bi bi-calendar-plus"></i><br>
                                        Registrar Horas
                                    </div>
                                </a>
                            </li>
                        @endcan
                        @can('mi_timesheet_horas_rechazadas_show')
                            <li>
                                <a href="{{ route('admin.timesheet-papelera') }}">
                                    <div>
                                        <i class="bi bi-eraser"></i><br>
                                        Horas en Borrador
                                    </div>
                                </a>
                            </li>
                        @endcan
                        @can('mi_timesheet_horas_aceptadas_show')
                            <li>
                                <a href="{{ route('admin.timesheet') }}">
                                    <div>
                                        <i class="bi bi-calendar4"></i><br>
                                        Mis Registros

                                        @if($rechazos_contador > 0)
                                            <span class="indicador_numero" style="width:100px !important; background:#EA7777 !important; right: 23px; top:23px;">{{ $rechazos_contador }} rechazados</span>
                                        @endif
                                    </div>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
                @if(auth()->user()->empleado)
                    @if(auth()->user()->empleado->es_supervisor)
                        <div class="tab-pane mb-4 fade" id="nav-gerente" role="tabpanel" aria-labelledby="nav-gerente-tab">
                            <ul class="mt-4">
                                @can('timesheet_administrador_aprobar_rechazar_horas_access')
                                    <li>
                                        <a href="{{ route('admin.timesheet-aprobaciones') }}">
                                            <div>
                                                <i class="bi bi-calendar2-minus"></i><br>
                                                Pendientes de Aprobar

                                                @if($aprobar_contador > 0)
                                                    <span class="indicador_numero">{{ $aprobar_contador }}</span>
                                                @endif
                                            </div>
                                        </a>
                                    </li>
                                @endcan
                                @can('timesheet_administrador_aprobar_rechazar_horas_access')
                                    <li>
                                        <a href="{{ route('admin.timesheet-aprobados') }}">
                                            <div>
                                                <i class="bi bi-calendar2-check"></i><br>
                                                Aprobados
                                            </div>
                                        </a>
                                    </li>
                                @endcan
                                @can('timesheet_administrador_aprobar_rechazar_horas_access')
                                    <li>
                                        <a href="{{ route('admin.timesheet-rechazos') }}">
                                            <div>
                                                <i class="bi bi-calendar2-x"></i><br>
                                                Rechazados
                                            </div>
                                        </a>
                                    </li>
                                @endcan
                                @can('timesheet_administrador_reportes_aprobador_access')
                                    @if($organizacion->fecha_registro_timesheet)
                                        <li>
                                            <a href="{{ route('admin.timesheet-reporte-aprobador', auth()->user()->empleado->id) }}">
                                                <div>
                                                    <i class="bi bi-file-earmark-text"></i><br>
                                                    Reportes
                                                </div>
                                            </a>
                                        </li>
                                    @else
                                        <li style="position:relative;">
                                            <a href="#" style="opacity:0.6;">
                                                <div>
                                                    <i class="bi bi-file-earmark-text"></i><br>
                                                    Reportes
                                                </div>
                                            </a>
                                            <strong class="text-danger text-center" style="position:absolute; top:20px; left: 0; width: 100%;">Necesaria fecha de inicio del timesheet</strong>
                                        </li>
                                    @endif
                                @endcan
                            </ul>
                        </div>
                    @endif
                @endif

                @if(Auth::user()->can('timesheet_administrador_proyectos_access') || Auth::user()->can('timesheet_administrador_tareas_proyectos_access') || Auth::user()->can('timesheet_administrador_clientes_access') || Auth::user()->can('timesheet_administrador_dashboard_access'))
                    <div class="tab-pane mb-4 fade" id="nav-liderazgo" role="tabpanel" aria-labelledby="nav-liderazgo-tab">
                        <ul class="mt-4">
                            @can('timesheet_administrador_configuracion_access')
                            <li>
                                    <a href="#" data-toggle="modal" data-target="#dia_semana_modal">
                                        <div>
                                            <i class="bi bi-calendar2-week"></i><br>
                                            Configuración Timesheet
                                        </div>
                                    </a>
                            </li>
                            @endcan

                            @can('timesheet_administrador_clientes_access')
                                <li>
                                    <a href="{{ route('admin.timesheet-clientes') }}">
                                        <div>
                                            <i class="bi bi-bag"></i><br>
                                            Clientes
                                        </div>
                                    </a>
                                </li>
                            @endcan

                            @can('timesheet_administrador_proyectos_access')
                                <li>
                                    <a href="{{ route('admin.timesheet-proyectos') }}">
                                        <div>
                                            <i class="bi bi-list-task"></i><br>
                                            Proyectos
                                        </div>
                                    </a>
                                </li>
                            @endcan
                            @can('timesheet_administrador_tareas_proyectos_access')
                                <li>
                                    <a href="{{ route('admin.timesheet-tareas') }}">
                                        <div>
                                            <i class="bi bi-card-list"></i><br>
                                            Tareas
                                        </div>
                                    </a>
                                </li>
                            @endcan
                            @can('timesheet_administrador_reportes_access')
                            @if($organizacion->fecha_registro_timesheet && $time_exist)
                                <li>
                                    <a href="{{ route('admin.timesheet-reportes') }}">
                                        <div>
                                            <i class="bi bi-file-earmark-text"></i><br>
                                            Reportes
                                        </div>
                                    </a>
                                </li>
                             @else
                                <li style="position:relative;">
                                    <a href="#" style="opacity:0.6;">
                                        <div>
                                            <i class="bi bi-file-earmark-text"></i><br>
                                            Reportes
                                        </div>
                                    </a>
                                    <strong class="text-danger text-center" style="position:absolute; top:20px; left: 0; width: 100%;">Seleccione fecha de inicio del timesheet</strong>
                                </li>
                            @endif
                            @endcan
                            @can('timesheet_administrador_dashboard_access')
                                <li>
                                    <a href="{{ route('admin.timesheet-dashboard') }}">
                                        <div>
                                            <i class="bi bi-bar-chart-line"></i><br>
                                            Dashboard
                                        </div>
                                    </a>
                                </li>
                            @endcan



                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>


    <div class="modal fade" id="dia_semana_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-calendar2-event iconos_formulario mr-3"></i> Establecer Jornada Laboral</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('admin.timesheet-actualizarDia') }}" class="row">
                @csrf
                <div class="col-12 form-group">
                    <label>Selecciones fecha de inicio del timesheet</label>
                    <input id="" class="form-control" type="date" name="fecha_registro_timesheet" value="{{ $organizacion->fecha_registro_timesheet }}" max="{{ $time_viejo ? $time_viejo : ''  }}">
                </div>
                <div class="col-12 form-group">
                    <label>Establecer limite de semanas para registros atrasados de timesheet</label>
                    <input id="semanas_min_timesheet" class="form-control" type="number" name="semanas_min_timesheet" value="{{ $organizacion->semanas_min_timesheet }}" min="0">
                    <small class="w-100 d-flex justify-content-between">Esta acción resetea el valor para toda la organización <a href="{{asset('admin/empleados')}}">Limite por empleado</a></small>
                </div>
                <div class="col-12 form-group">
                    <label>Establecer limite de semanas que el colaborador puede adelantar</label>
                    <input id="semanas_adicionales" class="form-control" type="number" name="semanas_adicionales" value="{{ $organizacion->semanas_adicionales }}" min="0" max="12">
                </div>
                <div class="form-group col-12">
                    <label>Seleccione el día de inicio de la jornada laboral</label>
                    <select class="form-control" name="inicio_timesheet">
                        <option value="Lunes" {{ $organizacion->inicio_timesheet == 'Lunes' ? 'selected style="background-color: #eee;"' : ''}}>
                            {{ $organizacion->inicio_timesheet == 'Lunes' ? 'Actual: ' : ''}}
                            Lunes
                        </option>
                        <option value="Martes" {{ $organizacion->inicio_timesheet == 'Martes' ? 'selected' : ''}}>
                            {{ $organizacion->inicio_timesheet == 'Martes' ? 'Actual: ' : ''}}
                            Martes
                        </option>
                        <option value="Miércoles" {{ $organizacion->inicio_timesheet == 'Miércoles' ? 'selected' : ''}}>
                            {{ $organizacion->inicio_timesheet == 'Miércoles' ? 'Actual: ' : ''}}
                            Miércoles
                        </option>
                        <option value="Jueves" {{ $organizacion->inicio_timesheet == 'Jueves' ? 'selected' : ''}}>
                            {{ $organizacion->inicio_timesheet == 'Jueves' ? 'Actual: ' : ''}}
                            Jueves
                        </option>
                        <option value="Viernes" {{ $organizacion->inicio_timesheet == 'Viernes' ? 'selected' : ''}}>
                            {{ $organizacion->inicio_timesheet == 'Viernes' ? 'Actual: ' : ''}}
                            Viernes
                        </option>
                        <option value="Sábado" {{ $organizacion->inicio_timesheet == 'Sábado' ? 'selected' : ''}}>
                            {{ $organizacion->inicio_timesheet == 'Sábado' ? 'Actual: ' : ''}}
                            Sábado
                        </option>
                        <option value="Domingo" {{ $organizacion->inicio_timesheet == 'Domingo' ? 'selected' : ''}}>
                            {{ $organizacion->inicio_timesheet == 'Domingo' ? 'Actual: ' : ''}}
                            Domingo
                        </option>
                    </select>
                </div>
                <div class="form-group col-12">
                    <label>Seleccione el día de fin de la jornada laboral</label>
                    <select class="form-control" name="dia_timesheet">
                        <option value="Lunes" {{ $organizacion->dia_timesheet == 'Lunes' ? 'selected style="background-color: #eee;"' : ''}}>
                            {{ $organizacion->dia_timesheet == 'Lunes' ? 'Actual: ' : ''}}
                            Lunes
                        </option>
                        <option value="Martes" {{ $organizacion->dia_timesheet == 'Martes' ? 'selected' : ''}}>
                            {{ $organizacion->dia_timesheet == 'Martes' ? 'Actual: ' : ''}}
                            Martes
                        </option>
                        <option value="Miércoles" {{ $organizacion->dia_timesheet == 'Miércoles' ? 'selected' : ''}}>
                            {{ $organizacion->dia_timesheet == 'Miércoles' ? 'Actual: ' : ''}}
                            Miércoles
                        </option>
                        <option value="Jueves" {{ $organizacion->dia_timesheet == 'Jueves' ? 'selected' : ''}}>
                            {{ $organizacion->dia_timesheet == 'Jueves' ? 'Actual: ' : ''}}
                            Jueves
                        </option>
                        <option value="Viernes" {{ $organizacion->dia_timesheet == 'Viernes' ? 'selected' : ''}}>
                            {{ $organizacion->dia_timesheet == 'Viernes' ? 'Actual: ' : ''}}
                            Viernes
                        </option>
                        <option value="Sábado" {{ $organizacion->dia_timesheet == 'Sábado' ? 'selected' : ''}}>
                            {{ $organizacion->dia_timesheet == 'Sábado' ? 'Actual: ' : ''}}
                            Sábado
                        </option>
                        <option value="Domingo" {{ $organizacion->dia_timesheet == 'Domingo' ? 'selected' : ''}}>
                            {{ $organizacion->dia_timesheet == 'Domingo' ? 'Actual: ' : ''}}
                            Domingo
                        </option>
                    </select>
                </div>
                <div class="col-12 text-right">
                    <div type="button" class="btn btn_cancelar" data-dismiss="modal">Cancelar</div>
                    <button class="btn btn-success">Guardar</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection


@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuActive = localStorage.getItem('menu-iso27001-active');
            $(`#tabsIso27001 [data-type="${menuActive}"]`).tab('show');

            $('#tabsIso27001 a').on('click', function(event) {
                event.preventDefault()
                $(this).tab('show')
                const keyTab = this.getAttribute('data-type');
                localStorage.setItem('menu-iso27001-active', keyTab);
            });
        });

        document.addEventListener('DOMContentLoaded', ()=>{
            document.querySelector("#semanas_adicionales").addEventListener("keypress", function (evt) {
                if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                {
                    evt.preventDefault();
                }
            });

            document.getElementById('semanas_adicionales').addEventListener('keyup',(e)=>{
                if (e.target.value < 0) {
                    e.target.value=0;
                }
                if (e.target.value > 12) {
                    e.target.value=12;
                }
            });

            $(".date_librery").flatpickr({
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                      shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                      longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    },
                    months: {
                      shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                      longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    },
                },
                altInput: true,
                dateFormat: 'd-m-Y',
            });
            $("#fecha_dia_time_organizacion_start").flatpickr({
                "disable": [
                    function(date) {

                    }
                ],
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                      shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                      longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    },
                    months: {
                      shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                      longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    },
                },
            });
        });
    </script>
@endsection
