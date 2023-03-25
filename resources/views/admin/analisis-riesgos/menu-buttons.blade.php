@extends('layouts.admin')
@section('content')
{{ Breadcrumbs::render('admin.analisis-riesgos.menu') }}
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
        <h5 class="titulo_general_funcion">Análisis de Riesgos</h5>
        {{-- <a href="{{ route('admin.home') }}" class="btn btn-success">
            <i class="fas fa-chart-pie mr-2"></i>
            Dashboard
        </a> --}}
    </div>

    <div class="mt-5 card">
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
                    @include('admin.analisis-riesgos.components.riesgos')
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    {{-- menus --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuActive = localStorage.getItem('menu-analisis-riesgos-active');
            $(`#tabsAnalisisRiesgos [data-type="${menuActive}"]`).tab('show');

            $('#tabsAnalisisRiesgos a').on('click', function(event) {
                event.preventDefault()
                $(this).tab('show')
                const keyTab = this.getAttribute('data-type');
                localStorage.setItem('menu-analisis-riesgos-active', keyTab);
            });
        });
    </script>

    {{-- Scrip menu secundario --}}
    <script>
        $(".btn_ventana_menu").click(function() {
            $(".ventana_menu").fadeOut(100);
            var id_ventana = $(".btn_ventana_menu:hover").attr("data-ventana");
            $(document.getElementById(id_ventana)).fadeIn(100);
            $(".ventana_menu").css("left", "0");
            $(".ventana_menu").css("transition", "0s");
            var text_ruta = "Análisis de Riesgo / " + $(".btn_ventana_menu:hover").attr("data-ruta");
            $(".breadcrumb-item.active").html(text_ruta);
        });
        $(".btn_cerrar_ventana").click(function() {
            $(".ventana_menu").fadeOut(100);
            $(".ventana_menu").css("left", "-50%");
            $(".ventana_menu").css("transition", "1s");
            $(".breadcrumb-item.active").html("Análisis de Riesgo");

        });

        $(".ventana_cerrar").click(function() {
            $(".ventana_menu").fadeOut(100);
            $(".ventana_menu").css("left", "-50%");
            $(".ventana_menu").css("transition", "1s");
            $(".breadcrumb-item.active").html("Análisis de Riesgo");
        });
    </script>
@endsection
