@extends('layouts.admin')

@section('content')
@section('titulo', 'Clientes')
{{-- {{ Breadcrumbs::render('proveedores_edit', $proveedores) }} --}}
<form method="POST" action="{{route('contract_manager.proveedor.update', [$proveedores->id]) }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    @include('contract_manager.proveedor.form', ['show_proveedor' => false])
</form>

@endsection
@section('scripts')
@parent
<script>
    $(function() {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        // @can('proveedores_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{route('contract_manager.proveedor.massDestroy') }}",
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
        // @endcan


        let dtOverrideGlobals = {
            buttons: dtButtons,
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            ajax: "{{route('contract_manager.proveedor.index') }}",
            columns: [{
                    data: 'placeholder',
                    name: 'placeholder'
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'razon_social',
                    name: 'razon_social'
                },
                {
                    data: 'nombre_comercial',
                    name: 'nombre_comercial'
                },
                {
                    data: 'rfc',
                    name: 'rfc'
                },
                {
                    data: 'calle',
                    name: 'calle'
                },
                {
                    data: 'colonia',
                    name: 'colonia'
                },
                {
                    data: 'ciudad',
                    name: 'ciudad'
                },
                {
                    data: 'codigo_postal',
                    name: 'codigo_postal'
                },
                {
                    data: 'telefono',
                    name: 'telefono'
                },
                {
                    data: 'pagina_web',
                    name: 'pagina_web'
                },
                {
                    data: 'nombre_completo',
                    name: 'nombre_completo'
                },
                {
                    data: 'puesto',
                    name: 'puesto'
                },
                {
                    data: 'correo',
                    name: 'correo'
                },
                {
                    data: 'celular',
                    name: 'celular'
                },
                {
                    data: 'objeto_descripcion',
                    name: 'objeto_descripcion'
                },
                {
                    data: 'cobertura',
                    name: 'cobertura'
                },
                {
                    data: 'actions',
                    name: '{{ trans('global.actions') }}'
                }
            ],
            orderCellsTop: true,
            order: [
                [1, 'desc']
            ],
            pageLength: 100,
        };
        let table = $('.datatable-Proveedores').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        $('.datatable thead').on('input', '.search', function() {
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
