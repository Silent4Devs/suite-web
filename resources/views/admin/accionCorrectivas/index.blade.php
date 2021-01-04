@extends('layouts.admin')
@section('content')

    <div class="card mt-5">
        <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center "
             style="margin-top:-40px; ">
            <h3 class="mb-2  text-center text-white"><strong>Acciones Correctivas</strong></h3>
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

        @can('accion_correctiva_create')

            <div style="margin-bottom: 10px; margin-left:12px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-success" href="{{ route('admin.accion-correctivas.create') }}">
                      Agregar <strong>+<strong>
                    </a>
                </div>
            </div>
        @endcan
        <div class="card">

            <div class="card-body">
                <table
                    class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AccionCorrectiva">
                    <thead>
                    <tr>
                        <th width="2">

                        </th>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.fecharegistro') }}
                        </th>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.nombrereporta') }}
                        </th>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.puestoreporta') }}
                        </th>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.nombreregistra') }}
                        </th>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.puestoregistra') }}
                        </th>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.tema') }}
                        </th>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.causaorigen') }}
                        </th>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.descripcion') }}
                        </th>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.metodo_causa') }}
                        </th>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.solucion') }}
                        </th>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.cierre_accion') }}
                        </th>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.estatus') }}
                        </th>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.fecha_compromiso') }}
                        </th>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.fecha_verificacion') }}
                        </th>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.responsable_accion') }}
                        </th>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.nombre_autoriza') }}
                        </th>
                        <th>
                            {{ trans('cruds.accionCorrectiva.fields.documentometodo') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
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
                                @foreach($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($puestos as $key => $item)
                                    <option value="{{ $item->puesto }}">{{ $item->puesto }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($puestos as $key => $item)
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
                                @foreach(App\Models\AccionCorrectiva::CAUSAORIGEN_SELECT as $key => $item)
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
                                @foreach(App\Models\AccionCorrectiva::METODO_CAUSA_SELECT as $key => $item)
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
                                @foreach(App\Models\AccionCorrectiva::ESTATUS_SELECT as $key => $item)
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
                                @foreach($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
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
            dtButtons.push(deleteButton)
            @endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.accion-correctivas.index') }}",
                columns: [
                    {data: 'placeholder', name: 'placeholder'},
                    {data: 'id', name: 'id'},
                    {data: 'fecharegistro', name: 'fecharegistro'},
                    {data: 'nombrereporta_name', name: 'nombrereporta.name'},
                    {data: 'puestoreporta_puesto', name: 'puestoreporta.puesto'},
                    {data: 'nombreregistra_name', name: 'nombreregistra.name'},
                    {data: 'puestoregistra_puesto', name: 'puestoregistra.puesto'},
                    {data: 'tema', name: 'tema'},
                    {data: 'causaorigen', name: 'causaorigen'},
                    {data: 'descripcion', name: 'descripcion'},
                    {data: 'metodo_causa', name: 'metodo_causa'},
                    {data: 'solucion', name: 'solucion'},
                    {data: 'cierre_accion', name: 'cierre_accion'},
                    {data: 'estatus', name: 'estatus'},
                    {data: 'fecha_compromiso', name: 'fecha_compromiso'},
                    {data: 'fecha_verificacion', name: 'fecha_verificacion'},
                    {data: 'responsable_accion_name', name: 'responsable_accion.name'},
                    {data: 'nombre_autoriza_name', name: 'nombre_autoriza.name'},
                    {data: 'documentometodo', name: 'documentometodo', sortable: false, searchable: false},
                    {data: 'actions', name: '{{ trans('global.actions') }}'}
                ],
                orderCellsTop: true,
                order: [[1, 'desc']],
                pageLength: 100,
            };
            let table = $('.datatable-AccionCorrectiva').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
            $('.datatable thead').on('input', '.search', function () {
                let strict = $(this).attr('strict') || false
                let value = strict && this.value ? "^" + this.value + "$" : this.value
                table
                    .column($(this).parent().index())
                    .search(value, strict)
                    .draw()
            });
        });

    </script>
@endsection
