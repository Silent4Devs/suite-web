@extends('layouts.admin')
@section('content')
    {{-- @include('partials.flashMessages')
    <div id="inicio_usuario" class="row" style="">
        <h5 class="col-12" style="color: #788BAC;margin-bottom: 30px">Planes de Acción</h5>
        <div class="col-lg-12 card p-0">
            <div class="card-body p-0">
                @livewire('plan-accion-kanban-form')
                @livewire('kanban-tarea')
                @livewire('kanban-lienzo', ['planAccionId' => 1, 'onlyRead' => false, 'empleadoFiltro' => null])
            </div>
        </div>
    </div> --}}
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
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 !important;
            margin-right: 10px !important;

        }



        .agregar {
            margin-right: 15px;

        }
    </style>

    <h5 class="col-12 titulo_general_funcion">Planes de Acción (KANBAN)</h5>
    <div class="mt-5 card">


        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 datatable-kanban-pa">
                <thead class="thead-dark">
                    <tr>
                        <th style="vertical-align: top">ID</th>
                        <th style="vertical-align: top">Nombre</th>
                        <th style="vertical-align: top">Norma(s)</th>
                        <th style="vertical-align: top">Módulo Origen</th>
                        <th style="vertical-align: top">Objetivo</th>
                        <th style="vertical-align: top">No. Tareas</th>
                        <th style="vertical-align: top">Avance</th>
                        <th style="vertical-align: top">Estatus</th>
                        <th style="vertical-align: top">Fecha Creación</th>
                        <th style="vertical-align: top">Opciones</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection


@section('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script> --}}
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
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

                        var now = new Date();
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                        $(doc.document.body).prepend(`
                        <div class="row mt-5 mb-4 col-12 ml-0" style="border: 2px solid #ccc; border-radius: 5px">
                                <div class="col-2 p-2" style="border-right: 2px solid #ccc">
                                    <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                                </div>
                                <div class="col-7 p-2" style="text-align: center; border-right: 2px solid #ccc">
                                    <p>${empresa_actual}</p>
                                    <strong style="color:#345183">EMPLEADOS: LISTA DE EMPLEADOS DE LA EMPRESA</strong>
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
                    text: '<i class="fas fa-filter" style="font-size: 1.1rem;color:#000"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Seleccionar Columnas',
                },
                {
                    extend: 'colvisGroup',
                    text: '<i class="fas fa-eye" style="font-size: 1.1rem;color:#000"></i>',
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
                titleAttr: 'Agregar plan acción',
                url: "{{ route('admin.kanban-plan-accion.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3 agregar",
                action: function(e, dt, node, config) {
                    let {
                        url
                    } = config;
                    window.location.href = url;
                }
            };

            dtButtons.push(btnAgregar);



            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.kanban-plan-accion.index') }}",
                columns: [{
                    data: 'id',
                    name: 'id'
                }, {
                    data: 'title',
                    name: 'title'
                }, {
                    data: 'id',
                    name: 'id'
                }, {
                    data: 'origen',
                    name: 'origen',
                    render: function(data, type, row, meta) {
                        if (data) {
                            return data;
                        }
                        return '- -';
                    }
                }, {
                    data: 'descripcion',
                    name: 'descripcion',
                    render: function(data, type, row, meta) {
                        if (data) {
                            return data;
                        }
                        return '- -';
                    }
                }, {
                    data: 'id',
                    name: 'id'
                }, {
                    data: 'id',
                    name: 'id'
                }, {
                    data: 'estatus',
                    name: 'estatus',
                    render: function(data, type, row, meta) {
                        if (data) {
                            return data;
                        }
                        return '- -';
                    }
                }, {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data, type, row, meta) {

                        let fecha = data.split('-');
                        let fechaFormateada = `${fecha[2].split('T')[0]}-${fecha[1]}-${fecha[0]}`;
                        return fechaFormateada;

                    }
                }, {
                    data: 'id',
                    render: function(data, type, row, meta) {
                        let buttons = `
                                <div class="btn-group" role="group" aria-label="Basic example">                                  
                                    <a href="{{ route('admin.kanban-plan-accion.show', ':id') }}" class="btn rounded-0" title="Ver"><i class="fa-solid fa-grip-vertical"></i></a>                                
                                    <a href="{{ route('admin.kanban-plan-accion.edit', ':id') }}" class="btn rounded-0" title="Editar"><i class="fas fa-edit"></i></a>                                  
                                    <a  class="btn rounded-0" title="Dar de Baja" href="{{ route('admin.kanban-plan-accion.destroy', ':id') }}"><i class="fas fa-trash-alt text-danger"></i></a>
                                </div>
                            `;
                        buttons = buttons.replaceAll(':id', data);
                        return buttons;
                    }
                }],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ]
            };
            let table = $('.datatable-kanban-pa').DataTable(dtOverrideGlobals);

        });
    </script>
@endsection
