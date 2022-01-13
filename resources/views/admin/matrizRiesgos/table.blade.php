
    <div class="mt-5 card">

        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Matriz Riesgo
                </strong></h3>
        </div>
        @can('configuracion_sede_create')
            <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12">
                    @include('csvImport.modal', ['model' => 'MatrizRiesgo', 'route' => 'admin.matriz-riesgos.parseCsvImport'])
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
                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Por favor registre cada una de las matrices
                            de riesgo</p>
                    </div>
                </div>
            </div>
            @include('partials.flashMessages')
            <div class="card-body datatable-fix">
                <div class="d-flex justify-content-between">
                    <a class="pr-3 ml-2 rounded btn btn-success" style=" margin: 13px 12px 12px 10px;"
                        href="{{ route('admin.matriz-riesgos.create', ['idAnalisis' => $id_matriz]) }}" type="submit"
                        name="action">Agregar nuevo</a>
                    <a class="pr-3 ml-2 rounded btn btn-success" style=" margin: 13px 12px 12px 10px;"
                        href="{{ route('admin.matriz-mapa', ['idAnalisis' => $id_matriz]) }}">Gráfica</a>
                </div>
                <table class="table table-bordered w-100 datatable datatable-Matriz">
                    <thead class="thead-dark">
                        <tr class="negras">
                            <th class="text-center" style="background-color:#3490DC;" colspan="8">Descripción General </th>
                            <th class="text-center" style="background-color:#1168af;" colspan="4">CID</th>
                            <th class="text-center" style="background-color:#217bc5;" colspan="4">Riesgo Inicial
                            <th class="text-center" style="background-color:#1168af;" colspan="2">Acciones</th>
                            <th class="text-center" style="background-color:#217bc5;" colspan="3">CID</th>
                            <th class="text-center" style="background-color:#1168af;" colspan="4">Riesgo Residual</th>
                            <th class="text-center" style="background-color:#1168af;" colspan="1">Opciones</th>
                        </tr>
                        <tr>
                            <th>
                                Id
                            </th>
                            <th>
                                Sede
                            </th>
                            <th>
                                Proceso
                            </th>
                            <th>
                                Responsable
                            </th>
                            <th>
                                Activo
                            </th>
                            <th>
                                Amenaza
                            </th>
                            <th>
                                Vulnerabilidad
                            </th>
                            <th>
                                Descripción riesgo
                            </th>
                            <th>
                                Confidencialidad
                            </th>
                            <th>
                                Integridad
                            </th>
                            <th>
                                Disponibilidad
                            </th>
                            <th>
                                Resultado ponderación
                            </th>
                            <th>
                                Probabilidad
                            </th>
                            <th>
                                Impacto
                            </th>
                            <th>
                                Nivel riesgo
                            </th>
                            <th>
                                Riesgo total
                            </th>
                            <th>
                                Control
                            </th>
                            <th>
                                Plan de acción
                            </th>
                            <th>
                                Confidencialidad
                            </th>
                            <th>
                                Integridad
                            </th>
                            <th>
                                Disponibilidad
                            </th>
                            <th>
                                Probabilidad
                            </th>
                            <th>
                                Impacto
                            </th>
                            <th>
                                Nivel riesgo
                            </th>
                            <th>
                                Riesgo total
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
                            <a href="{{ route('admin.matriz-riesgos.create', ['idAnalisis' => $id_matriz]) }}"><i class="fas fa-share"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>




@section('scripts')
    @parent
    <script>
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

            /*@can('configuracion_sede_create')
                let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar sede',
                url: "{{ route('admin.matriz-riesgos.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
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
            @endcan*/
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
            let id_matriz = @json($id_matriz);
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "/admin/matriz-seguridad?id=" + id_matriz,
                columns: [{
                        data: 'id',
                        name: 'id'
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
                        data: 'id_responsable',
                        name: 'id_responsable'
                    },
                    {
                        data: 'activo_id',
                        name: 'activo_id'
                    },
                    {
                        data: 'id_amenaza',
                        name: 'id_amenaza'
                    },
                    {
                        data: 'id_vulnerabilidad',
                        name: 'id_vulnerabilidad'
                    },
                    {
                        data: 'descripcionriesgo',
                        name: 'descripcionriesgo'
                    },
                    {
                        data: 'confidencialidad',
                        name: 'confidencialidad',
                    },
                    {
                        data: 'integridad',
                        name: 'integridad'
                    },
                    {
                        data: 'disponibilidad',
                        name: 'disponibilidad',
                    },
                    {
                        data: 'resultadoponderacion',
                        name: 'resultadoponderacion',
                    },
                    {
                        data: 'probabilidad',
                        name: 'probabilidad'
                    },
                    {
                        data: 'impacto',
                        name: 'impacto'
                    },
                    {
                        data: 'nivelriesgo',
                        name: 'nivelriesgo'
                    },
                    {
                        data: 'riesgototal',
                        name: 'riesgototal'
                    },
                    {
                        data: 'control',
                        name: 'control'
                    },
                    {
                        data: 'plan_de_accion',
                        name: 'plan_de_accion'
                    },
                    {
                        data: 'confidencialidad_cid',
                        name: 'confidencialidad_cid'
                    },
                    {
                        data: 'integridad_cid',
                        name: 'integridad_cid'
                    },
                    {
                        data: 'disponibilidad_cid',
                        name: 'disponibilidad_cid'
                    },
                    {
                        data: 'probabilidad_residual',
                        name: 'probabilidad_residual'
                    },
                    {
                        data: 'impacto_residual',
                        name: 'impacto_residual'
                    },
                    {
                        data: 'nivelriesgo_residual',
                        name: 'nivelriesgo_residual'
                    },
                    {
                        data: 'riesgo_total_residual',
                        name: 'riesgo_total_residual'
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
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
