@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('cuestionario-AIA') }}

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
    </style>

    <h5 class="col-12 titulo_general_funcion">Cuestionario de Análisis de Impacto AIA</h5>



    <div class="mt-5 card">

        {{-- <a class="pr-3 ml-2 rounded btn btn-success" style=" margin: 13px 12px 12px 10px;"
        href="{{ route('admin.matriz-mapa.SistemaGestion', ['idAnalisis' => $id_matriz]) }}">Gráfica</a> --}}


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


        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 datatable datatable-analisis-impacto tblCSV"
                id="datatable-analisis-impacto">
                <thead class="thead-dark">
                    <tr>
                        <th style="min-width: 20px;">
                            ID
                        </th>
                        <th style="min-width: 200px;">
                            ID de la Aplicación
                        </th>
                        <th style="min-width: 200px;">
                            Nombre de la Aplicación:
                        </th>
                        <th style="min-width: 200px;">
                            Área:
                        </th>
                        <th style="min-width: 150px;">
                            Fecha de la entrevista:
                        </th>

                        <th style="min-width: 250px;">
                            Entrevistado:
                        </th>
                        <th style="min-width: 250px;">
                            Puesto:
                        </th>
                        <th style="min-width: 250px;">
                            Correo:
                        </th>
                        <th style="min-width: 25px;">
                            Extensión:
                        </th>
                        <th style="min-width: 100px;">
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
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar Cuestinoario',
                url: "{{ route('admin.analisis-aia.create') }}",
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

            @can('amenazas_agregar')
                dtButtons.push(btnAgregar);
            @endcan

            // dtButtons.push(btnExport);
            // dtButtons.push(btnImport);

            @can('amenazas_eliminar')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.analisis-aia.massDestroy') }}",
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
                //dtButtons.push(deleteButton)
            @endcan
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.analisis-aia.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'id_aplicacion',
                        name: 'id_aplicacion',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'nombre_aplicacion',
                        name: 'nombre_aplicacion',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },

                    {
                        data: 'area',
                        name: 'area',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'fecha_entrevista',
                        name: 'fecha_entrevista',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },

                    {
                        data: 'entrevistado',
                        name: 'entrevistado',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'puesto',
                        name: 'puesto',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'correo',
                        name: 'correo',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'extencion',
                        name: 'extencion',
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
            let table = $('.datatable-analisis-impacto').DataTable(dtOverrideGlobals);
            $('.btn.buttons-print.btn-sm.rounded.pr-2').unbind().click(function() {
                let titulo_tabla = `
                    <h5>
                        <strong>
                           Cuestionario Análisis de Impacto AIA
                        </strong>
                    </h5>
                `;
                imprimirTabla('datatable-analisis-impacto', titulo_tabla);
            });

        });
    </script>
@endsection
