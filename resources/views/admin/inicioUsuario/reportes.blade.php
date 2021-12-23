<style type="text/css">
a.btn.btn-success{
    width: 60% !important;
    margin-bottom: 10px;
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
            <div class="mb-3 ml-2 mr-2 bg-white rounded " style="height:300px; border:1px solid #ccc !important">
                <div class="mt-4 mb-3 ml-4 col-9" style="border-bottom: solid 2px #0CA193;">
                    <h6 class="mt-3 mr-1" style="color: #008186; font-weight: bold;">Deseo reportar un:</h6>
                </div>
                {{-- <div class="col-4 justify-content-end pr-0" style="text-align:end"> --}}

                {{-- </div> --}}
                <div class="mt-4  row justify-content:center align-items-center">
                    <div class="text-center col-12">
                        <a href="{{ asset('admin/inicioUsuario/reportes/seguridad') }}"  class="btn btn-success">
                            <i class="fas fa-exclamation-triangle"></i> Incidente de Seguridad
                        </a>
                    </div>
                    <div class="text-center col-12">
                        <a href="{{ asset('admin/inicioUsuario/reportes/riesgos') }}"  class="btn btn-success">
                            <i class="fas fa-shield-alt"></i>  Riesgo Identificado
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7 col-lg-7">

            <div class="mb-3 ml-2 mr-2 bg-white rounded" style="height:300px; border:1px solid #ccc !important">
                <div class="mt-4 mb-3 ml-4 col-10" style="border-bottom: solid 2px #0CA193;">
                    <h6 class="mt-3" style="color: #008186; font-weight: bold;">Deseo realizar una:</h6>
                </div>
                {{-- --}}
                <div class="mt-4 text-center">
                    <a href="{{ asset('admin/inicioUsuario/reportes/quejas') }}" class="btn btn-success">
                        <i class="fas fa-frown"></i> Queja
                    </a>

                    <a href="{{ asset('admin/inicioUsuario/reportes/denuncias') }}" class="btn btn-success">
                        <i class="fas fa-hand-paper"></i> Denuncia
                    </a>
                    <a href="{{ asset('admin/inicioUsuario/reportes/mejoras') }}" class="btn btn-success">
                        <i class="fas fa-rocket"></i> Propuesta de Mejora
                    </a>
                    <a href="{{ asset('admin/inicioUsuario/reportes/sugerencias') }}" class="btn btn-success">
                        <i class="fas fa-lightbulb"></i>Sugerencia
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
