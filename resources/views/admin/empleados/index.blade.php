@extends('layouts.admin')
@section('content')
    <style>
        .btn-outline-success {
            background: #788bac !important;
            color: white;
            border:none;
        }
        .btn-outline-success:focus{
            border-color:#345183 !important;
            box-shadow:none;
        }

        .btn-outline-success:active{
            box-shadow:none !important;
        }
        .btn-outline-success:hover {
            background: #788bac;
            color: white;

        }

        .btn_cargar {
            border-radius: 100px !important;
            border: 1px solid #345183;
            color: #345183;
            text-align: center;
            padding: 0;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 !important;
            margin-right: 10px !important;

        }

       

        .agregar {
            margin-right: 15px;

        }

    </style>
    {{ Breadcrumbs::render('EV360-Empleados') }}

    <h5 class="col-12 titulo_general_funcion">Empleados</h5>
    <div class="mt-5 card">
        @can('bd_empleados_agregar')
            <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12">
                    @include('csvImport.modalempleado', [
                        'model' => 'Vulnerabilidad',
                        'route' => 'admin.vulnerabilidads.parseCsvImport',
                    ])
                </div>
            </div>
        @endcan
        <div class="d-flex justify-content-between" style="justify-content: flex-end !important;">
            @can('bd_empleados_configurar_vista_datos')
            <div class="p-2">
                <a href="{{ url('admin/panel-inicio') }}" style="text-align: right;padding-right: 20px;"
                    class="btn btn-success btn-sm active" role="button" aria-pressed="true"><i
                        class="pl-2 pr-3 fas fa-plus"></i> Configurar vista datos</a>
            </div>
            @endcan
        </div>
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
            <table class="table table-bordered w-100 datatable-Empleado tblCSV">
                <thead class="thead-dark">
                    <tr>
                        {{-- <th>

                        </th> --}}
                        <th style="vertical-align: top">
                            ID
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
                            Cumpleaños
                        </th>
                        <th style="vertical-align: top">
                            Fecha Nacimiento
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
                        <div class="row mt-5 mb-4 col-12 ml-0" style="border: 2px solid #ccc; border-radius: 5px">
                                <div class="col-2 p-2" style="border-right: 2px solid #ccc">
                                    <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                                </div>
                                <div class="col-7 p-2" style="text-align: center; border-right: 2px solid #ccc">
                                    <p>${empresa_actual}</p>
                                    <strong style="color:#345183">EMPLEADOS: LISTA DE EMPLEADOS DE LA EMPRESA</strong>
                                </div>
                                <div class="col-3 p-2">
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
                    text: '<i class="fas fa-filter" style="font-size: 1.1rem;color:#000"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Seleccionar Columnas',
                },
                {
                    extend: 'colvisGroup',
                    text: '<i class="fas fa-eye" style="font-size: 1.1rem;color:#000"></i>',
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
            @can('bd_empleados_agregar')
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
                // let btnExport = {
                //     text: '<i class="fas fa-download"></i>',
                //     titleAttr: 'Descargar plantilla',
                //     className: "btn btn_cargar",
                //     url: "{{ route('descarga-empleado') }}",
                //     action: function(e, dt, node, config) {
                //         let {
                //             url
                //         } = config;
                //         window.location.href = url;
                //     }
                // };
                let btnImport = {
                    text: '<i class="fas fa-file-upload"></i>',
                    titleAttr: 'Importar datos',
                    className: "btn btn_cargar",
                    action: function(e, dt, node, config) {
                        window.location.href = "{{ route('admin.empleado.importar') }}";
                    }
                };
                dtButtons.push(btnAgregar);
                // dtButtons.push(btnExport);
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
                ajax: {
                    url: "{{ route('admin.empleado.getListaEmpleadosIndex') }}",
                    type: 'POST',
                    data: {
                        _token: _token
                    }
                },
                columns: [
                    // {
                    //     data: 'checkbox',
                    //     name: 'checkbox',
                    //     render: function(data, type, row, meta) {
                    //         return '<input type="checkbox" class="select_one" name="checkbox[]" id="checkbox' +
                    //             row.id + '" value="' + row.id + '">';
                    //     }
                    // },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'avatar',
                        name: 'avatar',
                        render: function(data, type, row, meta) {
                            const ids = row.id.toString();
                            console.log(ids);
                            return `<div class="text-center"><a href="empleados/${ids}/edit"><img style="width: 40px;height: 40px;border-radius: 50%;" src="${row.avatar_ruta}"></a></div>`;
                        }
                    },
                    {
                        data: 'n_empleado',
                        render: function(data, type, row, meta) {
                            if (data != null) {
                                return data;
                            }
                            return '- -';
                        }
                    },
                    {
                        data: 'name',
                        render: function(data, type, row, meta) {
                            if (data != null) {
                                return data;
                            }
                            return '- -';
                        }
                    },
                    {
                        data: 'email',
                        render: function(data, type, row, meta) {
                            if (data != null) {
                                return data;
                            }
                            return '- -';
                        }
                    },
                    {
                        data: 'telefono',
                        render: function(data, type, row, meta) {
                            if (data != null) {
                                return data;
                            }
                            return '- -';
                        }
                    },
                    {
                        data: 'area.area',
                        render: function(data, type, row, meta) {
                            if (data != null) {
                                return data;
                            }
                            return '- -';
                        }
                    },
                    {
                        data: 'puesto',
                        render: function(data, type, row, meta) {
                            if (row.puesto != null) {
                                return row.puesto;
                            }
                            return '- -';
                        }
                    },
                    {
                        data: 'supervisor',
                        render: function(data, type, row, meta) {
                            if (row.supervisor != null) {
                                return row.supervisor.name;
                            }
                            return '- -';
                        }
                    },
                    {
                        data: 'antiguedad',
                        name: 'antiguedad',
                        render: function(data, type, row, meta) {
                            if (data != null) {
                                return data;
                            }
                            return '- -';
                        }
                    },
                    {
                        data: 'estatus',
                        name: 'estatus',
                        render: function(data, type, row, meta) {
                            if (row.estatus == 'alta') {
                                return '<i class="fas fa-check text-success"></i> Alta';
                            } else {
                                return '<i class="fas fa-times text-danger"></i> Baja';
                            }
                        }
                    },
                    {
                        data: 'sede',
                        render: function(data, type, row, meta) {
                            if (row.sede != null) {
                                return row.sede.sede;
                            }
                            return '- -';
                        }
                    },
                    {
                        data: 'sede',
                        render: function(data, type, row, meta) {
                            if (row.cumpleaños != null) {
                                //get current year
                                var currentYear = new Date().getFullYear();
                                let fecha = row.cumpleaños.split('-');
                                let dia = fecha[2];
                                let mes = fecha[1];
                                let anio = fecha[0];
                                let birthday = `${dia} de ${obtenerMes(Number(mes))} del ${currentYear}`;
                                return birthday;
                            }
                            return '- -';
                        }
                    },
                    {
                        data: 'sede',
                        render: function(data, type, row, meta) {
                            if (row.cumpleaños != null) {
                                return row.cumpleaños;
                            }
                            return '- -';
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            let buttons = `
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    @can('bd_empleados_ver')
                                    <a href="{{ route('admin.empleados.show', ':id') }}" class="btn rounded-0" title="Ver"><i class="fas fa-eye"></i></a>
                                    @endcan
                                    @can('bd_empleados_editar')
                                    <a href="{{ route('admin.empleados.edit', ':id') }}" class="btn rounded-0" title="Editar"><i class="fas fa-edit"></i></a>
                                   @endcan
                                   @can('bd_empleados_dar_de_baja')
                                    <a  class="btn rounded-0" title="Dar de Baja" href="{{ route('admin.empleado.solicitud-baja',':id') }}"><i class="fas fa-trash-alt text-danger"></i></a>
                                   @endcan
                                </div>
                            `;
                            // onclick="DarDeBaja(this,'${row.name}','${row.avatar_ruta}')"
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
                },
            };
            let table = $('.datatable-Empleado').DataTable(dtOverrideGlobals);
            // new $.fn.dataTable.FixedColumns(table, {
            //     leftColumns: 2,
            //     rightColumns: 2
            // });
            function obtenerMes(mes) { 
                switch (mes) {
                    case 1:
                    return 'Enero';   
                        break;
                    case 2:
                    return 'Febrero';   
                        break;
                    case 3:
                    return 'Marzo';   
                        break;
                    case 4:
                    return 'Abril';   
                        break;
                    case 5:
                    return 'Mayo';   
                        break;
                    case 6:
                    return 'Junio';   
                        break;
                    case 7:
                    return 'Julio';   
                        break;
                    case 8:
                    return 'Agosto';   
                        break;
                    case 9:
                    return 'Septiembre';   
                        break;
                    case 10:
                    return 'Octubre';   
                        break;
                    case 11:
                    return 'Noviembre';   
                        break;
                    case 12:
                    return 'Diciembre';   
                        break;
                    default:
                        return '- -';
                        break;
                }
             }
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
