@extends('layouts.admin')
@section('content')

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
    <h5 class="col-12 titulo_general_funcion">Inventario de Activos</h5>
    <div class="mt-5 card">
        @can('inventario_activos_agregar')
            {{-- <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2 text-center text-white"><strong>Inventario de Activos</strong></h3>
            </div> --}}
            <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12">
                    @include('csvImport.modalactivoinventario', ['model' => 'Vulnerabilidad', 'route' =>
                    'admin.vulnerabilidads.parseCsvImport'])
                </div>
            </div>
        @endcan

        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 datatable-Activo" id="columnaft">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            {{ trans('cruds.activo.fields.id') }}
                        </th>
                        <th>
                            Nombre&nbsp;del&nbsp;activo
                        </th>
                        <th>
                            Categoría
                        </th>
                        <th>
                            Subcategoría
                        </th>
                        <th style="min-width: 350px !important;">
                            {{ trans('cruds.activo.fields.descripcion') }}
                        </th>
                        <th>
                            {{ trans('cruds.activo.fields.dueno') }}
                        </th>
                        <th>
                            Responsable
                        </th>
                        <th>
                            Sede
                        </th>
                        <th>
                            Ubicación
                        </th>
                        <th>
                            Marca
                        </th>
                        <th>
                            Modelo
                        </th>
                        <th>
                            N° serie
                        </th>
                        <th>
                            N° producto
                        </th>
                        <th>
                            Fecha de alta
                        </th>
                        <th>
                            Fecha fin de garantía
                        </th>
                        <th>
                            Fecha compra
                        </th>
                        <th>
                            Fecha de baja
                        </th>
                        <th>
                            Observaciones
                        </th>
                        <th>
                            Opciones
                        </th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @foreach ( $activos_nuevo as $sub )
                <tr>
                    <td>
                        {{$sub->id}}
                    </td>
                    <td>
                        {{$sub->nombreactivo}}
                    </td>
                    <td>
                        {{$sub->tipoactivo->tipo}}
                    </td>
                    <td>
                        {{$sub->subcategoria->subcategoria}}
                    </td>
                    <td>
                        {{ trans('cruds.activo.fields.descripcion') }}
                    </td>
                    <td>
                        {{ trans('cruds.activo.fields.dueno') }}
                    </td>
                    <td>
                        Responsable
                    </td>
                    <td>
                        Sede
                    </td>
                    <td>
                        Ubicación
                    </td>
                    <td>
                        Marca
                    </td>
                    <td>
                        Modelo
                    </td>
                    <td>
                        N° serie
                    </td>
                    <td>
                        N° producto
                    </td>
                    <td>
                        Fecha de alta
                    </td>
                    <td>
                        Fecha fin de garantía
                    </td>
                    <td>
                        Fecha compra
                    </td>
                    <td>
                        Fecha de baja
                    </td>
                    <td>
                        Observaciones
                    </td>
                    <td>
                        Opciones
                    </td>
                </tr>

                    @endforeach
                </tbody> --}}
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
                    title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'portrait',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [5, 20, 5, 20];
                        doc.styles.tableHeader.fontSize = 10;
                        doc.defaultStyle.fontSize = 10; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
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
            @can('inventario_activos_agregar')
                let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar inventario de activos',
                url: "{{ route('admin.activos.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3 agregar",
                action: function(e, dt, node, config){
                let {url} = config;
                window.location.href = url;
                }
                };
                let btnExport = {
                text: '<i class="fas fa-download"></i>',
                titleAttr: 'Descargar plantilla',
                className: "btn btn_cargar" ,
                url:"{{ route('descarga-activo_inventario') }}",
                action: function(e, dt, node, config) {
                let {
                url
                } = config;
                window.location.href = url;
                }
                };
                let btnImport = {
                text: '<i class="fas fa-file-upload"></i>',
                titleAttr: 'Importar datos',
                className: "btn btn_cargar",
                action: function(e, dt, node, config) {
                $('#xlsxImportModal').modal('show');
                }
                };

                dtButtons.push(btnAgregar);
                dtButtons.push(btnExport);
                dtButtons.push(btnImport);
            @endcan
            @can('inventario_activos_eliminar')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.activos.massDestroy') }}",
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

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.activos.index') }}",
                columnDefs: [{
                    targets: [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17],
                    visible: false
                }],
                columns: [{
                        data: 'identificador',
                        name: 'identificador'
                    },
                    {
                        data: 'nombreactivo',
                        name: 'nombreactivo'


                    },
                    {
                        data: 'tipoactivo_tipo',
                        name: 'tipoactivo.tipo'
                    },
                    {
                        data: 'subcategoria',
                        name: 'subcategoria.subcategoria'

                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {


                            let html =
                                `<img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/${row.dueno.avatar}" title="${row.dueno.name}"></img>`;

                            return `${row.dueno ? html: ''}`;
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            let html =
                                `<img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/${row.empleado.avatar}" title="${row.empleado.name}"></img>`;

                            return  html;
                        }
                    },
                    {
                        data: 'ubicacion_sede',
                        name: 'ubicacion.sede'
                    },
                    {
                        data: 'sede',
                        name: 'sede'
                    },
                    {
                        data: 'marca',
                        name: 'marca'
                    },
                    {
                        data: 'modelo',
                        name: 'modelo'
                    },
                    {
                        data: 'n_serie',
                        name: 'n_serie'
                    },
                    {
                        data: 'n_producto',
                        name: 'n_producto'
                    },
                    {
                        data: 'fecha_alta',
                        name: 'fecha_alta'
                    },
                    {
                        data: 'fecha_fin',
                        name: 'fecha_fin'
                    },
                    {
                        data: 'fecha_compra',
                        name: 'fecha_compra'
                    },
                    {
                        data: 'fecha_baja',
                        name: 'fecha_baja'
                    },
                    {
                        data: 'observaciones',
                        name: 'observaciones'
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
            };
            let table = $('.datatable-Activo').DataTable(dtOverrideGlobals);
            // $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
            //     $($.fn.dataTable.tables(true)).DataTable()
            //         .columns.adjust();
            // });
            // $('.datatable thead').on('input', '.search', function() {
            //     let strict = $(this).attr('strict') || false
            //     let value = strict && this.value ? "^" + this.value + "$" : this.value
            //     table
            //         .column($(this).parent().index())
            //         .search(value, strict)
            //         .draw()
            // });
        });
    </script>



@endsection
