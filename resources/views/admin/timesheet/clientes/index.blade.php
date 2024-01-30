@extends('layouts.admin')
@section('content')
    <style type="text/css">
        .td-cj-1 {
            background-color: rgba(0, 0, 0, 0.1) !important;
        }

        .td-cj-2 {
            background-color: rgba(0, 0, 0, 0.2) !important;
        }

        .td-cj-3 {
            background-color: rgba(0, 0, 0, 0.2) !important;
        }

        #datatable_clientes th {
            min-width: 150px;
        }

        @page {
            size: landscape;
        }
    </style>


    {{ Breadcrumbs::render('timesheet-clientes') }}

    <h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">Clientes</font>
    </h5>


    <div class="text-right">
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.timesheet-clientes-create') }}" type="button" class="btn btn-primary">Registrar
                TimeSheet</a> &nbsp;
        </div>
    </div>
    <br>
    <br>

    @include('admin.timesheet.complementos.cards')

    @include('admin.timesheet.complementos.blue-card-header')

    <div class="card card-body">
        <div class="row">
            @include('partials.flashMessages')
            <div class="datatable-fix w-100">
                <table id="datatable_clientes" class="table w-100">
                    <thead>
                        <tr id="dt-header">
                            <th rowspan="2">ID</th>
                            <th rowspan="2">Razón social</th>
                            <th rowspan="2">Nombre comercial del proveedor</th>
                            <th rowspan="2">RFC persona moral o persona física</th>
                            <th colspan="6" class="td-cj-1" style="text-align: center;">DOMICILIO FISCAL</th>
                            <th colspan="4" class="td-cj-2" style="text-align: center;">DATOS DEL CONTACTO</th>
                            <th colspan="2" class="td-cj-3" style="text-align: center;">PRODUCTOS Y/O SERVICIOS</th>
                            <th rowspan="2" class="th_opciones">Opciones</th>
                        </tr>
                        <tr>

                            <th class="td-cj-1">Calle y Número</th>
                            <th class="td-cj-1">Colonia</th>
                            <th class="td-cj-1">Ciudad o Municipio/ País</th>
                            <th class="td-cj-1">Código postal</th>
                            <th class="td-cj-1">Teléfonos con lada</th>
                            <th class="td-cj-1">Página Web</th>

                            <th class="td-cj-2">Nombre completo del contacto:</th>
                            <th class="td-cj-2">Puesto</th>
                            <th class="td-cj-2">Correo electrónico</th>
                            <th class="td-cj-2">Celular</th>

                            <th class="td-cj-3">Objeto social / Descripción
                                del servicio o producto</th>
                            <th class="td-cj-3">Cobertura, Rango geográfico
                                en el cual presta los servicios</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->identificador }}</td>
                                <td>{{ $cliente->razon_social }}</td>
                                <td>{{ $cliente->nombre }}</td>
                                <td>{{ $cliente->rfc }}</td>
                                <td>{{ $cliente->calle }}</td>
                                <td>{{ $cliente->colonia }}</td>
                                <td>{{ $cliente->ciudad }}</td>
                                <td>{{ $cliente->codigo_postal }}</td>
                                <td>{{ $cliente->telefono }}</td>
                                <td>{{ $cliente->pagina_web }}</td>
                                <td>{{ $cliente->nombre_contacto }}</td>
                                <td>{{ $cliente->puesto_contacto }}</td>
                                <td>{{ $cliente->correo_contacto }}</td>
                                <td>{{ $cliente->celular_contacto }}</td>
                                <td>{{ $cliente->objeto_descripcion }}</td>
                                <td>{{ $cliente->cobertura }}</td>
                                <td class="d-flex">
                                    <a href="{{ asset('admin/timesheet/clientes/edit') }}/{{ $cliente->id }}"
                                        class="btn" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <button class="btn" title="Eliminar" data-toggle="modal"
                                        data-target="#modal_cliente_eliminar_{{ $cliente->id }}" style="color:red;"><i
                                            class="fa-solid fa-trash-can"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    @foreach ($clientes as $cliente)
        <div class="modal fade" id="modal_cliente_eliminar_{{ $cliente->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button class="btn btn-tache-cerrar" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
                        <div class="delete">
                            <div class="text-center">
                                <i class="fa-solid fa-trash-can" style="color: #E34F4F; font-size:60pt;"></i>
                                <h1 class="my-4" style="font-size:14pt;">Eliminar Cliente:
                                    <small>{{ $cliente->nombre }}</small>
                                </h1>
                                <p class="parrafo">¿Desea eliminar al cliente {{ $cliente->nombre }}?</p>
                            </div>

                            <div class="mt-4 d-flex justify-content-between">
                                <button class="btn btn_cancelar" data-dismiss="modal">
                                    Cancelar
                                </button>
                                <form action="{{ route('admin.timesheet-cliente-delete', $cliente->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-info" style="border:none; background-color:#E34F4F;">
                                        Eliminar Cliente
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection


@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Mis Registros ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Mis Registros ${new Date().toLocaleDateString().trim()}`,
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

                        var css =
                            '@page { size: landscape; } @media print {.header-print {display: table-header-group;}}',
                            head = doc.document.head || doc.document.getElementsByTagName('head')[0],
                            style = doc.document.createElement('style');
                        style.type = 'text/css';
                        style.media = 'print';
                        if (style.styleSheet) {
                            style.styleSheet.cssText = css;
                        } else {
                            style.appendChild(doc.document.createTextNode(css));
                        }
                        head.appendChild(style);
                        $(doc.document.body).find('thead').prepend('<tr class="header-print">' + $(
                            '#dt-header').html() + '</tr>');

                        let logo_actual = @json($logo_actual);
                        let empresa_actual = @json($empresa_actual);
                        let empleado = @json(auth()->user()->empleado->name);

                        var now = new Date();
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                        $(doc.document.body).prepend(`
                            <div class="row">
                                <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                    <img class="img-fluid" style="max-width:80px" src="${logo_actual}"/>
                                </div>
                                <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                    <p>${empresa_actual}</p>
                                    <strong style="color:#345183">Timsheet: Clientes</strong>
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
                            $(this).css('font-size', '12px');
                            $(this).css('color', '#fff');
                            $(this).css('background-color', 'blue');
                        });
                    },
                    title: '',
                    exportOptions: {
                        columns: ['th:not(.th_opciones):visible']
                    },
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
                // text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                // titleAttr: 'Agregar sede',
                // url: "{{ route('admin.timesheet-clientes-create') }}",
                // className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                // action: function(e, dt, node, config) {
                //     let {
                //         url
                //     } = config;
                //     window.location.href = url;
                // }
            };
            // dtButtons.push(btnAgregar);



            let dtOverrideGlobals = {
                buttons: dtButtons,
            };
            let table = $('#datatable_clientes').DataTable(dtOverrideGlobals);
            console.log(table.selector);
            $('.btn.buttons-print.btn-sm.rounded.pr-2').unbind().click(function() {
                let titulo_tabla = `
                    <h5>
                        <strong>
                            Timesheet:
                        </strong>
                        <font style="font-weight: lighter;">
                            Clientes
                        </font>
                    </h5>
                `;
                imprimirTabla('datatable_clientes', titulo_tabla);
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
