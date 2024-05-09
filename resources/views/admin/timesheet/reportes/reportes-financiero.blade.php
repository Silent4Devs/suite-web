@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet.css') }}{{ config('app.cssVersion') }}">
@endsection
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

        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0/dist/chartjs-plugin-datalabels.min.js">
    </script>

    <h5 class="col-12 titulo_general_funcion">Timesheet: <font style="font-weight:lighter;">Reporte Financiero</font>
    </h5>

    {{-- @include('admin.timesheet.complementos.cards') --}}
    @include('admin.timesheet.complementos.admin-aprob')
    {{-- @include('admin.timesheet.complementos.blue-card-header') --}}

    @livewire('timesheet.reporte-financiero')
@endsection

{{-- @section('scripts')
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
                        autoWidth: true
                    },
                    customizeData: function(data) {

                        for (var i = 0; i < data.body.length; i++) {
                            var columnaD = data.body[i][3];
                            var elementosD = columnaD.split(/\s{2,}/);
                            var arrayD = [];
                            elementosD.forEach(function(elemento) {
                                arrayD.push(elemento.trim());
                            });
                            data.body[i][3] = arrayD;

                            var columnaE = data.body[i][4];
                            var elementosE = columnaE.split(/\s{2,}/);
                            var arrayE = [];
                            elementosE.forEach(function(elemento) {
                                elementosE.forEach(function(subElemento) {
                                    arrayE.push(subElemento.trim());
                                });
                            });
                            data.body[i][4] = arrayE;

                            var columnaF = data.body[i][5];
                            var elementosF = columnaF.split(/\s{2,}/);
                            var arrayF = [];
                            elementosF.forEach(function(elemento) {
                                arrayF.push(elemento.trim());
                            });
                            data.body[i][5] = arrayF;

                            var columnaG = data.body[i][6];
                            var elementosG = columnaG.split(/\s{2,}/);
                            var arrayG = [];
                            elementosG.forEach(function(elemento) {
                                arrayG.push(elemento.trim());
                            });
                            data.body[i][6] = arrayG;
                        }
                    },
                    customize: function(xlsx) {
                        var sheet = xlsx.xl.worksheets[
                            'sheet1.xml'];


                        $('col', sheet).each(function() {
                            $(this).attr('width', '25');
                        });

                        $('row c[r^="D"], row c[r^="E"], row c[r^="F"], row c[r^="G"]', sheet).each(
                            function() {
                                var cellText = $(this).find('is t').text();
                                cellText = cellText.replace(/,/g, ',\n');
                                $(this).find('is t').text(cellText);
                                $(this).attr('s', '25');
                                $(this).attr('style', 'mso-wrap-text: true;');
                            });
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
                render: true,
            };

            let table = $('#datatabletimesheetproyectosfinancieros').DataTable(dtOverrideGlobals);
        });
    </script>
@endsection --}}
