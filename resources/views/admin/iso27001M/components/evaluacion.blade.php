@can('sistema_de_gestion_evaluacion_acceder')

    <div href="#" class="btn btn-secundario btn_modal_video" data-toggle="modal" data-target="#modal_guia_general"><i
            class="far fa-play-circle mr-2"></i> GUÍA DE USO</div>
    <ul class="mt-4">
        @can('indicadores_sgsi_acceder')
            <li><a href="{{ route('admin.indicadores-sgsis.index') }}">
                    <div>
                        <i class="bi bi-window-desktop"></i> <br>
                        Indicadores del Sistema de Gestión
                    </div>
                </a>
            </li>
        @endcan
        @can('centro_atencion_incidentes_de_seguridad_acceder')
            <li><a href="{{ route('admin.desk.index') }}">
                    <div>
                        <i class="bi bi-cone-striped"></i> <br>
                        Incidentes de Seguridad
                    </div>
                </a>
            </li>
        @endcan
        {{-- <li><a href="{{ route('admin.indicadorincidentessis.index') }}">
                <div>
                    <i class="fas fa-file-contract"></i>
                    Indicador Incidentes
                </div>
            </a></li> --}}
        @can('programa_anual_auditoria_acceder')
            <li><a href="{{ route('admin.auditoria-anuals.index') }}">
                    <div>
                        <i class="bi bi-calendar4-range"></i> <br>
                        Programa Anual de Auditoria
                    </div>
                </a>
            </li>
        @endcan

        @can('plan_de_auditoria_acceder')
            <li><a href="{{ route('admin.plan-auditoria.index') }}">
                    <div>
                        <i class="bi bi-clipboard-data"></i> <br>
                        Plan de Auditoria
                    </div>
                </a>
            </li>
        @endcan
        @can('auditoria_interna_acceder')
            <li><a href="{{ route('admin.auditoria-internas.index') }}">
                    <div>
                        <i class="bi bi-diagram-2"></i> <br>
                        Informe de Auditoría
                    </div>
                </a>
            </li>
        @endcan
        @can('revision_por_direccion_acceder')
            <li><a href="{{ route('admin.minutasaltadireccions.index') }}">
                    <div>
                        <i class="bi bi-file-earmark-text"></i> <br>
                        Revisión por dirección
                    </div>
                </a></li>
        @endcan
    </ul>
@else
    <div class="mt-5 row" style="margin-left: -10px">
        <div class="mb-3 col-12">
            <img src="{{ asset('img/not_access.svg') }}" width="400px" style="margin-left: calc(50% - 200px);" />
        </div>
        <div class="col-12">
            <strong style="font-size:12pt">
                <i class="mr-1 fas fa-info-circle"></i>
                No puedes acceder al módulo de Evaluación, solicita al administrador que te
                otorge dichos permisos
            </strong>
        </div>
    </div>

@endcan
