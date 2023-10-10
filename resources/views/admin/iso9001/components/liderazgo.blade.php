@can('liderazgo_access')
    <div href="#" class="btn btn-secundario btn_modal_video" data-toggle="modal" data-target="#modal_guia_general"><i class="far fa-play-circle mr-2"></i> GUÍA DE USO</div>
    <ul class="mt-4">
        <li><a href="{{ route('admin.comiteseguridads.index') }}">
                <div>
                    <i class="fas fa-shield-alt"></i>
                    Conformación del comité de seguridad
                </div>
            </a></li>
        <li><a href="{{ route('admin.minutasaltadireccions.index') }}">
                <div>
                    <i class="fas fa-columns"></i>
                    Minutas de sesiones con alta dirección
                </div>
            </a></li>
        <li><a href="{{ route('admin.evidencias-sgsis.index') }}">
                <div>
                    <i class="far fa-window-restore"></i>
                    Evidencias de asignación de recursos al SGSI
                </div>
            </a></li>
        <li><a href="{{ route('admin.politica-sgsis.index') }}">
                <div>
                    <i class="fas fa-landmark"></i>
                    Política del Sistema de Gestión
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
                No puedes acceder al módulo de Liderazgo, solicita al administrador que te
                otorge dichos permisos
            </strong>
        </div>
    </div>
@endcan
