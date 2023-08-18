@extends('layouts.admin')
@section('content')
@section('titulo', 'Requisiciones')

<style>
    table{
    table-layout: fixed;
    width: 250px;
   }

   th, td {
    border: 1px solid blue;
    width: 100px;
    word-wrap: break-word
    }
</style>
<div class="card card-content">
    <div class="col s8" style="margin-bottom: 30px;">
        <div style="display:flex; justify-content:space-between;">
            <h3 class="titulo-form">INSTRUCCIONES</h3>
            <div style="display:flex; justify-content:flex-end; gap:10px; align-items:center;">
                <a class="btn" style="background-color: #959595 !important;" href="{{ route('requisiciones.archivo') }}"
                    type="submit" name="action">Archivo <i class="material-icons right">inventory_2</i></a>
                <a class="right btn waves-effect waves-light btn-redondeado" style=" margin: 13px 12px 12px 10px; "
                    href="{{ route('requisiciones.create') }}" type="submit" name="action">Agregar Requisicion<i
                        class="material-icons right">add</i></a>
            </div>
        </div>
        <p class="instrucciones">En esta sección podrá dar de alta a las requisiciones.</p>
    </div>
    <div class="text-end row">

    </div>
    <div class="row datatable-fix caja_tabla_responsiva" style="margin-top:30px;">
        <table id="requisiciones-table">
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Fecha De Solicitud</th>
                    <th>Referencia</th>
                    <th>Producto</th>
                    <th>Proveedor</th>
                    <th>Estatus</th>
                    <th>Proyecto</th>
                    <th>Área que Solicita</th>
                    <th>Solicitante</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @isset($requisiciones)
                    @foreach ($requisiciones as $requisicion)
                    <tr>
                        <td  >{{ $requisicion->folio }}</td>
                        <td>{{ date('d-m-Y', strtotime($requisicion->fecha)) }}</td>
                        <td>{{$requisicion->referencia}}</td>
                        <td>
                            @foreach($requisicion->productos_requisiciones as $producto)
                                {{$producto->producto->descripcion}}
                            @endforeach
                        </td>
                        <td>
                          @if ($requisicion->proveedor_catalogo  != null)
                          {{ $requisicion->proveedor_catalogo  }}
                          @endif

                          @if ($proveedor_indistinto)
                               <h1>indistinto</h1>
                          @endif



                            @foreach($requisicion->provedores_requisiciones as $proveedor)
                                {{$proveedor->proveedor}}
                                <br>
                                @if($proveedor->cotizacion)
                                    <a href="{{ asset('storage/cotizaciones_requisiciones_proveedores/'. $proveedor->cotizacion) }}" style="text-decoration: underline; color: deepskyblue;" target="_blank">
                                        Descargar cotización <i class="fa-regular fa-circle-down"></i>
                                    </a>
                                @else
                                    <i style="color: #959595;"> Sin cotización </i>
                                @endif
                                <br>
                                <br>
                                <hr>
                                <br>
                            @endforeach
                        </td>
                        <td>
                            <div class="flex" style="justify-content:center; gap:20px; align-items:center;">
                                @if ($requisicion->estado == 'curso')
                                <span style="color:blue" class="aprobado">En Curso</span>
                                @endif
                                @if ($requisicion->estado == 'rechazado')
                                    <span style="color:yellow" class="aprobado">Rechazada</span>
                                @endif

                                @if ($requisicion->estado == 'firma_requisicion')
                                <span style="color:green" class="aprobado">Firmada</span>
                                @endif

                                @if ($requisicion->estado == 'firmada_final')
                                <span style="color:green" class="aprobado">Firmada</span>
                                @endif

                                @if ($requisicion->estado == 'cancelada')
                                    <span style="color:red" class="cancelada">Cancelada</span>
                                @endif

                                @if ($requisicion->estado == 'firmada')
                                    <span style="color:green" class="firmada">Firmada</span>
                                @endif

                         </td>
                            <td>@isset($requisicion->contrato)
                                {{ $requisicion->contrato->no_proyecto }} / {{ $requisicion->contrato->no_contrato }} - {{ $requisicion->contrato->nombre_servicio }}
                            @endisset</td>
                            <td>{{ $requisicion->area }}</td>
                            <td>{{ $requisicion->user }}</td>
                            <td>
                                <div class="flex" style="justify-content:center; gap:20px; align-items:center; margin-top:15px;">
                                    @if ($requisicion->estado == 'rechazado')
                                        <a href="{{ route('requisiciones.edit', ['id' => $requisicion->id]) }}"
                                            title="Actualizar" style="color:#2395AA;">
                                            <i class="material-icons-outlined">edit</i>
                                        </a>
                                    @endif

                                    <a href="{{ route('requisiciones.show', ['id' => $requisicion->id]) }}"
                                        title="Ver/Imprimir" style="color:#2395AA;">
                                        <i class="fa-solid fa-print fa-xl"></i>
                                    </a>

                                    <a href="#modal_archivar_requisicion{{ $requisicion->id }}" title="Archivar"
                                        class='modal-trigger' style="color:#2395AA !important;">
                                        <i class="fa-solid fa-box-archive fa-xl"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                @endisset
            </tbody>
        </table>
    </div>
</div>

@endsection

@isset($requisiciones)
@foreach ($requisiciones as $requisicion)
    <div id="modal_archivar_requisicion{{ $requisicion->id }}" class="modal alerta_modal"
        style="width: 400px; margin: auto !important;">
        <form method="POST" action="{{ route('requisiciones.estado', ['id' => $requisicion->id]) }}">
            @csrf
            <div class="col s12" style="text-align: center; margin-top:20px;">
                <i class="fa-solid fa-box-archive" style="font-size:40pt; color: #2395AA;"></i>
                <h5><strong>Archivar Requisición:</strong></h5>
                <span>{{ $requisicion->referencia }} </span>
                <p>
                    ¿Desea archivar la requisicion <strong>{{ $requisicion->referencia }}</strong>?
                </p>
            </div>
            <div class="col s12" style="text-align: center; margin-top:20px;">
                <a class="btn btn-default btn-xs modal-close" style="background-color:#888 !important;">Regresar</a>
                <button class="btn btn-default btn-xs" style="background-color:#2395AA !important;">Archivar</button>
            </div>
        </form>
    </div>
@endforeach
@endisset


@section('scripts')


<script>
    $(document).ready(function() {
        $('#requisiciones-table').DataTable({
            autoWidth: false,
            scrollX: true,
            stateSave: true,
            dom: 'lBfrtip',
            ordering: false,
            buttons: [{
                    extend: "copyHtml5",
                    text: "<i class='material-icons-outlined'>file_copy</i>",
                    titleAttr: "Copiar",
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'csvHtml5',
                    title: `Reporte de proveedores_${new Date().toLocaleDateString().trim()}`,
                    text: "<i class='material-symbols-outlined'>table_view</i>",

                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Reporte de proveedores_${new Date().toLocaleDateString().trim()}`,
                    text: "<i class='material-symbols-outlined'>draft</i>",
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
                                columns: [{
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
                    text: '<i class="material-symbols-outlined">filter_alt</i>',
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
                    text: '<i class="material-symbols-outlined">visibility</i>',
                    show: ':hidden',
                    titleAttr: 'Ver todo',
                },
                {
                    extend: 'colvisRestore',
                    text: '<i class="material-icons-outlined">refresh</i>',
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
    });
</script>

@endsection
