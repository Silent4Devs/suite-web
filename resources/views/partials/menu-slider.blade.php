<div class="menu-global-tbj">
    <div class="title-page-global item-menu-slider">
        <div class="caja-logo-ltr-light">
            <img src="{{ asset('img/logo-ltr-light.png') }}" alt="">
        </div>
    </div>
    <div class="menu-slider item-menu-slider">
        <div class="box-menu-slider">
            <button class="btn-menu-ar" onclick="menuSileder('retreat');">
                <i class="material-symbols-outlined">arrow_back_ios</i>
            </button>
            <div class="caja-items-menu-slider scroll_estilo">

                <div class="gruop-item-menu-slider group-menu-main">

                    {{-- @can('mi_organizacion_acceder')
                    <div class="item-ms">
                        <a href="{{ route('admin.organizacions.index') }}">
                            <i class="material-symbols-outlined">corporate_fare</i>
                            <span>Organización</span>
                        </a>
                    </div>
                @endcan
                @can('sedes_acceder')
                    <div class="item-ms">
                        <a href="{{ route('admin.sedes.obtenerListaSedes') }}">
                            <i class="material-symbols-outlined">home_pin</i>
                            <span>Sedes</span>
                        </a>
                    </div>
                @endcan
                @can('crear_area_acceder')
                    <div class="item-ms">
                        <a href="{{ route('admin.areas.renderJerarquia') }}">
                            <i class="material-symbols-outlined">mitre</i>
                            <span>Áreas</span>
                        </a>
                    </div>
                @endcan
                @can('portal_de_comunicaccion_acceder')
                    <div class="item-ms active">
                        <a href="{{ route('admin.portal-comunicacion.index') }}">
                            <i class="material-symbols-outlined">home</i>
                            <span>Inicio</span>
                        </a>
                    </div>
                @endcan
                @can('documentos_publicados_acceder')
                    <div class="item-ms">
                        <a href="{{ route('admin.documentos.publicados') }}">
                            <i class="material-symbols-outlined">description</i>
                            <span>Documentos Publicados</span>
                        </a>
                    </div>
                @endcan
                @can('politica_sistema_gestion_acceder')
                    <div class="item-ms">
                        <a href="{{ route('admin.politica-sgsis.visualizacion') }}">
                            <i class="material-symbols-outlined">local_library</i>
                            <span>Políticas</span>
                        </a>
                    </div>
                @endcan
                @can('comformacion_comite_seguridad_acceder')
                    <div class="item-ms">
                        <a href="{{ route('admin.comiteseguridads.index') }}">
                            <i class="material-symbols-outlined">partner_exchange</i>
                            <span>Comités</span>
                        </a>
                    </div>
                @endcan
                @can('portal_comunicacion_mostrar_mapa_de_procesos')
                    <div class="item-ms">
                        <a href="{{ route('admin.procesos.mapa') }}">
                            <i class="material-symbols-outlined">flowsheet</i>
                            <span>Mapa de procesos</span>
                        </a>
                    </div>
                @endcan
                @can('portal_comunicacion_mostrar_reportar')
                    <div class="item-ms">
                        <a href="{{ asset('admin/portal-comunicacion/reportes') }}">
                            <i class="material-symbols-outlined">flag</i>
                            <span>Reportar</span>
                        </a>
                    </div>
                @endcan
                @can('organigrama_acceder')
                    <div class="item-ms">
                        <a href="{{ route('admin.organigrama.index') }}">
                            <i class="material-symbols-outlined">schema</i>
                            <span>Organigrama</span>
                        </a>
                    </div>
                @endcan
                @can('analisis_foda_acceder')
                    <div class="item-ms">
                        <a href="{{ route('admin.foda-organizacions') }}">
                            <i class="material-symbols-outlined">border_all</i>
                            <span>FODA</span>
                        </a>
                    </div>
                @endcan
                @can('portal_comunicacion_mostrar_directorio')
                    <div class="item-ms">
                        <a href="{{ route('admin.directorio.index') }}">
                            <i class="material-symbols-outlined">person_book</i>
                            <span>Directorio</span>
                        </a>
                    </div>
                @endcan
                @can('determinacion_alcance_acceder')
                    <div class="item-ms">
                        <a href="{{ route('admin.alcance-sgsis/visualizacion') }}">
                            <i class="material-symbols-outlined">table_chart_view</i>
                            <span>Alcances</span>
                        </a>
                    </div>
                @endcan --}}

                    @can('control_documentar_acceder')
                        <div class="item-ms">
                            <a href="{{ route('admin.documentos.index') }}" title="Ver Documentos" data-toggle="tooltip"
                                data-placement="bottom">
                                <i class="material-symbols-outlined">description</i>
                                <span>Documentos</span>
                            </a>
                        </div>
                    @endcan
                    @can('escuela_estudiante')
                        <div class="item-ms">
                            <a href="{{ asset('/admin/mis-cursos') }}" title="Capacitaciones" data-toggle="tooltip"
                                data-placement="bottom">
                                <i class="material-symbols-outlined">school</i>
                                <span>Capacitaciones</span>
                            </a>
                        </div>
                    @endcan
                    @can('mi_perfil_acceder')
                        <div class="item-ms">
                            <a href="{{ route('admin.solicitud') }}" title="Solicitudes" data-toggle="tooltip"
                                data-placement="bottom">
                                <i class="material-symbols-outlined">assignment_turned_in</i>
                                <span>Solicitudes</span>
                            </a>
                        </div>
                    @endcan
                    @can('mi_perfil_acceder')
                        <div class="item-ms">
                            <a href="{{ route('admin.inicio-Usuario.index') }}" title="Ver Perfil" data-toggle="tooltip"
                                data-placement="bottom">
                                <i class="material-symbols-outlined">account_circle</i>
                                <span>Perfil</span>
                            </a>
                        </div>
                    @endcan
                    @can('timesheet_acceder')
                        <div class="item-ms">
                            <a href="{{ route('admin.timesheet-create') }}" title="Timesheet" data-toggle="tooltip"
                                data-placement="bottom">
                                <i class="material-symbols-outlined">date_range</i>
                                <span>Timesheet</span>
                            </a>
                        </div>
                    @endcan
                    @can('calendario_organizacional_acceder')
                        <div class="item-ms">
                            <a href="{{ route('admin.systemCalendar') }}" title="Ver Calendario" data-toggle="tooltip"
                                data-placement="bottom">
                                <i class="material-symbols-outlined">calendar_today</i>
                                <span>Calendario</span>
                            </a>
                        </div>
                    @endcan
                    @can('katbol_requisiciones_acceso')
                        <div class="item-ms">
                            <a href="{{ asset('contract_manager/requisiciones') }}" title="Ver Requisiciones"
                                data-toggle="tooltip" data-placement="bottom">
                                <i class="material-symbols-outlined">contract</i>
                                <span>Requisiciones</span>
                            </a>
                        </div>
                    @endcan
                </div>

                <div class="gruop-item-menu-slider group-menu-centro-atencion" role="tablist">

                    @can('centro_atencion_incidentes_de_seguridad_acceder')
                        <div class="item-ms nav-item" role="presentation" role="presentation">
                            <a class="nav-link" title="Incidentes de seguridad" data-toggle="tooltip"
                                data-placement="bottom" id="incidentes-tab" data-bs-toggle="tab" href="#incidentes"
                                role="tab" aria-controls="incidentes" aria-selected="true">
                                <i class="fas fa-exclamation-triangle"></i>
                                <span>Incidentes de seguridad</span>
                            </a>
                        </div>
                    @endcan
                    @can('centro_atencion_riesgos_acceder')
                        <div class="item-ms nav-item" role="presentation">
                            <a class="nav-link" title="Riesgos" data-toggle="tooltip" data-placement="bottom"
                                id="riesgos-tab" data-bs-toggle="tab" href="#riesgos" role="tab" aria-controls="riesgos"
                                aria-selected="false">
                                <i class="fas fa-shield-alt"></i>
                                <span>Riesgos</span>
                            </a>
                        </div>
                    @endcan
                    @can('centro_atencion_quejas_acceder')
                        <div class="item-ms nav-item" role="presentation">
                            <a class="nav-link" title=" Quejas" data-toggle="tooltip" data-placement="bottom"
                                id="quejas-tab" data-bs-toggle="tab" href="#quejas" role="tab" aria-controls="quejas"
                                aria-selected="false">
                                <i class="fas fa-frown"></i>
                                <span> Quejas</span>
                            </a>
                        </div>
                    @endcan
                    @can('centro_atencion_quejas_clientes_acceder')
                        <div class="item-ms nav-item" role="presentation">
                            <a class="nav-link" title=" Quejas Clientes" data-toggle="tooltip" data-placement="bottom"
                                id="quejasClientes-tab" data-bs-toggle="tab" href="#quejasClientes" role="tab"
                                aria-controls="quejasClientes" aria-selected="false">
                                <i class="fas fa-thumbs-down"></i>
                                <span> Quejas Clientes</span>
                            </a>
                        </div>
                    @endcan
                    @can('centro_atencion_denuncias_acceder')
                        <div class="item-ms nav-item" role="presentation">
                            <a class="nav-link" title=" Denuncias" data-toggle="tooltip" data-placement="bottom"
                                id="denuncias-tab" data-bs-toggle="tab" href="#denuncias" role="tab"
                                aria-controls="denuncias" aria-selected="false">
                                <i class="fas fa-hand-paper"></i>
                                <span> Denuncias</span>
                            </a>
                        </div>
                    @endcan
                    @can('centro_atencion_mejoras_acceder')
                        <div class="item-ms nav-item" role="presentation">
                            <a class="nav-link" title=" Mejoras" data-toggle="tooltip" data-placement="bottom"
                                id="mejoras-tab" data-bs-toggle="tab" href="#mejoras" role="tab"
                                aria-controls="mejoras" aria-selected="false">
                                <i class="fas fa-rocket"></i>
                                <span> Mejoras</span>
                            </a>
                        </div>
                    @endcan
                    @can('centro_atencion_sugerencias_acceder')
                        <div class="item-ms nav-item" role="presentation">
                            <a class="nav-link" title="Sugerencias" data-toggle="tooltip" data-placement="bottom"
                                id="sugerencias-tab" data-bs-toggle="tab" href="#sugerencias" role="tab"
                                aria-controls="sugerencias" aria-selected="false">
                                <i class="fas fa-lightbulb"></i>
                                <span> Sugerencias</span>
                            </a>
                        </div>
                    @endcan

                </div>
            </div>
            <button class="btn-menu-ar" onclick="menuSileder('advance');">
                <i class="material-symbols-outlined">arrow_forward_ios</i>
            </button>
        </div>
    </div>
    <div class="options-global item-menu-slider">
        <button class="btn-menu-global-show" onclick="menuView();">
            <i class="material-symbols-outlined">keyboard_arrow_up</i>
        </button>
    </div>
</div>
<script>
    function menuSileder(tipo) {
        if (tipo == 'advance') {
            document.querySelector('.menu-slider .caja-items-menu-slider').scrollLeft += 100;
        }
        if (tipo == 'retreat') {
            document.querySelector('.menu-slider .caja-items-menu-slider').scrollLeft -= 100;
        }
    }

    function menuView() {
        document.querySelector('body').classList.toggle('menu-global-hidden');
        if (document.querySelector('body.menu-global-hidden')) {
            localStorage.setItem('menuView', 'menu-global-hidden');
        } else {
            localStorage.setItem('menuView', '');
        }
    }
    document.querySelector('body').classList.add(localStorage.getItem('menuView') || '');
</script>
