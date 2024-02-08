@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/listainformativa.css') }}{{config('app.cssVersion')}}">
    @include('admin.listainformativa.estilos')
@endsection
@section('content')
    {{-- <div class="mt-3">
        {{ Breadcrumbs::render('Incidentes-Vacaciones') }}
    </div> --}}

    <div class="row">
        <h5 class="col-12 titulo_general_funcion">Lista Informativa</h5>
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
        </div>
        @can('incidentes_vacaciones_crear')
            <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12">
                    @include('csvImport.modal', [
                        'model' => 'Amenaza',
                        'route' => 'admin.amenazas.parseCsvImport',
                    ])
                </div>
            @endcan
        </div> --}}


    @include('partials.flashMessages')
    <div class="datatable-rds w-100">
        <h3 class="title-table-rds">Lista Informativa</h3>
        @include('admin.listainformativa.table')
    </div>

    {{-- </div> --}}
@endsection

{{-- @section('scripts')
    @parent
    <script>
        $(function() {
            // let btnAgregar = {
            //     text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
            //     titleAttr: 'Agregar Regla',
            //     url: "{{ route('admin.incidentes-vacaciones.create') }}",
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

            let dtButtons = [

            ];

            // @can('incidentes_vacaciones_crear')
            //     dtButtons.push(btnAgregar);
            // @endcan

            // dtButtons.push(btnExport);
            // dtButtons.push(btnImport);


            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.lista-informativa.index') }}",
                columns: [{
                        data: 'modulo',
                        name: 'modulo',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }

                    },
                    {
                        data: 'submodulo',
                        name: 'submodulo',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'participantes',
                        render: function(data, type, row, meta) {
                            let parsedData;
                            try {
                                parsedData = JSON.parse(data);
                            } catch (error) {
                                console.error('Error parsing JSON data:', error);
                                return '';
                            }

                            if (Array.isArray(parsedData)) {
                                let html = '<div class="row">'; // Opening div for the data
                                let displayedEmpleados = 0; // Counter for displayed empleados
                                let numeroParticipantes = 0;

                                parsedData.forEach(function(participante) {
                                    numeroParticipantes++;
                                    if (participante.empleado && displayedEmpleados < 3) {
                                        html +=
                                            `<div class="col-4">
                                                <img src="{{ asset('storage/empleados/imagenes') }}/${participante.empleado.avatar}" class="img_empleado" title="${participante.empleado.name}">
                                            </div>`;
                                        displayedEmpleados++;
                                    }
                                    // Add more empleado fields as needed
                                });

                                html += '</div>'; // Closing div for the data

                                if (numeroParticipantes > 3) {
                                    numeroParticipantes = numeroParticipantes - 3;
                                    html +=
                                        '<button type="button" class="btn btn-round ml-2" style="border-radius: 50%;  background-color: #fff8dc;   width: 30px; height: 30px; position:relative; left:10rem; top:-1rem;" data-bs-toggle="modal" data-bs-target="#exampleModal' +
                                        meta.row + '">+' + numeroParticipantes + '</button>';
                                }

                                return html;
                            }
                            return ''; // Return empty string if 'participantes' data is not an array
                        }
                    },
                    // {
                    //     data: 'actions',
                    //     name: '{{ trans('global.actions') }}'
                    // }
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return `
                            <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical" style="color: #000000;"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a href="/admin/lista-informativa/${data}/edit"
                                                    class="btn btn-sm" title="Editar"><i class="fa fa-edit"></i>&nbsp;
                                                    Editar</a></li>
                                            <li><a href="/admin/lista-informativa/${data}/show" class="btn btn-sm"
                                                    title="Visualizar"><i class="fa fa-eye"></i>&nbsp;Ver</a></li>
                                    </ul>
                                </div>`;
                        }
                    },
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
            };
            let table = $('.datatable-lista-informativa').DataTable(dtOverrideGlobals);
            // $('.btn.buttons-print.btn-sm.rounded.pr-2').unbind().click(function() {
            //     let titulo_tabla = `
        //     <h5>
        //         <strong>
        //             Vacaciones
        //         </strong>
        //     </h5>
        // `;
            //     imprimirTabla('datatable-lista-informativa', titulo_tabla);
            // });

        });
    </script>
@endsection --}}
