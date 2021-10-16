<style>
    .letras-dashboard {
        font-size: 12px;
    }

    .letras-dashboard2 {
        font-size: 10px;
    }

    .fondo-azul {
        background-color: deepskyblue;
        color: black;
    }
</style>
<div class="row" style="display:flex; justify-content: end; padding-right: 20px;">
    <button class="btn btn-danger" onclick="printJS({
        printable: 'impreso_row',
        type: 'html',
        css: 'ht tps://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css',})">
        <i class="fas fa-print"></i>
        Imprimir
    </button>
</div>
<div class="mt-3" id="impreso_row">


    <div class="row">
                <div class="col-12">
            <!--<div class="col">-->
            <div class="card">
                <div class="card-body">
                    <h6 align="center">PORCENTAJE DE IMPLEMENTACIÓN GENERAL ISO 27001
                        ({{number_format($porcentajeGap1, 2, '.', '') + (number_format($porcentajeGap3['porcentaje'], 2, '.', '')) + number_format($porcentajeGap2['Avance'], 2, '.', '')}}
                        %)
                    </h6>
                    <div class="progress">
                        <div
                            class="progress-bar progress-bar-striped progress-bar-animated"
                            role="progressbar" aria-valuenow="40"
                            aria-valuemin="0" aria-valuemax="100"
                            style="width: {{number_format($porcentajeGap1, 2, '.', '') + (number_format($porcentajeGap3['porcentaje'], 2, '.', '')) + number_format($porcentajeGap2['Avance'], 2, '.', '')}}%">{{number_format($porcentajeGap1, 2, '.', '') + (number_format($porcentajeGap3['porcentaje'], 2, '.', '')) + number_format($porcentajeGap2['Avance'], 2, '.', '')}}
                            %
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm">
                            <table class="table table-responsive-sm letras-dashboard">
                                <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Fase</th>
                                    <th scope="col">Meta</th>
                                    <th scope="col">Alcanzado</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">GAP01</th>
                                    <td>Planear</td>
                                    <td>30%</td>
                                    <td>{{number_format($porcentajeGap1, 2, '.', '')}}%</td>
                                </tr>
                                <tr>
                                    <th scope="row">GAP02</th>
                                    <td>Hacer</td>
                                    <td>40%</td>
                                    <td>{{number_format($porcentajeGap2['Avance'], 2, '.', '')}}%</td>
                                </tr>
                                <tr>
                                    <th rowspan="2">
                                        GAP03
                                    </th>
                                    <td>Verificar</td>
                                    <td>15%</td>
                                    <td>{{number_format($porcentajeGap3['verificar'], 2, '.', '')}}%</td>
                                </tr>
                                <tr>
                                    <td>Actuar</td>
                                    <td>15%</td>
                                    <td>{{number_format($porcentajeGap3['actuar'], 2, '.', '')}}%</td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Total</td>
                                    <td>100%</td>
                                    <td class="fondo-azul">{{number_format($porcentajeGap1, 2, '.', '') + (number_format($porcentajeGap3['porcentaje'], 2, '.', '')) + number_format($porcentajeGap2['Avance'], 2, '.', '')}}%
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm">
                            <canvas id="popChart" width="800" height="650"></canvas>
                        </div>
                        <div class="col-sm">
                            <div id="gaugeArea" width="800" height="650"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--segunda tabla-->
    {{-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="fondo-azul text-white" align="center">
                        POR DOMINIO DE CONTROL</h6>
                    <table class="table table-responsive" style="margin-top: 0px;">
                        <thead class="thead-dark letras-dashboard2 align-middle">
                        <tr>
                            <th scope="col">NOMBRE DOMINIOS DE CONTROL</th>
                            <th scope="col">CONTROLES QUE APLICAN</th>
                            <th scope="col">PESO CONTROLES IMPLEMENTADOS Y PARCIALMENTE IMPLEMENTADOS</th>
                            <th scope="col">IMPLEMENTADOS</th>
                            <th scope="col">PARCIALMENTE</th>
                            <th scope="col">NO CUMPLE</th>
                            <th scope="col">NO APLICA</th>
                        </tr>
                        </thead>
                        <tbody class="letras-dashboard" align="center">
                        <tr>
                            <td>DOMINIO 5 - POLÍTICAS DE SEGURIDAD DE LA INFORMACIÓN</td>
                            <td>2</td>
                            <td>2</td>
                            <td>2</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>DOMINIO 6 - ORGANIZACIÓN DE LA SEGURIDAD DE LA INFORMACIÓN</td>
                            <td>7</td>
                            <td>5.5</td>
                            <td>4</td>
                            <td>3</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>DOMINIO 7 - SEGURIDAD DE LOS RECURSOS HUMANOS</td>
                            <td>6</td>
                            <td>4</td>
                            <td>3</td>
                            <td>1</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>DOMINIO 8 - GESTIÓN DE ACTIVOS</td>
                            <td>6</td>
                            <td>4</td>
                            <td>3</td>
                            <td>1</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>DOMINIO 9 - CONTROL DE ACCESO</td>
                            <td>6</td>
                            <td>4</td>
                            <td>3</td>
                            <td>1</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>DOMINIO 10 - CRIPTOGRAFÍA</td>
                            <td>6</td>
                            <td>4</td>
                            <td>3</td>
                            <td>1</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>DOMINIO 11 - SEGURIDAD FÍSICA Y DEL ENTORNO</td>
                            <td>6</td>
                            <td>4</td>
                            <td>3</td>
                            <td>1</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>DOMINIO 12 - SEGURIDAD DE LAS OPERACIONES</td>
                            <td>6</td>
                            <td>4</td>
                            <td>3</td>
                            <td>1</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>DOMINIO 13 - SEGURIDAD DE LAS COMUNICACIONES</td>
                            <td>6</td>
                            <td>4</td>
                            <td>3</td>
                            <td>1</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>DOMINIO 14 - ADQUISICIÓN, DESARROLLO Y MANTENIMIENTO DE SISTEMAS</td>
                            <td>6</td>
                            <td>4</td>
                            <td>3</td>
                            <td>1</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>DOMINIO 15 - RELACIÓN CON LOS PROVEEDORES</td>
                            <td>6</td>
                            <td>4</td>
                            <td>3</td>
                            <td>1</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>DOMINIO 16 - GESTIÓN DE INCIDENTES DE SEGURIDAD DE LA INFORMACIÓN</td>
                            <td>6</td>
                            <td>4</td>
                            <td>3</td>
                            <td>1</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>DOMINIO 17 - ASPECTOS DE SEGURIDAD DE LA INFORMACIÓN DE LA GESTION DE CONTINUIDAD DE
                                NEGOCIO
                            </td>
                            <td>6</td>
                            <td>4</td>
                            <td>3</td>
                            <td>1</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>DOMINIO 18 - SEGURIDAD DE LAS COMUNICACIONES</td>
                            <td>6</td>
                            <td>4</td>
                            <td>3</td>
                            <td>1</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
    <!--segunda tabla-->
    <!--tercera tabla-->
    {{-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 align="center">AVANCES POR DOMINIO DE CONTROL</h6>
                    <canvas id="myChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div> --}}
    <!--tercera tabla-->
    <!--cuarta tabla-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="barraGap1_tablero" class="barraGap1_table">
                        <h6 align="center">GAP 01: DEFINICIÓN DE MARCO DE
                            SEGURIDAD
                            Y PRIVACIDAD DE LA ORGANIZACIÓN ({{number_format($porcentajeGap1, 2, '.', '')}}%)</h6>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                aria-valuenow="{{(number_format($porcentajeGap1, 2, '.', '') * 100) / 30}}" aria-valuemin="0"
                                aria-valuemax="100"
                                style="width: {{(number_format($porcentajeGap1, 2, '.', '') * 100) / 30}}%">{{number_format($porcentajeGap1, 2, '.', '')}}
                                %
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row" id="refrs">
                        <div class="col-sm" align="center">
                            <span>PLANEAR</span>
                            <table class="table table-responsive-sm letras-dashboard">
                                <thead>
                                <tr>
                                    <th scope="col">ESTATUS</th>
                                    <th scope="col">REQUISITOS</th>
                                    <th scope="col">PESO</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Cumple satisfactoriamente</td>
                                    <td class="text-black" style="background-color: rgba(22, 160, 133, 0.6);">
                                        {{$conteos['Gap1']['satisfactorio']}}
                                    </td>
                                    <td>{{number_format(($conteos['Gap1']['satisfactorio'] * 100) / 15), 2, '.', ''}}%</td>
                                    {{-- <td>{{$conteos['Gap1']['satisfactorio']}}</td> --}}
                                    {{-- <td>{{number_format($porcentajeGap1, 2, '.', '')}}%</td> --}}
                                </tr>
                                <tr>
                                    <td>Cumple parcialmente</td>
                                    <td class="text-black" style="background-color: rgba(244, 208, 63, 0.6);">
                                        {{$conteos['Gap1']['parcialmente']}}
                                    </td>
                                    {{-- <td>{{number_format(($conteos['Gap1']['parcialmente'] * 30) / 15), 2, '.', ''}}%</td> --}}
                                    <td>{{number_format(($conteos['Gap1']['parcialmente'] * 100) / 15), 2, '.', ''}}%</td>

                                </tr>
                                <tr>
                                    <td>No cumple</td>
                                    <td class="text-black" style="background-color: rgba(231, 76, 60, 0.6);">
                                        {{$conteos['Gap1']['nocumple']}}
                                    </td>
                                    <td>{{number_format(($conteos['Gap1']['nocumple'] * 100) / 15), 2, '.', ''}}%</td>
                                </tr>
                                <!--<tr>
                                    <td>Autodiagnóstico</td>
                                    <td class="bg-dark text-white">1</td>
                                    <td>5%</td>
                                </tr>
                                <tr>
                                    <td>Plan de trabajo</td>
                                    <td class="bg-info text-white">1</td>
                                    <td>5%</td>
                                </tr>-->
                                <tr>
                                    <td align="right">Total</td>
                                    <td>
                                        {{$conteos['Gap1']['satisfactorio'] + $conteos['Gap1']['parcialmente'] + $conteos['Gap1']['nocumple']}}
                                    </td>
                                    <td>
                                        {{number_format($porcentajeGap1, 2, '.', '')}}%
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm" align="center">
                            <h6>Requisitos GAP 01 - Planear</h6>
                            <canvas id="popChart1" width="800" height="800"></canvas>
                            <p>15 requisitos</p>
                        </div>
                        <div class="col-sm" align="center">
                            <h6>% Cumplimiento GAP 01 - Planear</h6>
                            <canvas id="popChart2" width="800" height="800"></canvas>
                            <h6>{{number_format($porcentajeGap1, 2, '.', '')}}% Cumplimiento</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--cuarta tabla-->
    <!--quinta tabla-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="barraGap2_tablero" class="barraGap2_table">
                        <h6 align="center">GAP 02: IMPLEMENTACIÓN DEL PLAN DE SEGURIDAD Y PRIVACIDAD DE LA INFORMACIÓN
                            ({{number_format($porcentajeGap2['Avance'], 2, '.', '')}}%)
                        </h6>
                        <div class="progress">
                            <div
                                class="progress-bar progress-bar-striped progress-bar-animated"
                                role="progressbar" aria-valuenow="40"
                                aria-valuemin="0" aria-valuemax="100"
                                style="width: {{number_format($porcentajeGap2['Porcentaje'], 2, '.', '')}}%">{{number_format($porcentajeGap2['Avance'], 2, '.', '')}}
                                %
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm" align="center">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: black; color: white;">No. Controles que aplican</span>
                                </div>
                                <input type="text" value="{{$total = 114 - $conteos['Gap2']['noaplica']}}"
                                       class="form-control"
                                       disabled style="color: black;">
                            </div>
                            <span>HACER</span>
                            <table class="table table-responsive-sm letras-dashboard">
                                <thead>
                                <tr>
                                    <th scope="col">ESTATUS</th>
                                    <th scope="col">REQUISITOS</th>
                                    <th scope="col">PESO</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Cumple satisfactoriamente</td>
                                    <td class="text-black" style="background-color: rgba(22, 160, 133, 0.6);">
                                        {{$conteos['Gap2']['satisfactorio']}}
                                    </td>
                                    <td>
                                        {{number_format(($conteos['Gap2']['satisfactorio'] * 40) / $total), 2, '.', ''}}%
                                    </td>
                                </tr>
                                <tr>
                                    <td>Cumple parcialmente</td>
                                    <td class="text-black" style="background-color: rgba(244, 208, 63, 0.6);">
                                        {{$conteos['Gap2']['parcialmente']}}
                                    </td>
                                    <td>
                                        {{number_format(($conteos['Gap2']['parcialmente'] * 40) / $total), 2, '.', ''}}%
                                    </td>
                                </tr>
                                <tr>
                                    <td>No cumple</td>
                                    <td class="text-black" style="background-color: rgba(231, 76, 60, 0.6);">
                                        {{$conteos['Gap2']['nocumple']}}
                                    </td>
                                    <td>
                                        {{number_format(($conteos['Gap2']['nocumple'] * 40) / $total), 2, '.', ''}}%
                                    </td>
                                </tr>
                                <tr>
                                    <td>No aplica</td>
                                    <td class="text-black" style="background-color: rgba(133, 193, 233 , 0.6);">
                                        {{$conteos['Gap2']['noaplica']}}
                                    </td>
                                    <td>
                                        {{number_format(($conteos['Gap2']['noaplica'] * 100) / $total), 2, '.', ''}}%
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">Total</td>
                                    <td>{{114 - $conteos['Gap2']['noaplica']}}</td>
                                    <td>
                                        {{number_format($porcentajeGap2['Avance'], 2, '.', '')}}%
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm" align="center">
                            <h6>Controles GAP 02 - Hacer</h6>
                            <canvas id="popChart3" width="800" height="750"></canvas>
                            <p>{{114 - $conteos['Gap2']['noaplica']}} controles</p>
                        </div>
                        <div class="col-sm" align="center">
                            <h6>% Cumplimiento GAP 02 - Hacer</h6>
                            <canvas id="popChart4" width="800" height="750"></canvas>
                            <h6>{{number_format($porcentajeGap2['Avance'], 2, '.', '')}}% Cumplimiento</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--quinta tabla-->
    <!--sexta tabla-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="barraGap3_tablero" class="barraGap3_table">
                        <h6 align="center">GAP 03: MONITOREO Y MEJORA CONTINUA ({{$porcentajeGap3['porcentaje']}}%)
                        </h6>
                        <div class="progress">
                            <div
                                class="progress-bar progress-bar-striped progress-bar-animated"
                                role="progressbar"
                                aria-valuenow="{{(number_format($porcentajeGap3['porcentaje'], 2, '.', '') * 100) / 30}}"
                                aria-valuemin="0" aria-valuemax="100"
                                style="width: {{(number_format($porcentajeGap3['porcentaje'], 2, '.', '') * 100) / 30}}%">{{$porcentajeGap3['porcentaje']}}%
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm" align="center">
                            <span>VERIFICAR</span>
                            <table class="table table-responsive-sm letras-dashboard">
                                <thead>
                                <tr>
                                    <th scope="col">ESTATUS</th>
                                    <th scope="col">REQUISITOS</th>
                                    <th scope="col">PESO</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Cumple satisfactoriamente</td>
                                    <td class="text-black" style="background-color: rgba(22, 160, 133, 0.6);">
                                        {{$conteos['Gap3verif']['satisfactorio']}}
                                    </td>
                                    <td>
                                        {{number_format(($conteos['Gap3verif']['satisfactorio'] * 100) / 6), 2, '.', ''}}%
                                    </td>
                                </tr>
                                <tr>
                                    <td>Cumple parcialmente</td>
                                    <td class="text-black" style="background-color: rgba(244, 208, 63, 0.6);">
                                        {{$conteos['Gap3verif']['parcialmente']}}
                                    </td>
                                    <td>
                                        {{number_format(($conteos['Gap3verif']['parcialmente'] * 100) / 6), 2, '.', ''}}%
                                    </td>
                                </tr>
                                <tr>
                                    <td>No cumple</td>
                                    <td class="text-black" style="background-color: rgba(231, 76, 60, 0.6);">
                                        {{$conteos['Gap3verif']['nocumple']}}
                                    </td>
                                    <td>
                                        {{number_format(($conteos['Gap3verif']['nocumple'] * 100) / 6), 2, '.', ''}}%
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">Total</td>
                                    <td>6</td>
                                    <td>{{number_format($porcentajeGap3['verificar'], 2, '.', '')}}%</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm" align="center">
                            <h6>Requisitos GAP 03 - Verificar</h6>
                            <canvas id="popChart5" width="800" height="750"></canvas>
                            <p>06 requisitos</p>
                        </div>
                        <div class="col-sm" align="center">
                            <h6> % Cumplimiento GAP 03 - Verificar</h6>
                            <canvas id="popChart6" width="800" height="750"></canvas>
                            <h6>{{number_format($porcentajeGap3['verificar'], 2, '.', '')}}% Cumplimiento</h6>
                        </div>
                    </div>
                    <hr>
                    <!--segunda-->
                    <div class="row">
                        <div class="col-sm" align="center">
                            <span>ACTUAR</span>
                            <table class="table table-responsive-sm letras-dashboard">
                                <thead>
                                <tr>
                                    <th scope="col">ESTATUS</th>
                                    <th scope="col">REQUISITOS</th>
                                    <th scope="col">PESO</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Cumple satisfactoriamente</td>
                                    <td class="text-black" style="background-color: rgba(22, 160, 133, 0.6);">
                                        {{$conteos['Gap3actuar']['satisfactorio']}}
                                    </td>
                                    <td>
                                        {{number_format(($conteos['Gap3actuar']['satisfactorio'] * 100) / 6), 2, '.', ''}}%
                                    </td>
                                </tr>
                                <tr>
                                    <td>Cumple parcialmente</td>
                                    <td class="text-black" style="background-color: rgba(244, 208, 63, 0.6);">
                                        {{$conteos['Gap3actuar']['parcialmente']}}
                                    </td>
                                    <td>
                                        {{number_format(($conteos['Gap3actuar']['parcialmente'] * 100) / 6), 2, '.', ''}}%
                                    </td>
                                </tr>
                                <tr>
                                    <td>No cumple</td>
                                    <td class="text-black" style="background-color: rgba(231, 76, 60, 0.6);">
                                        {{$conteos['Gap3actuar']['nocumple']}}
                                    </td>
                                    <td>
                                        {{number_format(($conteos['Gap3actuar']['nocumple'] * 100) / 6), 2, '.', ''}}%
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">Total</td>
                                    <td>6</td>
                                    <td>{{number_format($porcentajeGap3['actuar'], 2, '.', '')}}%</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: black; color: white;">TOTAL GAP 03</span>
                                </div>
                                <input type="text" value="{{$porcentajeGap3['porcentaje']}}%" class="form-control" disabled
                                       style="color: black;">
                            </div>
                        </div>
                        <div class="col-sm" align="center">
                            <h6>Requisitos GAP 03 - Actuar</h6>
                            <canvas id="popChart7" width="800" height="750"></canvas>
                            <p>06 requisitos</p>
                        </div>
                        <div class="col-sm" align="center">
                            <h6>% Cumplimiento GAP 03 - Actuar</h6>
                            <canvas id="popChart8" width="800" height="750"></canvas>
                            <h6>{{number_format($porcentajeGap3['actuar'], 2, '.', '')}}% Cumplimiento</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--sexta tabla-->
</div>

<script>
    //Grafica de barras
    var popCanvas = document.getElementById("popChart");
    var barChart = new Chart(popCanvas, {
        type: 'bar',
        data: {
            labels: ["Planear", "Hacer", "Verificar", "Actuar"],
            datasets: [{
                label: '% Implementación por fase',
                data: [
                    {!! number_format($porcentajeGap1) !!},
                    {!! number_format($porcentajeGap2['Avance']) !!},
                    {!! number_format($porcentajeGap3['verificar']) !!},
                    {{number_format($porcentajeGap3['actuar'], 2, '.', '')}}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                ]
            }]
        },
        options: {
            legend: {
                display: false
            },
        }
    });

    //doughtnuts
    var popCanvas1 = document.getElementById("popChart1");
    var barChart1 = new Chart(popCanvas1, {
        type: 'horizontalBar',
        labels: {
            render: 'value'
        },
        data: {
            labels: [
                "Satistactoriamente",
                "Parcialmente",
                "No cumple",
            ],
            datasets: [{
                label: '',
                data: [
                    {{$conteos['Gap1']['satisfactorio']}},
                    {{$conteos['Gap1']['parcialmente']}},
                    {{$conteos['Gap1']['nocumple']}}
                ],
                backgroundColor: [
                    'rgba(22, 160, 133, 0.6)',
                    'rgba(244, 208, 63, 0.6)',
                    'rgba(231, 76, 60, 0.6)',
                ]
            }]
        },
        options:  {
            legend: {
                display: false
            },
            "hover": {
                "animationDuration": 0
            },
            "animation": {
                "duration": 1,
                "onComplete": function() {
                    var chartInstance = this.chart
                    ctx = chartInstance.ctx;
                    ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                    ctx.fillStyle = this.chart.config.options.defaultFontColor;
                    ctx.textAlign = 'left';
                    ctx.textBaseline = 'top';

                    this.data.datasets.forEach(function(dataset, i) {
                        var meta = chartInstance.controller.getDatasetMeta(i);
                        meta.data.forEach(function(bar, index) {
                            var data = dataset.data[index];
                            ctx.fillText(data, bar._model.x, bar._model.y - 5);
                        });
                    });
                }
            },

        }
    });

    var popCanvas2 = document.getElementById("popChart2");
    var barChart2 = new Chart(popCanvas2, {
        type: 'doughnut',
        data: {
            labels: [
                "Cumple satistactoriamente",
                "Cumple parcialmente",
                "No cumple",
            ],
            datasets: [{
                label: '% Implementación por fase',
                data: [
                    {{$conteos['Gap1']['satisfactorio']}},
                    {{$conteos['Gap1']['parcialmente']}},
                    {{$conteos['Gap1']['nocumple']}}
                ],
                backgroundColor: [
                    'rgba(22, 160, 133, 0.6)',
                    'rgba(244, 208, 63, 0.6)',
                    'rgba(231, 76, 60, 0.6)',
                ]
            }]
        }
    });

    var popCanvas3 = document.getElementById("popChart3");
    var barChart3 = new Chart(popCanvas3, {
        type: 'horizontalBar',
        data: {
            labels: [
                "Satistactoriamente",
                "Parcialmente",
                "No cumple",
                "No aplica"
            ],
            datasets: [{
                label: '% Implementación por fase',
                data: [
                    {{$conteos['Gap2']['satisfactorio']}},
                    {{$conteos['Gap2']['parcialmente']}},
                    {{$conteos['Gap2']['nocumple']}},
                    {{$conteos['Gap2']['noaplica']}}
                ],
                backgroundColor: [
                    'rgba(22, 160, 133, 0.6)',
                    'rgba(244, 208, 63, 0.6)',
                    'rgba(231, 76, 60, 0.6)',
                    'rgba(133, 193, 233 , 0.6)',
                ]
            }]
        },
        options:  {
            legend: {
                display: false
            },
            "hover": {
                "animationDuration": 0
            },
            "animation": {
                "duration": 1,
                "onComplete": function() {
                    var chartInstance = this.chart
                    ctx = chartInstance.ctx;
                    ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                    ctx.fillStyle = this.chart.config.options.defaultFontColor;
                    ctx.textAlign = 'left';
                    ctx.textBaseline = 'top';

                    this.data.datasets.forEach(function(dataset, i) {
                        var meta = chartInstance.controller.getDatasetMeta(i);
                        meta.data.forEach(function(bar, index) {
                            var data = dataset.data[index];
                            ctx.fillText(data, bar._model.x, bar._model.y - 5);
                        });
                    });
                }
            },

        }
    });

    var popCanvas4 = document.getElementById("popChart4");
    var barChart4 = new Chart(popCanvas4, {
        type: 'doughnut',
        data: {
            labels: [
                "Cumple satistactoriamente",
                "Cumple parcialmente",
                "No cumple",
                "No aplica"
            ],
            datasets: [{
                label: '% Implementación por fase',
                data: [
                    {{$conteos['Gap2']['satisfactorio']}},
                    {{$conteos['Gap2']['parcialmente']}},
                    {{$conteos['Gap2']['nocumple']}},
                    {{$conteos['Gap2']['noaplica']}}
                ],
                backgroundColor: [
                    'rgba(22, 160, 133, 0.6)',
                    'rgba(244, 208, 63, 0.6)',
                    'rgba(231, 76, 60, 0.6)',
                    'rgba(133, 193, 233 , 0.6)',
                ]
            }]
        }
    });

    var popCanvas5 = document.getElementById("popChart5");
    var barChart5 = new Chart(popCanvas5, {
        type: 'horizontalBar',
        data: {
            labels: [
                "Satistactoriamente",
                "Parcialmente",
                "No cumple",
            ],
            datasets: [{
                label: '% Implementación por fase',
                data: [
                    {{$conteos['Gap3verif']['satisfactorio']}},
                    {{$conteos['Gap3verif']['parcialmente']}},
                    {{$conteos['Gap3verif']['nocumple']}},
                ],
                backgroundColor: [
                    'rgba(22, 160, 133, 0.6)',
                    'rgba(244, 208, 63, 0.6)',
                    'rgba(231, 76, 60, 0.6)',
                ]
            }]
        },
        options:  {
            legend: {
                display: false
            },
            "hover": {
                "animationDuration": 0
            },
            "animation": {
                "duration": 1,
                "onComplete": function() {
                    var chartInstance = this.chart
                    ctx = chartInstance.ctx;
                    ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                    ctx.fillStyle = this.chart.config.options.defaultFontColor;
                    ctx.textAlign = 'left';
                    ctx.textBaseline = 'top';

                    this.data.datasets.forEach(function(dataset, i) {
                        var meta = chartInstance.controller.getDatasetMeta(i);
                        meta.data.forEach(function(bar, index) {
                            var data = dataset.data[index];
                            ctx.fillText(data, bar._model.x, bar._model.y - 5);
                        });
                    });
                }
            },

        }
    });

    var popCanvas6 = document.getElementById("popChart6");
    var barChart6 = new Chart(popCanvas6, {
        type: 'doughnut',
        data: {
            labels: [
                "Cumple satistactoriamente",
                "Cumple parcialmente",
                "No cumple",
            ],
            datasets: [{
                label: '% Implementación por fase',
                data: [
                    {{$conteos['Gap3verif']['satisfactorio']}},
                    {{$conteos['Gap3verif']['parcialmente']}},
                    {{$conteos['Gap3verif']['nocumple']}},
                ],
                backgroundColor: [
                    'rgba(22, 160, 133, 0.6)',
                    'rgba(244, 208, 63, 0.6)',
                    'rgba(231, 76, 60, 0.6)',
                ]
            }]
        }
    });

    var popCanvas7 = document.getElementById("popChart7");
    var barChart7 = new Chart(popCanvas7, {
        type: 'horizontalBar',
        data: {
            labels: [
                "Satistactoriamente",
                "Parcialmente",
                "No cumple",
            ],
            datasets: [{
                label: '% Implementación por fase',
                data: [
                    {{$conteos['Gap3actuar']['satisfactorio']}},
                    {{$conteos['Gap3actuar']['parcialmente']}},
                    {{$conteos['Gap3actuar']['nocumple']}},
                ],
                backgroundColor: [
                    'rgba(22, 160, 133, 0.6)',
                    'rgba(244, 208, 63, 0.6)',
                    'rgba(231, 76, 60, 0.6)',
                ]
            }]
        },
        options:  {
            legend: {
                display: false
            },
            "hover": {
                "animationDuration": 0
            },
            "animation": {
                "duration": 1,
                "onComplete": function() {
                    var chartInstance = this.chart
                    ctx = chartInstance.ctx;
                    ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                    ctx.fillStyle = this.chart.config.options.defaultFontColor;
                    ctx.textAlign = 'left';
                    ctx.textBaseline = 'top';

                    this.data.datasets.forEach(function(dataset, i) {
                        var meta = chartInstance.controller.getDatasetMeta(i);
                        meta.data.forEach(function(bar, index) {
                            var data = dataset.data[index];
                            ctx.fillText(data, bar._model.x, bar._model.y - 5);
                        });
                    });
                }
            },

        }
    });

    var popCanvas8 = document.getElementById("popChart8");
    var barChart8 = new Chart(popCanvas8, {
        type: 'doughnut',
        data: {
            labels: [
                "Cumple satistactoriamente",
                "Cumple parcialmente",
                "No cumple",
            ],
            datasets: [{
                label: '% Implementación por fase',
                data: [
                    {{$conteos['Gap3actuar']['satisfactorio']}},
                    {{$conteos['Gap3actuar']['parcialmente']}},
                    {{$conteos['Gap3actuar']['nocumple']}},
                ],
                backgroundColor: [
                    'rgba(22, 160, 133, 0.6)',
                    'rgba(244, 208, 63, 0.6)',
                    'rgba(231, 76, 60, 0.6)',
                ]
            }]
        }
    });

    //speedometer
    // Element inside which you want to see the chart
    let element = document.querySelector('#gaugeArea')

    // Properties of the gauge
    let gaugeOptions = {
        hasNeedle: {{number_format($porcentajeGap1, 2, '.', '') + (number_format($porcentajeGap3['porcentaje'], 2, '.', '')) + number_format($porcentajeGap2['Avance'], 2, '.', '')}},
        needleColor: 'black',
        needleStartValue: 0,
        needleUpdateSpeed: 1000,
        arcColors: ["rgb(255,84,84)", "rgb(239,214,19)", "rgb(61,204,91)"],
        arcDelimiters: [33.33, 66.66],
        rangeLabel: ['0', '100'],
        centralLabel: '{{number_format($porcentajeGap1, 2, '.', '') + (number_format($porcentajeGap3['porcentaje'], 2, '.', '')) + number_format($porcentajeGap2['Avance'], 2, '.', '')}}%',
    }

    // Drawing and updating the chart
    GaugeChart.gaugeChart(element, 300, gaugeOptions).updateNeedle({{number_format($porcentajeGap1, 2, '.', '') + (number_format($porcentajeGap3['porcentaje'], 2, '.', '')) + number_format($porcentajeGap2['Avance'], 2, '.', '')}})

    //radarchart
    //Empieza radar chart
    var data = {
        labels: [
            "Dominio 5",
            "Dominio 6",
            "Dominio 7",
            "Dominio 8",
            "Dominio 9",
            "Dominio 10",
            "Dominio 11",
            "Dominio 12",
            "Dominio 13",
            "Dominio 14",
            "Dominio 15",
            "Dominio 16",
            "Dominio 17",
            "Dominio 18",
        ],
        datasets: [
            {
                label: "Meta",
                backgroundColor: "rgba(179,181,198,0.2)",
                borderColor: "rgba(179,181,198,1)",
                pointBackgroundColor: "rgba(179,181,198,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(179,181,198,1)",
                data: [65, 59, 90, 81, 56, 55, 40, 20, 10, 50, 80, 56, 48, 74]
            },
            {
                label: "Alcanzado",
                backgroundColor: "rgba(255,99,132,0.2)",
                borderColor: "rgba(255,99,132,1)",
                pointBackgroundColor: "rgba(255,99,132,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(255,99,132,1)",
                data: [28, 48, 40, 79, 96, 27, 100, 54, 24, 90, 83, 23, 64, 32]
            }
        ]
    };

    var ctx = document.getElementById("myChart");
    var options = {
        tooltips: {
            mode: 'label'
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    };
    var myRadarChart = new Chart(ctx, {
        type: 'radar',
        data: data,
        options: options
    });
    Chart.helpers.bindEvents(myRadarChart, ['mousedown'], function (evt) {
        var lastMousePosition = [evt.x, evt.y];
        //console.log('mousedown');
        var lastActive = myRadarChart.lastActive;
        if (Array.isArray(lastActive) && lastActive.length) {
            lastActive = lastActive[0];
            //console.log(lastActive);
            var moveHandler = function (evt) {
                var index = lastActive._index;
                var dataset = lastActive._datasetIndex;
                //console.log('mouse move');
                if (evt.y < lastMousePosition[1]) {
                    myRadarChart.data.datasets[dataset].data[index] = myRadarChart.data.datasets[dataset].data[index] + 1;
                    myRadarChart.update(1, false);
                } else if (evt.y > lastMousePosition[1]) {
                    myRadarChart.data.datasets[dataset].data[index] = myRadarChart.data.datasets[dataset].data[index] - 1;
                    myRadarChart.update(1, false);
                }
                lastMousePosition = [evt.x, evt.y];
            };
            var outHandler = function () {
                //console.log('unbinding');
                Chart.helpers.unbindEvents(myRadarChart, {'mousemove': moveHandler});
                Chart.helpers.unbindEvents(myRadarChart, {'mouseup': outHandler});
                Chart.helpers.unbindEvents(myRadarChart, {'mouseout': outHandler});
            }
            Chart.helpers.bindEvents(myRadarChart, ['mousemove'], moveHandler);
            Chart.helpers.bindEvents(myRadarChart, ['mouseup'], outHandler);
            Chart.helpers.bindEvents(myRadarChart, ['mouseout'], outHandler);
        }
    });

</script>

