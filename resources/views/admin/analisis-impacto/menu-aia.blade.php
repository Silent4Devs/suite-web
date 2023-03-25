@extends('layouts.admin')
@section('content')
{{ Breadcrumbs::render('AIA') }}
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
        <h5 class="titulo_general_funcion">Análisis de Impacto AIA</h5>
        {{-- <a href="{{ route('admin.home') }}" class="btn btn-success">
            <i class="fas fa-chart-pie mr-2"></i>
            Dashboard
        </a> --}}
    </div>

    <div class="mt-2 card">
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="tabsAnalisisRiesgos" role="tablist">
                    {{-- <a class="nav-link active" id="nav-riesgo-tab" data-type="riesgo" data-toggle="tab" href="#nav-riesgo"
                        role="tab" aria-controls="nav-riesgo" aria-selected="true">
                        <i class="mr-2 bi bi-exclamation-triangle" style="font-size:20px;" style="text-decoration:none;"></i>
                        Riesgos
                    </a> --}}
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane mb-2 fade show active" id="nav-riesgo" role="tabpanel"
                    aria-labelledby="nav-riesgo-tab">
                    <ul class="mt-2">
                        @can('matriz_bia_cuestionario_acceder')
                            <li>
                                <a href="{{ route('admin.analisis-aia.index') }}">
                                    <div>
                                        <i class="fas fa-clipboard-list"></i><br>
                                        Cuestionarios
                                    </div>
                                </a>
                            </li>
                        @endcan
                        @can('matriz_bia_matriz')
                            <li>
                                <a href="{{ route('admin.analisis-aia.matriz') }}">
                                    <div>
                                        <i class="fas fa-border-none"></i><br>
                                        Matriz AIA
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


