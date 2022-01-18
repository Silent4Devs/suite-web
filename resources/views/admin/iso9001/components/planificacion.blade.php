@can('planificacion_access')
    <div href="#" class="btn btn-secundario btn_modal_video" data-toggle="modal" data-target="#modal_guia_general"><i class="far fa-play-circle mr-2"></i> GUÍA DE USO</div>
    <ul class="mt-4">
        <li><a href="#" data-ventana="riesgos" data-ruta="Análisis de riesgos" class="btn_ventana_menu">
                <div>
                    <i class="fas fa-exclamation-triangle"></i>
                    Análisis de riesgos
                </div>
            </a></li>
        <div class="ventana_menu" id="riesgos" style="color:#008186 !important">
            <i class="fas fa-arrow-circle-left iconos_menu text-align:left btn_cerrar_ventana" data-ventana="riesgos"
                style="font-size:20pt; position: absolute; left:60px; cursor:pointer"></i>
            <h3 class="text-center"><strong>Análisis de riesgos</strong></h3>
            <ul>
                <li><a href="{{ route('admin.amenazas.index') }}">
                        <div>
                            <i class="fas fa-fire"></i>
                            Amenazas
                        </div>
                    </a></li>
                <li><a href="{{ route('admin.vulnerabilidads.index') }}">
                        <div>
                            <i class="fas fa-shield-alt"></i>
                            Vulnerabilidades
                        </div>
                    </a></li>
                <li><a href="{{ route('admin.analisis-riesgos.index') }}">
                        <div>
                            <i class="fas fa-table"></i>
                            Matriz de Riesgos
                        </div>
                    </a></li>
            </ul>
        </div>
        <li><a href="{{ route('admin.paneldeclaracion.index') . '#controles' }}">
                <div>
                    <i class="fas fa-user-lock"></i>
                    Asignación de Controles
                </div>
            </a></li>
        <li><a href="{{ route('admin.declaracion-aplicabilidad.index') . '#declaracion' }}">
                <div>
                    <i class="far fa-file"></i>
                    Declaración de aplicabilidad
                </div>
            </a></li>
        {{-- <li><a href="{{ route('admin.riesgosoportunidades.index') }}">
                <div>
                    <i class="fas fa-asterisk"></i>
                    Riesgos y oportunidades
                </div>
            </a></li> --}}
        <li><a href="{{ route('admin.objetivosseguridads.index') }}">
                <div>
                    <i class="fas fa-lock"></i>
                    Objetivos de seguridad
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
                No puedes acceder al módulo de Planificación, solicita al administrador que te
                otorge dichos permisos
            </strong>
        </div>
    </div>
@endcan
