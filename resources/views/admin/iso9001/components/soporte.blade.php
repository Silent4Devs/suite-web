@can('soporte_access')
    <div href="#" class="btn btn-secundario btn_modal_video" data-toggle="modal" data-target="#modal_guia_general"><i class="far fa-play-circle mr-2"></i> GUÍA DE USO</div>
    <ul class="mt-4">
        <li><a href="#" data-ventana="capacitacion" data-ruta="Capacitaciones" class="btn_ventana_menu">
                <div>
                    <i class="fas fa-chalkboard-teacher"></i>
                    Transferencia de Conocimiento
                </div>
            </a></li>
        <div class="ventana_menu" id="capacitacion" style="color:#008186 !important">
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
                    <i class="fas fa-flag-checkered"></i>
                    Competencias
                </div>
            </a></li>
        <li><a href="{{ route('admin.concientizacion-sgis.index') }}">
                <div>
                    <i class="fas fa-book-reader"></i>
                    Concientización SGI
                </div>
            </a></li>
        <li><a href="{{ route('admin.material-sgsis.index') }}">
                <div>
                    <i class="fas fa-cubes"></i>
                    Material SGSI
                </div>
            </a></li>
        {{-- <li><a href="{{ route('admin.material-iso-veinticientes.index') }}">
                <div>
                    <i class="far fa-object-ungroup"></i>
                    Material ISO 27001: 2013
                </div>
            </a></li> --}}
        <li><a href="{{ route('admin.comunicacion-sgis.index') }}">
                <div>
                    <i class="far fa-comments"></i>
                    Comunicados Generales
                </div>
            </a></li>
        <li><a href="{{ route('admin.control-accesos.index') }}">
                <div>
                    <i class="fas fa-vote-yea"></i>
                    Control de Accesos
                </div>
            </a></li>
        <li><a href="{{ asset('admin/documentos/publicados') }}">
                <div>
                    <i class="far fa-folder-open"></i>
                    Infomación Documentada
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
                No puedes acceder al módulo de Soporte, solicita al administrador que te
                otorge dichos permisos
            </strong>
        </div>
    </div>
@endcan
