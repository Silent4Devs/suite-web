@extends('layouts.admin')
@section('content')
    <style>
        .table tr td:nth-child(1) {
            min-width: 200px !important;
        }

        .table tr td:nth-child(4) {
            min-width: 200px !important;
        }
    </style>
    @include('flash::message')
    @include('partials.flashMessages')
    <h5 class="col-12 titulo_general_funcion">Usuarios</h5>
    <div class="mt-5 card">

        <div class="d-flex justify-content-between" style="justify-content: flex-end !important;">

            <div class="p-2">
                <a href={{ route('admin.users.eliminados') }} class="btn btn-danger" role="button" aria-pressed="true">
                    <i class="fas fa-user-slash"></i>&nbsp &nbsp Usuarios eliminados</a>
            </div>

        </div>

        <div class="card-body datatable-fix">


            @if (!$existsVinculoEmpleadoAdmin)
                <h5>Por favor da clic en el icono <small class="p-1 border border-primary rounded"><i
                            class="fas fa-user-tag"></i></small> de la fila del usuario Admin</h5>
            @endif
            <table class="table table-bordered w-100 datatable-User">
                <thead class="thead-dark">
                    <tr>

                        <th style="vertical-align: top">
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th style="vertical-align: top">
                            Correo&nbsp;electrónico
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
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                    </tr>
                </tbody>
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
            @can('usuarios_agregar')
                let btnAgregar = {
                    text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                    titleAttr: 'Agregar usuario',
                    url: "{{ route('admin.users.create') }}",
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
            @can('usuarios_eliminar')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.users.massDestroy') }}",
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
                // dtButtons.push(deleteButton)
            @endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: {
                    url: "{{ route('admin.users.getUsersIndex') }}",
                    type: 'POST',
                    data: {
                        _token: _token
                    }
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
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
                        data: 'id',
                        render: function(data, type, row, meta) {
                            if (row.n_empleado != null || row.empleado_id != null) {
                                if (row.empleado) {
                                    return row.empleado?.name;
                                }
                            }
                            return 'Sin vincular a empleado';

                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            if (row.n_empleado != null || row.empleado_id != null) {
                                if (row.empleado) {
                                    return row.empleado?.area?.area;
                                }
                            }
                            return 'Sin vincular a empleado';
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            if (row.n_empleado != null || row.empleado_id != null) {
                                if (row.empleado) {
                                    return row.empleado?.puesto;
                                }
                            }
                            return 'Sin vincular a empleado';
                        }
                    },
                    {
                        data: 'id',
                        name: 'actions',
                        render: function(data, type, row, meta) {
                            let empleados = @json($empleados);
                            let urlButtonShow = `/admin/users/${data}`;
                            let urlButtonDelete = `/admin/users/${data}`;
                            let urlButtonEdit = `/admin/users/${data}/edit`;
                            let urlButtonTwoFactor = `/admin/users/two-factor/${data}/change`;
                            let urlButtonBloquearUsuario = `/admin/users/bloqueo/${data}/change`;
                            let existsVinculoEmpleadoAdmin = @json($existsVinculoEmpleadoAdmin);
                            let htmlBotones =
                                `
                                <div class="btn-group">
                                    @can('usuarios_editar')
                                    <a href="${urlButtonEdit}" class="btn btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
                                    @endcan
                                    @can('usuarios_ver')
                                    <a href="${urlButtonShow}" class="btn btn-sm" title="Visualizar"><i class="fas fa-eye"></i></a>
                                    @endcan
                                    @can('usuarios_vincular_empleados')
                                    <button title="${row.n_empleado?'Cambiar empleado vinculado':'Vincular Empleado'}" class="btn btn-sm ${row.n_empleado?'':'border border-primary rounded'}" onclick="AbrirModal('${data}');">
                                        <i class="fas fa-user-tag"></i>
                                    </button>
                                    @endcan
                                    @can('usuarios_verificacion_dos_factores')
                                    <a href="${urlButtonTwoFactor}" title="${row.two_factor?'Quitar Verificación por dos factores':'Activar verificación por dos factores'}" class="btn btn-sm">
                                        ${row.two_factor?' <i class="fas fa-key"></i>':' <i class="fas fa-key"></i>'}
                                    </a>
                                    @endcan
                                    @can('usuarios_bloquear_usuario')
                                    <a href="${urlButtonBloquearUsuario}" title="${row.is_active?'Bloquear usuario':'Desbloquear usuario'}" class="btn btn-sm">
                                        ${row.is_active?' <i class="fas fa-unlock"></i>':' <i class="fas fa-lock"></i>'}
                                    </a>
                                    @endcan
                                    @can('usuarios_eliminar')
                                    <button class="btn btn-sm text-danger" title="Eliminar" onclick="Eliminar('${urlButtonDelete}','${row.name}');"><i class="fas fa-trash-alt"></i></button>
                                    @endcan
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
                                                <p><strong>Empleado vinculado actualmente:</strong> ${row.empleado?.name?row.empleado?.name:"Sin vincular"}</p>
                                                <select name="n_empleado" id="n_empleado${data}" class="select2">
                                                    <option value="" selected disabled>-- Selecciona el empleado a vincular --</option>`;
                            empleados.forEach(empleado => {
                                htmlBotones += `
                                                            <option value="${empleado.n_empleado != null ? `NEMPLEADO-${empleado.n_empleado}`:`IDEMPLEADO-${empleado.id}`}">${empleado.name}</option>
                                                        `;
                            });
                            htmlBotones += `</select>
                                                <span class="text-sm n_empleado_error errores text-danger"></span>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <button type="button" class="btn btn-primary" onclick="VincularEmpleado('${row.name}','${data}');">Vincular</button>
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
                    [0, 'desc']
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
                    'theme': 'bootstrap4',
                    'dropdownParent': $(`#vincularEmpleado${user_id}`)
                });
            }

            window.VincularEmpleado = function(nombre, user_id) {
                console.log(user_id);
                let n_empleado = document.getElementById(`n_empleado${user_id}`).value;
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
