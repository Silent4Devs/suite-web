@extends('layouts.admin')
@section('content')
    <style>
        .btn-outline-success {
            background: #345183;
            color: white;
            border: none;
        }

        .btn-outline-success:hover {
            background: #345183;
            color: white;
            border: none;
        }

        .btn_cargar {
            border-radius: 100px !important;
            border: 1px solid #345183;
            color: #345183;
            text-align: center;
            padding: 0;
            width: 45px;
            height: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 !important;
            margin-right: 10px !important;
        }

        .btn_cargar:hover {
            color: #fff;
            background: #345183;
        }

        .btn_cargar i {
            font-size: 15pt;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .agregar {
            margin-right: 15px;
        }

        .table tr td:nth-child(9) {

            text-align: left !important;

        }

        .table tr td:nth-child(7) {

            text-align: left !important;

        }

    </style>
    {{ Breadcrumbs::render('EV360-Empleados') }}

    <h5 class="col-12 titulo_general_funcion">Empleados</h5>
    <div class="mt-5 card">
        @can('configuracion_empleados_create')
            <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12">
                    @include('csvImport.modalempleado', [
                        'model' => 'Vulnerabilidad',
                        'route' => 'admin.vulnerabilidads.parseCsvImport',
                    ])
                </div>
            </div>
        @endcan
        <div class="d-flex justify-content-between">
            <div class="p-10">
                <button id="eliminar_todo" class="btn btn-danger btn-sm"
                    style="text-align: right;padding-right: 20px; background-color: red !important;"><i
                        class="fa-solid fa-trash"></i> seleccionados</button>
                <div class="spinner-grow hide" role="status" id="loaderDiv">
                    <span class="sr-only">Loading...</span>
                </div>
                <span class="sr-only">Loading...</span>
            </div>
            <div class="p-2">
                <a href="{{ url('admin/panel-inicio') }}" style="text-align: right;padding-right: 20px;"
                    class="btn btn-success btn-sm active" role="button" aria-pressed="true"><i
                        class="pl-2 pr-3 fas fa-plus"></i> Configurar vista datos</a>
            </div>
        </div>

        {{-- <a href="{{ url('admin/panel-inicio') }}" style="text-align: right;padding-right: 20px;"><button
                class="btn-xs btn-primary rounded ml-2 pr-3"><i class="pl-2 pr-3 fas fa-plus"></i> Configurar mis
                datos</button></a> --}}
        @if (!$ceo_exists)
            <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                <div class="row w-100">
                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                        <div class="w-100">
                            <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                        </div>
                    </div>
                    <div class="col-11">
                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Atención</p>
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Cree el listado de los empleados,
                            comenzando
                            por el de más alta jerarquía</p>
                    </div>
                </div>
            </div>
        @endif

        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 datatable-Empleado">
                <thead class="thead-dark">
                    <tr>
                        <th>

                        </th>
                        <th style="vertical-align: top">
                            Foto
                        </th>
                        <th style="vertical-align: top">
                            N°&nbsp;de&nbsp;empleado
                        </th>
                        <th style="vertical-align: top; min-width:200px;">
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th style="vertical-align: top">
                            Correo&nbsp;electrónico
                        </th>
                        <th style="vertical-align: top">
                            Teléfono
                        </th>
                        <th style="vertical-align: top">
                            Área
                        </th>
                        <th style="vertical-align: top">
                            Puesto
                        </th>
                        <th style="vertical-align: top; min-width:200px;">
                            Jefe Inmediato
                        </th>
                        <th style="vertical-align: top">
                            Antiguedad
                        </th>
                        <th style="vertical-align: top">
                            Estatus
                        </th>
                        <th style="vertical-align: top">
                            Sede
                        </th>
                        <th style="vertical-align: top">
                            Opciones
                        </th>
                    </tr>

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
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#345183"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#345183"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;color:#345183"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    // set custom header when print
                    customize: function(doc) {
                        let logo_actual = @json($logo_actual);
                        let empresa_actual = @json($empresa_actual);

                        var now = new Date();
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                        $(doc.document.body).prepend(`
                            <div class="row">
                                <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                    <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                                </div>
                                <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                    <p>${empresa_actual}</p>
                                    <strong style="color:#345183">EMPLEADOS: LISTA DE EMPLEADOS DE LA EMPRESA</strong>
                                </div>
                                <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                    Fecha: ${jsDate}
                                </div>
                            </div>
                        `);

                        $(doc.document.body).find('table')
                            .css('font-size', '12px')
                            .css('margin-top', '15px')
                        // .css('margin-bottom', '60px')
                        $(doc.document.body).find('th').each(function(index) {
                            $(this).css('font-size', '18px');
                            $(this).css('color', '#fff');
                            $(this).css('background-color', 'blue');
                        });
                    },
                    title: '',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-filter" style="font-size: 1.1rem;color:#345183"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Seleccionar Columnas',
                },
                {
                    extend: 'colvisGroup',
                    text: '<i class="fas fa-eye" style="font-size: 1.1rem;color:#345183"></i>',
                    className: "btn-sm rounded pr-2",
                    show: ':hidden',
                    titleAttr: 'Ver todo',
                },
                // {
                //     extend: 'colvisRestore',
                //     text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Restaurar a estado anterior',
                // }

            ];
            @can('configuracion_empleados_create')
                let btnAgregar = {
                    text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                    titleAttr: 'Agregar empleado',
                    url: "{{ route('admin.empleados.create') }}",
                    className: "btn-xs btn-outline-success rounded ml-2 pr-3 agregar",
                    action: function(e, dt, node, config) {
                        let {
                            url
                        } = config;
                        window.location.href = url;
                    }
                };
                let btnExport = {
                    text: '<i class="fas fa-download"></i>',
                    titleAttr: 'Descargar plantilla',
                    className: "btn btn_cargar",
                    url: "{{ route('descarga-empleado') }}",
                    action: function(e, dt, node, config) {
                        let {
                            url
                        } = config;
                        window.location.href = url;
                    }
                };
                let btnImport = {
                    text: '<i class="fas fa-file-upload"></i>',
                    titleAttr: 'Importar datos',
                    className: "btn btn_cargar",
                    action: function(e, dt, node, config) {
                        $('#xlsxImportModal').modal('show');
                    }
                };
                dtButtons.push(btnAgregar);
                dtButtons.push(btnExport);
                dtButtons.push(btnImport);
            @endcan

            @can('configuracion_empleados_delete')
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
                ajax: "{{ route('admin.empleados.index') }}",
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox',
                        render: function(data, type, row, meta) {
                            return '<input type="checkbox" class="select_one" name="checkbox[]" id="checkbox' +
                                row.id + '" value="' + row.id + '">';
                        }
                    },
                    {
                        data: 'avatar',
                        name: 'avatar',
                        render: function(data, type, row, meta) {
                            const ids = row.id.toString();
                            console.log(ids);
                            return `<div class="text-center"><a href="empleados/${ids}/edit"><img style="width: 50px;height: 50px;border-radius: 50%;" src="${row.avatar_ruta}"></a></div>`;
                        }
                    },
                    {
                        data: 'n_empleado',
                        name: 'n_empleado'
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
                        data: 'telefono',
                        name: 'telefono'
                    },
                    {
                        data: 'area',
                        name: 'area'
                    },
                    {
                        data: 'puesto',
                        name: 'puesto'
                    },
                    {
                        data: 'jefe',
                        name: 'jefe'
                    },
                    {
                        data: 'antiguedad',
                        name: 'antiguedad'
                    },
                    {
                        data: 'estatus',
                        name: 'estatus',
                        render: function(data, type, row, meta) {
                            if (row.estatus == 'alta') {
                                return '<i class="fas fa-check text-success"></i>';
                            } else {
                                return '<i class="fas fa-times text-danger"></i>';
                            }
                        }
                    },
                    {
                        data: 'sede',
                        name: 'sede'
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            let buttons = `
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('admin.empleados.show', ':id') }}" class="btn rounded-0" title="Ver"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.empleados.edit', ':id') }}" class="btn rounded-0" title="Ver"><i class="fas fa-edit"></i></a>
                                   <button onclick="DarDeBaja(this,'${row.name}','${row.avatar_ruta}')" data-url="{{ route('admin.empleados.destroy', ':id') }}" class="btn rounded-0 text-danger" title="Dar de Baja"><i class="fa-solid fa-user-xmark"></i></button>
                                </div>
                            `;
                            buttons = buttons.replaceAll(':id', data);
                            return buttons;
                        }
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }],
                select: {
                    style: "multi",
                    selector: "td:first-child"
                }
            };
            let table = $('.datatable-Empleado').DataTable(dtOverrideGlobals);

            $('#eliminar_todo').click(function() {
                let ArregloIds = [];
                let arregloEliminar = table.rows({
                    selected: true
                }).data().toArray();
                arregloEliminar.forEach(item => {
                    ArregloIds.push(item.id) // Segunda columna
                });
                console.log(ArregloIds);
                $.ajax({
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('admin.empleado.deleteMultiple') }}',
                    data: {
                        data: ArregloIds
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        $("#loaderDiv").show();
                        $('#eliminar_todo').hide();
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Bien Hecho',
                                'Registros eliminados ',
                                'success'
                            )
                        }
                        $("#loaderDiv").hide();
                        $('#eliminar_todo').show();
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

            window.DarDeBaja = (e, empleado, avatar) => {
                let url = $(e).data('url');
                Swal.fire({
                    title: '¿Estás seguro?',
                    html: `
                        <div>
                            <img style="clip-path: circle(18px at 50% 50%);width: 50px;" src="${avatar}" /> <strong>${empleado}</strong> será dado de baja.    
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, dar de baja',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                if (data.success) {
                                    Swal.fire(
                                        'Éxito',
                                        data.empleado + ' ha sido dado de baja',
                                        'success'
                                    ).then().then(() => {
                                        table.ajax.reload();
                                    });
                                }
                            }
                        });
                    }
                });
            }
        });
    </script>
@endsection
