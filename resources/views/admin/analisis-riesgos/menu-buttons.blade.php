@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.analisis-riesgos.menu') }}

    <style>
        :root {
            --color-menu-modulo: #fcb4bc;
        }

        ul.menu-modulos li a,
        ul.menu-modulos li a::before {
            background-image: url("{{ asset('img/menu-modulos/menu-grafis-4.png') }}");
        }
    </style>

    <h5 class="titulo_general_funcion">Análisis de Riesgos</h5>

    @include('admin.analisis-riesgos.components.riesgos')
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
