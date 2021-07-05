<link rel="stylesheet" type="text/css" href="{{ asset('css/dark_mode.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/menu.css') }}">



<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show c-sidebar-light" style=" border: none;">

    <div class="bg-transparent c-sidebar-brand d-md-down-none caja_caja_img_logo">

       <!-- <div class="text-center dark_mode1" style="padding-top: 20px;">-->
               {{--<a href="{{url('/')}}" class="pl-0"><img src="{{ asset('img/Silent4Business-Logo-Color.png') }}" style="width: 40%;" class="img_logo"></a> --}}
            <div class="caja_img_logo">
               <?php
                use Illuminate\Support\Facades\DB;
                $users = DB::table('organizacions')
                ->select('logotipo')
                ->first();

                if (isset($users)) { ?>
                <img src="{{ url('images/' . $users->logotipo) }}" class="img_logo w-100">
                <?php } elseif (!isset($users)) { ?>
                <img src="{{ url('img/Silent4Business-Logo-Color.png') }}" class="img_logo w-100">
                <?php } else { ?>
                <img src="{{ url('img/Silent4Business-Logo-Color.png') }}" class="img_logo w-100">
                <?php }
                ?>

            </div>

    </div>



    <ul class="c-sidebar-nav dark_mode1">

    <li class="c-sidebar-nav-title"><font class="letra_blanca">Menu</font></li>
        @can('organizacion_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/matriz-riesgos*") ? "c-show" : "" }} {{ request()->is("admin/gap-unos*") ? "c-show" : "" }} {{ request()->is("admin/gap-dos*") ? "c-show" : "" }} {{ request()->is("admin/gap-tres*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                  <i class="fas fa-building iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> Mi Organización </font>
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route("admin.organizacions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/organizacions") || request()->is("admin/organizacions/*") ? "active" : "" }}">
                            <i class="fas fa-bullseye iconos_menu letra_blanca">

                            </i>
                            <font class="letra_blanca" style="margin-left:5px;"> Organización</font>
                        </a>
                    </li>
                    @can('sede_access')
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route("admin.sedes.obtenerListaSedes") }}" class="c-sidebar-nav-link {{ request()->is("admin/sedes") || request()->is("admin/sedes/*") ? "active" : "" }}">
                            <i class="fas fa-map-marked-alt iconos_menu letra_blanca">

                            </i>
                            <font class="letra_blanca"> Sedes</font>
                        </a>
                    </li>
                @endcan
                @can('area_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.areas.obtenerAreasPorGrupo") }}" class="c-sidebar-nav-link {{ request()->is("admin/areas") || request()->is("admin/areas/*") ? "active" : "" }}">
                        {{--<i class="fas fa-puzzle-piece iconos_menu letra_blanca">

                        </i>--}}
                        <i class="fab fa-adn iconos_menu letra_blanca">

                        </i>
                        <font class="letra_blanca"> {{ trans('cruds.area.title') }} </font>
                    </a>
                </li>
                 @endcan
                 <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.organigrama.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/organigrama") || request()->is("admin/organigrama/*") ? "c-active" : "" }}">
                        <i class="fas fa-users iconos_menu letra_blanca">
                        </i>
                        <font class="letra_blanca"> Organigrama </font>
                    </a>
                </li>
                </ul>
            </li>
        @endcan
        @can('dashboard_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link {{ request()->is("admin/dashboards") || request()->is("admin/dashboards/*") ? "active" : "" }}">
                    <i class="fa-fw far fa-chart-bar iconos_menu letra_blanca">

                    </i>
                    <font class="letra_blanca"> {{ trans('cruds.dashboard.title') }} </font>
                </a>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.planTrabajoBase.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/planTrabajoBase") || request()->is("admin/planTrabajoBase/*") ? "active" : "" }}">
                <i class="fas fa-clipboard-list iconos_menu letra_blanca"></i>

                </i>
                <font class="letra_blanca"> Plan de trabajo base </font>
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ url('/admin/analisis-brechas') }}" class="c-sidebar-nav-link">
                <i class="iconos_menu letra_blanca fas fa-fw fa-file-signature">

                </i>
              <font class="letra_blanca"> Análisis de brechas</font>
            </a>
        </li>
        @can('implementacion_access')
            {{-- <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.implementacions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/implementacions") || request()->is("admin/implementacions/*") ? "active" : "" }}">

                    <i class="fas fa-paper-plane iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> {{ trans('cruds.implementacion.title') }} </font>
                </a>
            </li> --}}
        @endcan
        @can('documentacion_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.carpeta.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/carpeta") || request()->is("admin/carpeta/*") ? "active" : "" }}">
                    <i class="fa-fw far fa-folder-open iconos_menu letra_blanca">

                    </i>
                   <font class="letra_blanca"> Documentos </font>
                </a>
                <!--<ul class="c-sidebar-nav-dropdown-items">
                    @can('carpetum_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.carpeta.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/carpeta") || request()->is("admin/carpeta/*") ? "active" : "" }}">
                                <i class="fa-fw far fa-folder-open iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.carpetum.title') }} </font>
                            </a>
                        </li>
                    @endcan
                    @can('archivo_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.archivos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/archivos") || request()->is("admin/archivos/*") ? "active" : "" }}">
                                <i class="fa-fw far fa-file-archive iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.archivo.title') }} </font>
                            </a>
                        </li>
                    @endcan
                </ul>-->
            </li>
        @endcan
        @can('analisis_riesgo_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/matriz-riesgos*") ? "c-show" : "" }} {{ request()->is("admin/gap-unos*") ? "c-show" : "" }} {{ request()->is("admin/gap-dos*") ? "c-show" : "" }} {{ request()->is("admin/gap-tres*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                  <i class="fas fa-exclamation-triangle iconos_menu letra_blanca">

                  </i>

                    <font class="letra_blanca"> {{ trans('cruds.analisisRiesgo.title') }} </font>
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('matriz_riesgo_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.matriz-riesgos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/matriz-riesgos") || request()->is("admin/matriz-riesgos/*") ? "c-active" : "" }}">
                              <i class="fas fa-table iconos_menu letra_blanca">
                              </i>
                                <font class="letra_blanca"> {{ trans('cruds.matrizRiesgo.title') }} </font>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "active" : "" }}">
                <i class="iconos_menu letra_blanca fa-fw fas fa-calendar">

                </i>
                <font class="letra_blanca"> Agenda </font>
            </a>
        </li>
        @can('glosario_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.glosarios.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/glosarios") || request()->is("admin/glosarios/*") ? "active" : "" }}">
                    <i class="fa-fw fas fa-book iconos_menu letra_blanca">

                    </i>
                    <font class="letra_blanca"> {{ trans('cruds.glosario.title') }} </font>
                </a>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.soporte.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/soporte.index") || request()->is("admin/soporte/*") ? "active" : "" }}">
                 <i class="fas fa-user-cog iconos_menu letra_blanca"></i>

                <font class="letra_blanca"> Soporte </font>
            </a>
        </li>

        <li class="c-sidebar-nav-title"><font class="letra_blanca">Normas</font></li>
        @can('isoveinticieteuno_access')

            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route("admin.iso27001.index") }}">
                    <i class="fa-fw fas fa-globe-americas iconos_menu letra_blanca"></i>
                    <font class="letra_blanca"> ISO 27001 </font>
                </a>
            </li>

            {{-- <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-globe-americas iconos_menu letra_blanca">

                    </i>
                    <font class="letra_blanca"> {{ trans('cruds.isoveinticieteuno.title') }} </font>
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('contexto_access')
                        <li class="c-sidebar-nav-dropdown" >
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-archive iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.contexto.title') }} </font>
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                            <!--@can('entendimiento_organizacion_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.entendimiento-organizacions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/entendimiento-organizacions") || request()->is("admin/entendimiento-organizacions/*") ? "active" : "" }}">
                                            <i class="" >

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.entendimientoOrganizacion.title') }} </font>
                                        </a>
                                    </li>-->
                                @endcan
                                <li class="c-sidebar-nav-item">
                                    <a href="{{ route("admin.declaracion-aplicabilidad.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/declaracion-aplicabilidad") || request()->is("admin/declaracion-aplicabilidad/*") ? "active" : "" }}">
                                        <i class="">

                                        </i>
                                        <font class="letra_blanca"> Declaración de aplicabilidad </font>
                                    </a>
                                </li>
                                @can('partes_interesada_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.partes-interesadas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/partes-interesadas") || request()->is("admin/partes-interesadas/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.partesInteresada.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                                @can('matriz_requisito_legale_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.matriz-requisito-legales.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/matriz-requisito-legales") || request()->is("admin/matriz-requisito-legales/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.matrizRequisitoLegale.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                                 @can('entendimiento_organizacion_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.entendimiento-organizacions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/entendimiento-organizacions") || request()->is("admin/entendimiento-organizacions/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> FODA </font>
                                        </a>
                                    </li>
                                @endcan
                                @can('alcance_sgsi_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.alcance-sgsis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/alcance-sgsis") || request()->is("admin/alcance-sgsis/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.alcanceSgsi.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                                <li class="c-sidebar-nav-item">
                                    <a href="{{ route("admin.reportes-contexto.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/reportes-contexto") || request()->is("admin/reportes-contexto/*") ? "active" : "" }}">
                                        <i class="">

                                        </i>
                                        <font class="letra_blanca"> Generar Reporte </font>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('liderazgo_access')
                        <li class="c-sidebar-nav-dropdown">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-gavel iconos_menu letra_blanca">

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.liderazgo.title') }} </font>
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('comiteseguridad_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.comiteseguridads.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/comiteseguridads") || request()->is("admin/comiteseguridads/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.comiteseguridad.title') }} </font>
                                        </a>
                                    </li>
                                @endcan

                                @can('minutasaltadireccion_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.minutasaltadireccions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/minutasaltadireccions") || request()->is("admin/minutasaltadireccions/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.minutasaltadireccion.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                                @can('evidencias_sgsi_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.evidencias-sgsis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/evidencias-sgsis") || request()->is("admin/evidencias-sgsis/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.evidenciasSgsi.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                                @can('politica_sgsi_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.politica-sgsis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/politica-sgsis") || request()->is("admin/politica-sgsis/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.politicaSgsi.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                                @can('roles_responsabilidade_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.roles-responsabilidades.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles-responsabilidades") || request()->is("admin/roles-responsabilidades/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.rolesResponsabilidade.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('planificacion_access')
                        <li class="c-sidebar-nav-dropdown">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-tasks iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.planificacion.title') }} </font>
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('riesgosoportunidade_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.riesgosoportunidades.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/riesgosoportunidades") || request()->is("admin/riesgosoportunidades/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.riesgosoportunidade.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                                @can('objetivosseguridad_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.objetivosseguridads.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/objetivosseguridads") || request()->is("admin/objetivosseguridads/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.objetivosseguridad.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('soporte_access')
                        <li class="c-sidebar-nav-dropdown">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-headset iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.soporte.title') }} </font>
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('recurso_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.recursos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/recursos") || request()->is("admin/recursos/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> Capacitaciones </font>
                                        </a>
                                    </li>
                                @endcan
                                @can('competencium_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.competencia.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/competencia") || request()->is("admin/competencia/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.competencium.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                                @can('concientizacion_sgi_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.concientizacion-sgis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/concientizacion-sgis") || request()->is("admin/concientizacion-sgis/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.concientizacionSgi.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                                @can('material_sgsi_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.material-sgsis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/material-sgsis") || request()->is("admin/material-sgsis/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.materialSgsi.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                                @can('material_iso_veinticiente_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.material-iso-veinticientes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/material-iso-veinticientes") || request()->is("admin/material-iso-veinticientes/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.materialIsoVeinticiente.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                                @can('comunicacion_sgi_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.comunicacion-sgis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/comunicacion-sgis") || request()->is("admin/comunicacion-sgis/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.comunicacionSgi.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                                @can('politica_del_sgsi_soporte_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.politica-del-sgsi-soportes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/politica-del-sgsi-soportes") || request()->is("admin/politica-del-sgsi-soportes/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.politicaDelSgsiSoporte.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                                @can('control_acceso_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.control-accesos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/control-accesos") || request()->is("admin/control-accesos/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.controlAcceso.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                                @can('informacion_documetada_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.informacion-documetadas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/informacion-documetadas") || request()->is("admin/informacion-documetadas/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.informacionDocumetada.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('operacion_access')
                        <li class="c-sidebar-nav-dropdown">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-briefcase iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.operacion.title') }} </font>
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('planificacion_control_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.planificacion-controls.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/planificacion-controls") || request()->is("admin/planificacion-controls/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.planificacionControl.title') }} </font>
                                        </a>
                                    </li>
                                @endcan

                                @can('tratamiento_riesgo_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.tratamiento-riesgos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tratamiento-riesgos") || request()->is("admin/tratamiento-riesgos/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.tratamientoRiesgo.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('evaluacion_access')
                        <li class="c-sidebar-nav-dropdown">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-file-signature iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.evaluacion.title') }} </font>
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('indicadores_sgsi_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.indicadores-sgsis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/indicadores-sgsis") || request()->is("admin/indicadores-sgsis/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.indicadoresSgsi.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                                @can('incidentes_de_seguridad_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.incidentes-de-seguridads.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/incidentes-de-seguridads") || request()->is("admin/incidentes-de-seguridads/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.incidentesDeSeguridad.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                                @can('indicadorincidentessi_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.indicadorincidentessis.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/indicadorincidentessis") || request()->is("admin/indicadorincidentessis/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.indicadorincidentessi.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                                @can('auditoria_anual_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.auditoria-anuals.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/auditoria-anuals") || request()->is("admin/auditoria-anuals/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.auditoriaAnual.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                                @can('plan_auditorium_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.plan-auditoria.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/plan-auditoria") || request()->is("admin/plan-auditoria/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.planAuditorium.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                                @can('auditoria_interna_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.auditoria-internas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/auditoria-internas") || request()->is("admin/auditoria-internas/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.auditoriaInterna.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                                @can('revision_direccion_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.revision-direccions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/revision-direccions") || request()->is("admin/revision-direccions/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.revisionDireccion.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('mejora_access')
                        <li class="c-sidebar-nav-dropdown">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-infinity iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.mejora.title') }} </font>
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('accion_correctiva_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.accion-correctivas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/accion-correctivas") || request()->is("admin/accion-correctivas/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.accionCorrectiva.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                              <!--  @can('planaccion_correctiva_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.planaccion-correctivas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/planaccion-correctivas") || request()->is("admin/planaccion-correctivas/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.planaccionCorrectiva.title') }} </font>
                                        </a>
                                    </li> -->
                                @endcan
                                @can('registromejora_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.registromejoras.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/registromejoras") || request()->is("admin/registromejoras/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.registromejora.title') }} </font>
                                        </a>
                                    </li>
                                @endcan
                              <!--  @can('dmaic_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.dmaics.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/dmaics") || request()->is("admin/dmaics/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.dmaic.title') }} </font>
                                        </a>
                                    </li>-->
                                @endcan
                              <!--  @can('plan_mejora_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.plan-mejoras.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/plan-mejoras") || request()->is("admin/plan-mejoras/*") ? "active" : "" }}">
                                            <i class="">

                                            </i>
                                            <font class="letra_blanca"> {{ trans('cruds.planMejora.title') }} </font>
                                        </a>
                                    </li>-->
                                @endcan
                            </ul>
                        </li>
                    @endcan

                </ul>
            </li> --}}
        @endcan
        {{-- @can('isoveintidostresuno_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-globe-africa iconos_menu letra_blanca">

                    </i>
                    <font class="letra_blanca"> {{ trans('cruds.isoveintidostresuno.title') }} </font>
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('adquirirveintidostrecientosuno_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.adquirirveintidostrecientosunos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/adquirirveintidostrecientosunos") || request()->is("admin/adquirirveintidostrecientosunos/*") ? "active" : "" }}">
                                <i class="fa-fw fab fa-amazon-pay iconos_menu letra_blanca">

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.adquirirveintidostrecientosuno.title') }} </font>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('isotreintaunmil_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-globe-americas iconos_menu letra_blanca">

                    </i>
                    <font class="letra_blanca"> {{ trans('cruds.isotreintaunmil.title') }} </font>
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('adquirirtreintaunmil_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.adquirirtreintaunmils.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/adquirirtreintaunmils") || request()->is("admin/adquirirtreintaunmils/*") ? "active" : "" }}">
                                <i class="fa-fw fab fa-amazon-pay iconos_menu letra_blanca">

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.adquirirtreintaunmil.title') }} </font>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan --}}

        <li class="c-sidebar-nav-title"><font class="letra_blanca">Administración</font></li>
        @can('faq_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fas fa-file-alt iconos_menu letra_blanca">

                    </i>
                    <font class="letra_blanca"> Configuracion de Datos </font>
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                {{--  @can('organizacione_access')
                      <li class="c-sidebar-nav-item">
                          <a href="{{ route("admin.organizaciones.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/organizaciones") || request()->is("admin/organizaciones/*") ? "active" : "" }}">
                              <i class="fa-fw fas fa-university iconos_menu letra_blanca" >

                              </i>
                              <font class="letra_blanca"> {{ trans('cruds.organizacione.title') }} </font>
                          </a>
                      </li>
                  @endcan--}}
                  @can('sede_access')
                  <li class="c-sidebar-nav-item">
                      <a href="{{ route("admin.sedes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/sedes") || request()->is("admin/sedes/*") ? "active" : "" }}">
                          <i class="fas fa-map-marked-alt iconos_menu letra_blanca">

                          </i>
                          <font class="letra_blanca"> Sedes</font>
                      </a>
                  </li>
                @endcan
                @can('area_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.grupoarea.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/areas") || request()->is("admin/areas/*") ? "active" : "" }}">
                        {{--<i class="fas fa-puzzle-piece iconos_menu letra_blanca">

                        </i>--}}
                        <i class="fab fa-adn iconos_menu letra_blanca">

                        </i>
                        <font class="letra_blanca"> {{ trans('cruds.area.title') }} </font>
                    </a>
                </li>
                 @endcan
                  @can('user_access')
                  <li class="c-sidebar-nav-item">
                      <a href="{{ route("admin.empleados.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/empleados") || request()->is("admin/empleados/*") ? "active" : "" }}">
                          <i class="fa-fw fas fa-user iconos_menu letra_blanca" >

                          </i>
                          <font class="letra_blanca"> Empleados </font>
                      </a>
                  </li>
                   @endcan
                  @can('activo_access')
                      <li class="c-sidebar-nav-item">
                          <a href="{{ route("admin.activos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/activos") || request()->is("admin/activos/*") ? "active" : "" }}">
                            <i class="fa-fw fas fa-laptop iconos_menu letra_blanca" >

                            </i>
                              <font class="letra_blanca"> Inventario de Activos</font>
                          </a>
                      </li>
                  @endcan
                  @can('tipoactivo_access')
                      <li class="c-sidebar-nav-item">
                          <a href="{{ route("admin.tipoactivos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tipoactivos") || request()->is("admin/tipoactivos/*") ? "active" : "" }}">
                        <i class="fas fa-th-list iconos_menu letra_blanca"></i>
                              <font class="letra_blanca"> Categorias de Activos</font>
                          </a>
                      </li>
                  @endcan
                   @can('tipoactivo_access')
                      <li class="c-sidebar-nav-item">
                          <a href="{{ route("admin.categoria-capacitacion.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tipoactivos") || request()->is("admin/tipoactivos/*") ? "active" : "" }}">
                        <i class="fas fa-th-list iconos_menu letra_blanca"></i>
                              <font class="letra_blanca"> Categorias de Capacitaciones</font>
                          </a>
                      </li>
                  @endcan
                  @can('tipoactivo_access')
                      <li class="c-sidebar-nav-item">
                          <a href="{{ route("admin.macroprocesos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tipoactivos") || request()->is("admin/tipoactivos/*") ? "active" : "" }}">
                        <i class="fas fa-th-list iconos_menu letra_blanca"></i>
                              <font class="letra_blanca"> Macroprocesos</font>
                          </a>
                      </li>
                  @endcan
                  @can('tipoactivo_access')
                      <li class="c-sidebar-nav-item">
                          <a href="{{ route("admin.procesos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/procesos") || request()->is("admin/procesos/*") ? "active" : "" }}">
                        <i class="fas fa-th-list iconos_menu letra_blanca"></i>
                              <font class="letra_blanca"> Procesos</font>
                          </a>
                      </li>
                  @endcan
                </ul>
            </li>
        @endcan

        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users iconos_menu letra_blanca">

                    </i>
                    <font class="letra_blanca"> {{ trans('cruds.userManagement.title') }} </font>
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.permission.title') }} </font>
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-briefcase iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.role.title') }} </font>
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.user.title') }} </font>
                            </a>
                        </li>
                    @endcan

                    @can('controle_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.controles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/controles") || request()->is("admin/controles/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-screwdriver iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.controle.title') }} </font>
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-file-alt iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.auditLog.title') }} </font>
                            </a>
                        </li>
                    @endcan
                    @can('puesto_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.puestos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/puestos") || request()->is("admin/puestos/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user-md iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.puesto.title') }} </font>
                            </a>
                        </li>
                    @endcan
                    @can('user_alert_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-bell iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.userAlert.title') }} </font>
                            </a>
                        </li>
                    @endcan
                    @can('enlaces_ejecutar_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.enlaces-ejecutars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/enlaces-ejecutars") || request()->is("admin/enlaces-ejecutars/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-cogs iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.enlacesEjecutar.title') }} </font>
                            </a>
                        </li>
                    @endcan
                    @can('team_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.teams.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/teams") || request()->is("admin/teams/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-users iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.team.title') }} </font>
                            </a>
                        </li>
                    @endcan
                    @can('estado_incidente_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.estado-incidentes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/estado-incidentes") || request()->is("admin/estado-incidentes/*") ? "active" : "" }}">
                                <i class="fa-fw fab fa-stripe-s iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.estadoIncidente.title') }} </font>
                            </a>
                        </li>
                    @endcan
                    @can('estatus_plan_trabajo_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.estatus-plan-trabajos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/estatus-plan-trabajos") || request()->is("admin/estatus-plan-trabajos/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-cogs iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.estatusPlanTrabajo.title') }} </font>
                            </a>
                        </li>
                    @endcan
                    @can('estado_documento_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.estado-documentos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/estado-documentos") || request()->is("admin/estado-documentos/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-cogs iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.estadoDocumento.title') }} </font>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('plan_base_actividade_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.plan-base-actividades.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/plan-base-actividades") || request()->is("admin/plan-base-actividades/*") ? "active" : "" }}">
                    <i class="fa-fw fas fa-cogs iconos_menu letra_blanca">

                    </i>
                    <font class="letra_blanca"> {{ trans('cruds.planBaseActividade.title') }} </font>
                </a>
            </li>
        @endcan
        @can('faq_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-question iconos_menu letra_blanca">

                    </i>
                    <font class="letra_blanca"> {{ trans('cruds.faqManagement.title') }} </font>
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('faq_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-briefcase iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.faqCategory.title') }} </font>
                            </a>
                        </li>
                    @endcan
                    @can('faq_question_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-questions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-question iconos_menu letra_blanca" >

                                </i>
                                <font class="letra_blanca"> {{ trans('cruds.faqQuestion.title') }} </font>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @if(\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') && \App\Models\Team::where('owner_id', auth()->user()->id)->exists())
            <li class="c-sidebar-nav-item">
                <a class="{{ request()->is("admin/team-members") || request()->is("admin/team-members/*") ? "active" : "" }} c-sidebar-nav-link" href="{{ route("admin.team-members.index") }}">
                    <i class="iconos_menu letra_blanca fa-fw fa fa-users">
                    </i>
                    <span>{{ trans("global.team-members") }}</span>
                </a>
            </li>
        @endif
        @can('lista_de_verificacion_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/control-documentos*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    <font class="letra_blanca"> {{ trans('cruds.listaDeVerificacion.title') }} </font>
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('control_documento_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.control-documentos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/control-documentos") || request()->is("admin/control-documentos/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                <font class="letra_blanca">{{ trans('cruds.controlDocumento.title') }}</font>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ url('sitemap') }}" class="c-sidebar-nav-link">
                <i class="iconos_menu letra_blanca fas fa-fw fa-sitemap">

                </i>
                <font class="letra_blanca">Mapa de sitio</font>
            </a>
        </li>

    </ul>

</div>

<script>



    var a = document.getElementsByClassName("active");
    for(var i = 0; i < a.length; i++)
        a[i].className += " c-active";


    var ida = document.getElementsByClassName("c-active");
    for(var i = 0; i < ida.length; i++)
        ida[i].id += "seleccionado";



    document.getElementById('seleccionado').parentNode.classList.add('c-show');

    document.getElementById('seleccionado').parentNode.parentNode.classList.add('c-show');

    document.getElementById('seleccionado').parentNode.parentNode.parentNode.classList.add('c-show');

    document.getElementById('seleccionado').parentNode.parentNode.parentNode.parentNode.classList.add('c-show');

    document.getElementById('seleccionado').parentNode.parentNode.parentNode.parentNode.parentNode.classList.add('c-show');

















/*
    document.getElementById('seleccionado').parentNode.classList.add('select_li');
    var idli = document.getElementsByClassName("select_li");
    for(var i = 0; i < idli.length; i++)
        idli[i].id += "seleccionadoli";

    document.getElementById('seleccionadoli').parentNode.classList.add('c-show');
    var idul = document.getElementsByClassName("c-show");
    for(var i = 0; i < idul.length; i++)
        idul[i].id += "seleccionadoul";

    document.getElementById('seleccionadoul').parentNode.classList.add('c-show');
    var idull = document.getElementsByClassName("c-show");
    for(var i = 0; i < idull.length; i++)
        idull[i].id += "seleccionadoull";

    document.getElementById('seleccionadoull').parentNode.classList.add('c-show');
    var idulll = document.getElementsByClassName("c-show");
    for(var i = 0; i < idulll.length; i++)
        idulll[i].id += "seleccionadoulll";

    document.getElementById('seleccionadoulll').parentNode.classList.add('c-show');
*/





</script>
