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
                <p class="m-0" style="font-size: 14px; color:#1E3A8A ">En esta sección podrá reportar cualquier
                    situación que afecte el logro de los
                    objetivos de la organización, el incumplimiento con las políticas internas, el código de ética y
                    conducta o los valores establecidos en la Organización.
                </p>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-5 col-lg-5">
            <div class="mb-3 ml-2 mr-2 card card-body">
                <div class="mt-4 mb-3 ml-4 col-9" style="">
                    <h6 class="" style="color: #747474; font-size: 18px;">Deseo reportar un:</h6>
                </div>
                {{-- <div class="col-4 justify-content-end pr-0" style="text-align:end"> --}}

                {{-- </div> --}}
                <div class="caja_btn_reporte">
                    @can('mi_perfil_mis_reportes_realizar_reporte_de_incidente_de_seguridad')
                        <a href="{{ asset('admin/inicioUsuario/reportes/seguridad') }}" class="btn_reporte smargin">
                            <i class="bi bi-exclamation-octagon"></i><br /> <span>Incidente de Seguridad</span>
                        </a>
                    @endcan
                    @can('mi_perfil_mis_reportes_realizar_reporte_de_riesgo_identificado')
                        <a href="{{ asset('admin/inicioUsuario/reportes/riesgos') }}" class="btn_reporte smargin">
                            <i class="bi bi-shield-exclamation"></i> <br /><span>Riesgo Identificado</span>
                        </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="col-sm-7 col-lg-7">

            <div class="mb-3 ml-2 mr-2 card card-body">
                <div class="mt-4 mb-3 ml-4 col-10" style="">
                    <h6 class="" style="color: #747474; font-size: 18px;">Deseo realizar una:</h6>
                </div>
                {{--  --}}
                <div class="caja_btn_reporte">
                    @can('mi_perfil_mis_reportes_realizar_reporte_de_queja')
                        <a href="{{ asset('admin/inicioUsuario/reportes/quejas') }}" class="btn_reporte">
                            <i class="bi bi-emoji-frown"></i> <br /><span> Queja</span>
                        </a>
                    @endcan
                    @can('mi_perfil_mis_reportes_realizar_reporte_de_denuncia')
                        <a href="{{ asset('admin/inicioUsuario/reportes/denuncias') }}" class="btn_reporte">
                            <i class="bi bi-flag"></i> <br /><span> Denuncia</span>
                        </a>
                    @endcan
                    @can('mi_perfil_mis_reportes_realizar_reporte_de_propuesta_de_mejora')
                        <a href="{{ asset('admin/inicioUsuario/reportes/mejoras') }}" class="btn_reporte">
                            <i class="bi bi-award"></i><br /><span> Propuesta de Mejora</span>
                        </a>
                    @endcan
                    @can('mi_perfil_mis_reportes_realizar_reporte_de_sugerencia')
                        <a href="{{ asset('admin/inicioUsuario/reportes/sugerencias') }}" class="btn_reporte">
                            <i class="bi bi-lightbulb"></i> <br /><span> Sugerencia</span>
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 px-4">
            <div class="card p-3">
                <h4>Seguimiento de mis Reportes</h4>
                <table class="table w-100" id="tblReportes">
                    <thead>
                        <tr>
                            <th>Tipo De Reporte</th>
                            <th>Folio</th>
                            <th>Fecha de Recepción</th>
                            <th>Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mis_quejas as $queja)
                            <tr>
                                <td>Queja</td>
                                <td>{{ $queja->folio }}</td>
                                <td>{{ $queja->fecha }}</td>
                                <td>{{ $queja->estatus }}</td>
                            </tr>
                        @endforeach
                        @foreach ($mis_denuncias as $denuncia)
                            <tr>
                                <td>Denuncia</td>
                                <td>{{ $denuncia->folio }}</td>
                                <td>{{ $denuncia->fecha }}</td>
                                <td>{{ $denuncia->estatus }}</td>
                            </tr>
                        @endforeach
                        @foreach ($mis_propuestas as $propuesta)
                            <tr>
                                <td>Propuesta</td>
                                <td>{{ $propuesta->folio }}</td>
                                <td>{{ $propuesta->fecha??'- -' }}</td>
                                <td>{{ $propuesta->estatus }}</td>
                            </tr>
                        @endforeach
                        @foreach ($mis_sugerencias as $sugerencia)
                            <tr>
                                <td>Sugerencia</td>
                                <td>{{ $sugerencia->folio }}</td>
                                <td>{{ $sugerencia->fecha??'- -' }}</td>
                                <td>{{ $sugerencia->estatus }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
