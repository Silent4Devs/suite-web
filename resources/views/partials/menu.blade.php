<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show c-sidebar-light">

<div class="c-sidebar-brand d-md-down-none bg-transparent">

    <div class="text-center">
            <a href="{{url('/')}}" class="pl-0"><img src="{{ asset('img/Silent4Business-Logo-Color.png') }}"
                                                     style="width: 40%;"></a>
        </div>

    </div>

    <ul class="c-sidebar-nav">

    <li class="c-sidebar-nav-title">Menu</li>
        @can('organizacion_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.organizacions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/organizacions") || request()->is("admin/organizacions/*") ? "active" : "" }}">
                    <i class="fa-fw fas fa-home c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.organizacion.title') }}
                </a>
            </li>
        @endcan
        @can('dashboard_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link {{ request()->is("admin/dashboards") || request()->is("admin/dashboards/*") ? "active" : "" }}">
                    <i class="fa-fw far fa-chart-bar c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.dashboard.title') }}
                </a>
            </li>
        @endcan
        @can('implementacion_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.implementacions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/implementacions") || request()->is("admin/implementacions/*") ? "active" : "" }}">
                    <i class="fa-fw far fa-window-restore c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.implementacion.title') }}
                </a>
            </li>
        @endcan
        @can('documentacion_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw far fa-file-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.documentacion.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('carpetum_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.carpeta.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/carpeta") || request()->is("admin/carpeta/*") ? "active" : "" }}">
                                <i class="fa-fw far fa-folder-open c-sidebar-nav-icon" style="text-indent: 30px">

                                </i>
                                {{ trans('cruds.carpetum.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('archivo_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.archivos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/archivos") || request()->is("admin/archivos/*") ? "active" : "" }}">
                                <i class="fa-fw far fa-file-archive c-sidebar-nav-icon" style="text-indent: 30px">

                                </i>
                                {{ trans('cruds.archivo.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "active" : "" }}">
                <i class="c-sidebar-nav-icon fa-fw fas fa-calendar">

                </i>
                {{ trans('global.systemCalendar') }}
            </a>
        </li>
        @can('glosario_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.glosarios.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/glosarios") || request()->is("admin/glosarios/*") ? "active" : "" }}">
                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.glosario.title') }}
                </a>
            </li>
        @endcan
        <li class="c-sidebar-nav-title">Normas</li>
        @can('isoveinticieteuno_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-globe-americas c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.isoveinticieteuno.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('contexto_access')
                        <li class="c-sidebar-nav-dropdown" >
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-archive c-sidebar-nav-icon" style="text-indent: 30px">

                                </i>
                                {{ trans('cruds.contexto.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('entendimiento_organizacion_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.entendimiento-organizacions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/entendimiento-organizacions") || request()->is("admin/entendimiento-organizacions/*") ? "active" : "" }}">
                                            <i class="" >

                                            </i>
                                            {{ trans('cruds.entendimientoOrganizacion.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('partes_interesada_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.partes-interesadas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/partes-interesadas") || request()->is("admin/partes-interesadas/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.partesInteresada.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('matriz_requisito_legale_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.matriz-requisito-legales.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/matriz-requisito-legales") || request()->is("admin/matriz-requisito-legales/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.matrizRequisitoLegale.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('alcance_sgsi_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.alcance-sgsis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/alcance-sgsis") || request()->is("admin/alcance-sgsis/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.alcanceSgsi.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('liderazgo_access')
                        <li class="c-sidebar-nav-dropdown">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-gavel c-sidebar-nav-icon" style="text-indent: 10px">

                                </i>
                                {{ trans('cruds.liderazgo.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('comiteseguridad_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.comiteseguridads.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/comiteseguridads") || request()->is("admin/comiteseguridads/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.comiteseguridad.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('minutasaltadireccion_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.minutasaltadireccions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/minutasaltadireccions") || request()->is("admin/minutasaltadireccions/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.minutasaltadireccion.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('evidencias_sgsi_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.evidencias-sgsis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/evidencias-sgsis") || request()->is("admin/evidencias-sgsis/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.evidenciasSgsi.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('politica_sgsi_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.politica-sgsis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/politica-sgsis") || request()->is("admin/politica-sgsis/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.politicaSgsi.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('roles_responsabilidade_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.roles-responsabilidades.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles-responsabilidades") || request()->is("admin/roles-responsabilidades/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.rolesResponsabilidade.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('planificacion_access')
                        <li class="c-sidebar-nav-dropdown">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-tasks c-sidebar-nav-icon" style="text-indent: 10px">

                                </i>
                                {{ trans('cruds.planificacion.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('riesgosoportunidade_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.riesgosoportunidades.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/riesgosoportunidades") || request()->is("admin/riesgosoportunidades/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.riesgosoportunidade.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('objetivosseguridad_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.objetivosseguridads.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/objetivosseguridads") || request()->is("admin/objetivosseguridads/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.objetivosseguridad.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('soporte_access')
                        <li class="c-sidebar-nav-dropdown">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-headset c-sidebar-nav-icon" style="text-indent: 10px">

                                </i>
                                {{ trans('cruds.soporte.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('recurso_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.recursos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/recursos") || request()->is("admin/recursos/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.recurso.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('competencium_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.competencia.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/competencia") || request()->is("admin/competencia/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.competencium.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('concientizacion_sgi_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.concientizacion-sgis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/concientizacion-sgis") || request()->is("admin/concientizacion-sgis/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.concientizacionSgi.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('material_sgsi_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.material-sgsis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/material-sgsis") || request()->is("admin/material-sgsis/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.materialSgsi.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('material_iso_veinticiente_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.material-iso-veinticientes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/material-iso-veinticientes") || request()->is("admin/material-iso-veinticientes/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.materialIsoVeinticiente.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('comunicacion_sgi_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.comunicacion-sgis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/comunicacion-sgis") || request()->is("admin/comunicacion-sgis/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.comunicacionSgi.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('politica_del_sgsi_soporte_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.politica-del-sgsi-soportes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/politica-del-sgsi-soportes") || request()->is("admin/politica-del-sgsi-soportes/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.politicaDelSgsiSoporte.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('control_acceso_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.control-accesos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/control-accesos") || request()->is("admin/control-accesos/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.controlAcceso.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('informacion_documetada_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.informacion-documetadas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/informacion-documetadas") || request()->is("admin/informacion-documetadas/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.informacionDocumetada.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('operacion_access')
                        <li class="c-sidebar-nav-dropdown">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon" style="text-indent: 10px">

                                </i>
                                {{ trans('cruds.operacion.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('planificacion_control_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.planificacion-controls.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/planificacion-controls") || request()->is("admin/planificacion-controls/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.planificacionControl.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('activo_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.activos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/activos") || request()->is("admin/activos/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.activo.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('tratamiento_riesgo_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.tratamiento-riesgos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tratamiento-riesgos") || request()->is("admin/tratamiento-riesgos/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.tratamientoRiesgo.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('evaluacion_access')
                        <li class="c-sidebar-nav-dropdown">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-file-signature c-sidebar-nav-icon" style="text-indent: 10px">

                                </i>
                                {{ trans('cruds.evaluacion.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('indicadores_sgsi_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.indicadores-sgsis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/indicadores-sgsis") || request()->is("admin/indicadores-sgsis/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.indicadoresSgsi.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('incidentes_de_seguridad_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.incidentes-de-seguridads.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/incidentes-de-seguridads") || request()->is("admin/incidentes-de-seguridads/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.incidentesDeSeguridad.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('indicadorincidentessi_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.indicadorincidentessis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/indicadorincidentessis") || request()->is("admin/indicadorincidentessis/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.indicadorincidentessi.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('auditoria_anual_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.auditoria-anuals.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/auditoria-anuals") || request()->is("admin/auditoria-anuals/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.auditoriaAnual.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('plan_auditorium_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.plan-auditoria.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/plan-auditoria") || request()->is("admin/plan-auditoria/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.planAuditorium.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('auditoria_interna_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.auditoria-internas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/auditoria-internas") || request()->is("admin/auditoria-internas/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.auditoriaInterna.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('revision_direccion_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.revision-direccions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/revision-direccions") || request()->is("admin/revision-direccions/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.revisionDireccion.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('mejora_access')
                        <li class="c-sidebar-nav-dropdown">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-infinity c-sidebar-nav-icon" style="text-indent: 10px">

                                </i>
                                {{ trans('cruds.mejora.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('accion_correctiva_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.accion-correctivas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/accion-correctivas") || request()->is("admin/accion-correctivas/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.accionCorrectiva.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('planaccion_correctiva_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.planaccion-correctivas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/planaccion-correctivas") || request()->is("admin/planaccion-correctivas/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.planaccionCorrectiva.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('registromejora_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.registromejoras.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/registromejoras") || request()->is("admin/registromejoras/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.registromejora.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('dmaic_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.dmaics.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/dmaics") || request()->is("admin/dmaics/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.dmaic.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('plan_mejora_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.plan-mejoras.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/plan-mejoras") || request()->is("admin/plan-mejoras/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            {{ trans('cruds.planMejora.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('isoveintidostresuno_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-globe-africa c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.isoveintidostresuno.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('adquirirveintidostrecientosuno_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.adquirirveintidostrecientosunos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/adquirirveintidostrecientosunos") || request()->is("admin/adquirirveintidostrecientosunos/*") ? "active" : "" }}">
                                <i class="fa-fw fab fa-amazon-pay c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.adquirirveintidostrecientosuno.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('isotreintaunmil_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-globe-americas c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.isotreintaunmil.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('adquirirtreintaunmil_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.adquirirtreintaunmils.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/adquirirtreintaunmils") || request()->is("admin/adquirirtreintaunmils/*") ? "active" : "" }}">
                                <i class="fa-fw fab fa-amazon-pay c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.adquirirtreintaunmil.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        <li class="c-sidebar-nav-title">Administración</li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon" style="text-indent: 30px">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon" style="text-indent: 30px">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon" style="text-indent: 30px">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('controle_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.controles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/controles") || request()->is("admin/controles/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-screwdriver c-sidebar-nav-icon" style="text-indent: 30px">

                                </i>
                                {{ trans('cruds.controle.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon" style="text-indent: 30px">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('area_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.areas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/areas") || request()->is("admin/areas/*") ? "active" : "" }}">
                                <i class="fa-fw far fa-building c-sidebar-nav-icon" style="text-indent: 30px">

                                </i>
                                {{ trans('cruds.area.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('organizacione_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.organizaciones.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/organizaciones") || request()->is("admin/organizaciones/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-university c-sidebar-nav-icon" style="text-indent: 30px">

                                </i>
                                {{ trans('cruds.organizacione.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tipoactivo_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tipoactivos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tipoactivos") || request()->is("admin/tipoactivos/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-laptop c-sidebar-nav-icon" style="text-indent: 30px">

                                </i>
                                {{ trans('cruds.tipoactivo.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('puesto_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.puestos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/puestos") || request()->is("admin/puestos/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user-md c-sidebar-nav-icon" style="text-indent: 30px">

                                </i>
                                {{ trans('cruds.puesto.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_alert_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-bell c-sidebar-nav-icon" style="text-indent: 30px">

                                </i>
                                {{ trans('cruds.userAlert.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('sede_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.sedes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/sedes") || request()->is("admin/sedes/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-building c-sidebar-nav-icon" style="text-indent: 30px">

                                </i>
                                {{ trans('cruds.sede.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('enlaces_ejecutar_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.enlaces-ejecutars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/enlaces-ejecutars") || request()->is("admin/enlaces-ejecutars/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon" style="text-indent: 30px">

                                </i>
                                {{ trans('cruds.enlacesEjecutar.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('team_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.teams.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/teams") || request()->is("admin/teams/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon" style="text-indent: 30px">

                                </i>
                                {{ trans('cruds.team.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('estado_incidente_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.estado-incidentes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/estado-incidentes") || request()->is("admin/estado-incidentes/*") ? "active" : "" }}">
                                <i class="fa-fw fab fa-stripe-s c-sidebar-nav-icon" style="text-indent: 30px"> 

                                </i>
                                {{ trans('cruds.estadoIncidente.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('estatus_plan_trabajo_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.estatus-plan-trabajos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/estatus-plan-trabajos") || request()->is("admin/estatus-plan-trabajos/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon" style="text-indent: 30px">

                                </i>
                                {{ trans('cruds.estatusPlanTrabajo.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('estado_documento_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.estado-documentos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/estado-documentos") || request()->is("admin/estado-documentos/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon" style="text-indent: 30px">

                                </i>
                                {{ trans('cruds.estadoDocumento.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('plan_base_actividade_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.plan-base-actividades.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/plan-base-actividades") || request()->is("admin/plan-base-actividades/*") ? "active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.planBaseActividade.title') }}
                </a>
            </li>
        @endcan
        @can('faq_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.faqManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('faq_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon" style="text-indent: 30px">

                                </i>
                                {{ trans('cruds.faqCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('faq_question_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-questions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-question c-sidebar-nav-icon" style="text-indent: 30px">

                                </i>
                                {{ trans('cruds.faqQuestion.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @if(\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') && \App\Models\Team::where('owner_id', auth()->user()->id)->exists())
            <li class="c-sidebar-nav-item">
                <a class="{{ request()->is("admin/team-members") || request()->is("admin/team-members/*") ? "active" : "" }} c-sidebar-nav-link" href="{{ route("admin.team-members.index") }}">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-users">
                    </i>
                    <span>{{ trans("global.team-members") }}</span>
                </a>
            </li>
        @endif
   
        <li class="c-sidebar-nav-item">
            <a href="{{ url('sitemap') }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sitemap">

                </i>
                Mapa de sitio
            </a>
        </li>
 
    </ul>

</div>
