@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.indicadores-sgsis.index') }}

    @can('indicadores_sgsi_create')

    @endcan

    <style>
        .table tr th:nth-child(2) {
            width: 150px !important;
            max-width: 200px !important;
            min-width: 200px !important;

        }

        .table tr th:nth-child(3) {
            width: 100px !important;
            max-width: 100px !important;
            min-width: 100px !important;

        }

        .table tr td:nth-child(4) {
            text-align: center !important;

        }

        .table tr th:nth-child(6) {
            width: 400px !important;
            max-width: 350px !important;
            min-width: 350px !important;

        }
    </style>
    <h5 class="col-12 titulo_general_funcion">Indicadores del Sistema de Gestión</h5>
    <div class="mt-5 card">

        <div class="text-right mt-5 mr-5">
            <a class="btn btn-danger" href="{{ asset('admin/indicadores/dashboard') }}">Dashboard</a>
        </div>

        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 datatable-IndicadoresSgsi">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Nombre del indicador
                        </th>
                        <th>
                            Área
                        </th>
                        <th>
                            Responsable
                        </th>
                        {{--<th>
                            Proceso
                        </th>--}}
                        <th>
                            Año
                        </th>
                        <th>
                            Descripción
                        </th>
                        <th>
                            Fórmula de cálculo
                        </th>
                        <th>
                            Unidad
                        </th>
                        <th>
                            Frecuencia
                        </th>
                        <th>
                            Indicadores
                        </th>
                        {{--<th>
                            Meta
                        </th>
                        <th>
                            No. revisiones
                        </th>
                        <th>
                            Resultado
                        </th>
                        <th>
                            Responsable
                        </th>--}}
                        <th>
                            Opciones
                        </th>
                    </tr>
                    {{-- <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach ($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach (App\Models\IndicadoresSgsi::FRECUENCIA_SELECT as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach (App\Models\IndicadoresSgsi::UNIDADMEDIDA_SELECT as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach (App\Models\IndicadoresSgsi::SEMAFORO_SELECT as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                    </tr> --}}
                </thead>
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
                    title: `Indicadores SGSI ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Indicadores SGSI ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Indicadores SGSI ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [5, 20, 5, 20];
                        doc.styles.tableHeader.fontSize = 7.1;
                        doc.defaultStyle.fontSize = 7.1; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Indicadores SGSI ${new Date().toLocaleDateString().trim()}`,
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

            @can('indicadores_sgsi_agregar')
                let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar indicador SGSI',
                url: "{{ route('admin.indicadores-sgsis.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config){
                let {url} = config;
                window.location.href = url;
                }
                };
                dtButtons.push(btnAgregar);
            @endcan
            @can('indicadores_sgsi_eliminar')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.indicadores-sgsis.massDestroy') }}",
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
                ajax: "{{ route('admin.indicadores-sgsis.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'area',
                        name: 'area',
                    },
                    {
                        data: 'responsable_name',
                        render: function(data, type, row, meta) {
                            if (row.id_empleado != null) {
                                if(row.responsable_name.trim()!=""){
                                    let empleado = JSON.parse(row.responsable_name);
                                    if (type === "empleadoText") {
                                        return empleado.name;
                                    } else {
                                        let html =
                                            `<img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/${empleado?.avatar}" title="${empleado?.name}"></img>`;

                                        return `${empleado ? html: ''}`;
                                    }
                                }
                            }

                            return `Sin dato`;
                        }
                    },
                    {
                        data: 'año',
                        name: 'año',
                    },
                    /*{
                        data: 'proceso',
                        name: 'proceso'
                    },*/
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    },
                    {
                        data: 'formula',
                        name: 'formula'
                    },
                    {
                        data: 'unidadmedida',
                        name: 'unidadmedida'
                    },
                    {
                        data: 'frecuencia',
                        name: 'frecuencia'
                    },
                    {
                        data: 'enlace',
                        name: 'enlace',
                        render: function(data, type, row, meta) {
                            return `
                            @can('indicadores_sgsi_vinculo')
                            <div class="text-center w-100"><a href="evaluaciones-sgsisInsertar/?id=${data}" target="_blank"><i class="fas fa-table fa-2x text-info"></i></a></div>
                            @endcan
                            `;
                        }
                    },
                    /*{
                        data: 'meta',
                        name: 'meta'
                    },
                    {
                        data: 'revisiones',
                        name: 'revisiones'
                    },
                    {
                        data: 'responsable',
                        name: 'responsable'
                    },*/
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ]
            };
            let table = $('.datatable-IndicadoresSgsi').DataTable(dtOverrideGlobals);
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
