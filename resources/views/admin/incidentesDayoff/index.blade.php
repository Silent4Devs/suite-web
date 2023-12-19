@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/vacaciones.css') }}">
@endsection
@section('content')
    {{ Breadcrumbs::render('Incidentes-dayoff') }}


    <h5 class=" titulo_general_funcion">Excepciones Day Off</h5>

    <div class="row">
        @can('incidentes_dayoff_crear')
            <div class="col-12 text-right">
                <a href="{{ route('admin.incidentes-dayoff.create') }}" type="button" class="btn btn-crear">Crear Excepción +</a>
            </div>
        @endcan
    </div>

    {{-- <div class="card">
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
        </div> --}}

    {{-- <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete item with ID: <span id="deleteItemId"></span>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                    </div>
                </div>
            </div>
        </div> --}}


    @include('partials.flashMessages')

    <div class="datatable-fix datatable-rds">
        @include('admin.incidentesDayoff.table')
    </div>
    {{-- </div> --}}
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

            let dtButtons = [

            ];

            let dtOverrideGlobals = {
                buttons: dtButtons,
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


                        data: 'actions',
                        name: '{{ trans('global.actions') }}'

                        // data: 'id',
                        // name: 'id',
                        // render: function(data, type, row, meta) {
                        //     let html = `
                    //         <div class="dropdown">
                    //             <button class="btn dropdown-toggle" type="button"
                    //                 data-toggle="dropdown" aria-expanded="false">
                    //                 <i class="fa-solid fa-ellipsis-vertical"></i>
                    //             </button>
                    //             <div class="dropdown-menu">
                    //                 <a class="dropdown-item" href="{{ url('admin/incidentes-dayoff/${row.id}') }}">
                    //                     <i class="fa-solid fa-eye"></i>&nbsp;Ver</a>
                    //                 <a class="dropdown-item" href="{{ url('admin/incidentes-dayoff/${row.id}/edit') }}">
                    //                     <i class="fa-solid fa-pencil"></i>&nbsp;Editar</a>
                    //                 `;

                        //     html += `
                    //     <a class="dropdown-item delete-item"
                    //     href="#"
                    //     data-id="${row.id}"
                    //     data-url="{{ url('admin/incidentes-dayoff/${row.id}') }}"
                    //     data-bs-toggle="modal"
                    //     data-bs-target="#deleteConfirmationModal">
                    //         <i class="fa-solid fa-trash"></i>&nbsp;Eliminar
                    //     </a>
                    //     `;

                        //     html += `</div > `;

                        //     return html;

                    },

                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
            };
            let table = $('.datatable-incidentes-dayoff').DataTable(dtOverrideGlobals);


        });
    </script>
@endsection
