@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.analisis-riesgos.index') }}


    <style>
        .btn-outline-success {
            background: #788bac !important;
            color: white;
            border: none;
        }

        .btn-outline-success:focus {
            border-color: #345183 !important;
            box-shadow: none;
        }

        .btn-outline-success:active {
            box-shadow: none !important;
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
            width: 35px;
            height: 35px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 !important;
            margin-right: 10px !important;
        }

        /* th {
                background-color: #345183;
                color: #ffff;

            } */

        .iconos-tabla {
            color: #fff;
            font-size: 10pt;

        }

        .iconos-top {

            margin-right: 5px;
            margin-top: 5px;
        }

        .table tr th:nth-child(4) {
            min-width: 80px !important;
            text-align: center !important;
        }

        .table tr td:nth-child(4) {
            text-align: center !important;
        }

        .agregar {
            margin-right: 15px;
        }

        .table tr td:nth-child(5) {

            text-align: center !important;

        }

        @media print {
            #tabla_blanca_imprimir_global {
                transform: scale(1.8);
                transform-origin: 0% 0%;
            }
        }
    </style>

    <h5 class="col-12 titulo_general_funcion">Matriz de Riesgo </h5>
    <div class="mt-5 card">
        @include('partials.flashMessages')
        @can('matriz_de_riesgo_agregar')
            <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12">
                    @include('csvImport.modalmatrizriesgo', [
                        'model' => 'Amenaza',
                        'route' => 'admin.amenazas.parseCsvImport',
                    ])
                </div>
            </div>
        @endcan

        {{-- <div style="margin-bottom:10px; margin-left:12px;" class="row">
                  <div class="col-lg-12">
                      <a class="btn btn-success" href="{{ route('admin.matriz-riesgos.create') }}">
                          Agregar Riesgo
                      </a>
                  </div>
              </div> --}}


        <div class="card-body datatable-fix">
            <table class=" w-100 datatable-rds datatable-AnalisisRiesgo tblCSV" id="datatable-AnalisisRiesgo">
                <thead>
                    <tr>
                        <th style="min-width: 40px;">
                            ID
                        </th>
                        <th style="min-width: 150px;">
                            Nombre
                        </th>
                        <th style="min-width: 150px;">
                            Tipo
                        </th>
                        <th style="min-width: 100px;">
                            Fecha
                        </th>
                        <th style="min-width: 100px;">
                            %&nbsp;Implementación
                        </th>
                        <th style="min-width: 200px;">
                            Elaboró
                        </th>
                        <th style="min-width: 100px;">
                            Estatus
                        </th>
                        <th style="min-width: 50px;" class="print-none">
                            Matriz
                        </th>
                        <th style="min-width: 40px;" class="print-none">
                            Opciones
                        </th>
                    </tr>

                </thead>
            </table>
        </div>
    </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            //let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Analisis de Riesgo ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Analisis de Riesgo ${new Date().toLocaleDateString().trim()}`,
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
                                        <strong style="color:#345183">Matriz de Riesgos</strong>
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
            @can('matriz_de_riesgo_eliminar')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.analisis-riesgos.massDestroy') }}",
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
            @endcan


            let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar nuevo analisis de riesgos',
                url: "{{ route('admin.analisis-riesgos.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3 agregar",
                action: function(e, dt, node, config) {
                    let {
                        url
                    } = config;
                    window.location.href = url;
                }
            };
            let btnExport = {
                text: '<i  class="fas fa-download"></i>',
                titleAttr: 'Descargar plantilla',
                className: "btn btn_cargar",
                url: "{{ route('descarga-analisis_riego') }}",
                action: function(e, dt, node, config) {
                    let {
                        url
                    } = config;
                    window.location.href = url;
                }
            };
            let btnImport = {
                text: '<i  class="fas fa-file-upload"></i>',
                titleAttr: 'Importar datos',
                className: "btn btn_cargar",
                action: function(e, dt, node, config) {
                    $('#xlsxImportModal').modal('show');
                }
            };

            @can('matriz_de_riesgo_agregar')
                dtButtons.push(btnAgregar);
            @endcan

            dtButtons.push(btnExport);
            dtButtons.push(btnImport);


            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                dom: "<'row align-items-center justify-content-center'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-6 col-lg-6'B><'col-md-3 col-12 col-sm-12 m-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",
                ajax: "{{ route('admin.analisis-riesgos.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'nombre',
                        name: 'nombre',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'tipo',
                        name: 'tipo',
                        render: function(data, type, row, meta) {
                            const tipo = row.tipo;
                            if (tipo == 'Análisis de riesgo integral') {
                                return `<div style="text-align:left">Análisis de Riesgo Integral (ISO 27001,9001,20000)</div>`;
                            }
                            if (tipo == 'Seguridad de la información') {
                                return `<div style="text-align:left">ISO 27001</div>`;
                            } else {
                                return `<div style="text-align:left">${data}</div>`;
                            }
                        }
                    },
                    {
                        data: 'fecha',
                        name: 'fecha',
                        render: function(data, type, row) {
                            return `<div style="text-align:center">${data}</div>`;
                        }

                    },
                    {
                        data: 'porcentaje_implementacion',
                        name: 'porcentaje_implementacion',
                        render: function(data, type, row) {
                            const porcentaje = row.porcentaje_implementacion;
                            if (porcentaje == 0) {
                                return `<div style="text-align:center">Sin evaluar</div>`;
                            } else {
                                return `<div style="text-align:center">${data} %</div>`;
                            }
                        }

                    },
                    {
                        data: 'elaboro',
                        name: 'elaboro',
                        render: function(data, type, row, meta) {
                            const elaboro = row.elaboro;
                            if (elaboro == 0) {
                                return `<div style="text-align:left">No se ha asociado colaborador</div>`;
                            } else {
                                return `<div style="text-align:left">${data}</div>`;
                            }
                        }

                    },
                    {
                        data: 'estatus',
                        name: 'estatus',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'enlace',
                        name: 'enlace',
                        render: function(data, type, row, meta) {
                            console.log(row.tipo);
                            const tipo = row.tipo;
                            switch (tipo) {
                                case 'Seguridad de la información':
                                    return `
                            <div class="text-center w-100" style="text-align:center">
                                @can('matriz_de_riesgo_vinculo')
                                    <a href="matriz-seguridad/?id=${data}" target="_blank"><i class="fas fa-table fa-2x text-info"></i></a>
                                @endcan
                            </div>
                            `;
                                    break;
                                case 'Análisis de riesgo integral':
                                    return `
                            <div class="text-center w-100" style="text-align:center">
                                @can('matriz_de_riesgo_vinculo')
                                    <a href="matriz-seguridad/sistema-gestion/?id=${data}" target="_blank"><i class="fas fa-table fa-2x text-info"></i></a>
                                @endcan
                            </div>
                            `;
                                    break;
                                case 'OCTAVE':
                                    return `
                                <div class="text-center w-100" style="text-align:center">
                                    @can('matriz_de_riesgo_vinculo')
                                    <a href="procesos-octave/${data}" target="_blank"><i class="fas fa-table fa-2x text-info"></i></a>
                                    @endcan
                                </div>
                            `;
                                    break;
                                case 'ISO 31000':
                                    return `
                            <div class="text-center w-100" style="text-align:center">
                                @can('matriz_de_riesgo_vinculo')
                                <a href="matriz-seguridad/ISO31000/?id=${data}" target="_blank"><i class="fas fa-table fa-2x text-info"></i></a>
                                @endcan
                            </div>
                            `;
                                    break;
                                case 'NIST':
                                    return `
                            <div class="text-center w-100" style="text-align:center">
                                @can('matriz_de_riesgo_vinculo')
                                <a href="matriz-seguridad/NIST/?id=${data}" target="_blank"><i class="fas fa-table fa-2x text-info"></i></a>
                                @endcan
                            </div>
                            `;
                                default:
                                    return `
                             <div class="w-100" style="text-align:left">No se encuentran coincidencias</div>
                            `;
                            }
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
                ]
            };
            let table = $('.datatable-AnalisisRiesgo').DataTable(dtOverrideGlobals);
            $('.btn.buttons-print.btn-sm.rounded.pr-2').unbind().click(function() {
                let titulo_tabla = `
                    <h5>
                        <strong>
                            Timesheet:
                        </strong>
                        <font style="font-weight: lighter;">
                            Matriz de Riesgos
                        </font>
                    </h5>
                `;
                imprimirTabla('datatable-AnalisisRiesgo', titulo_tabla);
            });
            // $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
            //     $($.fn.dataTable.tables(true)).DataTable()
            //         .columns.adjust();
            // });
            // $('.datatable thead').on('input', '.search', function() {
            //     let strict = $(this).attr('strict') || false
            //     let value = strict && this.value ? "^" + this.value + "$" : this.value
            //     table
            //         .column($(this).parent().index())
            //         .search(value, strict)
            //         .draw()
            // });
        });
    </script>
@endsection
