@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Configurar Soporte</h5>
    <div class="mt-5 card">
        {{-- <div style="margin-bottom: 10px; margin-left:10px;" class="row">
        <div class="col-lg-12">
            @include('csvImport.modalpartesinteresadas', ['model' => 'Amenaza', 'route' => 'admin.amenazas.parseCsvImport'])
        </div>
    </div> --}}

        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8 align-content-center">
                    @include('layouts.errors')

                </div>
                <div class="col-sm-2">
                </div>
            </div>
        </div>
        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table datatable-ConfSoporte " style="width: 100%">
                <thead class="thead-dark dt-personalizada">
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Rol
                        </th>
                        <th style="min-width:200px;">
                            Nombre
                        </th>
                        <th style="min-width:200px;">
                            Puesto
                        </th>
                        <th>
                            Teléfono
                        </th>
                        <th>
                            Extensión
                        </th>
                        <th>
                            Tel. Celular
                        </th>
                        <th>
                            Correo
                        </th>
                        <th>
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
            //let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Reporte de soporte ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Reporte de soporte ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Reporte de soporte ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    /*customize: function(doc) {
                        //Remove the title created by datatTables
                        doc.content.splice(0, 1);
                        //Create a date string that we use in the footer. Format is dd-mm-yyyy
                        var now = new Date();
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now
                            .getFullYear();
                        // Logo converted to base64
                        // var logo = getBase64FromImageUrl('https://datatables.net/media/images/logo.png');
                        // The above call should work, but not when called from codepen.io
                        // So we use a online converter and paste the string in.
                        // Done on http://codebeautify.org/image-to-base64-converter
                        // It's a LONG string scroll down to see the rest of the code !!!
                        var logo =
                            'data:image/png;base64,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';
                        // A documentation reference can be found at
                        // https://github.com/bpampuch/pdfmake#getting-started
                        // Set page margins [left,top,right,bottom] or [horizontal,vertical]
                        // or one number for equal spread
                        // It's important to create enough space at the top for a header !!!
                        doc.pageMargins = [10, 60, 10, 30];
                        // Set the font size fot the entire document
                        doc.defaultStyle.fontSize = 6;
                        // Set the fontsize for the table header
                        doc.styles.tableHeader.fontSize = 6;
                        // Create a header object with 3 columns
                        // Left side: Logo
                        // Middle: brandname
                        // Right side: A document title
                        doc['header'] = (function() {
                            return {
                                columns: [{
                                        image: logo,
                                        width: 32
                                    },
                                    {
                                        alignment: 'left',
                                        italics: true,
                                        text: 'Senado de la República',
                                        fontSize: 18,
                                        margin: [10, 0]
                                    },
                                    {
                                        alignment: 'right',
                                        fontSize: 14,
                                        text: 'Reporte de proveedores'
                                    }
                                ],
                                margin: 20
                            }
                        });
                        // Create a footer object with 2 columns
                        // Left side: report creation date
                        // Right side: current page and total pages
                        doc['footer'] = (function(page, pages) {
                            return {
                                columns: [{
                                        alignment: 'left',
                                        text: ['Fecha de creación: ', {
                                            text: jsDate.toString()
                                        }]
                                    },
                                    {
                                        alignment: 'right',
                                        text: ['Página ', {
                                            text: page.toString()
                                        }, ' de ', {
                                            text: pages.toString()
                                        }]
                                    }
                                ],
                                margin: 20
                            }
                        });
                        // Change dataTable layout (Table styling)
                        // To use predefined layouts uncomment the line below and comment the custom lines below
                        // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
                        var objLayout = {};
                        objLayout['hLineWidth'] = function(i) {
                            return .5;
                        };
                        objLayout['vLineWidth'] = function(i) {
                            return .5;
                        };
                        objLayout['hLineColor'] = function(i) {
                            return '#aaa';
                        };
                        objLayout['vLineColor'] = function(i) {
                            return '#aaa';
                        };
                        objLayout['paddingLeft'] = function(i) {
                            return 4;
                        };
                        objLayout['paddingRight'] = function(i) {
                            return 4;
                        };
                        doc.content[0].layout = objLayout;
                    },*/
                },
                {
                    extend: 'print',
                    title: `Reporte de soporte ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
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


            @can('configurar_soporte_agregar')
                let btnAgregar = {
                    text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                    titleAttr: 'Agregar nueva parte interesada',
                    url: "{{ route('admin.configurar-soporte.create') }}",
                    className: "btn-xs btn-outline-success rounded ml-2 pr-3 agregar",
                    action: function(e, dt, node, config) {
                        let {
                            url
                        } = config;
                        window.location.href = url;
                    }
                };
                dtButtons.push(btnAgregar);
            @endcan

            let dtOverrideGlobals = {
                buttons: [dtButtons],
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                dom: "<'row align-items-center justify-content-center'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-6 col-lg-6'B><'col-md-3 col-12 col-sm-12 m-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",
                ajax: "{{ route('admin.configurar-soporte.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'rol',
                        name: 'rol'
                    },
                    {
                        data: 'id_elaboro',
                        name: 'id_elaboro'
                    },
                    {
                        data: 'puesto',
                        name: 'puesto'
                    },
                    {
                        data: 'telefono',
                        name: 'telefono'
                    },
                    {
                        data: 'extension',
                        name: 'extension'
                    },
                    {
                        data: 'tel_celular',
                        name: 'tel_celular'
                    },
                    {
                        data: 'correo',
                        name: 'correo'
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
                //pageLength: 100,
            };
            let table = $('.datatable-ConfSoporte').DataTable(dtOverrideGlobals);
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
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
