@extends('layouts.admin')
@section('content')
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

        .table tr td:nth-child(2) {
            text-align: justify !important;
        }

        .table tr th:nth-child(3) {
            text-align: center !important;
            min-width: 200px !important;
        }

        .table tr td:nth-child(4) {
            text-align: center !important;
        }

        .table tr th:nth-child(4) {
            width: 120px !important;
            max-width: 120px !important;
            min-width: 120px !important;
            text-align: center !important;
        }

        .table tr th:nth-child(2) {
            width: 400px !important;
            max-width: 500px !important;
            min-width: 100px !important;
            text-align: center !important;
        }


        .table tr td:nth-child(5) {
            max-width: 200px !important;
            min-width: 200px !important;
            width: 200px !important;
            text-align: center !important;
        }

        .table tr th:nth-child(5) {
            width: 200px !important;
            max-width: 200px !important;
            min-width: 200px !important;
            text-align: center !important;
        }

        .table tr td:nth-child(6) {
            max-width: 200px !important;
            min-width: 200px !important;
            width: 200px !important;
            text-align: center !important;
        }

        .table tr th:nth-child(6) {
            width: 200px !important;
            max-width: 200px !important;
            min-width: 200px !important;
            text-align: center !important;
        }

        .table tr td:nth-child(7) {
            max-width: 200px !important;
            min-width: 200px !important;
            width: 200px !important;
            text-align: center !important;
        }

        .table tr th:nth-child(7) {
            width: 200px !important;
            max-width: 200px !important;
            min-width: 200px !important;
            text-align: center !important;
        }

        .table tr td:nth-child(8) {
            max-width: 80px !important;
            min-width: 80px !important;
            width: 80px !important;
            text-align: center !important;
        }

        .table tr th:nth-child(8) {
            width: 80px !important;
            max-width: 80px !important;
            min-width: 80px !important;
            text-align: center !important;
        }

        .agregar {
            margin-right: 15px;
        }

        .radius {
            border-radius: 16px;
        }

        .titulo-card {

            text-align: left;
            font: 20px Roboto;
            color: #606060;
        }
    </style>

    {{ Breadcrumbs::render('admin.alcance-sgsis.index') }}
    @can('determinacion_alcance_agregar')
        <div class="row d-flex align-items-center">
            <h5 class="col-12 titulo_general_funcion">Determinación de Alcance</h5>
            <a type="button" class="col-md-2 btn btn-primary btn-lg ml-auto" style="margin-right: 14px; font-size: 14px;"
                href="{{ route('admin.alcance-sgsis.create') }}">
                Registrar Alcance</a>
        </div>
        <div class="mt-5 card radius">
            {{-- <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2 text-center text-white"><strong>Determinación de Alcance</strong></h3>
            </div> --}}
            <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12">
                    @include('csvImport.modalvulnerabilidad', [
                        'model' => 'Vulnerabilidad',
                        'route' => 'admin.vulnerabilidads.parseCsvImport',
                    ])
                </div>
            </div>
            {{-- <div style="margin-bottom: 10px; margin-left:10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.alcance-sgsis.create') }}">
                  Agregar <strong>+</strong>
            </a>
        </div>
    </div> --}}
        @endcan

        @include('partials.flashMessages')
        <div class="card-body datatable-fix radius">
            <div class="titulo-card">Alcance</div>
            <hr>
            <table class="table table-striped datatable-AlcanceSgsi">
                <thead class="thead-dark">
                    <tr>
                        <th style="max-width:300px !important;background-color:rgb(255, 255, 255); color:#414141;">Nombre
                            del Alcance</th>
                        <th style="min-width:200px; background-color:rgb(255, 255, 255); color:#414141;">Alcance</th>
                        <th class="d-flex justify-content-center"
                            style="max-width:80px;background-color:rgb(255, 255, 255); color:#414141;">
                            Estatus</th>
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
            //let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Alcance SGSIS ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Alcance SGSIS ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                // {
                //     extend: 'pdfHtml5',
                //     title: `Alcance SGSIS ${new Date().toLocaleDateString().trim()}`,
                //     text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Exportar PDF',
                //     orientation: 'portrait',
                //     exportOptions: {
                //         columns: ['th:not(:last-child):visible']
                //     },
                //     customize: function(doc) {
                //         // doc.pageMargins = [20, 60, 20, 30];
                //         // doc.styles.tableHeader.fontSize = 7.5;
                //         // doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10
                //     }
                // },
                {
                    extend: 'print',
                    title: `Alcance SGSIS ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
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
                                    <strong style="color:#345183">DETERMINACIÓN DE ALCANCE</strong>
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
            @can('determinacion_alcance_eliminar')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.alcance-sgsis.massDestroy') }}",
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

            @can('determinacion_alcance_agregar')
                let btnAgregar = {
                    text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                    titleAttr: 'Agregar alcance SGSIS',
                    url: "{{ route('admin.alcance-sgsis.create') }}",
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
                    url: "{{ route('descarga-determinacion_alcance') }}",
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
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.alcance-sgsis.index') }}",
                columns: [{
                        data: 'nombre',
                        name: 'nombre',
                    },
                    {
                        data: 'alcancesgsi',
                        name: 'alcancesgsi'
                    },
                    {
                        data: 'id_reviso_alcance',
                        name: 'id_reviso_alcance'
                    },
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ]
            };
            let table = $('.datatable-AlcanceSgsi').DataTable(dtOverrideGlobals);
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
