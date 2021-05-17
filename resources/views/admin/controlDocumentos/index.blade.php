@extends('layouts.admin')
@section('content')
    @can('control_documento_create')
        <div class="mt-5 card">
            <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2 text-center text-white"><strong>Control de Documentos</strong></h3>
            </div>
        @endcan
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 datatable-ControlDocumento">
                <thead class="thead-dark">
                    <tr>
                        <th style="vertical-align: top">
                            {{ trans('cruds.controlDocumento.fields.id') }}
                        </th>
                        <th style="vertical-align: top">
                            {{ trans('cruds.controlDocumento.fields.clave') }}
                        </th>
                        <th style="vertical-align: top">
                            {{ trans('cruds.controlDocumento.fields.nombre') }}
                        </th>
                        <th style="vertical-align: top">
                            {{ trans('cruds.controlDocumento.fields.fecha_creacion') }}
                        </th>
                        <th style="vertical-align: top">
                            {{ trans('cruds.controlDocumento.fields.version') }}
                        </th>
                        <th style="vertical-align: top">
                            {{ trans('cruds.controlDocumento.fields.elaboro') }}
                        </th>
                        <th style="vertical-align: top">
                            {{ trans('cruds.controlDocumento.fields.reviso') }}
                        </th>
                        <th style="vertical-align: top">
                            {{ trans('cruds.controlDocumento.fields.estado') }}
                        </th>
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
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
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
                                @foreach ($estado_documentos as $key => $item)
                                    <option value="{{ $item->estado }}">{{ $item->estado }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                    </tr> --}}
                </thead>
                {{-- <tbody>
                    @foreach ($controlDocumentos as $key => $controlDocumento)
                        <tr data-entry-id="{{ $controlDocumento->id }}">
                            <td>
                                {{ $controlDocumento->id ?? '' }}
                            </td>
                            <td>
                                {{ $controlDocumento->clave ?? '' }}
                            </td>
                            <td>
                                {{ $controlDocumento->nombre ?? '' }}
                            </td>
                            <td>
                                {{ $controlDocumento->fecha_creacion ?? '' }}
                            </td>
                            <td>
                                {{ $controlDocumento->version ?? '' }}
                            </td>
                            <td>
                                {{ $controlDocumento->elaboro->name ?? '' }}
                            </td>
                            <td>
                                {{ $controlDocumento->reviso->name ?? '' }}
                            </td>
                            <td>
                                {{ $controlDocumento->estado->estado ?? '' }}
                            </td>
                            <td>

                                @can('control_documento_edit')
                                    <a class="btn btn-xs btn-info"
                                        href="{{ route('admin.control-documentos.edit', $controlDocumento->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('control_documento_delete')
                                    <form action="{{ route('admin.control-documentos.destroy', $controlDocumento->id) }}"
                                        method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                        style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger"
                                            value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

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
                    title: `Control de Documentos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Control de Documentos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Control de Documentos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'portrait',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [5, 20, 5, 20];
                        // doc.styles.tableHeader.fontSize = 6.5;
                        // doc.defaultStyle.fontSize = 6.5; //<-- set fontsize to 16 instead of 10 
                    }
                },
                {
                    extend: 'print',
                    title: `Control de Documentos ${new Date().toLocaleDateString().trim()}`,
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
            @can('control_documento_create')
                let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar documento',
                url: "{{ route('admin.control-documentos.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config){
                let {url} = config;
                window.location.href = url;
                }
                };
                dtButtons.push(btnAgregar);
            @endcan
            @can('control_documento_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.control-documentos.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                return $(entry).data('entry-id')
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

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ]
            });
            let table = $('.datatable-ControlDocumento:not(.ajaxTable)').DataTable({
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.control-documentos.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'clave',
                        name: 'clave'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'fecha_creacion',
                        name: 'fecha_creacion'
                    },
                    {
                        data: 'version',
                        name: 'version'
                    },
                    {
                        data: 'elaboro',
                        name: 'elaboro.name'
                    },
                    {
                        data: 'reviso',
                        name: 'reviso.name'
                    },
                    {
                        data: 'estado',
                        name: 'estado.estado'
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
            })
            // $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
            //     $($.fn.dataTable.tables(true)).DataTable()
            //         .columns.adjust();
            // });

            // let visibleColumnsIndexes = null;
            // $('.datatable thead').on('input', '.search', function() {
            //     let strict = $(this).attr('strict') || false
            //     let value = strict && this.value ? "^" + this.value + "$" : this.value

            //     let index = $(this).parent().index()
            //     if (visibleColumnsIndexes !== null) {
            //         index = visibleColumnsIndexes[index]
            //     }

            //     table
            //         .column(index)
            //         .search(value, strict)
            //         .draw()
            // });
            // table.on('column-visibility.dt', function(e, settings, column, state) {
            //     visibleColumnsIndexes = []
            //     table.columns(":visible").every(function(colIdx) {
            //         visibleColumnsIndexes.push(colIdx);
            //     });
            // })
        })

    </script>
@endsection
