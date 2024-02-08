@extends('layouts.admin')
<link rel="stylesheet" href="{{ asset('css/vacaciones.css') }}{{config('app.cssVersion')}}">
@section('content')
    <div class="mt-3">
        {{ Breadcrumbs::render('Vista-Global-Vacaciones') }}
    </div>

    <h5 class="col-12 titulo_general_funcion">Vista Global de Solicitudes de Vacaciones</h5>

    <div class="row">
        @can('reglas_vacaciones_vista_global')
            <div class="col-12 text-right">
                <a type="button" class="btn" style="background-color:#b9eeb9; border: #fff; width:200px;"
                    href="{{ url('admin/ExportVacaciones') }}">
                    <i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935" title="Exportar Excel"></i>
                    Exportar Excel
                </a>
            </div>
        @endcan
    </div>

    @include('partials.flashMessages')
    <div class="datatable-fix datatable-rds">
        <h3 class="title-table-rds">Vista Global de Solicitudes de Vacaciones</h3>
        <table class="datatable datatable-vista-global-vacaciones tblCSV" id="vista-global-vacaciones">
            <thead>
                <tr>
                    <th style="min-width: 200px;">
                        Solicitante
                    </th>
                    <th style="min-width: 200px;">
                        Descripción
                    </th>
                    <th style="min-width: 75px;">
                        Periodo
                    </th>
                    <th style="min-width: 110px;">
                        Días Solicitados
                    </th>

                    <th style="min-width: 100px;">
                        Inicio
                    </th>
                    <th style="min-width: 100px;">
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
                            <img src="{{ $sol->empleado->avatar_ruta }}" title="{{ $sol->empleado->name }}"
                                class="rounded-circle" style="clip-path: circle(15px at 50% 50%);height: 30px;" />
                            <span>{{ $sol->empleado->name }}</span>
                        </td>
                        <td style="min-width: 200px;">
                            {{ $sol->descripcion }}
                        </td>
                        <td style="min-width: 75px;">
                            {{ $sol->año }}
                        </td>
                        <td style="min-width: 110px;">
                            {{ $sol->dias_solicitados }}
                        </td>

                        <td style="min-width: 100px;">
                            {{ $sol->fecha_inicio }}
                        </td>
                        <td style="min-width: 100px;">
                            {{ $sol->fecha_fin }}
                        </td>
                        <td style="min-width: 75px;">
                            @if ($sol->aprobacion == 1)
                                <div style="text-align:left">
                                    <span class="estatus-global-vac"
                                        style="background: #FBFFBF; color: #DD8E04;">Pendiente</span>
                                </div>
                            @elseif ($sol->aprobacion == 2)
                                <div style="text-align:left">
                                    <span class="estatus-global-vac"
                                        style="background: #D9D9D9; color: #464646;">Rechazado</span>
                                </div>
                            @elseif ($sol->aprobacion == 3)
                                <div style="text-align:left">
                                    <span class="estatus-global-vac"
                                        style="background: #BFFFC9; color: #008F27;">Aprobado</span>
                                </div>
                            @elseif (!$sol->aprobacion)
                                <span class="estatus-global-vac" style="background: #ffbfe5; color: #dd0483;">Sin
                                    Seguimiento</span>
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
@endsection

@section('scripts')
    @parent
    <script>
        $(function() {
            // let dtButtons = [{
            //         extend: 'csvHtml5',
            //         title: `Amenazas ${new Date().toLocaleDateString().trim()}`,
            //         text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Exportar CSV',
            //         exportOptions: {
            //             columns: ['th:not(:last-child):visible']
            //         }
            //     },
            //     {
            //         extend: 'excelHtml5',
            //         title: `Amenazas ${new Date().toLocaleDateString().trim()}`,
            //         text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Exportar Excel',
            //         exportOptions: {
            //             columns: ['th:not(:last-child):visible']
            //         }
            //     },

            //     {
            //         extend: 'print',
            //         text: '<i class="fas fa-print" style="font-size: 1.1rem;color:#345183"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Imprimir',
            //         // set custom header when print
            //         customize: function(doc) {
            //             let logo_actual = @json($logo_actual);
            //             let empresa_actual = @json($empresa_actual);
            //             let empleado = @json(auth()->user()->empleado->name);

            //             var now = new Date();
            //             var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
            //             $(doc.document.body).prepend(`
        //                 <div class="row">
        //                     <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
        //                         <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
        //                     </div>
        //                     <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
        //                         <p>${empresa_actual}</p>
        //                         <strong style="color:#345183">Solicitudes Vacaciones</strong>
        //                     </div>
        //                     <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
        //                         Fecha: ${jsDate}
        //                     </div>
        //                 </div>
        //             `);

            //             $(doc.document.body).find('table')
            //                 .css('font-size', '12px')
            //                 .css('margin-top', '15px')
            //             // .css('margin-bottom', '60px')
            //             $(doc.document.body).find('th').each(function(index) {
            //                 $(this).css('font-size', '18px');
            //                 $(this).css('color', '#fff');
            //                 $(this).css('background-color', 'blue');
            //             });
            //         },
            //         title: '',
            //         exportOptions: {
            //             columns: ['th:not(:last-child):visible']
            //         }
            //     },
            //     {
            //         extend: 'colvis',
            //         text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Seleccionar Columnas',
            //     },
            //     {
            //         extend: 'colvisGroup',
            //         text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
            //         className: "btn-sm rounded pr-2",
            //         show: ':hidden',
            //         titleAttr: 'Ver todo',
            //     },
            //     {
            //         extend: 'colvisRestore',
            //         text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Restaurar a estado anterior',
            //     }

            // ];

            let dtButtons = [];

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
                pageLength: 5,
                buttons: dtButtons,
                processing: true,
                retrieve: true,
            };
            let table = $('.datatable-vista-global-vacaciones').DataTable(dtOverrideGlobals);
            // $('.btn.buttons-print.btn-sm.rounded.pr-2').unbind().click(function() {
            //     let titulo_tabla = `
        //     <h5>
        //         <strong>
        //            Vista Global de Vacaciones
        //         </strong>
        //     </h5>
        // `;
            //     imprimirTabla('vista-global-vacaciones', titulo_tabla);
            // });

        });
    </script>
@endsection
