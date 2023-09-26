@extends('layouts.admin')
@section('content')
    <div class="mt-3">
        {{ Breadcrumbs::render('Vista-Global-Vacaciones') }}
    </div>

    <style>
        .btn_cargar {
            border-radius: 100px !important;
            border: 1px solid #345183;
            color: #345183;
            text-align: center;
            padding: 0;
            width: 45px;
            height: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 !important;
            margin-right: 10px !important;
        }

        .btn_cargar:hover {
            color: #fff;
            background: #345183;
        }

        .btn_cargar i {
            font-size: 15pt;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .agregar {
            margin-right: 15px;
        }
    </style>

    <h5 class="col-12 titulo_general_funcion">Vista Global de Solicitudes de Vacaciones</h5>

    <div class="card">
        @can('amenazas_agregar')
            <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12">
                    @include('csvImport.modal', [
                        'model' => 'Amenaza',
                        'route' => 'admin.amenazas.parseCsvImport',
                    ])
                </div>
            @endcan
        </div>

        @include('flash::message')
        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 datatable datatable-vista-global-vacaciones tblCSV"
                id="datatable-vista-global-vacaciones">
                <thead class="thead-dark">
                    <tr>
                        <th style="min-width: 200px;">
                            Solicitante
                        </th>
                        <th style="min-width: 110px;">
                            Días Solicitados
                        </th>

                        <th style="min-width: 75px;">
                            Inicio
                        </th>
                        <th style="min-width: 75px;">
                            Fin
                        </th>
                        <th style="min-width: 75px;">
                            Estatus
                        </th>
                        {{-- <th style="min-width: 150px;">
                            Comentarios
                        </th> --}}
                        <th style="min-width: 70px;">
                            Opciones
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($solVac as $sol)
                        <tr>
                            <td style="min-width: 200px;">
                                <img src="{{ asset('storage/empleados/imagenes') }}/{{ $sol->avatar }}"
                                    title="{{ $sol->empleado->name }}" class="rounded-circle"
                                    style="clip-path: circle(15px at 50% 50%);height: 30px;" />
                                <span>{{ $sol->empleado->name }}</span>
                            </td>
                            <td style="min-width: 110px;">
                                {{ $sol->dias_solicitados }}
                            </td>

                            <td style="min-width: 75px;">
                                {{ $sol->fecha_inicio }}
                            </td>
                            <td style="min-width: 75px;">
                                {{ $sol->fecha_fin }}
                            </td>
                            <td style="min-width: 75px;">
                                @if ($sol->aprobacion == 1)
                                    <div style="text-align:left">
                                        <span class="badge badge-pill badge-warning">Pendiente</span>
                                    </div>
                                @elseif ($sol->aprobacion == 2)
                                    <div style="text-align:left">
                                        <span class="badge badge-pill badge-danger">Rechazado</span>
                                    </div>
                                @elseif ($sol->aprobacion == 3)
                                    <div style="text-align:left">
                                        <span class="badge badge-pill badge-success">Aprobado</span>
                                    </div>
                                @elseif (!$sol->aprobacion)
                                    <span class="badge badge-pill badge-secondary">Sin Seguimiento</span>
                                @endif
                            </td>
                            {{-- <td style="min-width: 150px;">
                                Comentarios
                            </td> --}}
                            <td style="min-width: 70px;">
                                <a href="solicitud-vacaciones/{{ $sol->id }}/vistaGlobal" title="Ver solicitud"><i
                                        class="fa-solid fa-eye fa-1x text-info text-aling:center"></i></a>
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
                    title: `Amenazas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Amenazas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
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
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                        $(doc.document.body).prepend(`
                            <div class="row">
                                <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                    <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                                </div>
                                <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                    <p>${empresa_actual}</p>
                                    <strong style="color:#345183">Amenazas</strong>
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
            // let btnAgregar = {
            //     text: '<i class="fa-solid fa-box-archive"></i>  Archivo',
            //     titleAttr: 'Archivo',
            //     url: "{{ route('admin.solicitud-vacaciones.archivo') }}",
            //     className: "btn-xs btn-outline-primary rounded ml-2 pr-3 archivo",
            //     action: function(e, dt, node, config) {
            //         let {
            //             url
            //         } = config;
            //         window.location.href = url;
            //     }
            // };
            // dtButtons.push(btnAgregar);


            // let btnExport = {
            //     text: '<i  class="fas fa-download"></i>',
            //     titleAttr: 'Descargar plantilla',
            //     className: "btn btn_cargar",
            //     url: "{{ route('descarga-amenaza') }}",
            //     action: function(e, dt, node, config) {
            //         let {
            //             url
            //         } = config;
            //         window.location.href = url;
            //     }
            // };
            // let btnImport = {
            //     text: '<i  class="fas fa-file-upload"></i>',
            //     titleAttr: 'Importar datos',
            //     className: "btn btn_cargar",
            //     action: function(e, dt, node, config) {
            //         $('#csvImportModal').modal('show');
            //     }
            // };



            // dtButtons.push(btnExport);
            // dtButtons.push(btnImport);


            let dtOverrideGlobals = {
                pageLength: 10,
                buttons: dtButtons,
                processing: true,
                retrieve: true,
            };
            let table = $('.datatable-vista-global-vacaciones').DataTable(dtOverrideGlobals);
            $('.btn.buttons-print.btn-sm.rounded.pr-2').unbind().click(function() {
                let titulo_tabla = `
                <h5>
                    <strong>
                       Vista Global de Vacaciones
                    </strong>
                </h5>
            `;
                imprimirTabla('datatable-vista-global-vacaciones', titulo_tabla);
            });

        });
    </script>
@endsection
