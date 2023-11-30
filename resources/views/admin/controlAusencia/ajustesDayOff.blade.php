@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('Ajustes-vacaciones') }}
    {{-- menus horizontales --}}
    <style type="text/css">
        .interno {
            background: #F0F2FF91 0% 0% no-repeat padding-box;
            box-shadow: 0px 1px 4px #0000001A;
            border: 1px solid #D2D2D2;
            border-radius: 14px;
            opacity: 1;
            text-align: center;
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
            box-sizing: border-box;
            position: relative;
            display: inline-block;
            width: 225px;
            height: 96px;
            border-radius: 15px;
            opacity: 1;
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
            background-color: #ffffff;
            /* color: #345183; */
            box-shadow: 0px 2px 3px 1px rgba(0, 0, 0, 0.2);
            transition: 0.1s;
            padding: 7px;
            border-style: solid;
            border-width: 2px;
            border-color: transparent conic-gradient(from 96deg at 50% 50%, #00ff1e 0.00%, #CE00A5 13.85%, #eb2f2f 50.36%, #80006E 100.00%) 0% 0%;
            border-radius: 15px;
            opacity: 1;
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
        <h5 class="titulo_general_funcion">Administración de Day Off</h5>
    </div>
    <div class="card">
        <div class="card-body">

            <ul class="mt-4">
                <div class="card card-body interno">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane mb-4 fade show active" id="nav-empleados" role="tabpanel"
                            aria-labelledby="nav-empleados-tab">
                            @can('reglas_dayoff_acceder')
                                <li>
                                    <a href="dayOff">
                                        <div>
                                            <i class="fa-solid fa-book"></i>
                                            <br>
                                            Lineamientos
                                        </div>
                                    </a>
                                </li>
                            @endcan
                            @can('incidentes_dayoff_acceder')
                                <li>
                                    <a href="incidentes-dayoff">
                                        <div>
                                            <i class="fa-solid fa-scale-unbalanced"></i><br>
                                            Excepciones
                                        </div>
                                    </a>
                                </li>
                            @endcan
                            @can('reglas_dayoff_vista_global')
                                <li>
                                    <a href="vista-global-dayoff">
                                        <div>
                                            <i class="fa-solid fa-globe"></i><br>
                                            Vista Global
                                        </div>
                                    </a>
                                </li>
                            @endcan
                        </div>
                    </div>
                </div>
            </ul>
        </div>
    </div>
@endsection
