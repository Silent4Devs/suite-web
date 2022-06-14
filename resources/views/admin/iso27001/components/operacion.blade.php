@can('sistema_de_gestion_operacion_acceder')
    <div href="#" class="btn btn-secundario btn_modal_video" data-toggle="modal" data-target="#modal_guia_general"><i class="far fa-play-circle mr-2"></i> GUÍA DE USO</div>
    @can('planificacion_y_control_acceder')
    <ul class="mt-4">
        <li><a href="{{ route('admin.planificacion-controls.index') }}">
                <div>
                    <i class="bi bi-list-stars"></i> <br>
                    Planificación y Control
                </div>
            </a></li>
    @endcan


        <li>
            @can('tratamiento_de_los_riesgos_acceder')
            <a href="{{ route('admin.tratamiento-riesgos.index') }}">
                <div>
                    <i class="bi bi-exclamation-square"></i> <br>
                    Tratamiento de riesgos
                </div>
            </a>
            @endcan
        </li>

    </ul>

    @else
    <div class="mt-5 row" style="margin-left: -10px">
        <div class="mb-3 col-12">
            <img src="{{ asset('img/not_access.svg') }}" width="400px" style="margin-left: calc(50% - 200px);" />
        </div>
        <div class="col-12">
            <strong style="font-size:12pt">
                <i class="mr-1 fas fa-info-circle"></i>
                No puedes acceder al módulo de Soporte, solicita al administrador que te
                otorge dichos permisos
            </strong>
        </div>
    </div>

@endcan
