<style type="text/css">
    .caja_btn_reporte{
        width: 100%;
        display: inline-block;
        align-items: initial;
        text-align: center;
    }
    .btn_reporte{
        width: 120px;
        height: 130px;
        overflow: hidden;
        text-decoration: none;
        display: inline-block;
        color: #fff;
        padding: 5px;
        border: 1px solid #ccc !important;
        background-color: #008186;
        margin: 5px;
        padding-top: 25px;
        border-radius: 6px;
        transition: 0.2s;
        box-shadow: 0px 2px 3px 1px rgba(0, 0, 0, 0.2);
    }
    .btn_reporte:hover{
        border: 1px solid #008186 !important;
        color: #008186;
        background-color: rgba(0, 0, 0, 0);
    }
    .btn_reporte i{
        font-size: 30pt;
        transition: 0.05s;
    }
    .btn_reporte:hover i{
        transform: scale(1.1);
    }
</style>


<div class="card-body datatable-fix w-100">
    <div class="px-1 py-2 mb-4 rounded " style="background-color: #DBEAFE; border-top:solid 3px #3B82F6;">
        <div class="row w-100">
            <div class="text-center col-1 align-items-center d-flex justify-content-center">
                <div class="w-100">
                    <i class="fas fa-info-circle" style="color: #3B82F6; font-size: 22px"></i>
                </div>
            </div>
            <div class="col-11">
                <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                <p class="m-0" style="font-size: 14px; color:#1E3A8A ">En esta sección podrá reportar cualquier situación que afecte el logro de los
                    objetivos de la organización, el incumplimiento con las políticas internas, el código de ética y conducta o los valores establecidos en la Organización.
                </p>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-5 col-lg-5">
            <div class="mb-3 ml-2 mr-2 bg-white rounded " style="border:1px solid #ccc !important;">
                <div class="mt-4 mb-3 ml-4 col-9" style="border-bottom: solid 2px #0CA193;">
                    <h6 class="mt-3 mr-1" style="color: #008186; font-weight: bold;">Deseo reportar un:</h6>
                </div>
                {{-- <div class="col-4 justify-content-end pr-0" style="text-align:end"> --}}

                {{-- </div> --}}
                <div class="caja_btn_reporte">
                        <a href="{{ asset('admin/inicioUsuario/reportes/seguridad') }}"  class="btn_reporte smargin">
                            <i class="fas fa-exclamation-triangle"></i><br/> <span>Incidente de Seguridad</span>
                        </a>
                        <a href="{{ asset('admin/inicioUsuario/reportes/riesgos') }}"  class="btn_reporte smargin">
                            <i class="fas fa-shield-alt"></i>  <br/><span>Riesgo Identificado</span>
                        </a>
                </div>
            </div>
        </div>
        <div class="col-sm-7 col-lg-7">

            <div class="mb-3 ml-2 mr-2 bg-white rounded" style="border:1px solid #ccc !important;">
                <div class="mt-4 mb-3 ml-4 col-10" style="border-bottom: solid 2px #0CA193;">
                    <h6 class="mt-3" style="color: #008186; font-weight: bold;">Deseo realizar una:</h6>
                </div>
                {{-- --}}
                <div class="caja_btn_reporte">
                    <a href="{{ asset('admin/inicioUsuario/reportes/quejas') }}" class="btn_reporte">
                        <i class="fas fa-frown"></i> <br/><span> Queja</span>
                    </a>

                    <a href="{{ asset('admin/inicioUsuario/reportes/denuncias') }}" class="btn_reporte">
                        <i class="fas fa-hand-paper"></i> <br/><span> Denuncia</span>
                    </a>
                    <a href="{{ asset('admin/inicioUsuario/reportes/mejoras') }}" class="btn_reporte">
                        <i class="fas fa-rocket"></i> <br/><span> Propuesta de Mejora</span>
                    </a>
                    <a href="{{ asset('admin/inicioUsuario/reportes/sugerencias') }}" class="btn_reporte">
                        <i class="fas fa-lightbulb"></i> <br/><span> Sugerencia</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
{{-- <div style="text-align: center;" class="mt-5">
    <a href="{{ asset('admin/inicioUsuario/reportes/seguridad') }}" class="cards_reportes">
        <i class="fas fa-exclamation-triangle"></i> Incidentes de seguridad
    </a>
    <a href="{{ asset('admin/inicioUsuario/reportes/riesgos') }}" class="cards_reportes">
        <i class="fas fa-shield-virus"></i> Riesgo Identificado
    </a>
    <a href="{{ asset('admin/inicioUsuario/reportes/quejas') }}" class="cards_reportes">
        <i class="fas fa-frown"></i> Realizar queja
    </a>
    <a href="{{ asset('admin/inicioUsuario/reportes/denuncias') }}" class="cards_reportes">
        <i class="fas fa-hand-paper"></i> Realizar denuncia
    </a>
    <a href="{{ asset('admin/inicioUsuario/reportes/mejoras') }}" class="cards_reportes">
        <i class="fas fa-rocket"></i> Reportar mejora
    </a>
    <a href="{{ asset('admin/inicioUsuario/reportes/sugerencias') }}" class="cards_reportes">
        <i class="fas fa-lightbulb"></i> Realizar sugerencia
    </a>
</div> --}}
