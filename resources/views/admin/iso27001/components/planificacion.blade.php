@can('sistema_de_gestion_planificacion_acceder')
    <div href="#" class="btn btn-secundario btn_modal_video" data-toggle="modal" data-target="#modal_guia_general"><i
            class="far fa-play-circle mr-2"></i> GUÍA DE USO</div>
    <ul class="mt-4">
        @can('menu_analisis_riesgo_acceder')
            <li><a href="#" data-ventana="riesgos" data-ruta="Análisis de riesgos" class="btn_ventana_menu">
                    <div>
                        <i class="bi bi-exclamation-triangle"></i> <br>
                        Análisis de riesgos
                    </div>
                </a></li>
            <div class="ventana_menu" id="riesgos" style="color:#345183 !important">
                <i class="fas fa-arrow-circle-left iconos_menu text-align:left btn_cerrar_ventana" data-ventana="riesgos"
                    style="font-size:20pt; position: absolute; left:60px; cursor:pointer"></i>
                <h3 class="text-center"><strong>Análisis de riesgos</strong></h3>
                <ul>
                    @can('amenazas_acceder')
                        <li><a href="{{ route('admin.amenazas.index') }}">
                                <div>
                                    <i class="fas fa-fire"></i>
                                    Amenazas
                                </div>
                            </a></li>
                    @endcan
                    @can('vulnerabilidades_acceder')
                        <li><a href="{{ route('admin.vulnerabilidads.index') }}">
                                <div>
                                    <i class="fas fa-shield-alt"></i>
                                    Vulnerabilidades
                                </div>
                            </a></li>
                    @endcan
                    @can('matriz_de_riesgo_acceder')
                        <li><a href="{{ route('admin.analisis-riesgos.index') }}">
                                <div>
                                    <i class="fas fa-table"></i>
                                    Matriz de Riesgos
                                </div>
                            </a></li>
                    @endcan
                </ul>
            </div>
        @endcan
        @can('asignacion_de_controles_acceder')
        @if($version_iso === true)
        <li><a href="{{ route('admin.paneldeclaracion.index') . '#controles' }}">
                <div>
                    <i class="bi bi-file-earmark-zip"></i> <br>
                    Asignación de controles
                </div>
            </a></li>
        @else
        <li><a href="{{ route('admin.paneldeclaracion-2022.index') . '#controles' }}">
            <div>
                <i class="bi bi-file-earmark-zip"></i> <br>
                Asignación de controles
            </div>
        </a></li>
        @endif
        @endcan
        @can('declaracion_de_aplicabilidad_acceder')
        @if($version_iso === true)
        <li><a href="{{ route('admin.declaracion-aplicabilidad.index') . '#declaracion' }}">
                <div>
                    <i class="bi bi-file-diff"></i> <br>
                    Declaración de aplicabilidad
                </div>
            </a></li>
        @else
        <li><a href="{{ route('admin.declaracion-aplicabilidad-2022.index') . '#declaracion' }}">
            <div>
                <i class="bi bi-file-diff"></i> <br>
                Declaración de aplicabilidad
            </div>
        </a></li>
        @endif
        @endcan
        @can('declaracion_de_aplicabilidad_acceder')
        @if($version_iso === true)
            <li><a href="{{ route('admin.declaracion-aplicabilidad.tabla') . '#declaracion' }}">
                    <div>
                        <i class="bi bi-file-diff"></i> <br>
                        Declaración de aplicabilidad Tabla
                    </div>
                </a></li>
        @else
        <li><a href="{{ route('admin.declaracion-aplicabilidad-2022.tabla') . '#declaracion' }}">
            <div>
                <i class="bi bi-file-diff"></i> <br>
                Declaración de aplicabilidad Tabla
            </div>
        </a></li>
        @endif
        @endcan
        {{-- <li><a href="{{ route('admin.riesgosoportunidades.index') }}">
                <div>
                    <i class="fas fa-asterisk"></i>
                    Riesgos y oportunidades
                </div>
            </a></li> --}}
        @can('objetivos_del_sistema_acceder')
            <li>
                <a href="{{ route('admin.tipos-objetivos.index') }}">
                    <div>
                        <i class="bi bi-book"></i><br>
                        Tipos de Objetivos
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.objetivosseguridads.index') }}">
                    <div>
                        <i class="bi bi-shield-lock"></i> <br>
                        Objetivos
                    </div>
                </a>
            </li>
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
                No puedes acceder al módulo de Planificación, solicita al administrador que te
                otorge dichos permisos
            </strong>
        </div>
    </div>
@endcan
