@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.informacion-documetadas.index') }}

    @can('informacion_documetada_create')
        <div class="mt-5 card">
            <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2 text-center text-white"><strong>Información Documentada</strong></h3>
            </div>
        @endcan


        @include('partials.flashMessages')
        <div class="card">
            <div class="card-body datatable-fix">
                <table class="table table-bordered w-100 datatable-InformacionDocumetada">
                    <thead class="thead-dark">
                        <tr>
                            <th>
                                {{ trans('cruds.informacionDocumetada.fields.id') }}
                            </th>
                            <th>
                                Titulo&nbsp;del&nbsp;documento
                            </th>
                            <th>
                                Tipo&nbsp;de&nbsp;documento
                            </th>
                            <th>
                                {{ trans('cruds.informacionDocumetada.fields.identificador') }}
                            </th>
                            <th>
                                {{ trans('cruds.informacionDocumetada.fields.version') }}
                            </th>
                            <th>
                                {{ trans('cruds.informacionDocumetada.fields.politicas') }}
                            </th>
                            <th>
                                {{ trans('cruds.informacionDocumetada.fields.contenido') }}
                            </th>
                            <th>
                                {{ trans('cruds.informacionDocumetada.fields.elaboro') }}
                            </th>
                            <th>
                                {{ trans('cruds.informacionDocumetada.fields.reviso') }}
                            </th>
                            <th>
                                {{ trans('cruds.informacionDocumetada.fields.aprobacion') }}
                            </th>
                            <th>
                                {{ trans('cruds.informacionDocumetada.fields.logotipo') }}
                            </th>
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
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach (App\Models\InformacionDocumetada::TIPODOCUMENTO_SELECT as $key => $item)
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
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach ($politica_sgsis as $key => $item)
                                <option value="{{ $item->politicasgsi }}">{{ $item->politicasgsi }}</option>
                            @endforeach
                        </select>
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
                    title: `Información Documentada ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Información Documentada ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Información Documentada ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Información Documentada ${new Date().toLocaleDateString().trim()}`,
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

            @can('informacion_documetada_delete')
                let btnAgregar = {
                    text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                    titleAttr: 'Agregar información documentada',
                    url: "{{ route('admin.informacion-documetadas.create') }}",
                    className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                    action: function(e, dt, node, config) {
                        let {
                            url
                        } = config;
                        window.location.href = url;
                    }
                };
                dtButtons.push(btnAgregar);
            @endcan
            @can('informacion_documetada_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.informacion-documetadas.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).data(), function(entry) {
                            return entry.id
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
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
                ajax: "{{ route('admin.informacion-documetadas.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'titulodocumento',
                        name: 'titulodocumento'
                    },
                    {
                        data: 'tipodocumento',
                        name: 'tipodocumento'
                    },
                    {
                        data: 'identificador',
                        name: 'identificador'
                    },
                    {
                        data: 'version',
                        name: 'version'
                    },
                    {
                        data: 'politicas',
                        name: 'politicas.politicasgsi'
                    },
                    {
                        data: 'contenido',
                        name: 'contenido'
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {


                            let html =
                                `<img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/${row.elaboro.avatar}" title="${row.elaboro.name}"></img>`;

                            return `${row.elaboro ? html: ''}`;
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {


                            let html =
                                `<img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/${row.reviso.avatar}" title="${row.reviso.name}"></img>`;

                            return `${row.reviso ? html: ''}`;
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {


                            let html =
                                `<img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/${row.aprobacion.avatar}" title="${row.aprobacion.name}"></img>`;

                            return `${row.aprobacion ? html: ''}`;
                        }
                    },
                    {
                        data: 'logotipo',
                        name: 'logotipo',
                        sortable: false,
                        searchable: false
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ]
            };
            let table = $('.datatable-InformacionDocumetada').DataTable(dtOverrideGlobals);
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
