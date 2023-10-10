@can('contexto_access')
    <div href="#" class="btn btn-secundario btn_modal_video" data-toggle="modal" data-target="#modal_guia_general"><i class="far fa-play-circle mr-2"></i> GUÍA DE USO</div>
    <ul class="mt-4">
        <li><a href="{{ url('/admin/analisisdebrechas') }}">
                <div>
                    <i class="fas fa-search"></i>
                    Análisis de brechas
                </div>
            </a></li>
        <li><a href="{{ url('iso9001/planTrabajobase') }}">
                <div>
                    <i class="fas fa-stream"></i>
                    Plan de implementación
                </div>
            </a></li>
        <li><a href="{{ route('admin.partes-interesadas.index') }}">
                <div>
                    <i class="far fa-handshake"></i>
                    Partes interesadas
                </div>
            </a></li>
        <li><a href="{{ route('admin.matriz-requisito-legales.index') }}">
                <div>
                    <i class="fas fa-balance-scale"></i>
                    Matriz de requisitos legales y regulatorios
                </div>
            </a></li>
        <li><a href="{{ route('admin.entendimiento-organizacions.index') }}">
                <div>
                    <i class="far fa-list-alt"></i>
                    Análisis FODA
                </div>
            </a></li>
        <li><a href="{{ route('admin.alcance-sgsis.index') }}">
                <div>
                    <i class="fas fa-bullseye"></i>
                    Determinación de alcance
                </div>
            </a></li>
        {{-- <li><a href="{{ route('admin.reportes-contexto.index') }}">
                <div>
                    <i class="far fa-file-alt"></i>
                    Generar reporte
                </div>
            </a></li> --}}
    </ul>
@else
    <div class="row" style="margin-left: -10px">
        <div class="mb-3 col-12">
            <img src="{{ asset('img/not_access.svg') }}" width="400px" style="margin-left: calc(50% - 200px);" />
        </div>
        <div class="col-12">
            <strong style="font-size:12pt">
                <i class="mr-1 fas fa-info-circle"></i>
                No puedes acceder al módulo de Análisis de Brechas, solicita al administrador que te
                otorge dichos permisos
            </strong>
        </div>
    </div>
@endcan
