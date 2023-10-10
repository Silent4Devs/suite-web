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
            <a href="{!! route('admin.analisis-impacto.menu-AIA') !!}">AIA</a>
        </li>
        <li class="breadcrumb-item active">Matriz</li>
    </ol>
    <div class="card">
        <div class="card-header">
            Mostrar Mátriz de Impacto

        </div>
        @include('flash::message')
        <div class="row">
            <div class="col-sm-3 offset-9 mt-3">
                <a class="btn btn-success" href="{{ route('admin.analisis-aia.ajustes') }}"><i class="bi bi-gear"></i>
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
                                        <i class="fas fa-server"></i><br>
                                        1.0
                                        <br>Aplicaciones
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a data-toggle="modal" data-target="#matriz_bia">
                                    <div>
                                        <i class="bi bi-bounding-box"></i><br>
                                        2.0
                                        <br>Matriz AIA
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a data-toggle="modal" data-target="#entradas_salidas">
                                    <div>
                                        <i class="bi bi-arrow-down-up"></i><br>
                                        3.0
                                        <br>Requerimientos Mínimos
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a data-toggle="modal" data-target="#tecnologica">
                                    <div>
                                        <i class="bi bi-cpu"></i><br>
                                        4.0
                                        <br>Respaldo
                                    </div>
                                </a>
                            </li>


                            <li>
                                <a data-toggle="modal" data-target="#requerimientos_minimos">
                                    <div>
                                        <i class="bi bi-clipboard-check"></i><br>
                                        5.0
                                        <br>Datos Técnicos
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a data-toggle="modal" data-target="#respaldo">
                                    <div>
                                        <i class="fas fa-sync mt-3"></i><br>
                                        6.0
                                        <br>Flujo de soporte a la aplicación
                                    </div>
                                </a>
                            </li>

                        </ul>

                    </div>
                </div>


                <!-- Modal>1.0 Aplicaciones-->
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
                                            <th colspan="8">Procesos</th>
                                        </tr>
                                        <tr style="background-color: #8f8f8f; font-size: 12px;">
                                            <th scope="col">ID</th>
                                            <th scope="col">ID Aplicación</th>
                                            <th scope="col">Nombre de la Aplicación</th>
                                            <th scope="col">Objetivo de la Aplicación</th>
                                            <th scope="col">Área a la que pertenece la Aplicación</th>
                                            <th scope="col">Área responsable del uso de la Aplicación:</th>
                                            <th scope="col">Titular de la Aplicación:</th>
                                            <th scope="col">Empresa o tercero que da soporte a la Aplicación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cuestionario as $data)
                                            <tr style="font-size: 11px;">
                                                <th scope="row">
                                                    <div style="text-align: left;">A0{{ $data->id}}</div>
                                                </th>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->id_aplicacion ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->nombre_aplicacion ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->objetivo_aplicacion ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->area_pertenece_aplicacion ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->area_responsable_aplicacion ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->titular_nombre ?: '' }}
                                                        {{ $data->titular_a_paterno ?: '' }}
                                                        {{ $data->titular_a_paterno ?: '' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->app_datos_terceros ?: 'No definido' }}</div>
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

                <!-- Modal>2.0 2.0 Matriz AIA-->
                <div class="modal fade" id="matriz_bia" tabindex="-1" aria-labelledby="matriz_bia" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">2.0 Matriz AIA</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr style="text-align:left !important; background-color: #9C1A3B; font-size: 11px;">
                                            <th colspan="5">Datos Generales de la Aplicación</th>
                                            <th colspan="4">TITULAR DEL PROCESO</th>
                                            <th colspan="1">PERIODICIDAD</th>
                                            <th colspan="12">MESES</th>
                                            <th colspan="4">SEMANAS</th>
                                            <th colspan="7">DIAS</th>
                                            <th colspan="24">HORAS</th>
                                          
                                            <th colspan="5">TIEMPOS DE RECUPERACIÓN</th>
                                            <th colspan="5">IMPACTO OPERATIVO</th>
                                            <th colspan="5">IMPACTO REGULATORIO</th>
                                            <th colspan="5">IMPACTO EN LA REPUTACION / IMAGEN PÚBLICA O POLÍTICA</th>
                                            <th colspan="5">IMPACTO SOCIAL</th>
                                            <th colspan="3">VALORACIÓN DEL PROCESO</th>
                                        </tr>
                                        <tr
                                            style="text-align:left !important; background-color: #8f8f8f; font-size: 11px;">
                                            <th scope="col">#</th>
                                            <th scope="col" style="min-width: 150px;">ID Aplicación</th>
                                            <th scope="col" style="min-width: 150px;">Nombre de la Aplicación</th>
                                            <th scope="col" style="min-width: 150px;">Objetivo de la Aplicación</th>
                                            <th scope="col" style="min-width: 150px;">Empresa o tercero que da soporte
                                                a la Aplicación</th>
                                            <th scope="col" style="min-width: 100px;">Nombre(s)</th>
                                            <th scope="col" style="min-width: 100px;">Apellido Paterno</th>
                                            <th scope="col" style="min-width: 100px;">Apellido Materno</th>
                                            <th scope="col" style="min-width: 100px;">Empresa o tercero que da soporte
                                                a la Aplicación</th>
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
                                           
                                            </th>
                                           
                                            <th scope="col">RPO (hrs)</th>
                                            <th scope="col">RTO (hrs)</th>
                                            <th scope="col">WRT (hrs)</th>
                                            <th scope="col">MTPD (hrs)</th>
                                            <th scope="col">Nivel RTO</th>
                                            <th scope="col">
                                                < 4 hrs</th>
                                            <th scope="col" style="min-width: 60px;">4-24 hrs</th>
                                            <th scope="col" style="min-width: 60px;">24-48 hrs</th>
                                            <th scope="col">>48 hrs</th>
                                            <th scope="col" style="vertical-align:middle !important;">
                                                <div class="box_rotate">Promedio</div>
                                            </th>
                                            <th scope="col">
                                                < 4 hrs</th>
                                            <th scope="col" style="min-width: 60px;">4-24 hrs</th>
                                            <th scope="col" style="min-width: 60px;">24-48 hrs</th>
                                            <th scope="col">>48 hrs</th>
                                            <th scope="col" style="vertical-align:middle !important;">
                                                <div class="box_rotate">Promedio</div>
                                            </th>
                                            <th scope="col">
                                                < 4 hrs</th>
                                            <th scope="col" style="min-width: 60px;">4-24 hrs</th>
                                            <th scope="col" style="min-width: 60px;">24-48 hrs</th>
                                            <th scope="col">>48 hrs</th>
                                            <th scope="col" style="vertical-align:middle !important;">
                                                <div class="box_rotate">Promedio</div>
                                            </th>
                                            <th scope="col">
                                                < 4 hrs</th>
                                            <th scope="col" style="min-width: 60px;">4-24 hrs</th>
                                            <th scope="col" style="min-width: 60px;">24-48 hrs</th>
                                            <th scope="col">>48 hrs</th>
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
                                                <th scope="row">A0{{ $data->id ?: 'No definido' }}</th>
                                                <td><div style="text-align: left;">{{ $data->id_aplicacion ?: 'No definido' }}</div></td>
                                                <td><div style="text-align: left;">{{ $data->nombre_aplicacion ?: 'No definido' }}</div></td>
                                                <td style="text-align: left !important;">
                                                    <div style="text-align: left;">{{ $data->objetivo_aplicacion ?: 'No definido' }}</div></td>
                                                <td>{{ $data->app_datos_terceros ?: 'No definido' }}</td>

                                                <td style="text-align: left !important;">
                                                    {{ $data->titular_nombre ?: 'No definido' }}</td>
                                                <td style="text-align: left !important;">
                                                    {{ $data->titular_a_paterno ?: 'No definido' }}</td>
                                                <td style="text-align: left !important;">
                                                    {{ $data->titular_a_materno ?: 'No definido' }}</td>
                                                <td>{{ $data->app_datos_terceros ?: 'No definido' }}</td>
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
                                              
                                                <td>{{ $data->rpo_horas ?: '0' }}</td>
                                                <td>{{ $data->rto_horas ?: '0' }}</td>
                                                <td>{{ $data->wrt_horas ?: '0' }}</td>
                                                <td>{{ $data->mtpd_horas ?: '0' }}</td>
                                                <td
                                                    style="background-color:{{ $data->nivel_rto[0] }};color:{{ $data->nivel_rto[1] }}">
                                                    {{ $data->nivel_rto[2] ?: '0' }}</td>
                                                <td>{{ $data->operacion_q_1 ?: '0' }}</td>
                                                <td style="text-align: center !important;">
                                                    {{ $data->operacion_q_2 ?: '0' }}</td>
                                                <td>{{ $data->operacion_q_3 ?: '0' }}</td>
                                                <td>{{ $data->operacion_q_4 ?: '0' }}</td>
                                                <td style="text-align:center !important;">
                                                    {{ $data->operacion_promedio ?: '0' }}</td>
                                                <td>{{ $data->regulatorio_q_1 ?: '0' }}</td>
                                                <td style="text-align: center !important;">
                                                    {{ $data->regulatorio_q_2 ?: '0' }}</td>
                                                <td>{{ $data->regulatorio_q_3 ?: '0' }}</td>
                                                <td>{{ $data->regulatorio_q_4 ?: '0' }}</td>
                                                <td
                                                    style="text-align:center
                                                    !important;">
                                                    {{ $data->regulatorio_promedio ?: '0' }}</td>
                                                <td>{{ $data->reputacion_q_1 ?: '0' }}</td>
                                                <td style="text-align: center !important;">
                                                    {{ $data->reputacion_q_2 ?: '0' }}</td>
                                                <td>{{ $data->reputacion_q_3 ?: '0' }}</td>
                                                <td>{{ $data->reputacion_q_4 ?: '0' }}</td>
                                                <td
                                                    style="text-align:center
                                                    !important;">
                                                    {{ $data->reputacion_promedio ?: '0' }}</td>
                                                <td>{{ $data->social_q_1 ?: '0' }}</td>
                                                <td style="text-align: center !important;">{{ $data->social_q_2 ?: '0' }}
                                                </td>
                                                <td>{{ $data->social_q_3 ?: '0' }}</td>
                                                <td>{{ $data->social_q_4 ?: '0' }}</td>
                                                <td
                                                    style="text-align:center
                                                    !important;">
                                                    {{ $data->social_promedio ?: '0' }}</td>
                                                <td>{{ $data->total_impactos ?: '0' }}</td>
                                                <td
                                                    style="background-color:{{ $data->nivel_impacto[0] }};color:{{ $data->nivel_impacto[1] }}">
                                                    {{ $data->nivel_impacto[2] ?: '0' }}</td>
                                                <td
                                                    style="background-color:{{ $data->criticidad_proceso[0] }};color:{{ $data->criticidad_proceso[1] }}">
                                                    {{ $data->criticidad_proceso[2] ?: '0' }}</td>
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

                <!-- Modal 3.0Requerimientos Mínimoss-->

                <div class="modal fade" id="entradas_salidas" tabindex="-1" aria-labelledby="entradas_salidas"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">3.0 Requerimientos Mínimos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr style="background-color: #9C1A3B; font-size: 12px;text-align:center;">
                                            <th colspan="35">REQUERIMIENTOS MINIMOS PARA LA OPERACIÓN</th>
                                        </tr>
                                        <tr
                                            style="background-color: #595959;color:white; font-size: 12px;text-align:center;">
                                            <th colspan="2" rowspan="3">INFORMACIÓN GENERAL</th>
                                            <th colspan="33">REQUERIMIENTOS MINIMOS PARA LA OPERACIÓN Y RECUPERACIÓN</th>
                                        </tr>
                                        <tr
                                            style="background-color: #808080; color:white; font-size: 12px; text-align:center;">
                                            <th scope="col" colspan="10">RECURSOS HUMANOS</th>
                                            <th scope="col" colspan="5">EQUIPOS DE COMPUTO</th>
                                            <th scope="col" colspan="5">LINEAS TELEFONICAS</th>
                                            <th scope="col" colspan="5">IMPRESORA/MULTIFUNCIONAL</th>
                                            <th scope="col" colspan="7">OTROS</th>
                                        </tr>
                                        <tr
                                            style="background-color: #808080; color:white; font-size: 12px;  text-align:center;">
                                            <th scope="col" rowspan="2"># Personas en Op. Normal</th>
                                            <th scope="col" colspan="9">En contingencia</th>
                                            <th scope="col" rowspan="2">#Op. Normal</th>
                                            <th scope="col" colspan="4">En contingencia</th>
                                            <th scope="col" rowspan="2">#Op. Normal</th>
                                            <th scope="col" colspan="4">En contingencia</th>
                                            <th scope="col" rowspan="2">#Op. Normal</th>
                                            <th scope="col" colspan="4">En contingencia</th>
                                            <th scope="col" rowspan="2">#Op. Normal</th>
                                            <th scope="col" colspan="6">En contingencia</th>
                                        </tr>
                                        <tr style="background-color: #808080; color:white;  text-align:center;">
                                            <th scope="col">#</th>
                                            <th scope="col" style="min-width: 200px;">Aplicación</th>
                                            <th scope="col" style="min-width: 200px;">Empresa/Área</th>
                                            <th scope="col" style="min-width: 200px;">Nombre</th>
                                            <th scope="col" style="min-width: 200px;">Puesto</th>
                                            <th scope="col" style="min-width: 200px;">Rol</th>
                                            <th scope="col" style="min-width: 200px;">Ext.</th>
                                            <th scope="col" style="min-width: 100px;">
                                                < 4 hrs</th>
                                            <th scope="col" style="min-width: 100px;">4-24 hrs</th>
                                            <th scope="col" style="min-width: 100px;">24-48 hrs</th>
                                            <th scope="col" style="min-width: 100px;">> 48 hrs</th>
                                            <th scope="col" style="min-width: 100px;">
                                                < 4 hrs</th>
                                            <th scope="col" style="min-width: 100px;">4-24 hrs</th>
                                            <th scope="col" style="min-width: 100px;">24-48 hrs</th>
                                            <th scope="col" style="min-width: 100px;">> 48 hrs</th>
                                            <th scope="col" style="min-width: 100px;">
                                                < 4 hrs</th>
                                            <th scope="col" style="min-width: 100px;">4-24 hrs</th>
                                            <th scope="col" style="min-width: 100px;">24-48 hrs</th>
                                            <th scope="col" style="min-width: 100px;">> 48 hrs</th>
                                            <th scope="col" style="min-width: 100px;">
                                                < 4 hrs</th>
                                            <th scope="col" style="min-width: 100px;">4-24 hrs</th>
                                            <th scope="col" style="min-width: 100px;">24-48 hrs</th>
                                            <th scope="col" style="min-width: 100px;">> 48 hrs</th>
                                            <th scope="col" style="min-width: 200px;">Descripcion</th>
                                            <th scope="col" style="min-width: 100px;">
                                                < 4 hrs</th>
                                            <th scope="col" style="min-width: 100px;">4-24 hrs</th>
                                            <th scope="col" style="min-width: 100px;">24-48 hrs</th>
                                            <th scope="col" style="min-width: 100px;">> 48 hrs</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cuestionario as $data)
                                            <tr style="font-size: 11px;">
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: left;">
                                                        A0{{ $data->id ?: 'No definido' }}</div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: left;">
                                                        {{ $data->nombre_aplicacion ?: 'No definido' }}</div>
                                                </td>

                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_total_personas_normal ?: '0' }}</div>
                                                </td>
                                                @if ($data->cantidad_total_personas_contingencia == 0)
                                                    <td colspan="5" style="background-color:#f3f3f3 ">
                                                        <div style="text-align: center; color:red;">No definido</div>
                                                    </td>
                                                    <td rowspan="{{ $data->rowspan_ajuste }}">
                                                        <div style="text-align: center; color:red;">
                                                            {{ $data->cantidad_total_personas_contingencia ?: '0' }}</div>
                                                    </td>
                                                    <td rowspan="{{ $data->rowspan_ajuste }}">
                                                        <div style="text-align: center; color:red;">
                                                            {{ $data->cantidad_total_personas_contingencia ?: '0' }}</div>
                                                    </td>
                                                    <td rowspan="{{ $data->rowspan_ajuste }}">
                                                        <div style="text-align: center; color:red;">
                                                            {{ $data->cantidad_total_personas_contingencia ?: '0' }}</div>
                                                    </td>
                                                    <td rowspan="{{ $data->rowspan_ajuste }}">
                                                        <div style="text-align: center; color:red;">
                                                            {{ $data->cantidad_total_personas_contingencia ?: '0' }}</div>
                                                    </td>
                                                @elseif ($data->cantidad_total_personas_contingencia >= 1)
                                                    <td>
                                                        <div style="text-align: center;">
                                                            {{ $data->datos_personas_contingencia->empresa ?: 'Sin Datos' }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div style="text-align: center;">
                                                            {{ $data->datos_personas_contingencia->nombre ?: '' }}
                                                            {{ $data->datos_personas_contingencia->a_paterno ?: '' }}
                                                            {{ $data->datos_personas_contingencia->a_materno ?: '' }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div style="text-align: center;">
                                                            {{ $data->datos_personas_contingencia->puesto ?: 'Sin Datos' }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div style="text-align: center;">
                                                            {{ $data->datos_personas_contingencia->rol ?: 'Sin Datos' }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div style="text-align: center;">
                                                            {{ $data->datos_personas_contingencia->tel ?: 'Sin Datos' }}
                                                        </div>
                                                    </td>
                                                    <td rowspan="{{ $data->rowspan_ajuste }}">
                                                        <div style="text-align: center;">
                                                            {{ $data->cantidad_total_personas_contingencia ?: '0' }}</div>
                                                    </td>
                                                    <td rowspan="{{ $data->rowspan_ajuste }}">
                                                        <div style="text-align: center;">
                                                            {{ $data->cantidad_total_personas_contingencia ?: '0' }}</div>
                                                    </td>
                                                    <td rowspan="{{ $data->rowspan_ajuste }}">
                                                        <div style="text-align: center;">
                                                            {{ $data->cantidad_total_personas_contingencia ?: '0' }}</div>
                                                    </td>
                                                    <td rowspan="{{ $data->rowspan_ajuste }}">
                                                        <div style="text-align: center;">
                                                            {{ $data->cantidad_total_personas_contingencia ?: '0' }}</div>
                                                    </td>
                                                @endif

                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_equipo_computo_normal ?: 'No definido' }}</div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_equipo_computo_contingencia ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_equipo_computo_contingencia ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_equipo_computo_contingencia ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_equipo_computo_contingencia ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_telefonia_normal ?: 'No definido' }}</div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_telefonia_contingencia ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_telefonia_contingencia ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_telefonia_contingencia ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_telefonia_contingencia ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_impresora_normal ?: 'No definido' }}</div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_impresora_contingencia ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_impresora_contingencia ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_impresora_contingencia ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_impresora_contingencia ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_otros_normal ?: 'No definido' }}</div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->descripcion_otros_normal ?: 'No definido' }}</div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_otros_contingencia ?: 'No definido' }}</div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_otros_contingencia ?: 'No definido' }}</div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_otros_contingencia ?: 'No definido' }}</div>
                                                </td>
                                                <td rowspan="{{ $data->rowspan_ajuste }}">
                                                    <div style="text-align: center;">
                                                        {{ $data->cantidad_otros_contingencia ?: 'No definido' }}</div>
                                                </td>
                                            </tr>
                                            @if ($data->cantidad_total_personas_contingencia >= 2)
                                                @foreach ($data->datos_personas_contingencia_dif as $persona_contingencia)
                                                    <tr style="font-size: 11px;">
                                                        <td>
                                                            <div style="text-align: center;">
                                                                {{ $persona_contingencia['empresa'] ?: 'Sin Datos' }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div style="text-align: center;">
                                                                {{ $persona_contingencia['nombre'] ?: '' }}
                                                                {{ $persona_contingencia['a_paterno'] ?: '' }}
                                                                {{ $persona_contingencia['a_materno'] ?: '' }}</div>
                                                        </td>
                                                        <td>
                                                            <div style="text-align: center;">
                                                                {{ $persona_contingencia['puesto'] ?: 'Sin Datos' }}</div>
                                                        </td>
                                                        <td>
                                                            <div style="text-align: center;">
                                                                {{ $persona_contingencia['rol'] ?: 'Sin Datos' }}</div>
                                                        </td>
                                                        <td>
                                                            <div style="text-align: center;">
                                                                {{ $persona_contingencia['tel'] ?: 'Sin Datos' }}</div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table><br>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal>4.0Respaldo de Bases de Datos y Código Fuente-->
                <div class="modal fade" id="tecnologica" tabindex="-1" aria-labelledby="tecnologica"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">4.0 Respaldo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="background-color: #9C1A3B; font-size: 12px;">
                                            <th colspan="5">Respaldo de Bases de Datos y Código Fuente</th>
                                        </tr>
                                        <tr style="background-color: #8f8f8f; font-size: 12px;">
                                            <th scope="col">#</th>
                                            <th scope="col">Aplicación</th>
                                            <th scope="col">¿Se tiene respaldo de base de datos, código fuente, scripts,
                                                etc.?</th>
                                            <th scope="col">¿Cuál es la periodicidad del respaldo?</th>
                                            <th scope="col">¿Qué tipo de respaldo se aplica? (Incremental, Full, etc.)
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cuestionario as $data)
                                            <tr style="font-size: 11px;">
                                                <th scope="row">
                                                    <div style="text-align: left;">A0{{ $data->id }}</div>
                                                </th>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->nombre_aplicacion ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->respaldo_q_14 ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->respaldo_q_15 ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->respaldo_q_16 ?: 'No definido' }}
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

                <!-- Modal>5.0 Datos Técnicos-->
                <div class="modal fade" id="requerimientos_minimos" tabindex="-1"
                    aria-labelledby="requerimientos_minimos" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">5.0 Datos Técnicos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr style="background-color: #9C1A3B; font-size: 12px;text-align:center;">
                                            <th colspan="6">Información General</th>
                                            <th colspan="13">Datos Técnicos</th>
                                        </tr>

                                        <tr style="background-color: #8f8f8f; font-size: 12px;">
                                            <th scope="col">#</th>
                                            <th scope="col" style="min-width: 200px;">Responsable</th>
                                            <th scope="col" style="min-width: 200px;">Aplicación</th>
                                            <th scope="col" style="min-width: 25px;">Versión</th>
                                            <th scope="col" style="min-width: 25px;">Estatus (productivo/desarrollo)</th>
                                            <th scope="col" style="min-width: 25px;">Publicación (interna/externa)</th>
                                            <th scope="col" style="min-width: 25px;">Administración o Soporte por
                                                terceros: (SI / NO)</th>
                                            <th scope="col" style="min-width: 200px;">Datos del tercero que administra
                                                o Soporta: (Nombre, Empresa,
                                                Contacto)</th>
                                            <th scope="col" style="min-width: 25px;">Interacción con otras
                                                aplicaciones:
                                                (SI / NO)</th>
                                            <th scope="col" style="min-width: 300px;">Datos de la aplicación con la que
                                                interactúa y tipo de conectividad: </th>
                                            <th scope="col" style="min-width: 50px;">SO</th>
                                            <th scope="col" style="min-width: 75px;">Lenguaje de Desarrollo</th>
                                            <th scope="col" style="min-width: 200px;">Softwares adicionales,
                                                especificar versiones y puertos en
                                                caso de usarse. (java, glashfish, tomcat, etc)</th>
                                            <th scope="col" style="min-width: 25px;">Utiliza certificados</th>
                                            <th scope="col" style="min-width: 75px;">Datos de Certificados</th>
                                            <th scope="col" style="min-width: 75px;">Nombre de instancias o bases de
                                                Datos</th>
                                            <th scope="col" style="min-width: 200px;">Puertos que utiliza</th>
                                            <th scope="col" style="min-width: 100px;">Tipo de Acceso al Sistema</th>
                                            <th scope="col" style="min-width: 200px;">URL de Acceso</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cuestionario as $data)
                                            <tr style="font-size: 12px;">
                                                <th scope="row">
                                                    <div style="text-align: left;">{{ $data->id }}</div>
                                                </th>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->titular_nombre ?: '' }}
                                                        {{ $data->titular_a_paterno ?: '' }}
                                                        {{ $data->titular_a_paterno ?: '' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->nombre_aplicacion ?: 'No definido' }}</div>
                                                </td>


                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->version ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    @if ($data->productivo_desarrollo == 1)
                                                        <div style="text-align: left;">
                                                            Productivo</div>
                                                    @elseif ($data->productivo_desarrollo == 2)
                                                        <div style="text-align: left;">
                                                            Desarrollo</div>
                                                    @else
                                                        <div style="text-align: left;">
                                                            No definido</div>
                                                    @endif

                                                </td>
                                                <td>
                                                    @if ($data->interno_externo == 1)
                                                        <div style="text-align: left;">
                                                            Interno</div>
                                                    @elseif ($data->interno_externo == 2)
                                                        <div style="text-align: left;">
                                                            Externo</div>
                                                    @else
                                                        <div style="text-align: left;">
                                                            No definido</div>
                                                    @endif

                                                </td>
                                                <td>
                                                    @if ($data->app_soporte_terceros == 1)
                                                        <div style="text-align: left;">
                                                            Sí</div>
                                                    @elseif ($data->app_soporte_terceros == 2)
                                                        <div style="text-align: left;">
                                                            No</div>
                                                    @else
                                                        <div style="text-align: left;">
                                                            No definido</div>
                                                    @endif

                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->app_datos_terceros ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    @if ($data->app_interaccion_otras_apps == 1)
                                                        <div style="text-align: left;">
                                                            Sí</div>
                                                    @elseif ($data->app_interaccion_otras_apps == 2)
                                                        <div style="text-align: left;">
                                                            No</div>
                                                    @else
                                                        <div style="text-align: left;">
                                                            No definido</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->app_datos_interactuan ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->app_SO ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->app_lenguajes ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->sofware_adicional ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    @if ($data->app_certificado == 1)
                                                        <div style="text-align: left;">
                                                            Sí</div>
                                                    @elseif ($data->app_certificado == 2)
                                                        <div style="text-align: left;">
                                                            No</div>
                                                    @else
                                                        <div style="text-align: left;">
                                                            No definido</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->app_tipo_cifrado ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->bd_base ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        <strong>Aplicación</strong>
                                                        {{ $data->app_puerto ?: 'No definido' }} |
                                                        <strong>BD</strong> {{ $data->bd_puerto ?: 'No definido' }} |
                                                        <strong>Otro</strong> {{ $data->otro_puerto ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($data->app_acceso == 1)
                                                        <div style="text-align: left;">
                                                            WEB</div>
                                                    @elseif ($data->app_acceso == 2)
                                                        <div style="text-align: left;">
                                                            Cliente-Servidor</div>
                                                    @elseif ($data->app_acceso == 3)
                                                        <div style="text-align: left;">
                                                            No aplica</div>
                                                    @else
                                                        <div style="text-align: left;">
                                                            No definido</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->app_datos_url ?: 'No definido' }}</div>
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

                <!-- Modal>6.0FLUJO DEL PROCESO DE SOPORTE A LA APLICACIÓN-->
                <div class="modal fade" id="respaldo" tabindex="-1" aria-labelledby="respaldo" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">6.0 FLUJO DEL PROCESO DE SOPORTE A LA
                                    APLICACIÓN</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr style="background-color: #9C1A3B; font-size: 12px;">
                                            <th colspan="4">Información General</th>
                                            <th colspan="5" style="text-align: center;">FLUJO DEL PROCESO DE SOPORTE A
                                                LA
                                                APLICACIÓN</th>
                                        </tr>
                                        <tr style="background-color: #8f8f8f; font-size: 12px;">
                                            <th scope="col">ID</th>
                                            <th scope="col" style="min-width: 200px;">Sistema </th>
                                            <th scope="col" style="min-width: 200px;">Responsable </th>
                                            <th scope="col" style="min-width: 200px;">Área Responsable del uso del
                                                Sistema</th>
                                            <th scope="col" style="min-width: 200px;">1. ¿Qué información se requiere
                                                para iniciar el proceso de soporte o mantenimiento? (Documentos, Correo
                                                electrónico, Oficios, Ticket, etc.)</th>
                                            <th scope="col" style="min-width: 200px;">2. ¿De dónde proviene la
                                                información?
                                                (Nombre de la Empresa / Nombre del Área / Nombre del Proceso / Nombre del
                                                Sistema)</th>
                                            <th scope="col" style="min-width: 800px;">3. ¿Quién le proporciona esta
                                                información?</th>
                                            <th scope="col" style="min-width: 800px;">4. ¿Quién es responsable de
                                                liberar/aplicar los mantenimientos al aplicativo?</th>
                                            <th scope="col" style="min-width: 300px;">5. ¿Cómo valida que el proceso se
                                                realizó correctamente? (Carta o firma de aceptación, Acuse de Recibido,
                                                Notificación, etc..)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cuestionario as $data)
                                            <tr style="font-size: 11px;">
                                                <th scope="row">
                                                    <div style="text-align: left;">A0{{ $data->id }}</div>
                                                </th>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->nombre_aplicacion ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->titular_nombre ?: '' }}
                                                        {{ $data->titular_a_paterno ?: '' }}
                                                        {{ $data->titular_a_paterno ?: '' }}</div>
                                                </td>

                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->area_responsable_aplicacion ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->flujo_q_1 ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->flujo_q_2 ?: 'No definido' }}</div>
                                                </td>

                                                <td>
                                                    @if (count($data->proporcionaMantenimientos) >= 1)
                                                        @foreach ($data->proporcionaInformacion as $proporciona)
                                                            <div style="text-align: left;"><strong>Nombre:
                                                                </strong>{{ $proporciona->nombre ?: 'No definido' }} |
                                                                <strong>Puesto:
                                                                </strong>{{ $proporciona->puesto ?: 'No definido' }} |
                                                                <strong>Correo electrónico:
                                                                </strong>{{ $proporciona->correo_electronico ?: 'No definido' }}
                                                                | <strong>Puesto:
                                                                </strong>{{ $proporciona->puesto ?: 'No definido' }} |
                                                                <strong>Ext.:
                                                                </strong>{{ $proporciona->extencion ?: 'No definido' }} |
                                                                <strong>Ubicación.:
                                                                </strong>{{ $proporciona->ubicacion ?: 'No definido' }}
                                                            </div>
                                                            <br>
                                                            <hr>
                                                        @endforeach
                                                    @else
                                                        <div style="text-align: center;">
                                                            No definido</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (count($data->proporcionaMantenimientos) >= 1)
                                                        @foreach ($data->proporcionaMantenimientos as $proporciona)
                                                            <div style="text-align: left;"><strong>Nombre:
                                                                </strong>{{ $proporciona->nombre ?: 'No definido' }} |
                                                                <strong>Puesto:
                                                                </strong>{{ $proporciona->puesto ?: 'No definido' }} |
                                                                <strong>Correo electrónico:
                                                                </strong>{{ $proporciona->correo_electronico ?: 'No definido' }}
                                                                | <strong>Puesto:
                                                                </strong>{{ $proporciona->puesto ?: 'No definido' }} |
                                                                <strong>Ext.:
                                                                </strong>{{ $proporciona->extencion ?: 'No definido' }} |
                                                                <strong>Ubicación.:
                                                                </strong>{{ $proporciona->ubicacion ?: 'No definido' }}
                                                            </div>
                                                            <br>
                                                            <hr>
                                                        @endforeach
                                                    @else
                                                        <div style="text-align: center;">
                                                            No definido</div>
                                                    @endif

                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->flujo_q_5 ?: 'No definido' }}</div>
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
