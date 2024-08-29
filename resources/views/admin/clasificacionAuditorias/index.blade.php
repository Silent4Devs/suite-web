@extends('layouts.admin')
@section('content')
    <h5 class="titulo_general_funcion">Catálogo de Clasificación</h5>

    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('admin.auditoria-clasificacion.create') }}" class="btn  btn-outline-primary">
                Nueva Clasificación
            </a>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5 style="font-weight: lighter;"> Clasificaciones </h5>
            <hr>
            <table class="table table-bordered w-100 datatable-AuditoriaInterna">
                <thead class="thead-dark">
                    <tr>
                        <th style="max-width: 70px;">
                            ID
                        </th>
                        <th style="min-width: 200px;">
                            Clasificación
                        </th>
                        <th style="min-width: 700px;">
                            Descripción
                        </th>
                        <th style="max-width: 50px;">

                        </th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @foreach ($clasifaudit as $item)
                        <tr>
                            <td>{{ $item->identificador }}</td>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline-dark dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
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
            let dtButtons = [];
            // {
            //         extend: 'csvHtml5',
            //         title: `Auditoría Interna ${new Date().toLocaleDateString().trim()}`,
            //         text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Exportar CSV',
            //         exportOptions: {
            //             columns: ['th:not(:last-child):visible'],
            //             orthogonal: "empleadoText"
            //         }
            //     },
            //     {
            //         extend: 'excelHtml5',
            //         title: `Auditoría Interna ${new Date().toLocaleDateString().trim()}`,
            //         text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Exportar Excel',
            //         exportOptions: {
            //             columns: ['th:not(:last-child):visible'],
            //             orthogonal: "empleadoText"
            //         }
            //     },
            //     {
            //         extend: 'print',
            //         title: `Auditoría Interna ${new Date().toLocaleDateString().trim()}`,
            //         text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
            //         className: "btn-sm rounded pr-2",
            //         titleAttr: 'Imprimir',
            //         exportOptions: {
            //             columns: ['th:not(:last-child):visible'],
            //             orthogonal: "empleadoText"
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
            // @can('auditoria_interna_agregar')
            //     let btnAgregar = {
            //         text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
            //         titleAttr: 'Agregar auditoría interna',
            //         url: "{{ route('admin.auditoria-internas.create') }}",
            //         className: "btn-xs btn-outline-success rounded ml-2 pr-3",
            //         action: function(e, dt, node, config) {
            //             let {
            //                 url
            //             } = config;
            //             window.location.href = url;
            //         }
            //     };
            //     dtButtons.push(btnAgregar);
            // @endcan
            // @can('auditoria_interna_eliminar')
            //     let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            //     let deleteButton = {
            //         text: deleteButtonTrans,
            //         url: "{{ route('admin.auditoria-internas.massDestroy') }}",
            //         className: 'btn-danger',
            //         action: function(e, dt, node, config) {
            //             var ids = $.map(dt.rows({
            //                 selected: true
            //             }).data(), function(entry) {
            //                 return entry.id
            //             });

            //             if (ids.length === 0) {
            //                 alert('{{ trans('global.datatables.zero_selected') }}')

            //                 return
            //             }

            //             if (confirm('{{ trans('global.areYouSure') }}')) {
            //                 $.ajax({
            //                         headers: {
            //                             'x-csrf-token': _token
            //                         },
            //                         method: 'POST',
            //                         url: config.url,
            //                         data: {
            //                             ids: ids,
            //                             _method: 'DELETE'
            //                         }
            //                     })
            //                     .done(function() {
            //                         location.reload()
            //                     })
            //             }
            //         }
            //     }
            //     // dtButtons.push(deleteButton)
            // @endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.auditoria-clasificacion.datatable') }}",
                columns: [{
                        data: 'id_clasificacion',
                        name: 'id_clasificacion'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            let html = `
                                <div class="dropdown">
                                    <button class="btn btn-outline-dark dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ url('admin/auditorias/clasificacion-auditorias/edit/${row.id}') }}">
                                            <i class="fa-solid fa-pencil"></i>&nbsp;Editar</a>
                                        `;

                            if (row.borrado === false) {
                                html += `
                                    <a class="dropdown-item" href="{{ url('admin/auditorias/clasificacion-auditorias/delete/${row.id}') }}">
                                        <i class="fa-solid fa-trash"></i>&nbsp;Eliminar</a>
                                `;
                            } else {
                                html += `
                                    <a class="dropdown-item disabled" href="#">
                                        <i class="fa-solid fa-trash"></i>&nbsp;Eliminar (En uso)</a>
                                `;
                            }

                            html += `</div></div>`;

                            return html;
                        }
                    },
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ]
            };
            let table = $('.datatable-AuditoriaInterna').DataTable(dtOverrideGlobals);
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
