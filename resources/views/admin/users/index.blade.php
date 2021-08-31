@extends('layouts.admin')
@section('content')
    @can('user_create')


        <div class="mt-5 card">
            <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2 text-center text-white"><strong>Usuarios</strong></h3>
            </div>
        @endcan

        <div class="card-body datatable-fix">
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
                            Correo&nbsp;electrónico
                        </th>
                        <th style="vertical-align: top">
                            Correo&nbsp;electrónico verificado
                        </th>
                        <th style="vertical-align: top">
                            Autentificación&nbsp;por&nbsp;dos factores
                        </th>
                        <th style="vertical-align: top">
                            {{ trans('cruds.user.fields.approved') }}
                        </th>
                        <th style="vertical-align: top">
                            {{ trans('cruds.user.fields.verified') }}
                        </th>
                        <th style="vertical-align: top">
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <th style="vertical-align: top">
                            Empleado Vinculado
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
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach ($roles as $key => $item)
                                    <option value="{{ $item->title }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach ($organizaciones as $key => $item)
                                    <option value="{{ $item->organizacion }}">{{ $item->organizacion }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach ($areas as $key => $item)
                                    <option value="{{ $item->area }}">{{ $item->area }}</option>
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
                    title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
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
                    title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
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
            @can('user_create')
                let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar usuario',
                url: "{{ route('admin.users.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config){
                let {url} = config;
                window.location.href = url;
                }
                };
                dtButtons.push(btnAgregar);
            @endcan
            @can('user_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.users.massDestroy') }}",
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
                // dtButtons.push(deleteButton)
            @endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.users.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'email_verified_at',
                        name: 'email_verified_at'
                    },
                    {
                        data: 'two_factor',
                        name: 'two_factor',
                        render: function(data, type, row, meta) {
                            return data ? 'Sí' : 'No';
                        }
                    },
                    {
                        data: 'approved',
                        name: 'approved',
                        render: function(data, type, row, meta) {
                            return data ? 'Sí' : 'No';
                        }
                    },
                    {
                        data: 'verified',
                        name: 'verified',
                        render: function(data, type, row, meta) {
                            return data ? 'Sí' : 'No';
                        }
                    },
                    {
                        data: 'roles',
                        name: 'roles.title',
                        render: function(data, type, row, meta) {
                            let roles = data.map(rol => {
                                return `
                                    <span class="badge badge-primary">${rol.title}</span>
                                `;
                            })
                            return roles;
                        }
                    },
                    {
                        data: 'n_empleado',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return row.empleado.name;
                            } else {
                                return 'Sin vincular a empleado';
                            }
                        }
                    },
                    {
                        data: 'n_empleado',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return row.empleado.area.area;
                            } else {
                                return 'Sin vincular a empleado';
                            }
                        }
                    },
                    {
                        data: 'n_empleado',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return row.empleado.puesto;
                            } else {
                                return 'Sin vincular a empleado';
                            }
                        }
                    },
                    {
                        data: 'id',
                        name: '{{ trans('global.actions') }}',
                        render: function(data, type, row, meta) {
                            let urlButtonShow = `/admin/users/${data}`;
                            let urlButtonDelete = `/admin/users/${data}`;
                            let urlButtonEdit = `/admin/users/${data}/edit`;

                            let htmlBotones = `
                                <div class="btn-group">
                                    <button title="${row.n_empleado?'Cambiar empleado vinculado':'Vincular Empleado'}" class="btn btn-sm" onclick="AbrirModal('${data}');">
                                        <i class="fas fa-user-tag"></i>
                                    </button>
                                    <a href="${urlButtonShow}" class="btn btn-sm" title="Visualizar"><i class="fas fa-eye"></i></a>                                
                                    <a href="${urlButtonEdit}" class="btn btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-sm text-danger" title="Eliminar" onclick="Eliminar('${urlButtonDelete}','${row.name}');"><i class="fas fa-trash-alt"></i></button>                                
                                </div>


                                <div data-user-id="${data}" class="modal fade" id="vincularEmpleado${data}" data-backdrop="static"
                                    data-keyboard="false" tabindex="-1" aria-labelledby="vincularEmpleado${data}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="vincularEmpleado${data}Label">Vinculación de Empleados
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <select name="n_empleado" id="n_empleado" class="select2">
                                                    @foreach ($empleados as $empleado)
                                                        <option value="{{ $empleado->n_empleado }}">{{ $empleado->name }}</option>
                                                    @endforeach
                                                </select>                                               
                                                <span class="text-sm n_empleado_error errores text-danger"></span>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="VincularEmpleado('${row.name}','${data}');">Vincular</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            return htmlBotones;
                        }
                    }
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ]
            };
            let table = $('.datatable-User').DataTable(dtOverrideGlobals);

            window.Eliminar = function(url, nombre) {
                Swal.fire({
                    title: `¿Estás seguro de eliminar el siguiente usuario?`,
                    html: `<strong><i class="mr-2 fas fa-exclamation-triangle"></i>${nombre}</strong>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            headers: {
                                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: url,
                            beforeSend: function() {
                                Swal.fire(
                                    '¡Estamos Eliminando!',
                                    `El usuario: ${nombre} está siendo eliminado`,
                                    'info'
                                )
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Eliminado!',
                                    `El usuario: ${nombre} ha sido eliminado`,
                                    'success'
                                )
                                table.ajax.reload();
                            },
                            error: function(error) {
                                console.log(error);
                                Swal.fire(
                                    'Ocurrió un error',
                                    `Error: ${error.responseJSON.message}`,
                                    'error'
                                )
                            }
                        });
                    }
                })
            }


            window.AbrirModal = function(user_id) {
                let errores = document.querySelectorAll('.errores');
                errores.forEach(element => {
                    element.innerHTML = "";
                });
                $(`#vincularEmpleado${user_id}`).modal('show');
                $('.select2').select2({
                    'theme': 'bootstrap4'
                });
            }

            window.VincularEmpleado = function(nombre, user_id) {
                let n_empleado = $("#n_empleado").val();
                console.log(n_empleado);
                $.ajax({
                    type: "POST",
                    url: "/admin/users/vincular",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        n_empleado,
                        user_id
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        Swal.fire(
                            '¡Estamos Vinculando!',
                            `El usuario: ${nombre} está siendo vinculado`,
                            'info'
                        )
                    },
                    success: function(response) {
                        Swal.fire(
                            'Usuario Vinculado',
                            `El usuario: ${nombre} ha sido vinculado`,
                            'success'
                        )
                        table.ajax.reload();
                        $(`#vincularEmpleado${user_id}`).modal('hide')
                        $('.modal-backdrop').hide();
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $.each(error.responseJSON.errors, function(indexInArray,
                            valueOfElement) {
                            $(`span.${indexInArray}_error`).text(valueOfElement[0]);
                            console.log(indexInArray, valueOfElement);
                        });
                        Swal.fire(
                            'Ocurrió un error',
                            `Error: ${error.responseJSON.message}`,
                            'error'
                        )
                    }
                });
            }

        });
    </script>
@endsection
