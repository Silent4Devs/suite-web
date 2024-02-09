@extends('layouts.admin')
@section('content')
    {{-- menus horizontales --}}
    <style type="text/css">
        div.nav .nav-link {
            color: #345183;
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
            background-color: #f8fcff;
            color: #3086AF;
            border-radius: 6px;
            box-shadow: 0px 2px 3px 1px rgba(0, 0, 0, 0.2);
            transition: 0.1s;
            padding: 7px;
        }

        div.tab-pane a:hover {
            text-decoration: none !important;
            outline: 1px solid #3086AF;
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
        <h5 class="titulo_general_funcion">Evaluaciones </h5>
    </div>
    <nav>
        <div class="nav nav-tabs" id="tabsCapitalHumano" role="tablist" style="margin-bottom: 0px !important;">
            <a class="nav-link active" id="nav-empleados-tab"
                data-type="empleados" data-toggle="tab" href="#nav-empleados" role="tab"
                aria-controls="nav-empleados" aria-selected="true">
                {{-- <i class="bi bi-people" style="font-size:20px;" style="text-decoration:none;"></i> --}}
                Empleados
            </a>
            <a class="nav-link" id="nav-calendario-comunicacion-tab" data-type="calendario-comunicacion"
                data-toggle="tab" href="#nav-calendario-comunicacion" role="tab"
                aria-controls="nav-calendario-comunicacion" aria-selected="false">
                {{-- <i class="bi bi-calendar3" style="font-size:20px;" style="text-decoration:none;"></i> --}}
                Calendario y Comunicación
            </a>
            <a class="nav-link" id="nav-ev360-tab" data-type="ev360" data-toggle="tab" href="#nav-ev360"
                role="tab" aria-controls="nav-ev360" aria-selected="false">
                {{-- <i class="bi bi-card-checklist" style="font-size:20px;" style="text-decoration:none;"></i> --}}
                Evaluación 360
            </a>
        </div>
    </nav>
    <div class="card">
        <div class="card-body">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane mb-4 fade show active" id="nav-empleados" role="tabpanel"
                    aria-labelledby="nav-empleados-tab">
                    @include('admin.recursos-humanos.capital-humano.components.empleados')
                </div>
                <div class="tab-pane mb-4 fade" id="nav-calendario-comunicacion" role="tabpanel"
                    aria-labelledby="nav-calendario-comunicacion-tab">
                    @include('admin.recursos-humanos.capital-humano.components.calendario-comunicacion')
                </div>
                <div class="tab-pane mb-4 fade" id="nav-ev360" role="tabpanel" aria-labelledby="nav-ev360-tab">
                    @include('admin.recursos-humanos.capital-humano.components.ev360')
                </div>

            </div>
        </div>
    </div>
@endsection


@section('scripts')
    {{-- menus --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuActive = localStorage.getItem('menu-capital-humano-active');
            $(`#tabsCapitalHumano [data-type="${menuActive}"]`).tab('show');

            $('#tabsCapitalHumano a').on('click', function(event) {
                event.preventDefault()
                $(this).tab('show')
                const keyTab = this.getAttribute('data-type');
                localStorage.setItem('menu-capital-humano-active', keyTab);
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
            var text_ruta = "Capital Humano / " + $(".btn_ventana_menu:hover").attr("data-ruta");
            $(".breadcrumb-item.active").html(text_ruta);
        });
        $(".btn_cerrar_ventana").click(function() {
            $(".ventana_menu").fadeOut(100);
            $(".ventana_menu").css("left", "-50%");
            $(".ventana_menu").css("transition", "1s");
            $(".breadcrumb-item.active").html("Capital Humano");

        });

        $(".ventana_cerrar").click(function() {
            $(".ventana_menu").fadeOut(100);
            $(".ventana_menu").css("left", "-50%");
            $(".ventana_menu").css("transition", "1s");
            $(".breadcrumb-item.active").html("Capital Humano");
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let lineActiveNav = document.createElement('div');
            lineActiveNav.classList.add('line-active-nav');

            document.querySelectorAll('.nav-tabs').forEach(element => {
                element.appendChild(lineActiveNav);
            });
        });
        $('.nav-link').click(function moveLineNav(e) {
            let boundLink = e.target.getBoundingClientRect();
            let boundNav = document.querySelector('.nav.nav-tabs:hover').getBoundingClientRect();

            let offsetTop = boundLink.top - boundNav.top + boundLink.height - 10;
            let offsetLeft = boundLink.left - boundNav.left;

            let line = document.querySelector('.nav-tabs:hover .line-active-nav');

            line.style.top = offsetTop + 'px';
            line.style.left = offsetLeft + 8 + 'px';
            line.style.width = boundLink.width - 16 + 'px';
        });
    </script>
@endsection
