@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('Menu-Vacaciones') }}


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

        #circulo {
            width: 1.5rem;
            height: 1.5rem;
            border-radius: 50%;
            background: rgb(100, 110, 220);
            display: flex;
            justify-content: center;

            text-align: center;
        }

        #circulo>p {
            font-family: sans-serif;
            color: white;
            font-size: 1rem;
            font-weight: bold;
        }
    </style>
    <style>
        .ventana_menu {
            width: calc(100% - 60px);
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
        <h5 class="titulo_general_funcion">Solicitudes</h5>

    </div>
    <div class="card">
        <div class="card-body">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane mb-4 fade show active" id="nav-empleados" role="tabpanel"
                    aria-labelledby="nav-empleados-tab">
                    <ul class="mt-4">
                        <li>
                            <a href="aprobacion">
                                <div style="position: relative !important;">
                                    <i class="bi bi-sun"></i>
                                    <br>
                                    Vacaciones
                                    <div id="circulo" style="position:absolute; top:-70px; right:-50px" class="offset-4 mt-4">
                                        <p > {{ $solicitud_vacacion }}</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.solicitud-dayoff.aprobacion') }}">
                                
                                <div style="position: relative !important;">
                                    <i class="bi bi-bicycle"></i><br>
                                    Days Off´s
                                    <div id="circulo" style="position:absolute; top:-70px; right:-50px" class="offset-4 mt-4">
                                        <p> {{ $solicitud_dayoff }}</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.solicitud-permiso-goce-sueldo.aprobacion') }}">
                                <div style="position: relative !important;">
                                    <i class="bi bi-piggy-bank"></i><br>
                                    Permisos con goce de sueldo
                                    <div id="circulo" style="position:absolute; top:-58px; right:-19px" class="offset-4 mt-4">
                                        <p> {{ $solicitud_permiso }}</p>
                                    </div>
                                </div>
                            </a>

                        </li>

                    </ul>

                </div>
            </div>
        </div>
    </div>
@endsection
