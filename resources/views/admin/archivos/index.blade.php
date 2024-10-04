@extends('layouts.admin')
@section('content')
    @can('archivo_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a clamary" href="{{ route('admin.archivos.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.archivo.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.archivo.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Archivo">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.archivo.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.archivo.fields.carpeta') }}
                        </th>
                        <th>
                            {{ trans('cruds.archivo.fields.nombre') }}
                        </th>
                        <th>
                            {{ trans('cruds.archivo.fields.estado') }}
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
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach ($carpeta as $key => $item)
                                    <option value="{{ $item->nombre }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
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
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('archivo_delete')
               let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.archivos.massDestroy') }}",
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
                dtButtons.push(deleteButton)
            @endcan

                  let dtOverrideGlobals = {
               buttons: dtButtons,
                                          processing: true,
                serverSide: true,
                                              retrieve: true,
                aaSorting: [],
                      aaSorting: [],
                      aaSorting: [],
                                                ajax: "{{ route('admin.archivos.index') }}",
                columns: [{
                        data: 'placeholder',
                       ame: 'placeholder'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                          },
                          },
                    {
                        data: 'carpeta_nombre',
                        name: 'carpeta.nombre'
                                     },
                    {
                        data: 'nombre',
                        name: 'nombre',
                        sortable: false,
                        searchable: false
                    },
                           data: 'estado_estado',
                        name: 'estado.estado'
           