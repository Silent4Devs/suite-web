@extends('layouts.admin')

@section('content')

@section('titulo', 'Contratos')


@include('layouts.datatables_css')
<link rel="stylesheet" type="text/css" href="{{asset('css/botones.css')}}">
<style>
    div.dt-button-collection {
        max-height: 60vh;
        overflow-y: scroll;
    }

    a.dt-button.dropdown-item.buttons-columnVisibility.active {
        background: #f0f0f1 !important;
        box-shadow: none !important;
    }

    a.dt-button.dropdown-item.buttons-columnVisibility.active {
        background: #4c52fd !important;
        box-shadow: none !important;
        color: white;
    }

    .tabs .tab a {
    background-color: transparent;
    color: #4c52fd !important;
    border-bottom:1px solid #ccc;
    }

    .tabs .tab a:hover, .tabs .tab a.active {
    background-color: transparent;
    color: #4c52fd !important;
    }

    .tabs .indicator {
        background-color: blue !important;
    }

</style>
{{-- {{ Breadcrumbs::render('contratos') }} --}}
<div class="row">
    <div class="col s12 m12">
        <div class="card z-depth-3">
            <div class="card-content">
                <section class="content-header">
                    <span class="card-title">
                    </span>
                    <div class='btn-group'>
                    <div class="col s8" style="margin-bottom: 30px;">
                        <h3 class="titulo-form">INSTRUCCIONES</h3>
                        <p class="instrucciones">En esta sección podrá dar de alta los contratos de esta organización.</p>
                    </div>
                      {{-- @can ('contratos.create') --}}
                        @if ($areas->count() > 0)
                            <a class="btn btn-success" style=" margin: 13px 12px 12px 10px; "href="{{ route('admin.contratos-katbol.create') }}" type="submit" name="action">Agregar Contrato <sup>+</sup></a>
                        @else
                            <a class="right btn waves-effect waves-light btn-redondeado" style=" margin: 13px 12px 12px 10px; "href="#" type="submit" name="action"> Antes de crear un contrato se necesita registrar proveedores y áreas <i class="material-icons right">add</i></a>
                        @endif
                      {{-- @endcan --}}
                    </div>
                </section>
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="contratos" role="tablist">
                                <a class="nav-link active" id="nav-contarea-tab" data-type="contexto" data-toggle="tab"
                                    href="#nav-contarea" role="tab" aria-controls="nav-contarea" aria-selected="true">
                                    <i class="fa-regular fa-file-lines"></i>
                                    Contratos del Área
                                </a>
                            {{-- @can ('contratos.create') --}}
                                <a class="nav-link" id="nav-contorg-tab" data-type="liderazgo" data-toggle="tab"
                                    href="#nav-contorg" role="tab" aria-controls="nav-contorg" aria-selected="false">
                                    <i class="fa-regular fa-file-lines"></i>
                                    Contratos de la Organización
                                </a>
                            {{-- @endcan --}}
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane mb-4 fade show active" id="nav-contarea" role="tabpanel"
                            aria-labelledby="nav-contarea-tab">
                            @include('admin.contratos-katbol.table')
                        </div>
                        <div class="tab-pane mb-4 fade" id="nav-contorg" role="tabpanel" aria-labelledby="nav-contorg-tab">
                            @include('admin.contratos-katbol.table_all')
                        </div>
                    </div>
                </div>
            </div>

                            {{-- @can ('contratos.create') --}}
                            {{-- @endcan --}}

                            <div class="text-center">

                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>
@endsection


@section('scripts')
    @include('layouts.datatables_js')
    <script>
        $(document).ready( function () {
        let table = $('#contratos-table').DataTable({
            autoWidth: false,
            "scrollX": true,
            columnDefs: [
                { targets: [0, 1], visible: true},
            ],
            stateSave: true,
            dom: 'lBfrtip',
            buttons: [
                {
                    extend: "copyHtml5",
                    text: "<i class='fa-solid fa-copy' title='Copiar'></i>",
                    titleAttr: "Copiar",
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend:    'csvHtml5',
                    title:`Reporte de contratos_${new Date().toLocaleDateString().trim()}`,
                    text: "<i class='fas fa-file-csv' style='font-size: 1.1rem'></i>",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title:`Reporte de contratos_${new Date().toLocaleDateString().trim()}`,
                    text: "<i class='fas fa-file-excel' style='font-size: 1.1rem'></i>",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];

                        // Loop over the cells in column `C`
                        $('row c[r^="C"]', sheet).each( function () {
                            // Get the value
                            if ( $('is t', this).text() == 'New York' ) {
                                $(this).attr( 's', '20' );
                            }
                    });
                    }
                },
                {
                    extend:    'pdfHtml5',
                    title:`Reporte de contratos_${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    customize: function (doc) {
						//Remove the title created by datatTables
						doc.content.splice(0,1);
						//Create a date string that we use in the footer. Format is dd-mm-yyyy
						var now = new Date();
						var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
						// Logo converted to base64
						// var logo = getBase64FromImageUrl('https://datatables.net/media/images/logo.png');
						// The above call should work, but not when called from codepen.io
						// So we use a online converter and paste the string in.
						// Done on http://codebeautify.org/image-to-base64-converter
						// It's a LONG string scroll down to see the rest of the code !!!

						// A documentation reference can be found at
						// https://github.com/bpampuch/pdfmake#getting-started
						// Set page margins [left,top,right,bottom] or [horizontal,vertical]
						// or one number for equal spread
						// It's important to create enough space at the top for a header !!!
						doc.pageMargins = [10,60,10,30];
						// Set the font size fot the entire document
						doc.defaultStyle.fontSize = 6;
						// Set the fontsize for the table header
						doc.styles.tableHeader.fontSize = 6;
						// Create a header object with 3 columns
						// Left side: Logo
						// Middle: brandname
						// Right side: A document title
						doc['header']=(function() {
							return {
								columns: [
									{
										alignment: 'left',
										italics: true,
										text: 'KATBOL',
										fontSize: 18,
										margin: [10,0]
									},
									{
										alignment: 'right',
										fontSize: 14,
										text: 'Reporte de contratos'
									}
								],
								margin: 20
							}
						});
						// Create a footer object with 2 columns
						// Left side: report creation date
						// Right side: current page and total pages
						doc['footer']=(function(page, pages) {
							return {
								columns: [
									{
										alignment: 'left',
										text: ['Fecha de creación: ', { text: jsDate.toString() }]
									},
									{
										alignment: 'right',
										text: ['Página ', { text: page.toString() },	' de ',	{ text: pages.toString() }]
									}
								],
								margin: 20
							}
						});
						// Change dataTable layout (Table styling)
						// To use predefined layouts uncomment the line below and comment the custom lines below
						// doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
						var objLayout = {};
						objLayout['hLineWidth'] = function(i) { return .5; };
						objLayout['vLineWidth'] = function(i) { return .5; };
						objLayout['hLineColor'] = function(i) { return '#aaa'; };
						objLayout['vLineColor'] = function(i) { return '#aaa'; };
						objLayout['paddingLeft'] = function(i) { return 4; };
						objLayout['paddingRight'] = function(i) { return 4; };
						doc.content[0].layout = objLayout;
				    },
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                // {
                //     extend: 'print',
                //     title: `Reporte de gestión de contratos_${new Date().toLocaleDateString().trim()}`,
                //     text: '<i class="material-symbols-outlined" >print</i>',
                //     titleAttr: 'Imprimir',
                //     layout: 'landscape',
                //     //autoPrint:false,
                //     customize: function (win) {
                //         $(win.document.body).find('table').addClass('display').css('font-size', '10px')
                //         .prepend(
                //             `<img src="{{asset('img/logo_katbol.png')}}"
                //                 style="position:absolute; top:0; left: 50%; transform: translate(-50%,0);opacity: 0.07;"/>`
                //         );
                //         $(win.document.body).find('tr:nth-child(odd) td').each(function(index){
                //             $(this).css('background-color','#D0D0D0');
                //         });

                //         $(win.document.body).find('h1').css('font-weight', 'bold');
                //         $(win.document.body).find('h1').css('font-size', '18px');
                //         $(win.document.body).find('h1').css('text-align','center');
                //     },
                //     exportOptions: {
                //         columns: ['th:not(:last-child):visible']
                //     }
                // },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
                    titleAttr: 'Seleccionar Columnas',
                    // prefixButtons:[

                    // ]
                },
                // {
                //     extend: 'colvisGroup',
                //     text: '<i class="fas fa-eye-slash"></i>',
                //     hide: ':visible',
                //     titleAttr: 'Esconder todo',
                // },
                {
                    extend: 'colvisGroup',
                    text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
                    show: ':hidden',
                    titleAttr: 'Ver todo',
                },
                {
                    extend:'colvisRestore',
                    text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
                    titleAttr: 'Restaurar a estado anterior',
                }
            ],
            language: {
                decimal: "",
                emptyTable: "No hay registros",
                info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                infoEmpty: "Mostrando 0 to 0 of 0 registros",
                infoFiltered: "(Filtrado de _MAX_ total registros)",
                infoPostFix: "",
                thousands: ",",
                lengthMenu: "Mostrar _MENU_ registros",
                loadingRecords: "Cargando...",
                processing: "Procesando...",
                search: "Buscar:",
                zeroRecords: "Sin resultados encontrados",
                paginate: {
                    first: "Primero",
                    last: "Ultimo",
                    next: "Siguiente",
                    previous: "Anterior",
                },
            },
        });
        //table.columns( [0,1,2] ).visible( false );
        } );
    </script>

    <script>
        $(document).ready( function () {
        let table = $('#contratos-table-all').DataTable({
            autoWidth: false,
            "scrollX": true,
            columnDefs: [
                { targets: [0, 1], visible: true},
            ],
            stateSave: true,
            dom: 'lBfrtip',
            buttons: [
                {
                    extend: "copyHtml5",
                    text: "<i class='fa-solid fa-copy' title='Copiar'></i>",
                    titleAttr: "Copiar",
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend:    'csvHtml5',
                    title:`Reporte de contratos_${new Date().toLocaleDateString().trim()}`,
                    text:      "<i class='fas fa-file-csv' style='font-size: 1.1rem'></i>",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title:`Reporte de contratos_${new Date().toLocaleDateString().trim()}`,
                    text: "<i class='fas fa-file-excel' style='font-size: 1.1rem'></i>",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];

                        // Loop over the cells in column `C`
                        $('row c[r^="C"]', sheet).each( function () {
                            // Get the value
                            if ( $('is t', this).text() == 'New York' ) {
                                $(this).attr( 's', '20' );
                            }
                    });
                    }
                },
                {
                    extend:    'pdfHtml5',
                    title:`Reporte de contratos_${new Date().toLocaleDateString().trim()}`,
                    text:      '<i class="fa fa-file-pdf-o"></i>',
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    customize: function (doc) {
                        //Remove the title created by datatTables
                        doc.content.splice(0,1);
                        //Create a date string that we use in the footer. Format is dd-mm-yyyy
                        var now = new Date();
                        var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
                        // Logo converted to base64
                        // var logo = getBase64FromImageUrl('https://datatables.net/media/images/logo.png');
                        // The above call should work, but not when called from codepen.io
                        // So we use a online converter and paste the string in.
                        // Done on http://codebeautify.org/image-to-base64-converter
                        // It's a LONG string scroll down to see the rest of the code !!!

                        // A documentation reference can be found at
                        // https://github.com/bpampuch/pdfmake#getting-started
                        // Set page margins [left,top,right,bottom] or [horizontal,vertical]
                        // or one number for equal spread
                        // It's important to create enough space at the top for a header !!!
                        doc.pageMargins = [10,60,10,30];
                        // Set the font size fot the entire document
                        doc.defaultStyle.fontSize = 6;
                        // Set the fontsize for the table header
                        doc.styles.tableHeader.fontSize = 6;
                        // Create a header object with 3 columns
                        // Left side: Logo
                        // Middle: brandname
                        // Right side: A document title
                        doc['header']=(function() {
                            return {
                                columns: [
                                    {
                                        alignment: 'left',
                                        italics: true,
                                        text: 'KATBOL',
                                        fontSize: 18,
                                        margin: [10,0]
                                    },
                                    {
                                        alignment: 'right',
                                        fontSize: 14,
                                        text: 'Reporte de contratos'
                                    }
                                ],
                                margin: 20
                            }
                        });
                        // Create a footer object with 2 columns
                        // Left side: report creation date
                        // Right side: current page and total pages
                        doc['footer']=(function(page, pages) {
                            return {
                                columns: [
                                    {
                                        alignment: 'left',
                                        text: ['Fecha de creación: ', { text: jsDate.toString() }]
                                    },
                                    {
                                        alignment: 'right',
                                        text: ['Página ', { text: page.toString() },    ' de ', { text: pages.toString() }]
                                    }
                                ],
                                margin: 20
                            }
                        });
                        // Change dataTable layout (Table styling)
                        // To use predefined layouts uncomment the line below and comment the custom lines below
                        // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
                        var objLayout = {};
                        objLayout['hLineWidth'] = function(i) { return .5; };
                        objLayout['vLineWidth'] = function(i) { return .5; };
                        objLayout['hLineColor'] = function(i) { return '#aaa'; };
                        objLayout['vLineColor'] = function(i) { return '#aaa'; };
                        objLayout['paddingLeft'] = function(i) { return 4; };
                        objLayout['paddingRight'] = function(i) { return 4; };
                        doc.content[0].layout = objLayout;
                    },
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                // {
                //     extend: 'print',
                //     title: `Reporte de gestión de contratos_${new Date().toLocaleDateString().trim()}`,
                //     text: '<i class="material-symbols-outlined" >print</i>',
                //     titleAttr: 'Imprimir',
                //     layout: 'landscape',
                //     //autoPrint:false,
                //     customize: function (win) {
                //         $(win.document.body).find('table').addClass('display').css('font-size', '10px')
                //         .prepend(
                //             `<img src="{{asset('img/logo_katbol.png')}}"
                //                 style="position:absolute; top:0; left: 50%; transform: translate(-50%,0);opacity: 0.07;"/>`
                //         );
                //         $(win.document.body).find('tr:nth-child(odd) td').each(function(index){
                //             $(this).css('background-color','#D0D0D0');
                //         });

                //         $(win.document.body).find('h1').css('font-weight', 'bold');
                //         $(win.document.body).find('h1').css('font-size', '18px');
                //         $(win.document.body).find('h1').css('text-align','center');
                //     },
                //     exportOptions: {
                //         columns: ['th:not(:last-child):visible']
                //     }
                // },
                {
                    extend: 'colvis',
                    text:  '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
                    titleAttr: 'Seleccionar Columnas',
                    // prefixButtons:[

                    // ]
                },
                // {
                //     extend: 'colvisGroup',
                //     text: '<i class="fas fa-eye-slash"></i>',
                //     hide: ':visible',
                //     titleAttr: 'Esconder todo',
                // },
                {
                    extend: 'colvisGroup',
                    text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
                    show: ':hidden',
                    titleAttr: 'Ver todo',
                },
                {
                    extend:'colvisRestore',
                    text:'<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
                    titleAttr: 'Restaurar a estado anterior',
                }
            ],
            language: {
                decimal: "",
                emptyTable: "No hay registros",
                info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                infoEmpty: "Mostrando 0 to 0 of 0 registros",
                infoFiltered: "(Filtrado de _MAX_ total registros)",
                infoPostFix: "",
                thousands: ",",
                lengthMenu: "Mostrar _MENU_ registros",
                loadingRecords: "Cargando...",
                processing: "Procesando...",
                search: "Buscar:",
                zeroRecords: "Sin resultados encontrados",
                paginate: {
                    first: "Primero",
                    last: "Ultimo",
                    next: "Siguiente",
                    previous: "Anterior",
                },
            },
        });
        //table.columns( [0,1,2] ).visible( false );
        } );
    </script>

    <script>
        $("#dolares_filtro").select2('destroy');
    </script>
@endsection

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script src="https://unpkg.com/jspdf-autotable@3.5.14/dist/jspdf.plugin.autotable.js"></script>
<script src="https://rawcdn.githack.com/FuriosoJack/TableHTMLExport/v2.0.0/src/tableHTMLExport.js"></script>
<script>
    $("#json").on("click", function () {
        $("#contratos-table").tableHTMLExport({type: "json", filename: "sample.json", ignoreColumns:'.botones_accion'});
    });
    $("#csv").on("click", function () {
        $("#contratos-table").tableHTMLExport({ type: "csv", filename: "sample.csv",ignoreColumns:'.botones_accion'});
    });
    $("#pdf").on("click", function () {
        $("#contratos-table").tableHTMLExport({type:'pdf',filename:'sample.pdf',ignoreColumns:'.botones_accion'});
    });
    $("#txt").on("click", function () {
        $("#contratos-table").tableHTMLExport({ type: "txt", filename: "sample.txt", ignoreColumns:'.botones_accion'});
    });
</script> --}}


