@extends('layouts.admin')
@section('content')
    <style>
        .box_rotate {
            transform: rotate(90deg);

        }

        .celdas_chicas {
            padding: 2px !important;
        }

        div.nav .nav-link {
            color: #345183;
        }

        .nav-tabs .nav-link.active {
            border-top: 2px solid #345183;
        }

        div.tab-pane ul {
            padding: 0;
            margin: 0;
            text-align: center;
        }

        div.tab-pane li {
            list-style: none;
            width: 150px;
            height: 150px;
            box-sizing: border-box;
            position: relative;
            margin: 10px;
            display: inline-block;
        }

        div.tab-pane li i {
            font-size: 30pt;
            margin-bottom: 10px;
            width: 100%;
        }

        div.tab-pane a {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #eee;
            color: #345183;
            border-radius: 6px;
            box-shadow: 0px 2px 3px 1px rgba(0, 0, 0, 0.2);
            transition: 0.1s;
            padding: 7px;
        }

        div.tab-pane a:hover {
            text-decoration: none !important;
            color: #345183;
            border: 1px solid #345183;
            box-shadow: 0px 2px 3px 1px rgba(0, 0, 0, 0.0);
            background-color: #fff;
            +
        }

        a:hover {
            text-decoration: none !important;
        }

        .ventana_menu {
            width: calc(100% - 40px);
            background-color: #fff;
            position: absolute;
            margin: auto;
            display: none;
            top: 35px;
            z-index: 3;
            height: calc(100% - 40px);

        }
    </style>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.analisis-impacto.menu') !!}">Análisis de Impacto</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{!! route('admin.analisis-impacto.menu-BIA') !!}">BIA</a>
        </li>
        <li class="breadcrumb-item active">Matriz</li>
    </ol>
    <div class="card">
        <div class="card-header">
            Mostrar Mátriz de Impacto

        </div>

        <div class="row">
            <div class="col-sm-3 offset-9 mt-3">
                <a class="btn btn-success" href="{{ route('admin.analisis-impacto.ajustes') }}"><i class="bi bi-gear"></i>
                    Ajustar parámetros </a>
            </div>
        </div>


        <div class="card-body">
            <div class="form-group">

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane mb-4 fade show active" id="nav-empleados" role="tabpanel"
                        aria-labelledby="nav-empleados-tab">
                        <ul class="mt-4">

                            <li>
                                <a data-toggle="modal" data-target="#procesos">
                                    <div>
                                        <i class="bi bi-bar-chart-steps"></i><br>
                                        1.0
                                        <br>Procesos
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a data-toggle="modal" data-target="#matriz_bia">
                                    <div>
                                        <i class="bi bi-bounding-box"></i><br>
                                        2.0
                                        <br>Matriz BIA
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a data-toggle="modal" data-target="#entradas_salidas">
                                    <div>
                                        <i class="bi bi-arrow-down-up"></i><br>
                                        3.0
                                        <br>Entradas y Salidas
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a data-toggle="modal" data-target="#tecnologica">
                                    <div>
                                        <i class="bi bi-cpu"></i><br>
                                        4.0
                                        <br>Inf. Tecnológica
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a data-toggle="modal" data-target="#requerimientos_minimos">
                                    <div>
                                        <i class="bi bi-clipboard-check"></i><br>
                                        5.0
                                        <br>Req. Minimos
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a data-toggle="modal" data-target="#respaldo">
                                    <div>
                                        <i class="bi bi-hdd-network"></i><br>
                                        6.0
                                        <br>Respaldo-Registros vitales
                                    </div>
                                </a>
                            </li>

                        </ul>

                    </div>
                </div>

                {{-- <div class="row">
                    <!-- Button trigger modal -->
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#procesos">
                            1.0
                            <br>Procesos
                        </button>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#matriz_bia">
                            2.0
                            <br>Matriz BIA
                        </button>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#entradas_salidas">
                            3.0
                            <br>Entradas y Salidas
                        </button>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tecnologica">
                            4.0
                            <br>Inf. Tecnológica
                        </button>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#requerimientos_minimos">
                            5.0
                            <br>Requerimientos minimos
                        </button>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#respaldo">
                            6.0
                            <br>Respaldo-registros vitales
                        </button>
                    </div>
                </div> --}}

                <!-- Modal>1.0 Procesos-->
                <div class="modal fade" id="procesos" tabindex="-1" aria-labelledby="procesos" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">1.0 Procesos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="background-color: #9C1A3B; font-size: 12px;">
                                            <th colspan="7">Procesos</th>
                                        </tr>
                                        <tr style="background-color: #8f8f8f; font-size: 12px;">
                                            <th scope="col">ID</th>
                                            <th scope="col">Dirección</th>
                                            <th scope="col">Área</th>
                                            <th scope="col">Macroproceso</th>
                                            <th scope="col">Proceso</th>
                                            <th scope="col">Subproceso</th>
                                            <th scope="col">CANTIDAD</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cuestionario as $data)
                                            <tr style="font-size: 11px;">
                                                <th scope="row">{{ $data->id_proceso }}</th>
                                                <td>{{ $data->direccion }}</td>
                                                <td>{{ $data->area }}</td>
                                                <td>{{ $data->macroproceso ?: 'N/A' }}</td>
                                                <td>{{ $data->nombre_proceso }}</td>
                                                <td>{{ $data->subproceso ?: 'N/A' }}</td>
                                                <td>{{ $data->id ?: 'N/A' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal>2.0 2.0 Matriz BIA-->
                <div class="modal fade" id="matriz_bia" tabindex="-1" aria-labelledby="matriz_bia" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">2.0 Matriz BIA</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr style="text-align:left !important; background-color: #9C1A3B; font-size: 11px;">
                                            <th colspan="6">PROCESOS</th>
                                            <th colspan="3">TITULAR DEL PROCESO</th>
                                            <th colspan="1">PERIODICIDAD</th>
                                            <th colspan="12">MESES</th>
                                            <th colspan="4">SEMANAS</th>
                                            <th colspan="7">DIAS</th>
                                            <th colspan="24">HORAS</th>
                                            <th colspan="5">TIEMPO DE EJECUCIÓN DEL PROCESO</th>
                                            <th colspan="5">TIEMPOS DE RECUPERACIÓN</th>
                                            <th colspan="4">IMPACTO OPERATIVO</th>
                                            <th colspan="4">IMPACTO REGULATORIO</th>
                                            <th colspan="4">IMPACTO EN LA REPUTACION / IMAGEN PÚBLICA O POLÍTICA</th>
                                            <th colspan="4">IMPACTO SOCIAL</th>
                                            <th colspan="3">VALORACIÓN DEL PROCESO</th>
                                        </tr>
                                        <tr
                                            style="text-align:left !important; background-color: #8f8f8f; font-size: 11px;">
                                            <th scope="col">#</th>
                                            <th scope="col" style="min-width: 150px;">Dirección</th>
                                            <th scope="col" style="min-width: 150px;">Área</th>
                                            <th scope="col" style="min-width: 150px;">Nombre del Proceso</th>
                                            <th scope="col" style="min-width: 150px;">Nombre del Subproceso</th>
                                            <th scope="col" style="min-width: 200px;">Objetivo</th>
                                            <th scope="col" style="min-width: 100px;">Nombre(s)</th>
                                            <th scope="col" style="min-width: 100px;">Apellido Paterno</th>
                                            <th scope="col" style="min-width: 100px;">Apellido Materno</th>
                                            <th scope="col" style="min-width: 200px;">Periodicidad con que se genera el
                                                proceso</th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">ENE</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">FEB</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">MAR</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">ABR</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">MAY</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">JUN</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">JUL</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">AGO</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">SEP</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">OCT</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">NOV</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">DIC</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">1a</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">2a</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">3a</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">4a</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">LUN</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">MAR</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">MIE</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">JUE</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">VIE</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">SAB</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">DOM</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">1</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">2</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">3</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">4</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">5</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">6</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">7</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">8</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">9</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">10</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">11</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">12</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">13</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">14</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">15</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">16</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">17</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">18</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">19</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">20</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">21</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">22</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">23</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">24</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">SEMANAS</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">DÍAS</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">HORAS</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">MINUTOS</div>
                                            </th>
                                            <th scope="col" class="celdas_chicas"
                                                style="vertical-align:middle !important;">
                                                <div class="box_rotate">OTRO
                                            </th>
                                            <th scope="col">RPO (hrs)</th>
                                            <th scope="col">RTO (hrs)</th>
                                            <th scope="col">WRT(hrs)</th>
                                            <th scope="col">MTPD(hrs)</th>
                                            <th scope="col">Nivel RTO</th>
                                            <th scope="col">
                                                < 4 hrs</th>
                                            <th scope="col" style="min-width: 60px;">4-24 hrs</th>
                                            <th scope="col">>24 hrs</th>
                                            <th scope="col" style="vertical-align:middle !important;">
                                                <div class="box_rotate">Promedio</div>
                                            </th>
                                            <th scope="col">
                                                < 4 hrs</th>
                                            <th scope="col" style="min-width: 60px;">4-24 hrs</th>
                                            <th scope="col">>24 hrs</th>
                                            <th scope="col" style="vertical-align:middle !important;">
                                                <div class="box_rotate">Promedio</div>
                                            </th>
                                            <th scope="col">
                                                < 4 hrs</th>
                                            <th scope="col" style="min-width: 60px;">4-24 hrs</th>
                                            <th scope="col">>24 hrs</th>
                                            <th scope="col" style="vertical-align:middle !important;">
                                                <div class="box_rotate">Promedio</div>
                                            </th>
                                            <th scope="col">
                                                < 4 hrs</th>
                                            <th scope="col" style="min-width: 60px;">4-24 hrs</th>
                                            <th scope="col">>24 hrs</th>
                                            <th scope="col" style="vertical-align:middle !important;">
                                                <div class="box_rotate">Promedio</div>
                                            </th>
                                            <th scope="col">Total de Impactos</th>
                                            <th scope="col">Nivel de Impacto</th>
                                            <th scope="col">Criticidad del proceso</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cuestionario as $data)
                                            <tr style="text-align:left !important;font-size: 11px;">
                                                <th scope="row">P00{{ $data->id ?: 'No definido' }}</th>
                                                <td>{{ $data->direccion ?: 'No definido' }}</td>
                                                <td>{{ $data->area ?: 'No definido' }}</td>
                                                <td style="text-align: left !important;">
                                                    {{ $data->nombre_proceso ?: 'No definido' }}</td>
                                                <td>{{ $data->subproceso ?: 'No definido' }}</td>
                                                <td style="text-align: left !important;">
                                                    {{ $data->objetivo_proceso ?: 'No definido' }}</td>
                                                <td style="text-align: left !important;">
                                                    {{ $data->titular_nombre ?: 'No definido' }}</td>
                                                <td style="text-align: left !important;">
                                                    {{ $data->titular_a_paterno ?: 'No definido' }}</td>
                                                <td style="text-align: left !important;">
                                                    {{ $data->titular_a_materno ?: 'No definido' }}</td>
                                                <td>
                                                    @if ($data->periodicidad == 1)
                                                        Diario
                                                    @elseif ($data->periodicidad == 2)
                                                        Semanal
                                                    @elseif ($data->periodicidad == 3)
                                                        Mensual
                                                    @elseif ($data->periodicidad == 4)
                                                        Otro: {{ $data->p_otro_txt }}
                                                    @else
                                                        No definido
                                                    @endif
                                                </td>
                                                <td style="text-align:center !important;">{{ $data->ene ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->feb ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->mar ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->abr ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->may ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->jun ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->jul ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->ago ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->sep ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->oct ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->nov ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->dic ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->s1 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->s2 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->s3 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->s4 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->d1 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->d2 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->d3 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->d4 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->d5 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->d6 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->d7 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h1 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h2 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h3 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h4 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h5 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h6 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h7 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h8 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h9 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h10 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h11 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h12 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h13 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h14 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h15 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h16 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h17 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h18 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h19 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h20 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h21 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h22 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h23 ?: '-' }}</td>
                                                <td style="text-align:center !important;">{{ $data->h24 ?: '-' }}</td>
                                                <td style="text-align:center !important;">
                                                    {{ $data->periodicidad_diario ?: '-' }}</td>
                                                <td style="text-align:center !important;">
                                                    {{ $data->periodicidad_quincenal ?: '-' }}</td>
                                                <td style="text-align:center !important;">
                                                    {{ $data->periodicidad_mensual ?: '-' }}</td>
                                                <td style="text-align:center !important;">
                                                    {{ $data->periodicidad_otro ?: '-' }}</td>
                                                <td style="text-align:center !important;">
                                                    {{ $data->periodicidad_flujo_txt ?: '-' }}</td>
                                                <td>{{ $data->rpo_horas ?: '-' }}</td>
                                                <td>{{ $data->rto_horas ?: '-' }}</td>
                                                <td>{{ $data->wrt_horas ?: '-' }}</td>
                                                <td>{{ $data->mtpd_horas ?: '-' }}</td>
                                                <td
                                                    style="background-color:{{ $data->nivel_rto[0] }};color:{{ $data->nivel_rto[1] }}">
                                                    {{ $data->nivel_rto[2] ?: '-' }}</td>
                                                <td>{{ $data->operacion_q_1 ?: '-' }}</td>
                                                <td style="text-align: center !important;">
                                                    {{ $data->operacion_q_2 ?: '-' }}</td>
                                                <td>{{ $data->operacion_q_3 ?: '-' }}</td>
                                                <td style="text-align:center !important;">
                                                    {{ $data->operacion_promedio ?: '-' }}</td>
                                                <td>{{ $data->regulatorio_q_1 ?: '-' }}</td>
                                                <td style="text-align: center !important;">
                                                    {{ $data->regulatorio_q_2 ?: '-' }}</td>
                                                <td>{{ $data->regulatorio_q_3 ?: '-' }}</td>
                                                <td
                                                    style="text-align:center
                                                    !important;">
                                                    {{ $data->regulatorio_promedio ?: '-' }}</td>
                                                <td>{{ $data->reputacion_q_1 ?: '-' }}</td>
                                                <td style="text-align: center !important;">
                                                    {{ $data->reputacion_q_2 ?: '-' }}</td>
                                                <td>{{ $data->reputacion_q_3 ?: '-' }}</td>
                                                <td
                                                    style="text-align:center
                                                    !important;">
                                                    {{ $data->reputacion_promedio ?: '-' }}</td>
                                                <td>{{ $data->social_q_1 ?: '-' }}</td>
                                                <td style="text-align: center !important;">{{ $data->social_q_2 ?: '-' }}
                                                </td>
                                                <td>{{ $data->social_q_3 ?: '-' }}</td>
                                                <td
                                                    style="text-align:center
                                                    !important;">
                                                    {{ $data->social_promedio ?: '-' }}</td>
                                                <td>{{ $data->total_impactos ?: '-' }}</td>
                                                <td
                                                    style="background-color:{{ $data->nivel_impacto[0] }};color:{{ $data->nivel_impacto[1] }}">
                                                    {{ $data->nivel_impacto[2] ?: '-' }}</td>
                                                <td
                                                    style="background-color:{{ $data->criticidad_proceso[0] }};color:{{ $data->criticidad_proceso[1] }}">
                                                    {{ $data->criticidad_proceso[2] ?: '-' }}</td>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal 3.0 Entradas y salidas-->
                <div class="modal fade" id="entradas_salidas" tabindex="-1" aria-labelledby="entradas_salidas"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">3.0 Entradas y Salidas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr style="background-color: #9C1A3B; font-size: 12px;">
                                            <th colspan="13">Propociona Información</th>
                                        </tr>
                                        <tr style="background-color: #9C1A3B; font-size: 12px;">
                                            <th scope="col">#</th>
                                            <th scope="col" style="min-width: 200px;">Dirección</th>
                                            <th scope="col" style="min-width: 200px;">Área</th>
                                            <th scope="col" style="min-width: 200px;">Proceso</th>
                                            <th scope="col">Subproceso</th>
                                            <th scope="col" style="min-width: 200px;">Insumo/ Entrada
                                                (Documentos, Correo electrónico, Oficios, Reportes, etc.)</th>
                                            <th scope="col" style="min-width: 200px;">Empresa, Área, Sistema o Proceso
                                                de
                                                Origen</th>
                                            <th scope="col" style="min-width: 100px;">Interno / Externo</th>
                                            <th scope="col" style="min-width: 200px;">¿Quién le proporciona esta
                                                información?</th>
                                            <th scope="col" style="min-width: 150px;">Puesto</th>
                                            <th scope="col">Correo electrónico</th>
                                            <th scope="col">Ext.</th>
                                            <th scope="col">Ubicación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($proporciona_informacion as $data)
                                            <tr style="font-size: 11px;">
                                                <td>
                                                    <div style="text-align: left;">P00{{ $data->cuestionario->id }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->cuestionario->direccion }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->cuestionario->area }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->nombre_proceso }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->subproceso ?: 'N/A' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->flujo_q_1 ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->flujo_q_2 ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->interno_externo ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->nombre ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->puesto ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->correo_electronico ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->extencion ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->ubicacion ?: 'No definido' }}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table><br>


                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr style="background-color: #9C1A3B; font-size: 12px;">
                                            <th colspan="16">Recibe Información</th>
                                        </tr>
                                        <tr style="background-color: #9C1A3B; font-size: 12px;">
                                            <th scope="col">#</th>
                                            <th scope="col" style="min-width: 200px;">Dirección</th>
                                            <th scope="col" style="min-width: 200px;">Área</th>
                                            <th scope="col" style="min-width: 200px;">Proceso</th>
                                            <th scope="col">Subproceso</th>
                                            <th scope="col" style="min-width: 200px;">Insumo/ Entrada
                                                (Documentos, Correo electrónico, Oficios, Reportes, etc.)</th>
                                            <th scope="col" style="min-width: 200px;">Empresa, Área, Sistema o Proceso
                                                de
                                                Origen</th>
                                            <th scope="col" style="min-width: 200px;">De que manera se recibe la
                                                información
                                                (Entrega Física / Correo Electrónico / Consulta en Aplicativo o Base de
                                                Datos / Consulta en Portal Web)</th>
                                            <th scope="col" style="min-width: 200px;">Salida
                                                (Documentos, Correo electrónico, Oficios, Reportes, etc.)</th>
                                            <th scope="col" style="min-width: 100px;">Interno / Externo</th>
                                            <th scope="col" style="min-width: 200px;">Nombre</th>
                                            <th scope="col">Puesto</th>
                                            <th scope="col">Correo electrónico:</th>
                                            <th scope="col">Ext.</th>
                                            <th scope="col">Ubicación</th>
                                            <th scope="col" style="min-width: 200px;">¿Cómo valida que el proceso se
                                                realizó correctamente?
                                                (Carta o firma de aceptación, Acuse de Recibido, Notificación, etc..)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recibe_informacion as $data)
                                            <tr style="font-size: 11px;">
                                                <td>
                                                    <div style="text-align: left;">P00{{ $data->cuestionario->id }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->cuestionario->direccion }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->cuestionario->area }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->nombre_proceso }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->subproceso ?: 'N/A' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->flujo_q_1 ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->flujo_q_2 ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->flujo_q_4 ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->flujo_q_6 ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->interno_externo ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->nombre ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->puesto ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->correo_electronico ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->extencion ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->ubicacion ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->flujo_q_10 ?: 'No definido' }}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal>4.0 Inf. Tecnológica-->
                <div class="modal fade" id="tecnologica" tabindex="-1" aria-labelledby="tecnologica"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">4.0 Información Tecnológica</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="background-color: #9C1A3B; font-size: 12px;">
                                            <th colspan="9">Infraestructura Tecnológica</th>
                                        </tr>
                                        <tr style="background-color: #8f8f8f; font-size: 12px;">
                                            <th scope="col">#</th>
                                            <th scope="col">Dirección</th>
                                            <th scope="col">Área</th>
                                            <th scope="col">Proceso</th>
                                            <th scope="col">Subproceso</th>
                                            <th scope="col">Aplicaciones</th>
                                            <th scope="col">Herramientas</th>
                                            <th scope="col">Base de Datos</th>
                                            <th scope="col">Otros</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tecnologica as $data)
                                            <tr style="font-size: 11px;">
                                                <th scope="row">
                                                    <div style="text-align: left;">P00{{ $data->cuestionario->id }}</div>
                                                </th>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->cuestionario->direccion }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->cuestionario->area }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->nombre_proceso }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->subproceso ?: 'N/A' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->aplicativos ?: 'N/A' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->sistemas ?: 'N/A' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->base_datos ?: 'N/A' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->otro ?: 'N/A' }}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal>5.0 Requerimientos minimos-->
                <div class="modal fade" id="requerimientos_minimos" tabindex="-1"
                    aria-labelledby="requerimientos_minimos" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">5.0 Requerimientos minimos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr style="background-color: #9C1A3B; font-size: 12px;text-align:center;">
                                            <th colspan="5">Información General</th>
                                            <th colspan="15">REQUERIMIENTOS MINIMOS PARA LA OPERACIÓN Y RECUPERACIÓN</th>
                                        </tr>
                                        <tr style="background-color: #8f8f8f; font-size: 12px; text-align:center;">
                                            <th colspan="5" style="background-color: #9C1A3B;"></th>
                                            <th colspan="7">Recursos Humanos</th>
                                            <th colspan="2">EQUIPOS DE COMPUTO</th>
                                            <th colspan="2">LINEAS TELEFONICAS</th>
                                            <th colspan="2">IMPRESORA/MULTIFUNCIONAL</th>
                                            <th colspan="2">OTROS</th>
                                        </tr>
                                        <tr style="background-color: #8f8f8f; font-size: 12px;">
                                            <th scope="col">#</th>
                                            <th scope="col" style="min-width: 200px;">Dirección</th>
                                            <th scope="col" style="min-width: 200px;">Área</th>
                                            <th scope="col" style="min-width: 200px;">Proceso</th>
                                            <th scope="col">Subproceso</th>
                                            <th scope="col">#personas en Op. Normal</th>
                                            <th scope="col" style="min-width: 100px;">Empresa/Área</th>
                                            <th scope="col" style="min-width: 150px;">Nombre</th>
                                            <th scope="col">Puesto</th>
                                            <th scope="col">Rol</th>
                                            <th scope="col">Ext.</th>
                                            <th scope="col">#</th>
                                            <th scope="col">Op. Normal</th>
                                            <th scope="col">En contingencia</th>
                                            <th scope="col">Op. Normal</th>
                                            <th scope="col">En contingencia</th>
                                            <th scope="col">Op. Normal</th>
                                            <th scope="col">En contingencia</th>
                                            <th scope="col">Op. Normal</th>
                                            <th scope="col">En contingencia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($personas_contingencia as $data)
                                            <tr style="font-size: 12px;">
                                                <td scope="row">
                                                    <div style="text-align: left;">P00{{ $data->cuestionario->id }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->cuestionario->direccion }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->cuestionario->area }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->nombre_proceso }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->subproceso ?: 'N/A' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->cantidad_total_personas_normal }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->empresa }} </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->nombre }} {{ $data->a_paterno }}
                                                        {{ $data->a_materno }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->puesto }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->rol }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->tel }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->cantidad_total_personas_contingencia }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->cantidad_equipo_computo_normal ?: 'N/A' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->cantidad_equipo_computo_contingencia ?: 'N/A' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->cantidad_telefonia_normal ?: 'N/A' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->cantidad_telefonia_contingencia ?: 'N/A' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->cantidad_impresora_normal ?: 'N/A' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->cantidad_impresora_contingencia ?: 'N/A' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->cantidad_otros_normal ?: 'N/A' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->cantidad_otros_contingencia ?: 'N/A' }}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal>6.0 Respaldo-registros vitales-->
                <div class="modal fade" id="respaldo" tabindex="-1" aria-labelledby="respaldo" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">6.0 Respaldo-registros vitales</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr style="background-color: #9C1A3B; font-size: 12px;">
                                            <th colspan="5">Información General</th>
                                            <th colspan="4">Respaldos de Información</th>
                                        </tr>
                                        <tr style="background-color: #8f8f8f; font-size: 12px;">
                                            <th scope="col">#</th>
                                            <th scope="col" style="min-width: 200px;">Dirección</th>
                                            <th scope="col" style="min-width: 200px;">Área</th>
                                            <th scope="col" style="min-width: 200px;">Proceso</th>
                                            <th scope="col">Subproceso</th>
                                            <th scope="col" style="min-width: 200px;">¿Se ejecutan respaldos fuera del
                                                equipo de computo de los archivos necesarios para ejecutar el proceso?.</th>
                                            <th scope="col" style="min-width: 200px;">Archivos o Registros
                                                respaldados/Archivos o Registros que se deberían respaldar.</th>
                                            <th scope="col" style="min-width: 200px;">¿Alguien mas tiene accesos al
                                                respaldo?.</th>
                                            <th scope="col" style="min-width: 200px;">¿De que manera se tienen
                                                resguardados los usuarios y contraseñas que utiliza para el acceso a
                                                sistemas necesarios en este proceso?.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cuestionario as $data)
                                            <tr style="font-size: 11px;">
                                                <th scope="row">
                                                    <div style="text-align: left;">P00{{ $data->id }}</div>
                                                </th>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->direccion }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->area }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->nombre_proceso }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->subproceso ?: 'N/A' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->respaldo_q_21 ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->respaldo_q_20 ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->respaldo_q_22 ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->respaldo_q_23 ?: 'No definido' }}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>




























                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.analisis-impacto.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
