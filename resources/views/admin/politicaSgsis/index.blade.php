@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.politica-sgsis.index') }}
    
    @can('politica_sgsi_create')

        <div class="mt-5 card">
            <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2 text-center text-white"><strong>Política SGSI</strong></h3>
            </div>
        @endcan
        <div class="card-body datatable-fix">
            <div class="table-responsive">
                <table class="table table-bordered datatable-PoliticaSgsi" style="width: 100%">
                    <thead class="thead-dark">
                        <tr>
                            <th style="text-transform: capitalize">
                                {{ trans('cruds.politicaSgsi.fields.id') }}
                            </th>
                            <th style="text-transform: capitalize">
                                {{ trans('cruds.politicaSgsi.fields.politicasgsi') }}
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
                            </td>
                        </tr> --}}
                    </thead>
                    <tbody>
                        @foreach ($politicaSgsis as $key => $politicaSgsi)
                            <tr data-entry-id="{{ $politicaSgsi->id }}">
                                <td>
                                    {{ $politicaSgsi->id ?? '' }}
                                </td>
                                <td>
                                    {{ $politicaSgsi->politicasgsi ?? '' }}
                                </td>
                                <td>
                                    @can('politica_sgsi_show')
                                        <a class="mr-2 rounded btn btn-sm btn-outline-primary"
                                            href="{{ route('admin.politica-sgsis.show', $politicaSgsi->id) }}">
                                            <i class="fas fa-eye" data-toggle="tooltip" data-placement="top" title="Ver"></i>
                                            {{-- {{ trans('global.view') }} --}}
                                        </a>
                                    @endcan

                                    @can('politica_sgsi_edit')
                                        <a class="mr-2 rounded btn btn-sm btn-outline-info"
                                            href="{{ route('admin.politica-sgsis.edit', $politicaSgsi->id) }}">
                                            <i class="fas fa-edit" data-toggle="tooltip" data-placement="top"
                                                title="Editar"></i>
                                            {{-- {{ trans('global.edit') }} --}}
                                        </a>
                                    @endcan

                                    @can('politica_sgsi_delete')
                                        <form action="{{ route('admin.politica-sgsis.destroy', $politicaSgsi->id) }}"
                                            method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            {{-- <input type="submit" class="rounded btn btn-sm btn-outline-danger"
                                                value="{!! '<i>ss</i>' !!}"> --}}
                                            <button type="submit" class="rounded btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash" data-toggle="tooltip" data-placement="top"
                                                    title="Eliminar"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
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
                    title: `Política SGSI ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Política SGSI ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Política SGSI ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [20, 60, 20, 30];
                        doc.styles.tableHeader.fontSize = 7.5;
                        doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10 
                    }
                },
                {
                    extend: 'print',
                    title: `Política SGSI ${new Date().toLocaleDateString().trim()}`,
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
            @can('politica_sgsi_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.politica-sgsis.massDestroy') }}",
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

            @can('politica_sgsi_create')
                let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar nueva política SGSI',
                url: "{{ route('admin.politica-sgsis.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config){
                let {url} = config;
                window.location.href = url;
                }
                };
                dtButtons.push(btnAgregar);
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ]
            });
            let table = $('.datatable-PoliticaSgsi:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
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
        })

    </script>
@endsection
