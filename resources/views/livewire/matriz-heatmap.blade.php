<div>
    <style>
        .text-orange {
            color: orange !important;
        }

        .mayus {
            text-transform: uppercase;
        }

        .text-yellow {
            color: #f4c272 !important;
        }

        .table-scroll {
            display: block;
            height: 300px;
            overflow-y: scroll;
        }

    </style>

    <div class="row">
        <div class="col-md-4">
            <p class="text-xl text-gray-700">Sede:</p>
            <select class="form-control" wire:model="sede">
                <option value="" selected disabled>Seleccione una sede</option>
                @foreach ($sedes as $sede)
                    <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <p class="text-xl text-gray-700">Area:</p>
            <select class="form-control" wire:model="area">
                <option value="" selected disabled>Seleccione un area</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->area }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <p class="text-xl text-gray-700">Proceso:</p>
            <select class="form-control" wire:model="sede">
                <option value="" selected disabled>Seleccione una proceso</option>
                @foreach ($procesos as $proceso)
                    <option value="{{ $proceso->id }}">{{ $proceso->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="calor">
                <div class="datosCalor">
                    <label class="text-primary" style="font-size: 20px;">Riesgo inicial</label>
                    <table class="table table-hover table-scroll">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Riesgo</th>
                                <th scope="col">Probabilidad</th>
                                <th scope="col">Impacto</th>
                                <th scope="col">Nivel riesgo</th>
                            </tr>
                        </thead>
                        @foreach ($listados as $listado)
                            <tr class="con" href="{{ route('admin.matriz-riesgos.show', [$listado->id]) }}">
                                <td>{{ $listado->id }}</td>
                                <td>{{ wordwrap($listado->descripcionriesgo, 10, "\n" ,TRUE) }}</td>
                                <td>{{ $listado->probabilidad }}</td>
                                <td>{{ $listado->impacto }}</td>
                                <td>
                                    @switch($listado->nivelriesgo)
                                        @case(0)
                                            <span class="text-green mayus">Baja ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @case(9)
                                            <span class="text-yellow mayus">Media ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @case(18)
                                            <span class="text-yellow mayus">Alta ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @case(27)
                                            <span class="text-orange mayus">Muy Alta ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @case(36)
                                            <span class="text-danger mayus">Alta ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @case(54)
                                            <span class="text-danger mayus">Muy Alta ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @case(81)
                                            <span class="text-danger mayus">Muy Alta ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @default
                                    @endswitch
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="mapaCalor">
                    <div class="txtVertical text-primary font-weight-bold"
                        style="position:absolute; margin-top: 20px;font-size: 20px; margin-left: 15px;">Impacto</div>
                    <table>
                        <tr>
                            <td>Muy Alta</td>
                            <td class="amarillo" id="s_baja_p_muyAlta" wire:click="callQuery(0 , '1')">
                                @if ($changer == '1')
                                    {{ $conteo }}
                                @else
                                    0
                                @endif
                            </td>
                            <td class="naranja" id="s_media_p_muyAlta" wire:click="callQuery(27, '2')">
                                @if ($changer == '2')
                                    {{ $conteo }}
                                @else
                                    27
                                @endif
                            </td>
                            <td class="rojo" id="s_alta_p_muyAlta" wire:click="callQuery(54, '3')">
                                @if ($changer == '3')
                                    {{ $conteo }}
                                @else
                                    54
                                @endif
                            </td>
                            <td class="rojo" id="s_muyAlta_p_muyAlta" wire:click="callQuery(81, '4')">
                                @if ($changer == '4')
                                    {{ $conteo }}
                                @else
                                    81
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Alta</td>
                            <td class="amarillo" id="s_baja_p_alta" wire:click="callQuery(0)">0</td>
                            <td class="amarillo" id="s_media_p_alta" wire:click="callQuery(18)">18</td>
                            <td class="naranja" id="s_alta_p_alta" wire:click="callQuery(36)">36</td>
                            <td class="rojo" id="s_muyAlta_p_alta" wire:click="callQuery(54)">54</td>
                        </tr>
                        <tr>
                            <td>Media</td>
                            <td class="verde" id="s_baja_p_media">0</td>
                            <td class="amarillo" id="s_media_p_media">9</td>
                            <td class="amarillo" id="s_alta_p_media">18</td>
                            <td class="naranja" id="s_muyAlta_p_media">27</td>
                        </tr>
                        <tr>
                            <td>Baja</td>
                            <td class="verde" id="s_baja_p_baja">0</td>
                            <td class="verde" id="s_media_p_baja">0</td>
                            <td class="amarillo" id="s_alta_p_baja">0</td>
                            <td class="amarillo" id="s_muyAlta_p_baja">0</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Baja</td>
                            <td>Media</td>
                            <td>Alta</td>
                            <td>Muy Alta</td>
                        </tr>
                    </table>
                    <div class="txtHorizontal text-primary font-weight-bold"
                        style="margin-left: 250px; font-size: 20px;">Probabilidad</div>
                </div>
            </div>

        </div>
        <div class="col-md-12">

            <div class="calor">
                <div class="datosCalor">
                    <label class="text-primary" style="font-size: 20px;">Riesgo residual</label>
                    <table class="table table-hover table-scroll">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Riesgo</th>
                                <th scope="col">Nivel riesgo</th>
                            </tr>
                        </thead>
                        @foreach ($listados as $listado)
                            <tr class="con" href="{{ route('admin.matriz-riesgos.show', [$listado->id]) }}">
                                <td>{{ $listado->id }}</td>
                                <td>{{ $listado->descripcionriesgo }}</td>
                                <td>
                                    @switch($listado->nivelriesgo)
                                        @case(0)
                                            <span class="text-green mayus">Baja ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @case(9)
                                            <span class="text-yellow mayus">Media ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @case(18)
                                            <span class="text-yellow mayus">Alta ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @case(27)
                                            <span class="text-orange mayus">Muy Alta ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @case(36)
                                            <span class="text-danger mayus">Alta ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @case(54)
                                            <span class="text-danger mayus">Muy Alta ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @case(81)
                                            <span class="text-danger mayus">Muy Alta ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @default
                                    @endswitch
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="mapaCalor">
                    <div class="txtVertical text-primary font-weight-bold"
                        style="position:absolute; margin-top: 20px;font-size: 20px; margin-left: 15px;">Impacto</div>
                    <table>
                        <tr>
                            <td>Muy Alta</td>
                            <td class="amarillo" id="s_baja_p_muyAlta">0</td>
                            <td class="naranja" id="s_media_p_muyAlta">27</td>
                            <td class="rojo" id="s_alta_p_muyAlta">54</td>
                            <td class="rojo" id="s_muyAlta_p_muyAlta">81</td>
                        </tr>
                        <tr>
                            <td>Alta</td>
                            <td class="amarillo" id="s_baja_p_alta">0</td>
                            <td class="amarillo" id="s_media_p_alta">18</td>
                            <td class="naranja" id="s_alta_p_alta">36</td>
                            <td class="rojo" id="s_muyAlta_p_alta">54</td>
                        </tr>
                        <tr>
                            <td>Media</td>
                            <td class="verde" id="s_baja_p_media">0</td>
                            <td class="amarillo" id="s_media_p_media">9</td>
                            <td class="amarillo" id="s_alta_p_media">18</td>
                            <td class="naranja" id="s_muyAlta_p_media">27</td>
                        </tr>
                        <tr>
                            <td>Baja</td>
                            <td class="verde" id="s_baja_p_baja">0</td>
                            <td class="verde" id="s_media_p_baja">0</td>
                            <td class="amarillo" id="s_alta_p_baja">0</td>
                            <td class="amarillo" id="s_muyAlta_p_baja">0</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Baja</td>
                            <td>Media</td>
                            <td>Alta</td>
                            <td>Muy Alta</td>
                        </tr>
                    </table>
                    <div class="txtHorizontal text-primary font-weight-bold"
                        style="margin-left: 250px; font-size: 20px;">Probabilidad</div>
                </div>
            </div>

        </div>
    </div>

    {{-- <div class="row">
        <div class="col-md-6">

            <div class="calor">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>
            </div>

        </div>
        {{-- <div class="col-md-6">

            <div class="calor">
                <div class="datosCalor">
                    <label class="text-primary" style="font-size: 20px;">Riesgo residual</label>
                </div>
                <div class="mapaCalor">
                    <div class="txtVertical text-primary font-weight-bold"
                        style="position:absolute; margin-top: 20px;font-size: 20px;">Impacto</div>
                    <table>
                        <tr>

                            <td>Muy Alta</td>
                            <td class="amarillo" id="s_baja_p_muyAlta"></td>
                            <td class="naranja" id="s_media_p_muyAlta"></td>
                            <td class="rojo" id="s_alta_p_muyAlta"></td>
                            <td class="rojo" id="s_muyAlta_p_muyAlta"></td>
                        </tr>
                        <tr>
                            <td>Alta</td>
                            <td class="amarillo" id="s_baja_p_alta"></td>
                            <td class="naranja" id="s_media_p_alta"></td>
                            <td class="naranja" id="s_alta_p_alta"></td>
                            <td class="rojo" id="s_muyAlta_p_alta"></td>
                        </tr>
                        <tr>
                            <td>Media</td>
                            <td class="verde" id="s_baja_p_media"></td>
                            <td class="amarillo" id="s_media_p_media"></td>
                            <td class="naranja" id="s_alta_p_media"></td>
                            <td class="naranja" id="s_muyAlta_p_media"></td>
                        </tr>
                        <tr>
                            <td>Baja</td>
                            <td class="verde" id="s_baja_p_baja"></td>
                            <td class="verde" id="s_media_p_baja"></td>
                            <td class="amarillo" id="s_alta_p_baja"></td>
                            <td class="amarillo" id="s_muyAlta_p_baja"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Baja</td>
                            <td>Media</td>
                            <td>Alta</td>
                            <td>Muy Alta</td>
                        </tr>
                    </table>
                    <div class="txtHorizontal text-primary font-weight-bold"
                        style="margin-left: 150px; font-size: 20px;">Probabilidad</div>
                </div>
            </div>

        </div>
    </div> --}}
</div>

<script>
    /*    function getPointCategoryName(point, dimension) {
        var series = point.series,
            isY = dimension === 'y',
            axis = series[isY ? 'yAxis' : 'xAxis'];
        return axis.categories[point[isY ? 'y' : 'x']];
    }

    Highcharts.chart('container', {

        chart: {
            type: 'heatmap',
            marginTop: 40,
            marginBottom: 80,
            plotBorderWidth: 1
        },


        title: {
            text: 'Riesgo Inicial'
        },

        xAxis: {
            categories: ['NULA', 'BAJA', 'MEDIA', 'ALTA']
        },

        yAxis: {
            categories: ['MUY ALTO', 'ALTO', 'MEDIA', 'BAJA'],
            title: null,
            reversed: true
        },

        accessibility: {
            point: {
                descriptionFormatter: function(point) {
                    var ix = point.index + 1,
                        xName = getPointCategoryName(point, 'x'),
                        yName = getPointCategoryName(point, 'y'),
                        val = point.value;
                    return ix + '. ' + xName + ' sales ' + yName + ', ' + val + '.';
                }
            }
        },

        colorAxis: {
            min: 0,
            minColor: '#FFFFFF',
            maxColor: Highcharts.getOptions().colors[0]
        },

        legend: {
            align: 'right',
            layout: 'vertical',
            margin: 0,
            verticalAlign: 'top',
            y: 25,
            symbolHeight: 280
        },

        tooltip: {
            formatter: function() {
                return '<b>' + getPointCategoryName(this.point, 'x') + '</b> sold <br><b>' +
                    this.point.value + '</b> items on <br><b>' + getPointCategoryName(this.point, 'y') +
                    '</b>';
            }
        },

        series: [{
            name: 'Sales per employee',
            borderWidth: 1,
            data: [
                [0, 0, 10],
                [0, 1, 19],
                [0, 2, 8],
                [0, 3, 24],
                [0, 4, 67],
                [1, 0, 92],
                [1, 1, 58],
                [1, 2, 78],
                [1, 3, 117],
                [1, 4, 48],
                [2, 0, 35],
                [2, 1, 15],
                [2, 2, 123],
                [2, 3, 64],
                [2, 4, 52],
                [3, 0, 72],
                [3, 1, 132],
                [3, 2, 114],
                [3, 3, 19],
                [3, 4, 16],
            ],
            dataLabels: {
                enabled: true,
                color: '#000000'
            }
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    yAxis: {
                        labels: {
                            formatter: function() {
                                return this.value.charAt(0);
                            }
                        }
                    }
                }
            }]
        }

    });*/
</script>
