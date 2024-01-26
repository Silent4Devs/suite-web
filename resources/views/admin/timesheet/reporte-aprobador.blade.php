@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet.css') }}?v=1.1">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0/dist/chartjs-plugin-datalabels.min.js">
    </script>
    {{ Breadcrumbs::render('timesheet-reporte-aprobador') }}
    <h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">Reporte Aprobador</font>
    </h5>
    <div class="card card-body">
        @livewire('timesheet.reporte-aprobador')
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript">
        $(".cde-nombre").mouseover(function() {
            $(".cde-nombre").addClass("ver");
        });
        $(".cde-nombre").mouseleave(function() {
            $(".cde-nombre").removeClass("ver");
        });

        $(".cde-puesto").mouseover(function() {
            $(".cde-puesto").addClass("ver");
        });
        $(".cde-puesto").mouseleave(function() {
            $(".cde-puesto").removeClass("ver");
        });

        $(".cde-area").mouseover(function() {
            $(".cde-area").addClass("ver");
        });
        $(".cde-area").mouseleave(function() {
            $(".cde-area").removeClass("ver");
        });

        $(".cde-estatus").mouseover(function() {
            $(".cde-estatus").addClass("ver");
        });
        $(".cde-estatus").mouseleave(function() {
            $(".cde-estatus").removeClass("ver");
        });

        // --------------------------------------
        function cerrarVentana(id) {
            $('#' + id).remove();
        }

        // -----------------------------------------
        let cont = 0;

        function tablaLivewire(id_tabla) {
            $('#' + id_tabla).attr('id', id_tabla + cont);

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
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                        $(doc.document.body).prepend(`
                            <div class="row">
                                <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                    <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                                </div>
                                <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                    <p>${empresa_actual}</p>
                                    <strong style="color:#345183">Timesheet: Reportes</strong>
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
                aLengthMenu: [
                    [5, 10, 50, 100, -1],
                    [5, 10, 50, 100, "Todos"]
                ],
                iDisplayLength: -1,
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api();
                    nb_cols = api.columns().nodes().length;
                    var j = 5;
                    while (j < nb_cols) {
                        var pageTotal = api
                            .column(j, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                a = isNaN(a) ? 0 : a;
                                b = isNaN(b) ? 0 : b;
                                return Number(a) + Number(b);
                            }, 0);
                        // Update footer
                        $(api.column(j).footer()).html(pageTotal);
                        j++;
                    }
                }
            };

            if ((id_tabla) == ('timesheet_empleados_lista' + cont)) {
                $('tfoot .cde-op').innerHTML = '';
                $('tfoot .cde-semenasf').innerHTML = '';
                $('tfoot .cde-totalh').innerHTML = '';
            }

            let table = $('#' + id_tabla + cont).DataTable(dtOverrideGlobals);

            return table;
        }

        document.addEventListener('DOMContentLoaded', () => {
            let table_1 = null;
            setTimeout(() => {
                table_1 = tablaLivewire('datatable_timesheet');
                tablaLivewire('timesheet_empleados_lista');
                tablaLivewire('datatable_timesheet_empleados');
            }, 100);
        });

        // -------------------------------------------------
        document.addEventListener('DOMContentLoaded', () => {
            $(".date_librery").flatpickr({
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes',
                            'Sábado'
                        ],
                    },
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct',
                            'Nov', 'Dic'
                        ],
                        longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                        ],
                    },
                },
                altInput: true,
                dateFormat: 'd-m-Y',
            });
            $("#fecha_dia_registros_inicio_empleados").flatpickr({
                "disable": [
                    function(date) {
                        return (date.getDay() === 0 || date.getDay() === 2 || date.getDay() === 3 ||
                            date.getDay() === 4 || date.getDay() === 5 || date.getDay() === 6);

                    }
                ],
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes',
                            'Sábado'
                        ],
                    },
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct',
                            'Nov', 'Dic'
                        ],
                        longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                        ],
                    },
                },
            });
            $("#fecha_dia_registros_fin_empleados").flatpickr({
                "disable": [
                    function(date) {
                        return (date.getDay() === 1 || date.getDay() === 2 || date.getDay() === 3 ||
                            date.getDay() === 4 || date.getDay() === 5 || date.getDay() === 6);

                    }
                ],
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes',
                            'Sábado'
                        ],
                    },
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct',
                            'Nov', 'Dic'
                        ],
                        longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                        ],
                    },
                },
            });
        });

        //  --------------------------------------------------------
        $('.select2').select2({
            'theme': 'bootstrap4',
        });
    </script>
@endsection
