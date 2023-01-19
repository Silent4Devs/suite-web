@extends('layouts.admin')
@section('content')
    <div class="mt-3">
        {{ Breadcrumbs::render('Solicitud-Dayoff') }}
    </div>

    <style>
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

        .caja_btn_reporte {
            width: 100%;
            display: inline-block;
            align-items: initial;
            text-align: center;
        }

        .btn_reporte {
            width: 120px;
            height: 130px;
            overflow: hidden;
            text-decoration: none;
            display: inline-block;
            color: #345183;
            padding: 5px;
            border: 1px solid #D9D9D9 !important;
            background-color: #EEEEEE;
            margin: 5px;
            padding-top: 12px;
            border-radius: 6px;
            transition: 0.2s;
            /*box-shadow: 0px 2px 3px 1px rgba(0, 0, 0, 0.2);*/
        }

        .btn_reporte:hover {
            border: 1px solid #345183 !important;
            color: #345183;
            background-color: rgba(0, 0, 0, 0);
        }

        .btn_reporte i {
            font-size: 30pt;
            transition: 0.05s;
        }

        .btn_reporte:hover i {
            transform: scale(1.1);
        }
    </style>

    <h5 class="col-12 titulo_general_funcion">Solicitud de Day Off</h5>

    <div class="card">
        @can('solicitud_dayoff_crear')
            <div class="form-group row mt-4">
                <label for="inputEmail3" class="col-sm-2 col-form-label offset-8 ">Días disponibles:</label>
                <div class="col-sm-2 pr-5">
                    <input type="text"  style="text-align:center;" class="form-control" id="inputEmail3" value="{{ $dias_disponibles }}" disabled>
                </div>
            </div>
            <div style="margin-bottom: 5px; margin-left:10px;" class="row">
                <div class="col-lg-12">
                    @include('csvImport.modal', [
                        'model' => 'Amenaza',
                        'route' => 'admin.amenazas.parseCsvImport',
                    ])
                </div>
            @endcan
        </div>

        @include('flash::message')
        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            @include('admin.solicitudDayoff.table')
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Amenazas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Amenazas ${new Date().toLocaleDateString().trim()}`,
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
                        let empleado = @json(auth()->user()->empleado->name);

                        var now = new Date();
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                        $(doc.document.body).prepend(`
                            <div class="row">
                                <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                    <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                                </div>
                                <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                    <p>${empresa_actual}</p>
                                    <strong style="color:#345183">Amenazas</strong>
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

            let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Nueva Solicitud',
                titleAttr: 'Crear solicitud de Day Off',
                url: "{{ route('admin.solicitud-dayoff.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3 agregar",
                action: function(e, dt, node, config) {
                    let {
                        url
                    } = config;
                    window.location.href = url;
                }
            };
            // let btnExport = {
            //     text: '<i  class="fas fa-download"></i>',
            //     titleAttr: 'Descargar plantilla',
            //     className: "btn btn_cargar",
            //     url: "{{ route('descarga-amenaza') }}",
            //     action: function(e, dt, node, config) {
            //         let {
            //             url
            //         } = config;
            //         window.location.href = url;
            //     }
            // };
            // let btnImport = {
            //     text: '<i  class="fas fa-file-upload"></i>',
            //     titleAttr: 'Importar datos',
            //     className: "btn btn_cargar",
            //     action: function(e, dt, node, config) {
            //         $('#csvImportModal').modal('show');
            //     }
            // };

            // dtButtons.push(btnExport);
            // dtButtons.push(btnImport);

            @can('solicitud_dayoff_crear')
                dtButtons.push(btnAgregar);
            @endcan


            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.solicitud-dayoff.index') }}",
                columns: [{
                        data: 'dias_solicitados',
                        name: 'dias_solicitados',
                        render: function(data, type, row) {
                            return `<div style="text-align:center">${data}</div>`;
                        }

                    },
                    // {
                    //     data: 'año',
                    //     name: 'año',
                    //     render: function(data, type, row) {
                    //         return `<div style="text-align:center">${data} año</div>`;
                    //     }

                    // },
                    {
                        data: 'fecha_inicio',
                        name: 'fecha_inicio',
                        render: function(data, type, row) {
                            let fecha = data.split('-');
                            let fechaDMY = `${fecha[2]}-${fecha[1]}-${fecha[0]}`;
                            return `<div style="text-align:left">${fechaDMY}</div>`;
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'fecha_fin',
                        name: 'fecha_fin',
                        render: function(data, type, row) {
                            let fecha = data.split('-');
                            let fechaDMY = `${fecha[2]}-${fecha[1]}-${fecha[0]}`;
                            return `<div style="text-align:left">${fechaDMY}</div>`;
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'aprobacion',
                        name: 'aprobacion',
                        render: function(data, type, row) {
                            const aprobacion = row.aprobacion;

                            switch (Number(aprobacion)) {
                                case 1:
                                    return `
                                    <div  style="text-align:left">
                                        <span class="badge badge-pill badge-warning">Pendiente</span>
                                    </div>
                                    `;
                                    break;
                                case 2:
                                    return `
                                    <div style="text-align:left">
                                        <span class="badge badge-pill badge-danger">Rechazado</span>
                                    </div>
                                    `;
                                    break;
                                case 3:
                                    return `
                                    <div style="text-align:left">
                                        <span class="badge badge-pill badge-success">Aprobado</span>
                                    </div>
                                    `;
                                    break;
                                default:
                                    return `
                                    <span class="badge badge-pill badge-secondary">Sin Seguimiento</span>
                                    `;
                            }
                        }
                    },

                    // {
                    //     data: 'descripcion',
                    //     name: 'descripcion',
                    //     render: function(data, type, row) {
                    //         return `<div style="text-align:left">${data}</div>`;
                    //     }
                    // },
                    {
                        data: 'actions',
                        render: function(data, type, row, meta) {
                            let aprobacion = row.aprobacion;
                            let id = row.id;
                            console.log(id);
                            if (aprobacion == 3) {
                                return `  
                                <div style="text-aling:center">
                                <a href="solicitud-dayoff/${row.id}/show"  title="Ver Solicitud"><i class="fa-solid fa-eye fa-1x text-info text-aling:center"></i></a>
                                </div>
                               `;

                            } else {
                                let urlEliminar = '{{ route('admin.solicitud-dayoff.destroy') }}'
                                return `     
                                <div style="text-aling:center">
                                <a href="solicitud-dayoff/${row.id}/show"  title="Ver Solicitud"><i class="fa-solid fa-eye fa-1x text-info text-aling:center"></i></a>
                                <button onclick="eliminar('${urlEliminar}','${row.id}')" title="Cancelar solicitud" class="btn btn-sm text-danger" style="display:inline-block"><i class="fa-solid fa-trash fa-1x text-danger text-aling:center"></i></button>
                                </div>
                               `;
                            }

                        }
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
            };
            let table = $('.datatable-solicitud-dayoff').DataTable(dtOverrideGlobals);
            $('.btn.buttons-print.btn-sm.rounded.pr-2').unbind().click(function() {
                let titulo_tabla = `
                <h5>
                    <strong>
                        Solicitud de Vacaciones
                    </strong>
                </h5>
            `;
                imprimirTabla('datatable-solicitud-dayoff', titulo_tabla);
            });
            window.eliminar = (url, id) => {
                Swal.fire({
                    title: '¿Esta seguro de cancelar la solicitud?',
                    text: "Esta solicitud ya no será visible para el aprobador.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí estoy seguro!',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: url,
                            data: {
                                id
                            },
                            dataType: "JSON",
                            success: function(response) {
                                if (response.status = 200) {
                                    table.ajax.reload();
                                }
                            },
                            error: function(error) {
                                toastr.error(error);
                            }
                        });
                    }
                })

            }
        });
    </script>
@endsection
