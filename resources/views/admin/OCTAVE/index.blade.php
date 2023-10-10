@extends('layouts.admin')
@section('content')
    <div class="mt-5 card">

        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Matriz Riesgo OCTAVE
                </strong></h3>
        </div>
        @can('configuracion_sede_create')
            <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12">
                    @include('csvImport.modal', [
                        'model' => 'MatrizRiesgo',
                        'route' => 'admin.matriz-riesgos.parseCsvImport',
                    ])
                </div>
            </div>
        @endcan
        @if ($numero_sedes > 0)
            <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                <div class="row w-100">
                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                        <div class="w-100">
                            <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                        </div>
                    </div>
                    <div class="col-11">
                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones
                        </p>
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Por favor registre cada uno de los
                            escenarios de riesgos</p>
                    </div>
                </div>
            </div>
            @include('partials.flashMessages')
            <div class="card-body datatable-fix">
                <div class="d-flex justify-content-between">
                    {{-- @can('analisis_de_riesgos_matriz_riesgo_analisis_create')
                        <a class="pr-3 ml-2 rounded btn btn-success" style=" margin: 13px 12px 12px 10px;"
                            href="{{ route('admin.matriz-riesgos.create', ['idAnalisis' => $id_matriz]) }}" type="submit"
                            name="action">Agregar nuevo</a>
                    @endcan
                  
                    

                    {{-- <a class="pr-3 ml-2 rounded btn btn-success" style=" margin: 13px 12px 12px 10px;"
                        href="{{ route('admin.matriz-riesgos.octave') }}?id_analisis={{ $id_matriz }}" type="submit"
                        name="action">Agregar
                        nuevo</a> --}}

                      <a class="pr-3 ml-2 rounded btn btn-success" style=" margin: 13px 12px 12px 10px;"
                        href="{{ route('admin.procesos-octave.index') }}" type="submit"
                        name="action">Agregar
                        nuevo</a>
                    <a class="pr-3 ml-2 rounded btn btn-success" style=" margin: 13px 12px 12px 10px;"
                        href="{{ route('admin.matriz-octavemapa', ['idAnalisis' => $id_matriz]) }}">Gráfica</a>
                </div>
                <table class="table table-bordered w-100 datatable datatable-Matriz">
                    <thead class="thead-dark">
                        <tr class="negras">
                            <th class="text-center" style="background-color:#3490DC;" colspan="6">Descripción General
                            </th>
                            <th class="text-center" style="background-color:#1168af;" colspan="6">Evaluación de Impactos
                                Asociados al Proceso</th>
                            <th class="text-center" style="background-color:#1168af;" colspan="1">Opciones</th>
                        </tr>
                        <tr>
                            <th>
                                VP
                            </th>
                            <th>
                                Área
                            </th>
                            <th>
                                Servicio
                            </th>
                            <th>
                                Sede
                            </th>
                            <th>
                                Proceso
                            </th>
                            <th>
                                Activo
                            </th>
                            <th>
                                Operacional
                            </th>
                            <th>
                                Cumplimiento
                            </th>
                            <th>
                                Legal
                            </th>
                            <th>
                                Reputacional
                            </th>
                            <th>
                                Tecnológico
                            </th>
                            <th>
                                Valor de impacto
                            </th>
                            <th>
                                Opciones
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        @else
            <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                <div class="row w-100">
                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                        <div class="w-100">
                            <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                        </div>
                    </div>
                    <div class="col-11">
                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                            Atención</p>
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Aún no se han agregado
                            matrices de riesgo
                            <a href="{{ route('admin.matriz-riesgos.create', ['idAnalisis' => $id_matriz]) }}"><i
                                    class="fas fa-share"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        let idMatriz = @json($id_matriz);
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Matriz Riesgos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Matriz Riesgos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Matriz Riesgos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'portrait',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [20, 60, 20, 30];
                        // doc.styles.tableHeader.fontSize = 7.5;
                        // doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Matriz Riesgos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
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

            @can('configuracion_sede_create')
                let btnAgregar = {
                // text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                // titleAttr: 'Agregar sede',
                // url: "{{ route('admin.matriz-riesgos.create') }}",
                // className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config){
                let {url} = config;
                window.location.href = url;
                }
                };
                let btnImport = {
                text: '<i class="pl-2 pr-3 fas fa-file-csv"></i> CSV Importar',
                titleAttr: 'Importar datos por CSV',
                className: "btn-xs btn-outline-primary rounded ml-2 pr-3",
                action: function(e, dt, node, config){
                $('#csvImportModal').modal('show');
                }
                };
                dtButtons.push(btnAgregar);
                dtButtons.push(btnImport);
            @endcan
            @can('configuracion_sede_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.matriz-riesgos.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                return entry.id
                });

                if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected') }}')

                return
                }

                if (confirm('{{ trans('global.areYouSure') }}')) {
                $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: config.url,
                data: { ids: ids, _method: 'DELETE' }})
                .done(function () { location.reload() })
                }
                }
                }
                //dtButtons.push(deleteButton)
            @endcan
            // let id_matriz = @json($id_matriz);
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                // ajax: "/admin/matriz-seguridad?id=" + id_matriz,
                columns: [{
                        data: 'vp',
                        name: 'vp'
                    },
                    {
                        data: 'id_area',
                        name: 'id_area'
                    },
                    {
                        data: 'servicio',
                        name: 'servicio'
                    },
                    {
                        data: 'id_sede',
                        name: 'id_sede'
                    },
                    {
                        data: 'id_proceso',
                        name: 'id_proceso'
                    },
                    {
                        data: 'activo_id',
                        name: 'activo_id'
                    },
                    {
                        data: 'operacional',
                        name: 'operacional',
                    },
                    {
                        data: 'cumplimiento',
                        name: 'cumplimiento'
                    },
                    {
                        data: 'legal',
                        name: 'legal',
                    },
                    {
                        data: 'reputacional',
                        name: 'reputacional',
                    },
                    {
                        data: 'tecnologico',
                        name: 'tecnologico'
                    },
                    {
                        data: 'valor',
                        name: 'valor'
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            let urlEdit = `/admin/matriz-riesgo/${data}/octave/edit`;
                            return `
                            <a href="${urlEdit}?id_analisis=${idMatriz}" class="btn"><i class="fas fa-edit"></i></a>
                            `;
                        }
                    }
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
            };
            let table = $('.datatable-Matriz').DataTable(dtOverrideGlobals);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.sedeSelect').select2();
            $('.areaSelect').select2();
        });
    </script>
@endsection
