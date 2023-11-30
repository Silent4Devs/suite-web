@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/vacaciones.css') }}">
@endsection
@section('content')
    <div class="mt-3">
        {{ Breadcrumbs::render('Incidentes-Vacaciones') }}
    </div>

    @include('admin.incidentesVacaciones.estilos')



    <div class="row">
        <h5 class="col-12 titulo_general_funcion">Excepciones Vacaciones</h5>
    </div>

    <div class="row">
        @can('incidentes_vacaciones_crear')
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.incidentes-vacaciones.create') }}" type="button" class="btn btn-crear">Crear Excepción
                    +</a>
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
    <div class="datatable-fix datatable-rds">
        @include('admin.incidentesVacaciones.table')
    </div>

    {{-- </div> --}}
@endsection

@section('scripts')
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
                ajax: "{{ route('admin.incidentes-vacaciones.index') }}",
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
                            return `<div style="text-align:left">${data}</div>`;
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
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
            };
            let table = $('.datatable-incidentes-vacaciones').DataTable(dtOverrideGlobals);
            // $('.btn.buttons-print.btn-sm.rounded.pr-2').unbind().click(function() {
            //     let titulo_tabla = `
        //     <h5>
        //         <strong>
        //             Vacaciones
        //         </strong>
        //     </h5>
        // `;
            //     imprimirTabla('datatable-incidentes-vacaciones', titulo_tabla);
            // });

        });
    </script>
@endsection
