@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    <style type="text/css">
        #lista_proyectos_tareas li {
            padding-top: 13px;
        }

        @media print {

            #sidebar,
            header,
            .nav-tabs,
            .titulo_general_funcion,
            .breadcrumb {
                display: none !important;
            }

        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0/dist/chartjs-plugin-datalabels.min.js">
    </script>

    <h5 class="col-12 titulo_general_funcion">Timesheet: <font style="font-weight:lighter;">Reporte Financiero</font>
    </h5>

    {{-- @include('admin.timesheet.complementos.cards') --}}
    @include('admin.timesheet.complementos.admin-aprob')
    {{-- @include('admin.timesheet.complementos.blue-card-header') --}}

    <div class="card card-body">
        <div class="datatable-fix w-100">
            <table id="datatable_timesheet_proyectos_financiero" class="table w-100 tabla-animada">
                <thead class="w-100">
                    <tr>
                        <th>ID </th>
                        <th>Nombre del proyecto </th>
                        <th>Cliente</th>
                        <th style="max-width: 250px !important;">Área(s)</th>
                        <th style="max-width: 250px !important;">Empleados participantes</th>
                        <th>Estatus</th>
                        <th>Horas totales del proyecto</th>
                        <th>Costo total del proyecto</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($proyectos as $proyecto)
                        <tr>
                            <td>
                                <strong> {{ $proyecto->identificador }} </strong>
                            </td>
                            <td>{{ $proyecto->proyecto }} </td>
                            <td>{{ $proyecto->cliente_id ? $proyecto->cliente->nombre : '' }} </td>
                            <td>
                                <ul style="padding-left:10px; ">
                                    @foreach ($proyecto->areas as $area)
                                        <li>{{ $area->area }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul style="padding-left:10px; ">
                                    @foreach ($proyecto->empleados as $empleado)
                                        <li>
                                            {{ $empleado['name'] }} | {{ $empleado['horas'] }} <small>h</small> |
                                            ${{ $empleado['costo_horas'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $proyecto->estatus }} </td>
                            <td>{{ $proyecto->horas_totales_llenas }} h</td>
                            <td>
                                @php
                                    $suma_costo = 0;
                                @endphp
                                @if (isset($proyectos->empleados))
                                    @foreach ($proyectos->empleados as $empleado)
                                        @php
                                            $suma_costo += $empleado['costo_horas'];
                                        @endphp
                                    @endforeach
                                @endif

                                ${{ $suma_costo }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Mis Registros ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Mis Registros ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customizeData: function(data) {
                        for (var i = 0; i < data.body.length; i++) {
                            var columnaD = data.body[i][
                                3
                            ];
                            columnaD = columnaD.replace(/\s{2,}/g, ' ');
                            if (columnaD.length > 100) {
                                columnaD = columnaD.slice(0, 100);
                            }
                            data.body[i][3] = columnaD;
                            var columnaE = data.body[i][
                                4
                            ];
                            columnaE = columnaE.replace(/\s{2,}/g, ' ');
                            if (columnaE.length > 100) {
                                columnaE = columnaE.slice(0, 100);
                            }
                            data.body[i][4] = columnaE;
                        }
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;color:#345183"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    // set custom header when print
                    customize: function(doc) {
                        let logo_actual = @json($logo_actual);
                        let empresa_actual = @json($empresa_actual);
                        let empleado = @json(auth()->user()->empleado->name);

                        var now = new Date();
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now
                            .getFullYear();
                        $(doc.document.body).prepend(`
                                <div class="row">
                                    <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                        <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                                    </div>
                                    <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                        <p>${empresa_actual}</p>
                                        <strong style="color:#345183">Timesheet: Reportes</strong>
                                    </div>
                                    <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                        Fecha: ${jsDate}
                                    </div>
                                </div>
                            `);

                        $(doc.document.body).find('table')
                            .css('font-size', '12px')
                            .css('margin-top', '15px')
                        // .css('margin-bottom', '60px')
                        $(doc.document.body).find('th').each(function(index) {
                            $(this).css('font-size', '18px');
                            $(this).css('color', '#fff');
                            $(this).css('background-color', 'blue');
                        });
                    },
                    title: '',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Seleccionar Columnas',
                },
                {
                    extend: 'colvisGroup',
                    text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
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
            let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar empleado',
                url: "{{ asset('admin/inicioUsuario/reportes/quejas') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config) {
                    let {
                        url
                    } = config;
                    window.location.href = url;
                }
            };
            let dtOverrideGlobals = {
                buttons: dtButtons,
                destroy: true,
                render: true,
            };

            let table = $('#datatable_timesheet_proyectos_financiero').DataTable(dtOverrideGlobals);
        });
    </script>
@endsection
