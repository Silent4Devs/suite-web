@extends('layouts.admin')
@section('content')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet.css') }}">

    <style type="text/css">
        #lista_proyectos_tareas li{
            padding-top: 13px;
        }
    </style>

    {{-- {{ Breadcrumbs::render('admin.iso27001.index') }} --}}
    <h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">Reportes</font> </h5>
    <div class="mt-5 card card-body">
        <nav class="mt-4">
            <div class="nav nav-tabs" id="tabsIso27001" role="tablist">
                <a class="nav-link active" id="nav-registros-tab" data-type="registros" data-toggle="tab"
                    href="#nav-registros" role="tab" aria-controls="nav-registros" aria-selected="true">
                    Registros
                </a>
                <a class="nav-link" id="nav-empleados-tab" data-type="empleados" data-toggle="tab"
                    href="#nav-empleados" role="tab" aria-controls="nav-empleados" aria-selected="false" style="position: relative;">
                    Empleados
                </a>
                <a class="nav-link" id="nav-proyectos-tab" data-type="proyectos" data-toggle="tab"
                    href="#nav-proyectos" role="tab" aria-controls="nav-proyectos" aria-selected="false">
                    proyectos
                </a>
                {{-- <a class="nav-link" id="nav-clientes-tab" data-type="clientes" data-toggle="tab"
                    href="#nav-clientes" role="tab" aria-controls="nav-clientes" aria-selected="false">
                    Clientes
                </a> --}}
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane mb-4 fade p-4 show active" id="nav-registros" role="tabpanel" aria-labelledby="nav-registros-tab">
                @livewire('timesheet.reportes-registros')
            </div>
            <div class="tab-pane mb-4 fade p-4" id="nav-empleados" role="tabpanel" aria-labelledby="nav-empleados-tab">
                @livewire('timesheet.reportes-empleados')
            </div>
            <div class="tab-pane mb-4 fade p-4" id="nav-proyectos" role="tabpanel" aria-labelledby="nav-proyectos-tab">
                @livewire('timesheet.reportes-proyectos')
            </div>
            {{-- <div class="tab-pane mb-4 fade p-4" id="nav-clientes" role="tabpanel" aria-labelledby="nav-clientes-tab">
            </div> --}}
        </div>
    </div>
@endsection


@section('scripts')
    @parent
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuActive = localStorage.getItem('menu-iso27001-active');
            $(`#tabsIso27001 [data-type="${menuActive}"]`).tab('show');

            $('#tabsIso27001 a').on('click', function(event) {
                event.preventDefault()
                $(this).tab('show')
                const keyTab = this.getAttribute('data-type');
                localStorage.setItem('menu-iso27001-active', keyTab);
            });
        });
    </script>

    <script type="text/javascript">
        function cerrarVentana(id){
            $('#' + id).remove();
        }
    </script>

    <script>
        let cont = 0;
        function tablaLivewire(id_tabla)
        {
            $('#' + id_tabla).attr('id', id_tabla + cont);

            $(function() {
                let dtButtons = [{
                        extend: 'csvHtml5',
                        title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Exportar CSV',
                        exportOptions: {
                            columns: ['th:not(:last-child):visible']
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Exportar Excel',
                        exportOptions: {
                            columns: ['th:not(:last-child):visible']
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Exportar PDF',
                        orientation: 'portrait',
                        exportOptions: {
                            columns: ['th:not(:last-child):visible']
                        },
                        customize: function(doc) {
                            doc.pageMargins = [5, 20, 5, 20];
                            doc.styles.tableHeader.fontSize = 10;
                            doc.defaultStyle.fontSize = 10; //<-- set fontsize to 16 instead of 10
                        }
                    },
                    {
                        extend: 'print',
                        title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
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
                    titleAttr: 'Agregar empleado',
                    url: "{{asset('admin/inicioUsuario/reportes/quejas')}}",
                    className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                    action: function(e, dt, node, config) {
                    let {
                    url
                    } = config;
                    window.location.href = url;
                    }
                };
                let dtOverrideGlobals = {
                    buttons: dtButtons,
                    order:[
                                [0,'desc']
                            ],
                    destroy: true,
                    render: true,
                };

                let table = $('#' + id_tabla + cont).DataTable(dtOverrideGlobals);
            });
        }
        tablaLivewire('timesheet_empleados_lista');
        tablaLivewire('datatable_timesheet_empleados');
        tablaLivewire('datatable_timesheet_proyectos');
    </script>

    <script type="text/javascript">
        $('.select2').select2({
            'theme' : 'bootstrap4',
        });
    </script>
@endsection