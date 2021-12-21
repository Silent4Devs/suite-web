@can('evaluacion_access')
    <ul>
        <li><a href="{{ route('admin.indicadores-sgsis.index') }}">
                <div>
                    <i class="fas fa-list-ul"></i>
                    Indicadores SGSI
                </div>
            </a></li>
        <li><a href="{{ route('admin.desk.index') }}">
                <div>
                    <i class="fas fa-lock"></i>
                    Incidentes de Seguridad
                </div>
            </a></li>
        {{-- <li><a href="{{ route('admin.indicadorincidentessis.index') }}">
                <div>
                    <i class="fas fa-file-contract"></i>
                    Indicador Incidentes
                </div>
            </a></li> --}}
        <li><a href="{{ route('admin.auditoria-anuals.index') }}">
                <div>
                    <i class="far fa-calendar-alt"></i>
                    Programa Anual de Auditoria
                </div>
            </a></li>
        <li><a href="{{ route('admin.plan-auditoria.index') }}">
                <div>
                    <i class="fas fa-clipboard-list"></i>
                    Plan de Auditoria
                </div>
            </a></li>
        <li><a href="{{ route('admin.auditoria-internas.index') }}">
                <div>
                    <i class="fas fa-network-wired"></i>
                    Auditoria Interna
                </div>
            </a></li>
        <li><a href="{{ route('admin.revision-direccions.index') }}">
                <div>
                    <i class="fas fa-tasks"></i>
                    Revisión por dirección
                </div>
            </a></li>
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
