@extends('layouts.admin')
@section('content')

<style type="text/css">
    #lista_proyectos_tareas li {
        padding-top: 13px;
    }

    @media print {

        #sidebar,
        header,
        .nav-tabs,
        .titulo_general_funcion,
        .breadcrumb {
            display: none !important;
        }

        #reporte_proyecto,
        #reporte_empleado,
        #reporte_general {
            width: 100% !important;
            position: absolute;
            top: 0;
            margin: 0 !important;
            margin-top: -150px !important;
            padding: 0 !important;
            background-color: #fff !important;
            border: 1px solid #fff !important;
        }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0/dist/chartjs-plugin-datalabels.min.js">
</script>

@livewire('timesheet.reportes-proyemp')

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
        $(".cde-fecha").mouseleave(function() {
            $(".cde-fecha").removeClass("ver");
        });

        $(".datatable_timesheet_proyectos tr th:nth-child(2), .datatable_timesheet_proyectos tr td:nth-child(2)").mouseover(
            function() {
                $(".datatable_timesheet_proyectos tr th:nth-child(2), .datatable_timesheet_proyectos tr td:nth-child(2)")
                    .addClass("ver");
            });
        $(".datatable_timesheet_proyectos tr th:nth-child(2), .datatable_timesheet_proyectos tr td:nth-child(2)")
            .mouseleave(function() {
                $(".datatable_timesheet_proyectos tr th:nth-child(2), .datatable_timesheet_proyectos tr td:nth-child(2)")
                    .removeClass("ver");
            });
        $(".datatable_timesheet_proyectos tr th:nth-child(3), .datatable_timesheet_proyectos tr td:nth-child(3)").mouseover(
            function() {
                $(".datatable_timesheet_proyectos tr th:nth-child(3), .datatable_timesheet_proyectos tr td:nth-child(3)")
                    .addClass("ver");
            });
        $(".datatable_timesheet_proyectos tr th:nth-child(3), .datatable_timesheet_proyectos tr td:nth-child(3)")
            .mouseleave(function() {
                $(".datatable_timesheet_proyectos tr th:nth-child(3), .datatable_timesheet_proyectos tr td:nth-child(3)")
                    .removeClass("ver");
            });
    </script>
    <script type="text/javascript">
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
            setTimeout(() => {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            }, 300);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                const menuActive = localStorage.getItem('menu-iso27001-active');
                $(`#tabsIso27001 [data-type="${menuActive}"]`).tab('show');

                $('#tabsIso27001 a').on('click', function(event) {
                    event.preventDefault()
                    $(this).tab('show')
                    const keyTab = this.getAttribute('data-type');
                    localStorage.setItem('menu-iso27001-active', keyTab);
                });
            }, 100);
        });
    </script>
    <script type="text/javascript">
        function cerrarVentana(id) {
            $('#' + id).remove();
        }
    </script>

    <script>
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
                    var j = 6;
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

            if (id_tabla == 'datatable_timesheet_proyectos') {
                console.log('"bPaginate": false,');
                dtOverrideGlobals.bPaginate = false;
                dtOverrideGlobals.bFilter = false;
                dtOverrideGlobals.info = false;
                dtOverrideGlobals.buttons = []
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
                tablaLivewire('datatable_timesheet_proyectos');
            }, 100);

            // $('#area_id_registros').on('change', function() {
            //     console.log(table_1.columns(3));
            //     if (this.value != null && this.value != "") {
            //         this.style.border = "2px solid #20a4a1";
            //         table_1.columns(3).search(this.value).draw();
            //     } else {
            //         this.style.border = "none";
            //         table_1.columns(3).search(this.value).draw();
            //     }
            // });
        });
    </script>
    <script type="text/javascript">
        $('.select2').select2({
            'theme': 'bootstrap4',
        });
    </script>

    <script type="text/javascript">
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
            $("#fecha_dia_registros_inicio_proyectos").flatpickr({
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
            $("#fecha_dia_registros_fin_proyectos").flatpickr({
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
    </script>
@endsection