@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.accion-correctivas.index') }}

    <style>
        .table tr th:nth-child(1) {
            min-width: 80px !important;
            text-align: center !important;
        }

        .table tr th:nth-child(2) {
            min-width: 150px !important;
            text-align: center !important;
        }

        .table tr td:nth-child(15) {
            text-align: justify !important;
        }
        .table tr td:nth-child(14) {
            text-align: justify !important;
        }

    </style>

    <div class="mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Acciones Correctivas</strong></h3>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8 align-content-center">
                    @include('layouts.errors')
                    @include('flash::message')
                </div>
                <div class="col-sm-2">
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body datatable-fix">
                <table class="table table-bordered w-100 datatable-AccionCorrectiva">
                    <thead class="thead-dark">
                        <tr>
                            {{-- <th style="vertical-align: top">
                                {{ trans('cruds.accionCorrectiva.fields.id') }}
                            </th> --}}
                            <th style="vertical-align: top">
                                Folio
                            </th>
                            <th style="vertical-align: top">
                                Título
                            </th>
                            <th style="vertical-align: top">
                                Fecha&nbsp;de&nbsp;registro
                            </th>
                            <th style="vertical-align: top">
                                Fecha&nbsp;de&nbsp;recepción
                            </th>
                            <th style="vertical-align: top">
                                Estatus
                            </th>
                            <th style="vertical-align: top">
                                Fecha&nbsp;de&nbsp;cierre&nbsp;de&nbsp;ticket
                            </th>
                            <th style="vertical-align: top">
                                Reportó
                            </th>
                            <th style="vertical-align: top">
                                Puesto
                            </th>
                            <th style="vertical-align: top">
                                Área
                            </th>
                            <th style="vertical-align: top">
                                Registró
                            </th>
                            <th style="vertical-align: top">
                                Puesto
                            </th>
                            <th style="vertical-align: top">
                                Área
                            </th>
                            <th style="vertical-align: top">
                                Causa&nbsp;de&nbsp;origen
                            </th>
                            <th style="vertical-align: top; min-width:500px;">
                                Descripción
                            </th>
                            <th style="vertical-align: top; min-width:500px;">
                                Comentarios
                            </th>
                            {{-- <th style="vertical-align: top">
                                Método&nbsp;utilizado&nbsp;para&nbsp;el análisis&nbsp;de&nbsp;causa&nbsp;raíz
                            </th>
                            <th style="vertical-align: top; min-width:500px;">
                                Descripción&nbsp;de&nbsp;la solución
                            </th>
                            <th style="vertical-align: top; min-width:500px;">
                                Descripción&nbsp;de&nbsp;la&nbsp;validación
                                para&nbsp;el&nbsp;cierre&nbsp;de&nbsp;la&nbsp;acción
                            </th>
                            <th style="vertical-align: top">
                                {{ trans('cruds.accionCorrectiva.fields.estatus') }}
                            </th>
                            <th style="vertical-align: top">
                                {{ trans('cruds.accionCorrectiva.fields.fecha_compromiso') }}
                            </th>
                            <th style="vertical-align: top">
                                {{ trans('cruds.accionCorrectiva.fields.fecha_verificacion') }}
                            </th> --}}
                            {{-- <th style="vertical-align: top">
                                {{ trans('cruds.accionCorrectiva.fields.responsable_accion') }}
                            </th>
                            <th style="vertical-align: top">
                                Responsable autorización&nbsp;AC
                            </th> --}}
                            {{-- <th style="vertical-align: top">
                                {{ trans('cruds.accionCorrectiva.fields.documentometodo') }}
                            </th> --}}
                            <th style="vertical-align: top">
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
                                <select class="search">
                                    <option value>{{ trans('global.all') }}</option>
                                    @foreach ($puestos as $key => $item)
                                        <option value="{{ $item->puesto }}">{{ $item->puesto }}</option>
                                    @endforeach
                                </select>
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
                                <select class="search">
                                    <option value>{{ trans('global.all') }}</option>
                                    @foreach ($puestos as $key => $item)
                                        <option value="{{ $item->puesto }}">{{ $item->puesto }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                            </td>
                            <td>
                                <select class="search" strict="true">
                                    <option value>{{ trans('global.all') }}</option>
                                    @foreach (App\Models\AccionCorrectiva::CAUSAORIGEN_SELECT as $key => $item)
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
                                    @foreach (App\Models\AccionCorrectiva::METODO_CAUSA_SELECT as $key => $item)
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
                                <select class="search" strict="true">
                                    <option value>{{ trans('global.all') }}</option>
                                    @foreach (App\Models\AccionCorrectiva::ESTATUS_SELECT as $key => $item)
                                        <option value="{{ $key }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                            </td>
                            <td>
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
                                <select class="search">
                                    <option value>{{ trans('global.all') }}</option>
                                    @foreach ($users as $key => $item)
                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                        </tr> --}}
                    </thead>
                </table>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [5, 20, 5, 20];
                        doc.styles.tableHeader.fontSize = 6.5;
                        doc.defaultStyle.fontSize = 6.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
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
            @can('accion_correctiva_create')
                let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar acciones correctivas',
                url: "{{ route('admin.accion-correctivas.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config){
                let {url} = config;
                window.location.href = url;
                }
                };
                dtButtons.push(btnAgregar);
            @endcan
            @can('accion_correctiva_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.accion-correctivas.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({selected: true}).data(), function (entry) {
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
                data: {ids: ids, _method: 'DELETE'}
                })
                .done(function () {
                location.reload()
                })
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
                ajax: "{{ route('admin.accion-correctivas.index') }}",
                columnDefs: [{
                    targets: [3, 4, 5, 14],
                    visible: false
                }],
                columns: [
                    // {
                    //     data: 'id',
                    //     name: 'id'
                    // },
                    {
                        data: 'folio',
                        name: 'folio'
                    },
                    {
                        data: 'tema',
                        name: 'tema'
                    },
                    {
                        data: 'fecharegistro',
                        name: 'fecharegistro'
                    },
                    {
                        data: 'fecha_verificacion',
                        name: 'fecha_verificacion'
                    },
                    {
                        data: 'estatus',
                        name: 'estatus'
                    },
                    {
                        data: 'fecha_cierre',
                        name: 'fecha_cierre'
                    },
                    {
                        data: 'reporto',
                        name: 'reporto'
                    },
                    {
                        data: 'reporto_puesto',
                        name: 'reporto_puesto'
                    },
                    {
                        data: 'reporto_area',
                        name: 'reporto_area'
                    },
                    {
                        data: 'registro',
                        name: 'registro'
                    },
                    {
                        data: 'registro_puesto',
                        name: 'registro_puesto'
                    },
                    {
                        data: 'registro_area',
                        name: 'registro_area'
                    },
                    {
                        data: 'causaorigen',
                        name: 'causaorigen'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    },
                    {
                        data: 'comentarios',
                        name: 'comentarios'
                    },
                    // {
                    //     data: 'metodo_causa',
                    //     name: 'metodo_causa'
                    // },
                    // {
                    //     data: 'solucion',
                    //     name: 'solucion'
                    // },
                    // {
                    //     data: 'cierre_accion',
                    //     name: 'cierre_accion'
                    // },
                    // {
                    //     data: 'estatus',
                    //     name: 'estatus'
                    // },
                    // {
                    //     data: 'fecha_compromiso',
                    //     name: 'fecha_compromiso'
                    // },
                    // {
                    //     data: 'fecha_verificacion',
                    //     name: 'fecha_verificacion'
                    // },
                    // {
                    //     data: 'responsable_accion_name',
                    //     name: 'responsable_accion.name'
                    // },
                    // {
                    //     data: 'nombre_autoriza_name',
                    //     name: 'nombre_autoriza.name'
                    // },
                    // {
                    //     data: 'documentometodo',
                    //     name: 'documentometodo',
                    //     sortable: false,
                    //     searchable: false
                    // },
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
            let table = $('.datatable-AccionCorrectiva').DataTable(dtOverrideGlobals);
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
