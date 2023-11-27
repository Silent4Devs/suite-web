@extends('layouts.admin')
@section('content')
    <div class="mt-3">
        {{ Breadcrumbs::render('Incidentes-dayoff') }}
    </div>

    @include('admin.incidentesDayOff.estilos')

    <style>
        table {
            background: #FFFFFF 0% 0% no-repeat padding-box;
            box-shadow: 0px 1px 4px #0000000F;
            border: 1px solid #E5E5E5;
            border-radius: 14px;
            opacity: 1;
        }

        table.dataTable thead,
        table.table thead {
            background: #FFFFFF !important;
            color: black !important;
        }

        div.row.align-items-center.justify-content-center {
            display: none;
            visibility: hidden;
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
    </style>

    <h5 class="col-12 titulo_general_funcion">Excepciones Day Off</h5>

    <div class="card">
        <div class="px-1 py-2 mb-4 rounded mt-2 mr-1 ml-1 " style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
            <div class="row w-100">
                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                    <div class="w-100">
                        <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                    </div>
                </div>
                <div class="col-11">
                    <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">En esta sección podrá hacer ajustes en el
                        número final de los días a otorgar por colaborador(es), incrementando o reduciendo los días según
                        aplique.
                    </p>

                </div>
            </div>
        </div>


        @include('partials.flashMessages')
        <div class="card-body">
            <div class="row">
                @include('admin.incidentesDayoff.table')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(function() {

            // let btnAgregar = {
            //     text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
            //     titleAttr: 'Agregar excepción',
            //     url: "{{ route('admin.incidentes-dayoff.create') }}",
            //     className: "btn-xs btn-outline-success rounded ml-2 pr-3 agregar",
            //     action: function(e, dt, node, config) {
            //         let {
            //             url
            //         } = config;
            //         window.location.href = url;
            //     }
            // };
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

            // @can('incidentes_dayoff_crear')
            //     dtButtons.push(btnAgregar);
            // @endcan

            // dtButtons.push(btnExport);
            // dtButtons.push(btnImport);


            let dtOverrideGlobals = {
                // buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.incidentes-dayoff.index') }}",
                columns: [{
                        data: 'nombre',
                        name: 'nombre',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }

                    },

                    {
                        data: 'dias_aplicados',
                        name: 'dias_aplicados',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'aniversario',
                        name: 'aniversario',
                        render: function(data, type, row) {
                            let aniversario = row.aniversario;
                            console.log(aniversario);
                            if (aniversario == 0) {
                                return `<div style="text-align:left">0</div>`;
                            } else {
                                return `<div style="text-align:left">${data}</div>`;
                            }
                        }
                    },
                    {
                        data: 'efecto',
                        name: 'efecto',
                        render: function(data, type, row) {
                            if (data == 1) {
                                return `<div style="text-align:left">Sumar días</div>`;
                            } else {
                                return `<div style="text-align:left">Restar días</div>`;
                            }
                        }
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },

                    {
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            let html = `
                            <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.incidentes-dayoff.destroy', ['incidentes_dayoff' => 13]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                        <!-- Modal Body -->
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete item with ID:?</p>
                                        </div>
                                        <!-- Modal Footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger" id="confirmDelete">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ url('admin/incidentes-dayoff/${row.id}') }}">
                                            <i class="fa-solid fa-eye"></i>&nbsp;Ver</a>                            
                                        <a class="dropdown-item" href="{{ url('admin/incidentes-dayoff/${row.id}/edit') }}">
                                            <i class="fa-solid fa-pencil"></i>&nbsp;Editar</a>
                                        `;

                            html += `
                            <a class="dropdown-item delete-item" href="#" data-id="${row.id}" data-toggle="modal" data-target="#deleteConfirmationModal">
    <i class="fa-solid fa-trash"></i>&nbsp;Eliminar
</a>
                                        `;
                            // if (row.borrado === false) {
                            // } else {
                            //     html += `
                        //         <a class="dropdown-item disabled" href="#">
                        //             <i class="fa-solid fa-trash"></i>&nbsp;Eliminar (En uso)</a>
                        //     `;
                            // }

                            html += `</div></div>`;

                            return html;

                        },
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
            };
            let table = $('.datatable-incidentes-dayoff').DataTable(dtOverrideGlobals);
            $('.btn.buttons-print.btn-sm.rounded.pr-2').unbind().click(function() {
                let titulo_tabla = `
                <h5>
                    <strong>
                        Exepciones Day Off
                    </strong>
                </h5>
            `;
                imprimirTabla('datatable-incidentes-dayoff', titulo_tabla);
            });

        });
    </script>
@endsection
