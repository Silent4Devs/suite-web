@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('Ausencias') }}
    {{-- menus horizontales --}}
    <style type="text/css">
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
        }

        a:hover {
            text-decoration: none !important;
        }
    </style>
    <style>
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

    {{-- {{ Breadcrumbs::render('capital-humano') }} --}}
    <div style="display:flex; justify-content:space-between;">
        <h5 class="titulo_general_funcion">Centro de Administración</h5>

    </div>
    <div class="card">
        @include('flash::message')
        <div class="card-body">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane mb-4 fade show active" id="nav-empleados" role="tabpanel"
                    aria-labelledby="nav-empleados-tab">
                    <ul class="mt-4">
                        @can('reglas_vacaciones_acceder')
                            <li>
                                <a href="ajustes-vacaciones">
                                    <div>
                                        <i class="fa-solid fa-users-gear"></i>

                                        <br>
                                        Ajustes Vacaciones
                                    </div>
                                </a>
                            </li>
                        @endcan
                        @can('reglas_dayoff_acceder')
                            <li>
                                <a href="ajustes-dayoff">
                                    <div>
                                        <i class="bi bi-gear-fill"></i>
                                        <br>
                                        Ajustes Day Off´s
                                    </div>
                                </a>
                            </li>
                        @endcan
                        @can('reglas_goce_sueldo_acceder')
                            <li>
                                <a href="ajustes-permisos-goce-sueldo">
                                    <div>
                                        <i class="fas fa-hand-holding-usd"></i><br>
                                        Ajustes Permisos
                                    </div>
                                </a>
                            </li>
                        @endcan
                        @can('solicitud_mensajeria_ajustes')
                            <li>
                                <a href="ajustes-envio-documentos">
                                    <div>
                                        <i class="bi bi-send-plus-fill"></i><br>
                                        Ajustes Envios
                                    </div>
                                </a>
                            </li>
                        @endcan
                    </ul>

                </div>
            </div>
        </div>
    </div>
@endsection
