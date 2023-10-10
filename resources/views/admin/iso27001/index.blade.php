@extends('layouts.admin')
@section('content')
    {{-- menus horizontales --}}
    <style type="text/css">
        .caja_botones_menu {
            display: flex;
        }

        .caja_botones_menu a {
            width: 33.33%;
            text-decoration: none;
            display: inline-block;
            color: #345183;
            padding: 5px 0px;
            border-top: 1px solid #ccc !important;
            border-right: 1px solid #ccc;
            background-color: #f9f9f9;
            margin: 0;
            text-align: center;
            align-items: center;
        }

        .caja_botones_menu a:first-child {
            border-left: 1px solid #ccc;
        }

        .caja_botones_menu a:not(.caja_botones_menu a.btn_activo) {
            border-bottom: 1px solid #ccc;
        }

        .caja_botones_menu a i {
            margin-right: 7px;
            font-size: 15pt;
        }

        .caja_botones_menu a.btn_activo,
        .caja_botones_menu a.btn_activo:hover {
            background-color: #fff;
        }

        .caja_botones_menu a:hover {
            background-color: #f1f1f1;
        }

        .caja_caja_secciones {
            width: 100%;
        }

        .caja_secciones {
            width: 100%;
            display: flex;
        }

        .caja_secciones section {
            width: 0px;
            overflow: hidden;
            transition: 0.4s;
            opacity: 0;
        }

        .caja_tab_reveldada {
            width: 100% !important;
            overflow: none;
            opacity: 1 !important;
        }



        .seccion_div {
            overflow: hidden;
            width: 990px;
        }

        .caja_tab_reveldada .seccion_div {
            overflow: hidden;
            transition-delay: 0.5s;
            width: 100%;
        }

    </style>
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



        @media(max-width: 648px) {
            .caja_secciones {
                min-height: 1000px;
            }
        }

        @media(max-width: 474px) {
            .caja_secciones {
                min-height: 2000px;
            }
        }

        .tabs {
            outline: none;
        }

    </style>
    <style>
        .ventana_menu {
            width: calc(100% - 40px);
            background-color: #fff;
            position: absolute;
            margin: auto;
            display: none;
            top: 10px;
            z-index: 3;
            height: calc(100% - 40px);

        }


        .btn_modal_video{
            width: 160px !important; transform: scale(0.7); position:absolute; right: 0; margin-top:-35px;
        }

    </style>
    <style>
    .toggle, .toggle:before, .slot__label {
        transition-property: background-color, transform, visibility;
        transition-duration: 0.25s;
        transition-timing-function: ease-in, cubic-bezier(0.6,0.2,0.4,1.5), linear;
    }
    .toggle:before, .slot, .slot__label {
        display: block;
    }
    .toggle:focus {
        outline: transparent;
    }
    .toggle {
        border-radius: 0.75em;
        box-shadow: 0 0 0 0.1em inset;
        cursor: pointer;
        position: relative;
        margin-right: 0.25em;
        width: 3em;
        height: 1.5em;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        -webkit-tap-highlight-color: transparent;
    }
    .toggle:before {
        background: currentColor;
        border-radius: 50%;
        content: "";
        top: 0.2em;
        left: 0.2em;
        width: 1.6em;
        height: 1.45em;
    }
    .toggle:checked:before {
        transform: translateX(1.5em);
    }
    .toggle:checked ~ .slot .slot__label, .slot__label:nth-child(2) {
        transform: translateY(-50%) scaleY(0);
    }
    .toggle:checked ~ .slot .slot__label:nth-child(2) {
        transform: translateY(-100%) scaleY(1);
    }
    .slot {
        color: transparent;
        font-size: 1.5em;
        font-weight: bold;
        letter-spacing: 0.1em;
        line-height: 1;
        overflow: hidden;
        height: 1em;
        text-indent: -0.9em;
    }
    .slot__label {
        transform-origin: 50% 0;
        color: #788BAC;
        font-family: "Roboto", sans-serif;
    }
    .slot__label:nth-child(2) {
        transform-origin: 50% 100%;
    }
    </style>



    <div class="modal fade" id="modal_guia_general" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="margin-top:150px;">
        <div class="modal-content" style="background-color: #1C274A; position:relative; min-width: 600px; width: 90% !important; border:1px solid rgba(255, 255, 255, 0.3);">
            <div class="text-right p-3" data-dismiss="modal" style="font-size: 20px; color:#fff; cursor: pointer;"><i class="fas fa-times"></i></div>
            <div class="modal-body">
                <video src="{{ asset('img/videos_guia/guia_general.mp4') }}"  controls style="width:100%;"></video>
            </div>
        </div>
      </div>
    </div>


    {{-- {{ Breadcrumbs::render('admin.iso27001.index') }} --}}
    <div style="display:flex; justify-content:space-between;">
        <h5 class="titulo_general_funcion">Sistema de Gestión</h5>
        @can('control_versiones_iso')
            <div class="d-flex">
                <input id="toggle" class="toggle" type="checkbox" role="switch" name="toggle" value="true" @if($version_iso === true) checked @endif style="align-content: center">
                <label for="toggle" class="slot">
                    <span class="slot__label">&nbsp;&nbsp;&nbsp;&nbsp;Norma ISO 27001:2022</span>
                    <span class="slot__label">&nbsp;&nbsp;&nbsp;&nbsp;Norma ISO 27001:2013</span>
                </label>
            </div>
        @endcan
        <div class="d-flex">
            <a href="#" class="btn btn-secundario" style="width: 160px !important;" data-toggle="modal" data-target="#modal_guia_general">
                <i class="far fa-play-circle mr-2"></i>
                GUÍA GENERAL
            </a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="{{ route('admin.dashboard_auditorias') }}" class="btn btn-success">
                <i class="fas fa-chart-pie mr-2"></i>
                DASHBOARD
            </a>
        </div>
    </div>
    <div class="mt-5 card">
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="tabsIso27001" role="tablist">
                    <a class="nav-link active" id="nav-contexto-tab" data-type="contexto" data-toggle="tab"
                        href="#nav-contexto" role="tab" aria-controls="nav-contexto" aria-selected="true">
                        <i class="bi bi-body-text"></i>
                        Contexto
                    </a>
                    <a class="nav-link" id="nav-liderazgo-tab" data-type="liderazgo" data-toggle="tab"
                        href="#nav-liderazgo" role="tab" aria-controls="nav-liderazgo" aria-selected="false">
                        <i class="bi bi-brightness-high"></i>
                        Liderazgo
                    </a>
                    <a class="nav-link" id="nav-planificacion-tab" data-type="planificacion" data-toggle="tab"
                        href="#nav-planificacion" role="tab" aria-controls="nav-planificacion" aria-selected="false">
                        <i class="bi bi-archive"></i>
                        Planificación
                    </a>
                    <a class="nav-link" id="nav-soporte-tab" data-type="soporte" data-toggle="tab" href="#nav-soporte"
                        role="tab" aria-controls="nav-soporte" aria-selected="false">
                        <i class="bi bi-headset"></i>
                        Soporte
                    </a>
                    <a class="nav-link" id="nav-operacion-tab" data-type="operacion" data-toggle="tab"
                        href="#nav-operacion" role="tab" aria-controls="nav-operacion" aria-selected="false">
                        <i class="bi bi-briefcase"></i>
                        Operación
                    </a>
                    <a class="nav-link" id="nav-evaluacion-tab" data-type="evaluacion" data-toggle="tab"
                        href="#nav-evaluacion" role="tab" aria-controls="nav-evaluacion" aria-selected="false">
                        <i class="bi bi-clipboard-check"></i>
                        Evaluación
                    </a>
                    <a class="nav-link" id="nav-mejora-tab" data-type="mejora" data-toggle="tab" href="#nav-mejora"
                        role="tab" aria-controls="nav-mejora" aria-selected="false">
                        <i class="bi bi-award"></i>
                        Mejora
                    </a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane mb-4 fade show active" id="nav-contexto" role="tabpanel"
                    aria-labelledby="nav-contexto-tab">
                    @include('admin.iso27001.components.contexto')
                </div>
                <div class="tab-pane mb-4 fade" id="nav-liderazgo" role="tabpanel" aria-labelledby="nav-liderazgo-tab">
                    @include('admin.iso27001.components.liderazgo')
                </div>
                <div class="tab-pane mb-4 fade" id="nav-planificacion" role="tabpanel"
                    aria-labelledby="nav-planificacion-tab">
                    @include('admin.iso27001.components.planificacion')
                </div>
                <div class="tab-pane mb-4 fade" id="nav-soporte" role="tabpanel" aria-labelledby="nav-soporte-tab">
                    @include('admin.iso27001.components.soporte')
                </div>
                <div class="tab-pane mb-4 fade" id="nav-operacion" role="tabpanel" aria-labelledby="nav-operacion-tab">
                    @include('admin.iso27001.components.operacion')
                </div>
                <div class="tab-pane mb-4 fade" id="nav-evaluacion" role="tabpanel" aria-labelledby="nav-evaluacion-tab">
                    @include('admin.iso27001.components.evaluacion')
                </div>
                <div class="tab-pane mb-4 fade" id="nav-mejora" role="tabpanel" aria-labelledby="nav-mejora-tab">
                    @include('admin.iso27001.components.mejora')
                </div>
            </div>
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
        version.value = version.checked ? 'true': 'false';
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
