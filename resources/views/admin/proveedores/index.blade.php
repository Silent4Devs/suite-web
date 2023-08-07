@extends('layouts.admin')
@section('content')
@section('titulo', 'Clientes')



@include('layouts.datatables_css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/botones.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/iconos.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/titulos.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/letra.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/formularios/organizacion.css') }}">
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

</style>

{{-- {{ Breadcrumbs::render('proveedores') }} --}}

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
                            <p class="instrucciones">En esta sección podrá dar de alta a los clientes que participarán dentro del flujo de contratos.</p>
                        </div>
                        {{-- @can('proveedores.create') --}}
                            <a class="right btn waves-effect waves-light btn-redondeado"
                                style=" margin: 13px 12px 12px 10px; " href="{{ route('admin.proveedores.create') }}"
                                type="submit" name="action">Agregar Cliente<i class="material-icons right">add</i></a>
                        {{-- @endcan --}}
                    </div>

                    @include('partials.flashMessages')

                </section>
                <div class="content">
                    <div class="clearfix"></div>

                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="row">
                                @include('admin.proveedores.table')
                            </div>
                        </div>
                    </div>
                    <div class="text-center">

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@include('layouts.datatables_js')

<script>
    $(document).ready(function() {
        $('#proveedores-table').DataTable({
            autoWidth: false,
            scrollX: true,
            stateSave: true,
            dom: 'lBfrtip',
            buttons: [{
                    extend: "copyHtml5",
                    text: "<i class='fa-solid fa-copy' title='Copiar'></i>",
                    titleAttr: "Copiar",
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'csvHtml5',
                    title: `Reporte de proveedores_${new Date().toLocaleDateString().trim()}`,
                    text: "<i class='fas fa-file-csv' style='font-size: 1.1rem'></i>",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Reporte de proveedores_${new Date().toLocaleDateString().trim()}`,
                    text:  "<i class='fas fa-file-excel' style='font-size: 1.1rem'></i>",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];

                        // Loop over the cells in column `C`
                        $('row c[r^="C"]', sheet).each(function() {
                            // Get the value
                            if ($('is t', this).text() == 'New York') {
                                $(this).attr('s', '20');
                            }
                        });
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Reporte de proveedores_${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
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
                                columns: [
                                    {
                                        alignment: 'left',
                                        italics: true,
                                        text: 'KATBOL',
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
                    },
                },
                // {
                //     extend: 'print',
                //     text: '<i class="material-symbols-outlined" >print</i>',

                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Imprimir',
                //     // set custom header when print
                //     customize: function(win) {
                //         let logo_actual = @json($logo_actual);
                //         let empresa_actual = @json($empresa_actual);

                //         var now = new Date();
                //         var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                //         $(win.document.body).prepend(`
                //             <div class="row">
                //                 <div class="col s4 m4" style="border:2px solid #CCCCCC">
                //                     <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                //                 </div>
                //                 <div class="col s4 m4" style="border:2px solid #CCCCCC">
                //                     <p>${empresa_actual}</p>
                //                     <strong style="color:#345183">EMPLEADOS: LISTA DE PROVEEDORES DE LA EMPRESA</strong>
                //                 </div>
                //                 <div class="col s4 m4" style="border:2px solid #CCCCCC">
                //                     Fecha: ${jsDate}
                //                 </div>
                //             </div>
                //         `);
                //         $(win.document.body).find('table')
                //             .css('font-size', '12px')
                //             .css('margin-top', '15px')
                //         .css('margin-bottom', '60px')
                //         $(win.document.body).find('th').each(function(index) {
                //             $(this).css('font-size', '18px');
                //             $(this).css('color', '#fff');
                //             $(this).css('background-color', 'blue');
                //         });
                //     },
                //     title: '',
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
                    extend: 'colvisRestore',
                    text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
                    titleAttr: 'Restaurar a estado anterior',
                }

            ],
            //  'copy', 'csv', 'excel', 'pdf', 'print'
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
            pageLength: 5,
            lengthMenu: [
                [5, 10, 20, -1],
                [5, 10, 20, "Todos"]
            ]
        });
        $('body').delegate('#proveedores-table tbody tr', "click", function() {
            if ($(this).hasClass('selected')) $(this).removeClass('selected');
            else {
                $(this).siblings('.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });
        $('.myBtn').hideme('#proveedores-table tbody tr', "click", function() {
            $('.hideMe.').hide();
        });
    });
</script>
@endsection
