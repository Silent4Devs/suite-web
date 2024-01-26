@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet.css') }}">

    {{ Breadcrumbs::render('timesheet-tareas') }}
    @include('admin.timesheet.complementos.cards')
    <h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">Tareas</font>
    </h5>

    <div class="card card-body">
        <div class="row">

            @livewire('timesheet.tabla-tareas-timesheet', ['proyecto_id' => null, 'origen' => 'tareas'])

        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        let cont = 0;

        function tablaLivewire(id_tabla) {
            $('#' + id_tabla).attr('id', id_tabla + cont);

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
                            let logo_actual = @json($logo_actual);
                            let empresa_actual = @json($empresa_actual);
                            let empleado = @json(auth()->user()->empleado->name);

                            var now = new Date();
                            var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now
                                .getFullYear();
                            $(doc.document.body).prepend(`
                                <div class="row">
                                    <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                        <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                                    </div>
                                    <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                        <p>${empresa_actual}</p>
                                        <strong style="color:#345183">Timesheet: Tareas</strong>
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
                let btnAgregar = {
                    text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                    titleAttr: 'Agregar empleado',
                    url: "{{ asset('admin/inicioUsuario/reportes/quejas') }}",
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
                    destroy: true,
                    render: true,
                };

                let table = $('#' + id_tabla + cont).DataTable(dtOverrideGlobals);
            });
        }
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                tablaLivewire('tabla_time_tareas');
            }, 500);
        });
    </script>

    <script type="text/javascript">
        $('.select2').select2({
            'theme': 'bootstrap4',
        });
    </script>
@endsection
