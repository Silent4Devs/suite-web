@extends('layouts.admin')

@section('content')
    @include('layouts.datatables_css')
@section('titulo', 'Dashboard')

<link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard/dashboard.css') }}">

<style type="text/css">
    .dataTables_info,
    .dataTables_length {
        margin-left: 20px;
    }

    .texto-tabla {

        text-align: left !important;
        padding: 8px !important;

    }

    .txt-table {

        text-align: center !important;
        padding: 8px !important;
    }


    .icono_cuenta_i {
        margin-top: 0px;
    }

    .highcharts-credits {
        display: none !important;
    }

    .dropdown-content.select-dropdown {
        width: 100% !important;
        height: auto !important;
        max-height: 400px;
        position: relative !important;
    }

</style>

<div class="container">
    <h5 class="col-12 titulo_general_funcion">Dashboard</h5>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-2">
            <div class="card card_dp">
                <div class="card-body datos-primeros dp1">
                    <div class="row">
                        <div class="col-12 display-b">
                            <div style="margin-top:3px;">
                                <i class="fa-solid fa-file-lines fa-xl"></i>
                            </div>
                            @if ($total > 0)
                                <div class="text_estadistica"><i class="material-icons dp48 vertical-align-bottom">arrow_upward</i>
                                    <label>{{ $total }}</label>
                                </div>
                            @elseif($total = 0)
                                <div class="mt-4 blue-text text_estadistica"><i class="material-icons dp48 vertical-align-bottom">arrow_forward</i>
                                    <label>{{ $total }}</label>
                                </div>
                            @else
                                <div class="red-text text_estadistica"><i class="material-icons dp48 vertical-align-bottom">arrow_downward</i>
                                    <label>{{ $total }}</label>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h4 style="font-size: 15px !important; text-align: center !important;">&nbsp;&nbsp;&nbsp;Total &nbsp;de&nbsp;&nbsp;&nbsp;  contratos</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-2">
            <div class="card card_dp">
                <div class="card-body datos-primeros dp2">
                    <div class="row">
                        <div class="col-12 display-b">
                            <div style="margin-top:3px;">
                                <i class="fa-solid fa-file-contract fa-xl"></i>
                            </div>
                            @if ($totalVig > 0)
                                <div class="text_estadistica"><i class="material-icons dp48 vertical-align-bottom">arrow_upward</i>
                                    <label>{{ $totalVig }}</label>
                                </div>
                            @elseif($totalVig = 0)
                                <div class="text_estadistica"><i class="material-icons dp48 vertical-align-bottom">arrow_forward</i>
                                    <label>{{ $totalVig }}</label>
                                </div>
                            @else
                                <div class="text_estadistica"><i class="material-icons dp48 vertical-align-bottom">arrow_downward</i>
                                    <label>{{ $totalVig }}</label>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h4 style="font-size: 15px !important; text-align: center !important;">&nbsp;Contratos&nbsp;&nbsp; vigentes</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-2">
            <div class="card card_dp">
                <div class="card-body datos-primeros dp3">
                    <div class="row">
                        <div class="col-12 display-b">
                            <div style="margin-top:3px;">
                                <i class="fa-solid fa-lock fa-xl"></i>
                            </div>
                            @if ($totalCer > 0)
                                <div class="text_estadistica"><i class="material-icons dp48 vertical-align-bottom">arrow_upward</i>
                                    <label>{{ $totalCer }}</label>
                                </div>
                            @elseif($totalCer = 0)
                                <div class="text_estadistica"><i class="material-icons dp48 vertical-align-bottom">arrow_forward</i>
                                    <label>{{ $totalCer }}</label>
                                </div>
                            @else
                                <div class="text_estadistica"><i class="material-icons dp48 vertical-align-bottom">arrow_downward</i>
                                    <label>{{ $totalCer }}</label>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h4 style="font-size: 15px !important; text-align: center !important;">&nbsp;&nbsp;Contratos &nbsp;&nbsp;&nbsp;cerrados</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-2">
            <div class="card card_dp">
                <div class="card-body datos-primeros dp4">
                    <div class="row">
                        <div class="col-12 display-b">
                            <div style="margin-top:3px;">
                                <i class="fa-solid fa-arrows-rotate fa-xl"></i>
                            </div>
                            @if ($totalRev > 0)
                                <p class="text_estadistica"><i class="material-icons dp48 vertical-align-bottom">arrow_upward</i>
                                    <label>{{ $totalRev }}</label>
                                </p>
                            @elseif($totalRev = 0)
                                <p class="text_estadistica"><i class="material-icons dp48 vertical-align-bottom">arrow_forward</i>
                                    <label>{{ $totalRev }}</label>
                                </p>
                            @else
                                <p class="text_estadistica"><i class="material-icons dp48 vertical-align-bottom">arrow_downward</i>
                                    <label>{{ $totalRev }}</label>
                                </p>
                            @endif
                        </div>
                        <div>
                            <h4 style="font-size: 15px !important; text-align: center !important;margin-top:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Renovaciones</h4>
                            <h4 style="font-size: 5px !important; text-align: center !important;margin-top:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-2">
            <div class="card card_dp">
                <div class="card-body datos-primeros dp5">
                    <div class="row">
                        <div class="col-12 display-b">
                            <div style="margin-top:3px;">
                                <i class="fa-solid fa-thumbs-up fa-xl"></i>
                            </div>
                            @if ($cumple > 0)
                                <div class="text_estadistica"><i class="material-icons dp48 vertical-align-bottom">arrow_upward</i>
                                    <label>{{ $cumple }}</label>
                                </div>
                            @elseif($cumple = 0)
                                <div class="text_estadistica"><i class="material-icons dp48 vertical-align-bottom">arrow_forward</i>
                                    <label>{{ $cumple }}</label>
                                </div>
                            @else
                                <div class="text_estadistica"><i class="material-icons dp48 vertical-align-bottom">arrow_downward</i>
                                    <label>{{ $cumple }}</label>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h4 style="font-size: 5px !important; text-align: center !important;">&nbsp;</h4>
                            <h4 style="font-size: 15px !important; text-align: center !important;margin-top:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cumplen</h4>
                            <h4 style="font-size: 5px !important; text-align: center !important;margin-top:5px;">&nbsp;</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-2">
            <div class="card card_dp">
                <div class="card-body datos-primeros dp6">
                    <div class="row">
                        <div class="col-12 display-b">
                            <div style="margin-top:3px;">
                                <i class="fa-solid fa-thumbs-down fa-xl"></i>
                            </div>
                            @if ($nocumple > 0)
                                <div class="text_estadistica"><i class="material-icons dp48 vertical-align-bottom">arrow_upward</i>
                                    <label>{{ $nocumple }}</label>
                                </div>
                            @elseif($nocumple = 0)
                                <div class="text_estadistica"><i class="material-icons dp48 vertical-align-bottom">arrow_forward</i>
                                    <label>{{ $nocumple }}</label>
                                </div>
                            @else
                                <div class="text_estadistica"><i class="material-icons dp48 vertical-align-bottom">arrow_downward</i>
                                    <label>{{ $nocumple }}</label>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h4 style="font-size: 5px !important; text-align: center !important;margin-top:8px;">&nbsp;</h4>
                            <h4 style="font-size: 15px !important; text-align: center !important;margin-top:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No Cumplen</h4>
                            <h4 style="font-size: 5px !important; text-align: center !important;margin-top:5px;">&nbsp;</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card border-0">
                <div class="card-body" style="height: 500px;">
                    <h4 class="card-title graficas_titulos graficas_titulo1">Tipo de contrato</h4>
                    <!--<div id="bar-chart" class="center"></div>-->
                    <figure class="highcharts-figure" width="600">
                        <div id="container"></div>
                    </figure>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="card-title graficas_titulos graficas_titulo2">Contratos por fase</h4>
                        </div>
                        <div class="col-12">
                            <div id="pie-chart-sample" class="center graficas" style="margin-top: 0;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="card-title graficas_titulos graficas_titulo3">Top 10 proveedores/clientes con más
                                contratos</h4>
                        </div>
                        <div class="col-12">
                            <div class="list-group">
                                @foreach ($topten as $top)
                                    <a href="#!" class="list-group-item">
                                        @if ($top->totalcontrato <= 0)
                                            <span class="badge badge-primary">
                                                {{ $top->totalcontrato }}
                                            </span>
                                        @elseif($top->totalcontrato > 0)
                                            <span class="badge badge-success">
                                                {{ $top->totalcontrato }}
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                {{ $top->totalcontrato }}
                                            </span>
                                        @endif
                                        {{ $top->nombre }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="card-title graficas_titulos graficas_titulo4">Top 10 proveedores en
                                incumplimiento</h4>
                        </div>
                        <div class="col-12">
                            <div class="list-group">
                                @foreach ($topnocumpletot as $top)
                                    <a href="#!" class="list-group-item">
                                        @if ($top->totalcontrato <= 0)
                                            <span class="badge badge-primary">
                                                {{ $top->totalcontrato }}
                                            </span>
                                        @elseif($top->totalcontrato > 0)
                                            <span class="badge badge-success">
                                                {{ $top->totalcontrato }}
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                {{ $top->totalcontrato }}
                                            </span>
                                        @endif
                                        {{ $top->nombre }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h4 style="font-size: 5px !important; text-align: center !important;margin-top:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
            <h4 class="card-title graficas_titulos graficas_titulo2" style="padding-top: 6px;">Clientes</h4>
            <div class="row" style="margin-top: 30px;">
                <div class="col-10">
                    {{-- @livewire('proveedores-dashboard.proveedores-component') --}}
                    <select class="form-control" name="proveedor" id="proveedor">
                        <option value="" selected disabled>Seleccione un Cliente</option>
                        @forelse($clientes as $item)
                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @empty
                            <option value="">No hay Clientes registrados</option>
                        @endforelse
                    </select>
                <h4 style="font-size: 5px !important; text-align: center !important;margin-top:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                </div>
                <div class="col s2">
                    {!! Form::submit('Buscar', ['class' => 'btn btn-primary', 'id' => 'buscar_proveedor', 'onclick' => "buscarproveedor($('#proveedor').val());return false;", 'style' => '']) !!}
                </div>
            </div>
            <div id="resultado_proveedor" class="col-12"></div>
<div id="resultado_contrato" class="col-12"></div>
<div class="row" style="display: flex; flex-wrap: wrap;">
    <div id="resultado_entregables" class="col-12 border rounded-3" style="display:none;"></div>
    <div id="c_grafica_facturacion" class="col-12 border rounded-3" style="display: none;">
        <div id="titulo_grafica_facturacion" class="col-12" style="padding: 15px;"></div>
        <div id="c_facturas" class="table-responsive" style="display: flex; align-items: center; margin-top: -14px;">
            <div id="tbl_facturas" class="table-responsive" style="padding: 0;"></div>
            <div id="grafica_facturacion" class="col-1" style="display:none"></div>
        </div>
    </div>
</div>
<div id="evaluaciones_servicio" class="table-responsive" style="display: none">
    <div id="niveles_servicio" class="table-responsive"
        style="padding: 19px 50px;"></div>
    <div id="titulo_graficas_servicio" class="col-12" style="padding: 15px;"></div>
    <div id="c_evaluaciones" class="col-12 border rounded-3">
        <div id="grafica_promedio" class="col-12 col-md-6 col-lg-6"></div>
        <div id="grafica_historico" class="col-12 col-md-6 col-lg-6"></div>
    </div>
</div>
<div id="cierre" class="col-12 border rounded-3" style="display: none;">
    <div id="titulo_cierre" class="col-12" style="width: 100%; padding: 15px 15px 0 15px"></div>
    <div id="c_cierre" class="col-12 row">
        <div id="tabla_cierre" class="col-12 col-md-6 col-lg-6">
            <!-- Contenido de la tabla de cierre aquí -->
        </div>
        <div id="grafica_cierre" class="col-12 col-md-6 col-lg-6">
            <!-- Contenido de la gráfica de cierre aquí -->
        </div>
    </div>
</div>


    @endsection
    @section('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    @include('layouts.datatables_js')
    <script type="text/javascript">
        let renovacion = @json($DashboardCicloVida['renovacion']);
        let solicitud_contrato = @json($DashboardCicloVida['solicitud_contrato']);
        let autorizacion = @json($DashboardCicloVida['autorizacion']);
        let negociacion = @json($DashboardCicloVida['negociacion']);
        let aprobacion = @json($DashboardCicloVida['aprobacion']);
        let ejecucion = @json($DashboardCicloVida['ejecucion']);
        let gestionOb = @json($DashboardCicloVida['gestionOb']);
        let modif_contrato = @json($DashboardCicloVida['modif_contrato']);
        let auditoria_reportes = @json($DashboardCicloVida['auditoria_reportes']);

        Highcharts.chart('pie-chart-sample', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: [{
                    name: 'Renovación',
                    y: renovacion,
                    sliced: true,
                    selected: true
                }, {
                    name: 'Solicitud de contrato',
                    y: solicitud_contrato,
                }, {
                    name: 'Autorización',
                    y: autorizacion,
                }, {
                    name: 'Negociación',
                    y: negociacion,
                }, {
                    name: 'Aprobación',
                    y: aprobacion,
                }, {
                    name: 'Ejecución',
                    y: ejecucion,
                }, {
                    name: 'Gestión de obligaciones',
                    y: gestionOb,
                }, {
                    name: 'Modificación de contrato',
                    y: modif_contrato,
                }, {
                    name: 'Auditoria y reportes',
                    y: auditoria_reportes,
                }]
            }]
        });
    </script>
    <script type="text/javascript">
        // Create the chart
        let fabrica_desarrollo = @json($DashboardTipoContrato['fabrica_desarrollo']);
        let fabrica_pruebas = @json($DashboardTipoContrato['fabrica_pruebas']);
        let telecomunicaciones = @json($DashboardTipoContrato['telecomunicaciones']);
        let seguridad_informacion = @json($DashboardTipoContrato['seguridad_informacion']);
        let Infraestructura = @json($DashboardTipoContrato['Infraestructura']);
        let servicio_nube = @json($DashboardTipoContrato['servicio_nube']);
        let servicio_norma = @json($DashboardTipoContrato['servicio_norma']);
        let arrendamiento_equipo = @json($DashboardTipoContrato['arrendamiento_equipo']);
        let adquisicion_de_bienes = @json($DashboardTipoContrato['Adquisición de bienes']);
        let Soporte = @json($DashboardTipoContrato['Soporte']);
        let impresion = @json($DashboardTipoContrato['impresion']);
        let licencia = @json($DashboardTipoContrato['licencia']);
        let administrativo = @json($DashboardTipoContrato['administrativo']);
        let adquisicion_de_papeleria = @json($DashboardTipoContrato['adquisicion_de_papeleria']);
        let servicios_de_consultoria = @json($DashboardTipoContrato['servicios_de_consultoria']);
        let servicios_medicos = @json($DashboardTipoContrato['servicios_medicos']);
        let servicio_de_seguros = @json($DashboardTipoContrato['servicio_de_seguros']);
        let mantenimiento_de_edificio = @json($DashboardTipoContrato['mantenimiento_de_edificio']);
        let seguridad_y_vigilancia = @json($DashboardTipoContrato['seguridad_y_vigilancia']);
        let servicio_de_limpieza = @json($DashboardTipoContrato['servicio_de_limpieza']);
        let servicios_de_alimentos = @json($DashboardTipoContrato['servicios_de_alimentos']);
        let educacion_continua = @json($DashboardTipoContrato['educacion_continua']);
        let adquisicion_de_mascarillas = @json($DashboardTipoContrato['adquisicion_de_mascarillas']);
        let adquisicion_de_pruebas_covid = @json($DashboardTipoContrato['adquisicion_de_pruebas_covid']);
        let otro = @json($DashboardTipoContrato['otro']);

        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: ' '
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total tipo contrato'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.1f}'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> en total<br/>'
            },

            series: [{
                name: "Contratos",
                colorByPoint: true,
                data: [{
                        name: "Fábrica desarrollo",
                        y: fabrica_desarrollo,
                        drilldown: "Fábrica desarrollo"
                    },
                    {
                        name: "Fábrica pruebas",
                        y: fabrica_pruebas,
                        drilldown: "Fábrica pruebas"
                    },
                    {
                        name: "Telecomunicaciones",
                        y: telecomunicaciones,
                        drilldown: "telecomunicaciones"
                    },
                    {
                        name: "Seguridad información",
                        y: seguridad_informacion,
                        drilldown: "Seguridad información"
                    },
                    {
                        name: "Infraestructura",
                        y: Infraestructura,
                        drilldown: "Infraestructura"
                    },
                    {
                        name: "Servicio nube",
                        y: servicio_nube,
                        drilldown: "Servicio nube"
                    },
                    {
                        name: "Servicio normativa",
                        y: servicio_norma,
                        drilldown: "Servicio normativa"
                    },
                    {
                        name: "Arrendamiento equipos",
                        y: arrendamiento_equipo,
                        drilldown: "Arrendamiento equipos"
                    },
                    {
                        name: "Adquisición de bienes",
                        y: adquisicion_de_bienes,
                        drilldown: "Adquisición de bienes"
                    },
                    {
                        name: "Soporte",
                        y: Soporte,
                        drilldown: "Soporte"
                    },
                    {
                        name: "Impresion",
                        y: impresion,
                        drilldown: "Impresion"
                    },
                    {
                        name: "Licencia",
                        y: licencia,
                        drilldown: "Licencia"
                    },
                    {
                        name: "Administrativo",
                        y: administrativo,
                        drilldown: "Administrativo"
                    },
                    {
                        name: "Adquisición de papelería",
                        y: adquisicion_de_papeleria,
                        drilldown: "Adquisición de papelería"
                    },
                    {
                        name: "Servicios de Consultoría ",
                        y: servicios_de_consultoria,
                        drilldown: "Servicios de Consultoría "
                    },
                    {
                        name: "Servicios Médicos",
                        y: servicios_medicos,
                        drilldown: "Servicios Médicos"
                    },
                    {
                        name: "Servicio de Seguros",
                        y: servicio_de_seguros,
                        drilldown: "Servicio de Seguros"
                    },
                    {
                        name: "Mantenimiento de Edificio",
                        y: mantenimiento_de_edificio,
                        drilldown: "Mantenimiento de Edificio"
                    },
                    {
                        name: "Seguridad y Vigilancia",
                        y: seguridad_y_vigilancia,
                        drilldown: "Seguridad y Vigilancia"
                    },
                    {
                        name: "Servicio de Limpieza",
                        y: servicio_de_limpieza,
                        drilldown: "Servicio de Limpieza"
                    },
                    {
                        name: "Servicios de Alimentos",
                        y: servicios_de_alimentos,
                        drilldown: "Servicios de Alimentos"
                    },
                    {
                        name: "Educación Continua",
                        y: educacion_continua,
                        drilldown: "Educación Continua"
                    },
                    {
                        name: "Adquisición de Mascarillas",
                        y: adquisicion_de_mascarillas,
                        drilldown: "Adquisición de Mascarillas"
                    },
                    {
                        name: "Adquisición de Pruebas COVID",
                        y: adquisicion_de_pruebas_covid,
                        drilldown: "Adquisición de Pruebas COVID"
                    },
                    {
                        name: "Otro",
                        y: otro,
                        drilldown: "Otro"
                    },
                ]
            }],
            drilldown: {
                series: [{
                        name: "Chrome",
                        id: "Chrome",
                        data: [
                            [
                                "v65.0",
                                0.1
                            ],
                            [
                                "v64.0",
                                1.3
                            ],
                            [
                                "v63.0",
                                53.02
                            ],
                            [
                                "v62.0",
                                1.4
                            ],
                            [
                                "v61.0",
                                0.88
                            ],
                            [
                                "v60.0",
                                0.56
                            ],
                            [
                                "v59.0",
                                0.45
                            ],
                            [
                                "v58.0",
                                0.49
                            ],
                            [
                                "v57.0",
                                0.32
                            ],
                            [
                                "v56.0",
                                0.29
                            ],
                            [
                                "v55.0",
                                0.79
                            ],
                            [
                                "v54.0",
                                0.18
                            ],
                            [
                                "v51.0",
                                0.13
                            ],
                            [
                                "v49.0",
                                2.16
                            ],
                            [
                                "v48.0",
                                0.13
                            ],
                            [
                                "v47.0",
                                0.11
                            ],
                            [
                                "v43.0",
                                0.17
                            ],
                            [
                                "v29.0",
                                0.26
                            ]
                        ]
                    },
                    {
                        name: "Firefox",
                        id: "Firefox",
                        data: [
                            [
                                "v58.0",
                                1.02
                            ],
                            [
                                "v57.0",
                                7.36
                            ],
                            [
                                "v56.0",
                                0.35
                            ],
                            [
                                "v55.0",
                                0.11
                            ],
                            [
                                "v54.0",
                                0.1
                            ],
                            [
                                "v52.0",
                                0.95
                            ],
                            [
                                "v51.0",
                                0.15
                            ],
                            [
                                "v50.0",
                                0.1
                            ],
                            [
                                "v48.0",
                                0.31
                            ],
                            [
                                "v47.0",
                                0.12
                            ]
                        ]
                    },
                    {
                        name: "Internet Explorer",
                        id: "Internet Explorer",
                        data: [
                            [
                                "v11.0",
                                6.2
                            ],
                            [
                                "v10.0",
                                0.29
                            ],
                            [
                                "v9.0",
                                0.27
                            ],
                            [
                                "v8.0",
                                0.47
                            ]
                        ]
                    },
                    {
                        name: "Safari",
                        id: "Safari",
                        data: [
                            [
                                "v11.0",
                                3.39
                            ],
                            [
                                "v10.1",
                                0.96
                            ],
                            [
                                "v10.0",
                                0.36
                            ],
                            [
                                "v9.1",
                                0.54
                            ],
                            [
                                "v9.0",
                                0.13
                            ],
                            [
                                "v5.1",
                                0.2
                            ]
                        ]
                    },
                    {
                        name: "Edge",
                        id: "Edge",
                        data: [
                            [
                                "v16",
                                2.6
                            ],
                            [
                                "v15",
                                0.92
                            ],
                            [
                                "v14",
                                0.4
                            ],
                            [
                                "v13",
                                0.1
                            ]
                        ]
                    },
                    {
                        name: "Opera",
                        id: "Opera",
                        data: [
                            [
                                "v50.0",
                                0.96
                            ],
                            [
                                "v49.0",
                                0.82
                            ],
                            [
                                "v12.1",
                                0.14
                            ]
                        ]
                    }
                ]
            }
        });
    </script>
    <script>
        var popCanvas = document.getElementById("tipocontratoChart");
        // let fabrica_desarrollo = @json($DashboardTipoContrato['fabrica_desarrollo']);

        if (popCanvas) {
            popCanvas.highcharts({
                type: 'column',
                data: {
                    labels: [
                        "Fábrica de desarrollo",
                        "Fábrica de pruebas",
                        "Telecomunicaciones",
                        "Seguridad de la información",
                        "Infraestructura",
                        "Servicios en la nube",
                        "Servicios de consultoría Normativa",
                        "Arrendamiento de Equipos",
                        "Impresión",
                        "Licenciamiento",
                        "Administrativo",
                        "AdquisicionPapeleria",
                        "ServiciosConsultoria",
                        "ServiciosMedicos",
                        "ServicioSeguros",
                        "MantenimientoEdificio",
                        "SeguridadyVigilancia",
                        "ServiciodeLimpieza",
                        "ServiciosdeAlimentos",
                        "EducaciónContinua",
                        "AdquisiciónPruebasCOVID",
                        "AdquisiciónMascarillas",
                        "Otro",
                    ],
                    datasets: [{
                        label: '% Implementación por fase',
                        data: [
                            fabrica_desarrollo,
                            fabrica_pruebas,
                            telecomunicaciones,
                            seguridad_informacion,
                            Infraestructura,
                            servicio_nube,
                            servicio_norma,
                            arrendamiento_equipo,
                            impresion,
                            licencia,
                            administrativo,
                            adquisicion_de_papeleria,
                            servicios_de_consultoria,
                            servicios_medicos,
                            servicio_de_seguros,
                            mantenimiento_de_edificio,
                            seguridad_y_vigilancia,
                            servicio_de_limpieza,
                            servicios_de_alimentos,
                            educacion_continua,
                            adquisicion_de_pruebas_covid,
                            adquisicion_de_mascarillas,
                            otro
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                        ]
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                }
            });
        }
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        function buscarproveedor(valorPuesto) {
            $.ajax({
                data: {
                    valor: valorPuesto
                },
                url: '{{ route('contract_manager.selectCliente') }}',
                type: 'POST',
                beforeSend: function() {
                    $("#resultado_proveedor").html("<div class='progress md-progress primary-color-dark'>\n " +
                        "<div class='indeterminate'></div>\n</div>");
                },
                success: function(data) {
                    //console.log(data);
                    $("#resultado_proveedor").html(data);

                },
                error: function(data) {
                    //console.log(data);
                    $("#resultado_proveedor").html("<div class=\"alert alert-danger\" role=\"alert\">\n" +
                        " ¡Intente de nuevo!\n" + "</div>");
                }
            });
        }

        function buscarcontrato() {
    var proveedorq = $('#proveedor').val();
    var contratoq = $('#contrato').val();

    $.ajax({
        data: {
            proveedorq: proveedorq,
            contratoq: contratoq
        },
        url: '{{ route('contract_manager.selectContrato')}}',
        type: 'POST',
        beforeSend: function() {
            $("#resultado_contrato").html("<div class='progress md-progress primary-color-dark'>\n " +
                "<div class='indeterminate'></div>\n</div>");
        },
        success: function(data) {
            try {
                // Intenta manejar la respuesta exitosa
                $("#resultado_contrato").html(data);
            } catch (error) {
                console.error("Error en la función success:", error);
            }
        },
        error: function(xhr, status, error) {
            try {
                // Intenta manejar el error
                console.error("Error en la solicitud AJAX:", error);
                $("#resultado_contrato").html("<div class=\"alert alert-danger\" role=\"alert\">\n" +
                    " ¡Intente de nuevo!\n" + "</div>");
            } catch (error) {
                console.error("Error en la función error:", error);
            }
        }
    });
}

        function buscarhistorico(servicio_id, nombre_servicio, unidad_servicio) {
            $.ajax({
                type: "POST",
                url: '{{ route('contract_manager.selectEvaluacionesServicio') }}',
                data: {
                    servicio_id
                },
                success: function({
                    historico
                }) {
                    arrLabels = [];
                    arrPromedios = [];
                    let color_sla = "";
                    let evPromedio = 0;
                    historico.forEach(evaluacion => {
                        evPromedioNoInt = Number(evaluacion.promedio) / Number(evaluacion.meta) * 100;
                        evPromedio = Math.round(evPromedioNoInt);
                        if (evPromedio > 60 && evPromedio <= 100) {
                            color_sla = "#009999";
                        } else if (evPromedio > 30 && evPromedio <= 60) {
                            color_sla = "#FFC000";
                        } else {
                            color_sla = "#FF6565";
                        }
                        let fecha = moment(
                            evaluacion.fecha
                        );

                        arrLabels.push(fecha.format('DD-MM-YYYY'));
                        arrPromedios.push({
                            y: Number(evaluacion.promedio),
                            color: color_sla,
                            more: evaluacion.fecha
                        });
                    });
                    historico_chart(arrLabels, arrPromedios, nombre_servicio, unidad_servicio);
                }
            });
        }
    </script>
    <script src="{{ asset('js/dashboard/graficas_contratos.js') }}"></script>
    @endsection
