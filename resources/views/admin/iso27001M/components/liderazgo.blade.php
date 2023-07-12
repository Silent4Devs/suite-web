@can('sistema_de_gestion_liderazgo_acceder')
    <div href="#" class="btn btn-secundario btn_modal_video" data-toggle="modal" data-target="#modal_guia_general"><i
            class="far fa-play-circle mr-2"></i> GUÍA DE USO</div>
    <ul class="mt-4">
        @can('comformacion_comite_seguridad_acceder')
            <li><a href="{{ route('admin.comiteseguridads.index') }}">
                    <div>
                        <i class="bi bi-shield"></i> <br>
                        Conformación del comité
                    </div>
                </a></li>
        @endcan
        @can('revision_por_direccion_acceder')
            <li><a href="{{ route('admin.minutasaltadireccions.index') }}">
                    <div>
                        <i class="bi bi-file-earmark-text"></i> <br>
                        Revisión por dirección
                    </div>
                </a></li>
        @endcan
        @can('evidencia_asignacion_recursos_sgsi_acceder')
            <li><a href="{{ route('admin.evidencias-sgsis.index') }}">
                    <div>
                        <i class="bi bi-window-desktop"></i> <br>
                        Evidencias de asignación de recursos al SGSI
                    </div>
                </a></li>
        @endcan
        @can('politica_sistema_gestion_acceder')
            <li><a href="{{ route('admin.politica-sgsis.index') }}">
                    <div>
                        <i class="bi bi-bank"></i> <br>
                        Política del Sistema de Gestión
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
                No puedes acceder al módulo de Liderazgo, solicita al administrador que te
                otorge dichos permisos
            </strong>
        </div>
    </div>
@endcan
