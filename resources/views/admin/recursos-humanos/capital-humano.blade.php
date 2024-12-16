@extends('layouts.admin')
@section('content')
    {{-- {{ Breadcrumbs::render('capital-humano') }} --}}
    <h5 class="titulo_general_funcion">Evaluaciones </h5>
    <nav>
        <div class="nav nav-tabs" id="tabsCapitalHumano" role="tablist" style="margin-bottom: 0px !important;">
            <a class="nav-link active" id="nav-empleados-tab" data-type="empleados" data-toggle="tab" href="#nav-empleados"
                role="tab" aria-controls="nav-empleados" aria-selected="true">
                {{-- <i class="bi bi-people" style="font-size:20px;" style="text-decoration:none;"></i> --}}
                Empleados
            </a>
            <a class="nav-link" id="nav-calendario-comunicacion-tab" data-type="calendario-comunicacion" data-toggle="tab"
                href="#nav-calendario-comunicacion" role="tab" aria-controls="nav-calendario-comunicacion"
                aria-selected="false">
                {{-- <i class="bi bi-calendar3" style="font-size:20px;" style="text-decoration:none;"></i> --}}
                Calendario y Comunicación
            </a>
            <a class="nav-link" id="nav-ev360-tab" data-type="ev360" data-toggle="tab" href="#nav-ev360" role="tab"
                aria-controls="nav-ev360" aria-selected="false">
                {{-- <i class="bi bi-card-checklist" style="font-size:20px;" style="text-decoration:none;"></i> --}}
                Evaluación
            </a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane mb-4 fade show active" id="nav-empleados" role="tabpanel" aria-labelledby="nav-empleados-tab">
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
@endsection
