@extends('layouts.admin')
@section('content')
    {{-- {{ Breadcrumbs::render('admin.iso27001.index') }} --}}

    <style>
        :root {
            --color-menu-modulo: #e0c5ff;
        }

        ul.menu-modulos li a,
        ul.menu-modulos li a::before {
            background-image: url("{{ asset('img/menu-modulos/menu-grafis-5.png') }}") !important;
        }
    </style>

    <div style="display:flex; justify-content:space-between;">
        <h5 class="titulo_general_funcion">KATBOL - GESTION DE CONTRATOS</h5>
    </div>
    <nav>
        <div class="nav nav-tabs" id="tabsIso27001" role="tablist">
            <a class="nav-link active" id="nav-contexto-tab" data-type="contexto" data-toggle="tab" href="#nav-contexto"
                role="tab" aria-controls="nav-contexto" aria-selected="true">
                <i class="fa-solid fa-file"></i>
                Gestion de Contratos
            </a>
            <a class="nav-link" id="nav-liderazgo-tab" data-type="liderazgo" data-toggle="tab" href="#nav-liderazgo"
                role="tab" aria-controls="nav-liderazgo" aria-selected="false">
                <i class="fa-solid fa-file-pen"></i>
                Administracion de Contratos
            </a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane mb-4 fade show active" id="nav-contexto" role="tabpanel" aria-labelledby="nav-contexto-tab">
            @include('contract_manager.katbol.gestion-contratos')
        </div>
        <div class="tab-pane mb-4 fade" id="nav-liderazgo" role="tabpanel" aria-labelledby="nav-liderazgo-tab">
            @include('contract_manager.katbol.administracion-gestion-contratos')
        </div>
    </div>
@endsection


@section('scripts')
    {{-- menus --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuActive = localStorage.getItem('menu-iso27001-active');
            $(`#tabsIso27001 [data-type="${menuActive}"]`).tab('show');

            $('#tabsIso27001 a').on('click', function(event) {
                event.preventDefault()
                $(this).tab('show')
                const keyTab = this.getAttribute('data-type');
                localStorage.setItem('menu-iso27001-active', keyTab);
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
            var text_ruta = "ISO 27001 / " + $(".btn_ventana_menu:hover").attr("data-ruta");
            $(".breadcrumb-item.active").html(text_ruta);
        });
        $(".btn_cerrar_ventana").click(function() {
            $(".ventana_menu").fadeOut(100);
            $(".ventana_menu").css("left", "-50%");
            $(".ventana_menu").css("transition", "1s");
            $(".breadcrumb-item.active").html("ISO 27001");

        });

        $(".ventana_cerrar").click(function() {
            $(".ventana_menu").fadeOut(100);
            $(".ventana_menu").css("left", "-50%");
            $(".ventana_menu").css("transition", "1s");
            $(".breadcrumb-item.active").html("ISO 27001");
        });
    </script>

    <script>
        document.addEventListener('change', function() {
            const version = document.getElementById('toggle');
            version.value = version.checked ? 'true' : 'false';
            // console.log(version.value);
            const valor = version.value;
            // console.log(valor);
            $.ajax({
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                url: "{{ route('admin.inicio-Usuario.updateVersionIso') }}",
                data: valor,
                processData: false,
                contentType: "application/json; charset=utf-8",
                dataType: "JSON",
            });

            async function reloadPage() {
                try {
                    await new Promise(resolve => setTimeout(resolve, 1000));
                    location.reload();
                } catch (error) {
                    console.error('Error al recargar la página:', error);
                }
            }
            reloadPage();
        });
    </script>
@endsection
