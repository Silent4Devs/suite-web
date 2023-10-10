@extends('layouts.admin')
@section('content')
   

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

    <h5 class="col-12 titulo_general_funcion">Mensajería</h5>

    <div class="card">
        @can('amenazas_agregar')
            <div style="margin-bottom: 10px; margin-left:10px;" class="row">
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
            <table class="table table-bordered w-100 datatable datatable-envio-documentos tblCSV"
            id="datatable-envio-documentos">
            <thead class="thead-dark">
                <tr>
                    <th style="min-width: 30px;">
                        ID
                    </th>
                    <th style="min-width: 100px;">
                        Fecha de la solicitud
                    </th>
                    <th style="min-width: 110px;">
                       Solicitante
                    </th>
                    <th style="min-width: 75px;">
                        Estatus
                    </th>
                    <th style="min-width: 100px;">
                        Notas
                    </th>
                    <th style="min-width: 50px;">
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
                                    <strong style="color:#345183">Solicitud de Mensajeria</strong>
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





            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.envio-documentos.atencion') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row) {
                            return `<div style="text-align:center">${data}</div>`;
                        }

                    },
                    {
                        data: 'fecha_solicitud',
                        name: 'fecha_solicitud',
                        render: function(data, type, row) {
                            let fecha = data.split('-');
                            let fechaDMY = `${fecha[2]}-${fecha[1]}-${fecha[0]}`;
                            return `<div style="text-align:left">${fechaDMY}</div>`;
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'solicita',
                        name: 'solicita',
                        render: function(data, type, row) {
                            data = JSON.parse(data);
                            return `<div style="text-align:left">${data.name}</div>`;
                        }
                    },
                    
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            const status = row.status;
                            switch (Number(status)) {
                                case 1:
                                    return `
                                    <div  style="text-align:left">
                                        <span class="badge badge-warning">En recolección</span>
                                    </div>
                                    `;
                                    break;
                                case 2:
                                    return `
                                    <div style="text-align:left">
                                        <span class="badge badge-primary">En camino</span>
                                    </div>
                                    `;
                                    break;
                                case 3:
                                    return `
                                    <div style="text-align:left">
                                        <span class="badge badge-success">Entregado</span>
                                    </div>
                                    `;
                                    break;
                                case 4:
                                    return `
                                    <div style="text-align:left">
                                        <span class="badge badge-danger">Devolución</span>
                                    </div>
                                    `;
                                    break;
                                default:
                                    return `
                                    <div style="text-align:left">
                                       Por asignar
                                    </div>
                                    `;
                            }
                        }
                    },
                    {
                        data: 'notas',
                        name: 'notas',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },


                    {
                        data: 'actions',
                        name: 'actions',

                        render: function(data, type, row, meta) {
                            let aprobacion = row.aprobacion;
                            let id = row.id;

                            return `  
                            <div style="text-aling:center">
                            <a href="atencion/${row.id}/seguimiento"  title="Dar seguimiento"><i class="fas fa-mail-bulk text-align:center;"></i></a>
                            </div>
                           `;

                        }
                    },
                    
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
            };
            let table = $('.datatable-envio-documentos').DataTable(dtOverrideGlobals);
            $('.btn.buttons-print.btn-sm.rounded.pr-2').unbind().click(function() {
                let titulo_tabla = `
                <h5>
                    <strong>
                        Solicitud de Mensajeria
                    </strong>
                </h5>
            `;
                imprimirTabla('datatable-envio-documentos', titulo_tabla);
            });
            window.eliminar = (url, id) => {
                Swal.fire({
                    title: '¿Esta seguro de cancelar la solicitud?',
                    text: "Esta solicitud ya no será visible para el coordinador y/o mensajero.",
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
