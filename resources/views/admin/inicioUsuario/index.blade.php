@extends('layouts.admin')
@section('content')
    <style type="text/css">
        body {
            background-color: #fff;
        }

        html {
            overflow-y: scroll !important;
        }

        .info-personal .caja_img_perfil {
            border-radius: 100px;
            height: 100px;
            width: 100px;
            box-shadow: 0px 1px 4px 1px rgba(0, 0, 0, 0.4);
            margin: auto;
            margin-top: -50px;
            margin-bottom: 20px;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .info-personal img {
            height: 100px;
            clip-path: circle(50px at 50% 50%);
        }

        .info-personal .cards {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-top: 8px;
        }



        table td i {
            font-size: 17pt;
            cursor: pointer;
            margin: 3px;
            color: #345183;
        }

        table td i:hover {
            opacity: 0.8;
        }

        td.opciones_iconos {
            text-align: center;
            vertical-align: middle;
        }

        .dataTables_filter {
            overflow: hidden;
        }

        .caja_botones_menu a {
            outline: none;
        }




        /*alerta*/

        .delete {
            margin: auto;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
        }

        .icono_delete {
            margin: 40px 0px;
            color: #FF5500;
            opacity: 0.7;
            font-size: 70pt;
        }

        .eliminar {
            background-color: #FF5500;
            opacity: 0.7;
            border: none;
        }

        .eliminar:hover {
            background-color: #FF5500;
            opacity: 1;
        }

        body.c-dark-theme .delete {
            background: #2a2b36;
        }

        body.c-dark-theme .btn-outline-secondary {
            border: 1px solid #ccc;
            color: #ccc;
        }

        .btn_archivar {
            all: unset !important;
        }


        .caja_botones_secciones a {
            position: relative;
        }

        .indicador_numero {
            position: absolute;
            background-color: #3086AF;
            color: #fff !important;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            padding: 0;
            margin: 0;
            border-radius: 50px;
            top: 0;
            right: 0;
            margin-top: -10px;
        }

        .container {
            max-width: 1500px !important;
        }
    </style>
    @include('partials.flashMessages')
    <div id="inicio_usuario" class="row" style="">
        <h5 class="col-12 titulo_general_funcion">Mi Perfil</h5>
        <div class="col-lg-12 row caja_botones_secciones">
            @if ($usuario->empleado)
                <div class="col-12 caja_botones_menu" style="justify-content: center !important;">
                    @can('mi_perfil_mis_datos_acceder')
                        <a href="#" id="b_misDatos" onclick="almacenarMenuEnLocalStorage('misDatos')" data-tabs="s_misDatos"
                            class=""><i class="bi bi-file-person"></i>
                            Datos</a>
                    @endcan
                    @can('mi_perfil_mi_calendario_acceder')
                        <a href="#" id="b_calendario" onclick="almacenarMenuEnLocalStorage('calendario')"
                            data-tabs="s_calendario"><i class="bi bi-calendar3"></i>
                            Calendario</a>
                    @endcan
                    @can('mi_perfil_mis_actividades_acceder')
                        <a href="#" id="b_actividades" onclick="almacenarMenuEnLocalStorage('actividades')"
                            data-tabs="s_actividades">
                            @if ($contador_actividades)
                                <span class="indicador_numero">{{ $contador_actividades }}</span>
                            @endif
                            <i class="bi bi-stopwatch"></i>Actividades
                        </a>
                    @endcan
                    @can('mi_perfil_mis_aprobaciones_acceder')
                        <a href="#" id="b_aprobaciones" onclick="almacenarMenuEnLocalStorage('aprobaciones')"
                            data-tabs="s_aprobaciones">
                            @if ($contador_revisiones)
                                <span class="indicador_numero">{{ $contador_revisiones }}</span>
                            @endif
                            <i class="bi bi-check2"></i>Aprobaciones
                        </a>
                    @endcan
                    @can('mi_perfil_mis_capacitaciones_acceder')
                        <a href="#" id="b_capacitaciones" onclick="almacenarMenuEnLocalStorage('capacitaciones')"
                            data-tabs="s_capacitaciones">
                            @if ($contador_recursos >= 1)
                                <span class="indicador_numero" id="contadorDeCapacitaciones"></span>
                            @endif
                            <i class="bi bi-mortarboard"></i>Capacitaciones
                        </a>
                    @endcan
                    @can('mi_perfil_mis_reportes_acceder')
                        <a href="#" id="b_reportes" onclick="almacenarMenuEnLocalStorage('reportes')"
                            data-tabs="s_reportes">
                            <i class="bi bi-clipboard-check"></i>
                            Reportes</a>
                    @endcan
                    @can('mi_perfil_mis_reportes_acceder')
                    <a href="#" id="b_solicitudes" onclick="almacenarMenuEnLocalStorage('solicitudes')" data-tabs="s_solicitudes">
                        <i class="bi bi-clipboard-check"></i>
                        Solicitudes
                        <span class="indicador_numero" style=" background: rgb(100, 110, 220);">{{ $solicitudes_pendientes}}</span>
                    </a>
                @endcan
                </div>
            @endif
            <div class="caja_caja_secciones">
                @if ($usuario->empleado)
                    <div class="caja_secciones">
                        @can('mi_perfil_mis_datos_acceder')
                            <section id="s_misDatos" data-id="datos" class="">
                                @include('admin.inicioUsuario.mis-datos')
                            </section>
                        @endcan
                        @can('mi_perfil_mi_calendario_acceder')
                            <section id="s_calendario" data-id="calendario">
                                <div class="container">
                                    @include('admin.inicioUsuario.calendario')
                                </div>
                            </section>
                        @endcan
                        @can('mi_perfil_mis_actividades_acceder')
                            <section id="s_actividades" data-id="actividades">
                                <div class="container">
                                    @include('admin.inicioUsuario.actividades')
                            </section>
                        @endcan
                        @can('mi_perfil_mis_aprobaciones_acceder')
                            <section id="s_aprobaciones" data-id="aprobaciones">
                                <div class="container">
                                    @include('admin.inicioUsuario.aprobaciones')
                                </div>
                            </section>
                        @endcan
                        @can('mi_perfil_mis_capacitaciones_acceder')
                            <section id="s_capacitaciones" data-id="capacitaciones">
                                <div class="container">
                                    @include('admin.inicioUsuario.capacitaciones')
                                </div>
                            </section>
                        @endcan
                        @can('mi_perfil_mis_reportes_acceder')
                            <section id="s_reportes" data-id="reportes">
                                <div class="container">
                                    @include('admin.inicioUsuario.reportes')
                                </div>
                            </section>
                        @endcan
                        @can('mi_perfil_mis_reportes_acceder')
                        <section id="s_solicitudes" data-id="solicitudes">
                            <div class="container">
                                @include('admin.inicioUsuario.solicitudes')
                            </div>
                        </section>
                    @endcan
                    </div>
                @else
                    @include('admin.inicioUsuario.agenda')
                @endif
            </div>

        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-filter" style="font-size: 1.1rem;color:#000"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Seleccionar Columnas',
                },
                {
                    extend: 'colvisGroup',
                    text: '<i class="fas fa-eye" style="font-size: 1.1rem;color:#000"></i>',
                    className: "btn-sm rounded pr-2",
                    show: ':hidden',
                    titleAttr: 'Ver todo',
                },
                {
                    extend: 'colvisRestore',
                    text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Restaurar a estado anterior',
                }

            ];

            let dtOverrideGlobals = {
                buttons: dtButtons,
            };
            let table = $('#tblReportes').DataTable(dtOverrideGlobals);
            setTimeout(() => {
                table.columns.adjust().draw();
            }, 1000);
            document.getElementById('b_reportes').addEventListener('click', () => {
                setTimeout(() => {
                    table.columns.adjust().draw();
                }, 1000);
            })
        });
        document.addEventListener('DOMContentLoaded', function() {
            seleccionarMenuAlIniciar();
            const btnActividades = document.getElementById('b_actividades');
            btnActividades.addEventListener('click', (e) => {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            })
        })

        function seleccionarMenuAlIniciar() {
            let tabSeleccionada = localStorage.getItem('mi-perfil-menu');
            if (tabSeleccionada) {
                document.querySelector(`section#s_${tabSeleccionada}`).classList.add('caja_tab_reveldada')
                document.querySelector(`a#b_${tabSeleccionada}`).classList.add('btn_activo')
            } else {
                document.querySelector(`section#s_misDatos`).classList.add('caja_tab_reveldada')
                document.querySelector(`a#b_misDatos`).classList.add('btn_activo')

            }
        }

        function almacenarMenuEnLocalStorage(menuSeleccionado) {
            localStorage.setItem('mi-perfil-menu', menuSeleccionado);
        }
    </script>
@endsection
