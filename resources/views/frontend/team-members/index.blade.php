@extends('layouts.admin')
@section('content')

    <div class="mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Integrantes de Equipos</strong></h3>
        </div>
        <div class="card-body datatable-fix">
            <p class="p-0 m-0 text-muted">Invita a usuarios ingresando su correo electrónico</p>
            <form class="form-inline" action="{{ route('admin.team-members.invite') }}" method="POST">
                @csrf
                <div class="mb-2 form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" class="mr-2 form-control" id="email" placeholder="email@example.com">
                </div>
                <button type="submit" class="mb-2 btn btn-primary">Invitar</button>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered w-100 datatable-User">
                    <thead class="thead-dark">
                        <tr>
                            <th style="vertical-align: top">
                                {{ trans('cruds.user.fields.id') }}
                            </th>
                            <th style="vertical-align: top">
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th style="vertical-align: top">
                                {{ trans('cruds.user.fields.email') }}
                            </th>
                            <th style="vertical-align: top">
                                Correo&nbsp;verificado
                            </th>
                            <th style="vertical-align: top">
                                Aprobado
                            </th>
                            <th style="vertical-align: top">
                                Verificado
                            </th>
                            <th style="vertical-align: top">
                                {{ trans('cruds.user.fields.roles') }}
                            </th>
                            <th style="vertical-align: top">
                                {{ trans('cruds.user.fields.organizacion') }}
                            </th>
                            <th style="vertical-align: top">
                                {{ trans('cruds.user.fields.area') }}
                            </th>
                            <th style="vertical-align: top">
                                {{ trans('cruds.user.fields.puesto') }}
                            </th>
                            <th style="vertical-align: top">
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <td>
                                    {{ $user->id ?? '' }}
                                </td>
                                <td>
                                    {{ $user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $user->email ?? '' }}
                                </td>
                                <td>
                                    {{ $user->email_verified_at ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $user->approved ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $user->approved ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <span style="display:none">{{ $user->verified ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @foreach ($user->roles as $key => $item)
                                        <span class="badge badge-info">{{ $item->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $user->organizacion->organizacion ?? '' }}
                                </td>
                                <td>
                                    {{ $user->area->area ?? '' }}
                                </td>
                                <td>
                                    {{ $user->puesto->puesto ?? '' }}
                                </td>
                                <td>
                                    @can('user_delete')
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                            <button type="submit" class="btn btn-xs btn-danger">
                                                <i class="fas fa-trash-alt"></i>
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
                    title: `Integrantes de Equipos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Integrantes de Equipos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Integrantes de Equipos ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Integrantes de Equipos ${new Date().toLocaleDateString().trim()}`,
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
            @can('user_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.users.massDestroy') }}",
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
                // dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ]
            });
            let table = $('.datatable-User:not(.ajaxTable)').DataTable({
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
