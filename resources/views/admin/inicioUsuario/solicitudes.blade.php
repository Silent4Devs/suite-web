<style type="text/css">
    .caja_btn_reporte {
        width: 100%;
        display: inline-block;
        align-items: initial;
        text-align: center;
    }

    .btn_reporte {
        width: 120px;
        height: 130px;
        overflow: hidden;
        text-decoration: none;
        display: inline-block;
        color: #345183;
        padding: 5px;
        border: 1px solid #D9D9D9 !important;
        background-color: #EEEEEE;
        margin: 5px;
        padding-top: 12px;
        border-radius: 6px;
        transition: 0.2s;
        /*box-shadow: 0px 2px 3px 1px rgba(0, 0, 0, 0.2);*/
    }

    .btn_reporte:hover {
        border: 1px solid #345183 !important;
        color: #345183;
        background-color: rgba(0, 0, 0, 0);
    }

    .btn_reporte i {
        font-size: 30pt;
        transition: 0.05s;
    }

    .btn_reporte:hover i {
        transform: scale(1.1);
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


<div class="card-body datatable-fix w-100">
    <div class="px-1 py-2 mb-4 rounded " style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
        <div class="row w-100">
            <div class="text-center col-1 align-items-center d-flex justify-content-center">
                <div class="w-100">
                    <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                </div>
            </div>
            <div class="col-11">
                <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                <p class="m-0" style="font-size: 14px; color:#1E3A8A ">En esta sección podrá hacer la solicitud de
                    Vacaciones, Day Off, Permisos y Mensajería.
                </p>

            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-12 col-lg-12">

            <div class="mb-3 ml-2 mr-2 card card-body">
                <div class="mt-4 mb-3 ml-4 col-10" style="">
                    <h6 class="" style="color: #747474; font-size: 18px;">Deseo realizar una solicitud de:</h6>
                </div>
                {{--  --}}
                <div class="caja_btn_reporte"
                    style="display: flex !important; align-items: center !important; text-align: center !important; justify-content: center !important;">
                    @can('mi_perfil_modulo_solicitud_ausencia')
                        <a href="{{ asset('admin/solicitud-vacaciones') }}" class="btn_reporte">
                            <i class="bi bi-sun"></i><span>Vacaciones</span>
                        </a>
                    @endcan
                    @can('mi_perfil_modulo_solicitud_ausencia')
                        <a href="{{ asset('admin/solicitud-dayoff') }}" class="btn_reporte">
                            <i class="bi bi-bicycle"></i><br><span>Day Off´s</span>
                        </a>
                    @endcan
                    @can('mi_perfil_modulo_solicitud_ausencia')
                        <a href="{{ asset('admin/solicitud-permiso-goce-sueldo') }}" class="btn_reporte">
                            <i class="bi bi-coin"></i><br><span>Permisos</span>
                        </a>
                    @endcan
                    @can('solicitud_mensajeria_acceder')
                        <a href="{{ asset('admin/envio-documentos') }}" class="btn_reporte">
                          <i class="bi bi-send"></i></><br><span>Mensajería</span>
                        </a>
                    @endcan
                    @php
                        if ($solicitudes_pendientes == 0) {
                            $mostrar_solicitudes = false;
                        } else {
                            $mostrar_solicitudes = true;
                        }
                    @endphp
                    @can('modulo_aprobacion_ausencia')
                        <div x-data="{ open: @js($mostrar_solicitudes) }">
                            <a href="{{ asset('admin/solicitud-vacaciones/menu') }}" class="btn_reporte"
                                style="position: relative; overflow: inherit !important">
                                <i class="bi bi-check-circle"></i><br>
                                Aprobaciones
                                <div id="circulo" style="display:inline-block;position:absolute; top:-60px; right:-13px;"
                                    class="offset-1 mt-5" x-show="open">
                                    <p> {{ $solicitudes_pendientes }}</p>
                                </div>
                            </a>
                        @endcan

                    </div>
                </div>
            </div>
        </div>
