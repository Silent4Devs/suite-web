@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.accion-correctivas.index') }}

    <link rel="stylesheet" type="text/css" href="{{ asset('css/centro_atencion_cards.css') }}">


    <style>
        .table tr th:nth-child(1) {
            min-width: 80px !important;
            text-align: center !important;
        }

        .table tr th:nth-child(2) {
            min-width: 150px !important;
            text-align: center !important;
        }



        .descripcion {
            text-align: justify !important;
        }


        .comentarios {
            text-align: justify !important;
        }


        .textoCentroCard {
            font-size: 12pt !important;
        }
    </style>
    <h5 class="col-12 titulo_general_funcion">Acciones Correctivas</h5>

    <div class="caja_botones_menu mt-4">
        <a href="#" data-tabs="aprobaciones" class="btn_activo"><i class="mr-2 bi bi-check2"></i>Solicitudes</a>
        <a href="#" data-tabs="indexAc"><i class="mr-2 fas fa-clipboard-list"></i>Acciones
            Correctivas</a>
    </div>
    <div class="row mt-4 ">
        <div class="col-6 col-md-2">
            <div class="tarjetas_seguridad_indicadores cdr-celeste">
                <div class="numero"><i class="fas fa-exclamation-triangle mr-2"></i> {{ $total_AC }}</div>
                <div class="textoCentroCard">AC</div>
            </div>
        </div>
        <div class="col-6 col-md-2 ">
            <div class="tarjetas_seguridad_indicadores cdr-amarillo">
                <div class="numero"><i class="far fa-arrow-alt-circle-right mr-2"></i> {{ $nuevos_AC }}</div>
                <div class="textoCentroCard">Sin atender</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="tarjetas_seguridad_indicadores cdr-morado">
                <div class="numero"><i class="fas fa-redo-alt mr-2"></i> {{ $en_curso_AC }}</div>
                <div class="textoCentroCard">En curso</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="tarjetas_seguridad_indicadores cdr-azul">
                <div class="numero"><i class="fas fa-history mr-2"></i> {{ $en_espera_AC }}</div>
                <div class="textoCentroCard">En espera</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="tarjetas_seguridad_indicadores cdr-verde">
                <div class="numero"><i class="far fa-check-circle mr-2"></i> {{ $cerrados_AC }} </div>
                <div class="textoCentroCard">Cerrados</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="tarjetas_seguridad_indicadores cdr-rojo">
                <div class="numero"><i class="bi bi-dash-circle mr-2"></i></strong> {{ $cancelados_AC }}</div>
                <div class="textoCentroCard">No procedentes</div>
            </div>
        </div>
    </div>
    <div class="caja_caja_secciones">
        <div class="caja_secciones">
            <section id="indexAc">
                <div class="mt-1 card">
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
                    <div class="card">
                        <div class="card-body datatable-fix">

                            <table class="table table-bordered w-100 datatable-AccionCorrectiva">
                                <thead class="thead-dark">
                                    <tr>
                                        {{-- <th style="vertical-align: top">
                                            {{ trans('cruds.accionCorrectiva.fields.id') }}
                                        </th> --}}
                                        <th style="vertical-align: top">
                                            Folio
                                        </th>
                                        <th style="vertical-align: top">
                                            Título
                                        </th>
                                        <th style="vertical-align: top">
                                            Fecha&nbsp;y&nbsp;hora&nbsp;de&nbsp;registro
                                        </th>
                                        <th style="vertical-align: top">
                                            Fecha&nbsp;y&nbsp;hora&nbsp;de&nbsp;recepción
                                        </th>
                                        <th style="min-width:60px;">
                                            Estatus
                                        </th>
                                        <th style="vertical-align: top">
                                            Fecha&nbsp;y&nbsp;hora&nbsp;de&nbsp;cierre&nbsp;de&nbsp;ticket
                                        </th>
                                        <th style="vertical-align: top">
                                            Reportó
                                        </th>
                                        <th style="vertical-align: top">
                                            Puesto
                                        </th>
                                        <th style="vertical-align: top">
                                            Área
                                        </th>
                                        <th style="vertical-align: top">
                                            Registró
                                        </th>
                                        <th style="vertical-align: top">
                                            Puesto
                                        </th>
                                        <th style="vertical-align: top">
                                            Área
                                        </th>
                                        <th style="vertical-align: top">
                                            Causa&nbsp;de&nbsp;origen
                                        </th>
                                        <th style="vertical-align: top; min-width:500px;">
                                            Descripción
                                        </th>
                                        <th style="vertical-align: top">
                                            Opciones
                                        </th>
                                    </tr>

                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section id="aprobaciones" class="caja_tab_reveldada">
                <div class="mt-1 card">
                    <div class="card-body datatable-fix">
                        <table id="tabla_usuario_aprobaciones" class="table">
                            <thead>
                                <tr>
                                    <th style=" min-width:80px; text-align: left !important;">
                                        Folio
                                    </th>
                                    <th style=" min-width:120px !important; text-align: left !important;">
                                        Origen
                                    </th>
                                    <th style="vertical-align: top; text-align: left !important; min-width:70px;">
                                        Fecha
                                    </th>
                                    <th style="vertical-align: top; text-align: center !important; min-width:80px;">
                                        Solicitante
                                    </th>
                                    <th style="vertical-align: top; text-align: center !important; min-width:80px;">
                                        Aprobador
                                    </th>
                                    <th style="vertical-align: top; text-align: center !important; min-width:70px;">
                                        Revisar
                                    </th>
                                    <th style="vertical-align: top  min-width:80px;">
                                        Opciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </div>

    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [5, 20, 5, 20];
                        doc.styles.tableHeader.fontSize = 6.5;
                        doc.defaultStyle.fontSize = 6.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
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
            let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar acciones correctivas',
                url: "{{ route('admin.accion-correctivas.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config) {
                    let {
                        url
                    } = config;
                    window.location.href = url;
                }
            };
            dtButtons.push(btnAgregar);

            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.accion-correctivas.massDestroy') }}",
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
            //dtBu@endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.accion-correctivas.index') }}",
                columnDefs: [{
                    visible: false
                }],
                columns: [
                    // {
                    //     data: 'id',
                    //     name: 'id'
                    // },
                    {
                        data: 'folio',
                        name: 'folio',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'tema',
                        name: 'tema',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'fecharegistro',
                        name: 'fecharegistro',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'fecha_verificacion',
                        name: 'fecha_verificacion',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
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
                        data: 'fecha_cierre',
                        name: 'fecha_cierre',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'reporto',
                        render: function(data, type, row, meta) {
                            if (row.id_reporto != null) {
                                let reporto = JSON.parse(row.reporto);
                                if (type === "empleadoText") {
                                    return reporto.name;
                                } else {
                                    let html =
                                        `<img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/${reporto?.avatar}" title="${reporto?.name}"></img>`;

                                    return `${reporto ? html: ''}`;
                                }
                            }

                            return `Sin dato`;
                        }
                    },
                    {
                        data: 'reporto_puesto',
                        name: 'reporto_puesto',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'reporto_area',
                        name: 'reporto_area',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'empleados',
                        name: 'empleados',
                        render: function(data, type, row, meta) {
                            if (type === "empleadoText") {
                                return data.name;
                            }
                            let reporto = "";
                            if (data) {
                                reporto +=
                                    `<img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/${data.avatar}" title="${data.name}"></img>`;
                            }
                            return reporto;
                        }
                    },
                    {
                        data: 'registro_puesto',
                        name: 'registro_puesto',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'registro_area',
                        name: 'registro_area',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'causaorigen',
                        name: 'causaorigen',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion',
                        className: 'descripcion',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    // {
                    //     data: 'metodo_causa',
                    //     name: 'metodo_causa'
                    // },
                    // {
                    //     data: 'solucion',
                    //     name: 'solucion'
                    // },
                    // {
                    //     data: 'cierre_accion',
                    //     name: 'cierre_accion'
                    // },
                    // {
                    //     data: 'estatus',
                    //     name: 'estatus'
                    // },
                    // {
                    //     data: 'fecha_compromiso',
                    //     name: 'fecha_compromiso'
                    // },
                    // {
                    //     data: 'fecha_verificacion',
                    //     name: 'fecha_verificacion'
                    // },
                    // {
                    //     data: 'responsable_accion_name',
                    //     name: 'responsable_accion.name'
                    // },
                    // {
                    //     data: 'nombre_autoriza_name',
                    //     name: 'nombre_autoriza.name'
                    // },
                    // {
                    //     data: 'documentometodo',
                    //     name: 'documentometodo',
                    //     sortable: false,
                    //     searchable: false
                    // },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                createdRow: (row, data, dataIndex, cells) => {
                    let fondo = "green";
                    let letras = "white";
                    if (data.estatus == 'Sin atender') {
                        fondo = "#FFCB63";
                        letras = "white";
                    }
                    if (data.estatus == 'En curso') {
                        fondo = "#AC84FF";
                        letras = "white";
                    }
                    if (data.estatus == 'En espera') {
                        fondo = "#6863FF";
                        letras = "white";
                    }
                    if (data.estatus == 'Cerrado') {
                        fondo = "#6DC866";
                        letras = "white";
                    }
                    if (data.estatus == 'No procedente') {
                        fondo = "#FF417B";
                        letras = "white";
                    }
                    if (data.estatus != null) {
                        $(cells[4]).css('background-color', fondo)
                        $(cells[4]).css('color', letras)
                    }

                },
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
            };
            let table = $('.datatable-AccionCorrectiva').DataTable(dtOverrideGlobals);


            $.ajaxSetup({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

            });
            let dtButtonsAprobacion = [{
                    extend: 'csvHtml5',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [5, 20, 5, 20];
                        doc.styles.tableHeader.fontSize = 6.5;
                        doc.defaultStyle.fontSize = 6.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
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

            let btnAgregarAprobacion = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar acciones correctivas',
                url: "{{ route('admin.accion-correctivas.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config) {
                    let {
                        url
                    } = config;
                    window.location.href = url;
                }
            };
            dtButtonsAprobacion.push(btnAgregarAprobacion);

            let deleteButtonTransAprobacion = '{{ trans('global.datatables.delete') }}';
            let deleteButtonAprobacion = {
                text: deleteButtonTransAprobacion,
                url: "{{ route('admin.accion-correctivas.massDestroy') }}",
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


            let dtOverrideGlobalsAprobacion = {
                buttons: dtButtonsAprobacion,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: {
                    method: 'POST',
                    url: "{{ route('admin.accion-correctivas.obtenerAprobaciones') }}",
                },
                columnDefs: [{
                    visible: false
                }],
                columns: [
                    // {
                    //     data: 'id',
                    //     name: 'id'
                    // },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            console.log(row);
                            if (row.desk_queja_cliente.length > 0) {
                                let item = row.desk_queja_cliente[0];
                                return item.folio
                            } else {

                                return `Sin folio`
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            console.log(row);
                            if (row.desk_queja_cliente.length > 0) {

                                return `Quejas Clientes`
                            } else {

                                return `Sin definir`
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {

                            if (row.desk_queja_cliente.length > 0) {
                                let stringDate = row.desk_queja_cliente[0].pivot.created_at;
                                let splitDate = stringDate.split('T');
                                let newDate = splitDate[0];
                                let splitNewDate = newDate.split('-');
                                let formatted_date =
                                    `${splitNewDate[2]}-${splitNewDate[1]}-${splitNewDate[0]}`;
                                return formatted_date;
                            } else {

                                return `Sin definir`
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            if (row.desk_queja_cliente.length > 0) {
                                return `<div><img class="ml-4 img_empleado" src="${row.desk_queja_cliente[0].registro.avatar_ruta}" title="${row.desk_queja_cliente[0].registro.name}"></div>`;
                            } else {

                                return `Sin definir`
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            if (row.desk_queja_cliente.length > 0) {
                                return `<div><img class="ml-4 img_empleado" src="${row.desk_queja_cliente[0].responsable_sgi.avatar_ruta}" title="${row.desk_queja_cliente[0].responsable_sgi.name}"></div>`;
                            } else {

                                return `Sin definir`
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            if (row.desk_queja_cliente.length > 0) {
                                let link = `<a href="{{ route('admin.desk.quejasClientes-edit', ':id') }}">
                                    <div class=""><i class="ml-4 text-center fas fa-eye"></i></div>
                                    </a>`;
                                link = link.replaceAll(':id', row.desk_queja_cliente[0].id);
                                console.log(link);
                                return link;
                            } else {

                                return `Sin definir`
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            if (row.desk_queja_cliente.length > 0) {
                                let opciones = `
                            <div><button class="btn text-success" onclick="aprobarAc('${data}',true,'${row.desk_queja_cliente[0].id}')"><i class="text-success iconos-crear far fa-thumbs-up"></i></button>
                                <button class="btn text-danger" onclick="aprobarAc('${data}',false, '${row.desk_queja_cliente[0].id}')"><i class="text-danger iconos-crear far fa-thumbs-down"></i></button></div>
                            `
                                return opciones;
                            } else {

                                return `Sin definir`
                            }
                        }

                    },

                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
            };
            let tableAprobacion = $('#tabla_usuario_aprobaciones').DataTable(dtOverrideGlobalsAprobacion);
            window.aprobarAc = (id_accion_corectiva, aprobada, id_queja_cliente) => {
                let url = "{{ route('admin.accion-correctivas.aprobarRechazar') }}";
                Swal.fire({
                    title: `¿Está seguro(a) de ${aprobada?'aprobar':'rechazar'} este ticket?`,
                    text: 'Comentarios',
                    icon: 'warning',
                    input: 'textarea',
                    inputAttributes: {
                        input: 'textarea',
                        required: !aprobada
                    },
                    inputValidator: (value) => {
                        if (!aprobada) {
                            if (value.trim().length < 3) {
                                return 'El campo comentarios debe tener al menos 3 caracteres'
                            }
                        }

                    },
                    showCancelButton: true,
                    confirmButtonText: `Si, ${aprobada?'aprobar':'rechazar'}`,
                    cancelButtonText: 'Cancelar',
                    showLoaderOnConfirm: true,
                    preConfirm: (login) => {
                        console.log(login);

                        return fetch(url, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': _token,
                                    'Content-Type': 'application/json',
                                    Accept: 'application/json'
                                },
                                body: JSON.stringify({
                                    id: id_accion_corectiva,
                                    aprobada,
                                    id_queja_cliente,
                                    comentarios: login
                                })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(response.statusText)
                                }
                                return response.json()
                            })
                            .catch(error => {
                                Swal.showValidationMessage(
                                    `Request failed: ${error}`
                                )
                            })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (result.value.success) {
                            Swal.fire(
                                `${result.value.message}`,
                                `La respuesta ha sido enviada con éxito`,
                                'success'
                            ).then(() => {
                                // window.location.reload();
                                table.ajax.reload();
                                tableAprobacion.ajax.reload()

                            });

                        }

                    }
                })


            }


        });
    </script>
@endsection
