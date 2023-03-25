@can('sistema_de_gestion_soporte_acceder')
    <div href="#" class="btn btn-secundario btn_modal_video" data-toggle="modal" data-target="#modal_guia_general"><i class="far fa-play-circle mr-2"></i> GUÍA DE USO</div>
    <ul class="mt-4">
        <li><a href="#" data-ventana="capacitacion" data-ruta="Capacitaciones" class="btn_ventana_menu">
                <div>
                    <i class="bi bi-person-video3"></i> <br>
                    Transferencia de Conocimiento
                </div>
            </a></li>
        <div class="ventana_menu" id="capacitacion" style="color:#345183 !important">
            <i class="fas fa-arrow-circle-left iconos_menu text-align:left btn_cerrar_ventana" data-ventana="capacitacion"
                style="font-size:20pt; position: absolute; left:60px; cursor:pointer"></i>
            <h3 class="text-center"><strong>Conocimientos</strong></h3>
            <ul>
                <li><a href="{{ asset('admin/categoria-capacitacion') }}">
                        <div>
                            <i class="fas fa-layer-group"></i>
                            Crear Categorías
                        </div>
                    </a></li>
                <li><a href="{{ route('admin.recursos.index') }}">
                        <div>
                            <i class="fas fa-graduation-cap"></i>
                            Crear Conocimientos
                        </div>
                    </a></li>
            </ul>
        </div>
        <li><a href="{{ route('admin.buscarCV') }}">
                <div>
                    <i class="bi bi-capslock"></i> <br>
                    Competencias
                </div>
            </a></li>
        @can('concientizacion_sgsi_acceder')
        <li><a href="{{ route('admin.concientizacion-sgis.index') }}">
                <div>
                    <i class="bi bi-window-desktop"></i> <br>
                    Concientización SGI
                </div>
            </a></li>
        @endcan
        @can('material_sgsi_acceder')
        <li><a href="{{ route('admin.material-sgsis.index') }}">
                <div>
                    <i class="bi bi-boxes"></i> <br>
                    Material SGSI
                </div>
            </a>
        </li>
        @endcan
        {{-- <li><a href="{{ route('admin.material-iso-veinticientes.index') }}">
                <div>
                    <i class="far fa-object-ungroup"></i>
                    Material ISO 27001: 2013
                </div>
            </a></li> --}}
        @can('comunicados_generales_acceder')
        <li><a href="{{ route('admin.comunicacion-sgis.index') }}">
                <div>
                    <i class="bi bi-chat-right-text"></i> <br>
                    Comunicados Generales
                </div>
            </a>
        </li>
        @endcan
        @can('control_de_accesos_acceder')
        <li><a href="{{ route('admin.control-accesos.index') }}">
                <div>
                    <i class="bi bi-person-badge"></i> <br>
                    Control de Accesos
                </div>
            </a>
        </li>
        @endcan
        @can('informacion_documentada_acceder')
        <li><a href="{{ asset('admin/documentos/publicados') }}">
                <div>
                    <i class="bi bi-file-earmark-post"></i> <br>
                    Infomación Documentada
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
                No puedes acceder al módulo de Soporte, solicita al administrador que te
                otorge dichos permisos
            </strong>
        </div>
    </div>
@endcan
