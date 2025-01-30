<ul class="menu-modulos">
    @can('competencias_acceder')
        <li>
            <a href="{{ route('admin.ev360-competencias.index') }}">
                <i class="bi bi-star-half"></i>
                <span>
                    Competencias
                </span>
            </a>
        </li>
    @endcan
    @can('perfiles_de_puesto_acceder')
        <li>
            <a href="#" data-bs-toggle="modal" data-bs-target="#puestos-modal">
                <i class="bi bi-briefcase"></i>
                <span>
                    Perfiles de Puestos
                </span>
            </a>
        </li>
    @endcan
    <li>
        <a href="#" data-bs-toggle="modal" data-bs-target="#empleados_bd">
            <i class="bi bi-people"></i>
            <span>
                Empleados
            </span>
        </a>
    </li>

    @can('objetivos_estrategicos_acceder')
        <li>
            <a href="{{ route('admin.ev360-objetivos.index') }}">
                <i class="bi bi-bullseye"></i>
                <span>
                    Objetivos Estratégicos
                </span>
            </a>
        </li>
    @endcan
    @can('perfiles_profesionales_acceder')
        <li>
            <a href="#" data-bs-toggle="modal" data-bs-target="#profesional">
                <i class="bi bi-person-rolodex"></i>
                <span>
                    Perfiles Profesionales
                </span>
            </a>
        </li>
    @endcan
    @can('organigrama_acceder')
        <li>
            <a href="{{ route('admin.organigrama.index') }}">
                <i class="bi bi-diagram-3"></i>
                <span>
                    Organigrama
                </span>
            </a>
        </li>
    @endcan
    @can('capacitaciones_categorias_acceder')
        <li>
            <a href="#" data-bs-toggle="modal" data-bs-target="#capacitaciones">
                <i class="bi bi-person-video3"></i>
                <span>
                    Capacitaciones
                </span>
            </a>
        </li>
    @endcan

    <li>
        <a href="ausencias">
            <i class="bi bi-chat-square-dots"></i>
            <span>
                Solicitudes e Incidencias
            </span>
        </a>
    </li>

    @can('beneficios_acceder')
        <li>
            <a href="#">
                <i class="bi bi-tag"></i>
                <span>
                    Beneficios
                </span>
            </a>
        </li>
    @endcan
    @can('timesheet_acceder')
        <li>
            <a href="{{ route('admin.timesheet-inicio') }}">
                <i class="bi bi-file-spreadsheet"></i>
                <span>
                    TimeSheet
                </span>
            </a>
        </li>
    @endcan
</ul>


<!-- Modal -->
<div class="modal fade modal-menu-modulo" id="puestos-modal" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div>
                    <h4 class="text-center"><strong>Perfil de Puesto</strong></h4>
                    <ul class="menu-modulos mt-4">
                        @can('lista_de_perfiles_de_puesto_acceder')
                            <li>
                                <a href="{{ route('admin.puestos.index') }}">
                                    <i class="bi bi-briefcase"></i>
                                    <span>
                                        Lista de Perfiles de Puesto
                                    </span>
                                </a>
                            </li>
                        @endcan
                        @can('competencias_por_puesto_acceder')
                            <li>
                                <a href="{{ route('admin.ev360-competencias-por-puesto.index') }}">
                                    <i class="bi bi-bookmark-star"></i>
                                    <span>
                                        Competencias por Puesto
                                    </span>
                                </a>
                            </li>
                        @endcan
                        @can('consulta_perfiles_de_puesto_acceder')
                            <li>
                                <a href="{{ route('admin.consulta-puestos') }}">
                                    <i class="bi bi-person-video2"></i>
                                    <span>
                                        Consulta de Perfiles de Puesto
                                    </span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-menu-modulo" id="capacitaciones" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div>
                    <h4 class="text-center"><strong>Capacitaciones</strong></h4>
                    <ul class="menu-modulos">
                        @can('capacitaciones_categorias_acceder')
                            <li>
                                <a href="{{ route('admin.categoria-capacitacion.index') }}">
                                    <i class="fas fa-layer-group"></i>
                                    <span>
                                        Categorías
                                    </span>
                                </a>
                            </li>
                        @endcan

                        <li>
                            <a href="{{ route('admin.recursos.index') }}">
                                <i class="fas fa-graduation-cap"></i>
                                <span>
                                    Capacitaciones
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.categories.index') }}">
                                <i class="fas fa-layer-group"></i>
                                <span>
                                    Categorias Escuela
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.levels.index') }}">
                                <i class="fa-solid fa-chart-area"></i>
                                <span>
                                    Niveles Escuela
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.dashboardescuela.index') }}">
                                <i class="fa-solid fa-chart-pie"></i>
                                <span>
                                    Dashboard
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.panel-cursos') }}">
                                <i class="fa-solid fa-sliders"></i>
                                <span>
                                    Panel de Control
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ asset('admin/certificado-course') }}">
                                <i class="fa-solid fa-graduation-cap"></i>
                                <span>
                                    Certificaciones
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-menu-modulo" id="profesional" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div>
                    <h4 class="text-center"><strong>Perfil Profesional</strong></h4>
                    <ul class="menu-modulos">
                        @can('admin_type_catalogue_training')
                            <li>
                                <a href="{{ route('admin.type-catalogue-training.index') }}">
                                    <i class="bi bi-briefcase"></i>
                                    <span>
                                        Catálogo Tipo de Capacitaciones
                                    </span>
                                </a>
                            </li>
                        @endcan
                        @can('admin_catalogue_training')
                            <li>
                                <a href="{{ route('admin.catalogue-training.index') }}">
                                    <i class="bi bi-briefcase"></i>
                                    <span>
                                        Catálogo de Capacitaciones
                                    </span>
                                </a>
                            </li>
                        @endcan
                        <li>
                            <a href="{{ route('admin.capital.expedientes-profesionales') }}">
                                <i class="bi bi-person-rolodex"></i>
                                <span>
                                    Perfiles Profesionales
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-menu-modulo" id="empleados_bd" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div>
                    <h4 class="text-center"><strong>Empleados</strong></h4>
                    <ul class="menu-modulos">
                        @can('bd_empleados_acceder')
                            <li>
                                <a href="{{ route('admin.empleados.index') }}">
                                    <i class="bi bi-people"></i>
                                    <span>
                                        BD Empleados
                                    </span>
                                </a>
                            </li>
                        @endcan
                        @can('lista_de_documentos_empleados_acceder')
                            <li>
                                <a href="{{ route('admin.lista-documentos-empleados') }}">
                                    <i class="far fa-address-book"></i>
                                    <span>
                                        Lista de Documentos de Empleados
                                    </span>
                                </a>
                            </li>
                        @endcan
                        @can('niveles_jerarquicos_acceder')
                            <li>
                                <a href="{{ route('admin.perfiles.index') }}">
                                    <i class="bi bi-triangle"></i>
                                    <span>
                                        Niveles Jerárquicos
                                    </span>
                                </a>
                            </li>
                        @endcan
                        @can('tipos_de_contrato_para_empleados_acceder')
                            <li>
                                <a href="{{ route('admin.tipos-contratos-empleados.index') }}">
                                    <i class="bi bi-bank"></i>
                                    <span>
                                        Tipos de contratos
                                    </span>
                                </a>
                            </li>
                        @endcan
                        @can('entidades_crediticeas_acceder')
                            <li>
                                <a href="{{ route('admin.entidades-crediticias.index') }}">
                                    <i class="bi bi-bank"></i>
                                    <span>
                                        Entidades Crediticias
                                    </span>
                                </a>
                            </li>
                        @endcan
                        <li>
                            <a href="{{ route('admin.empleados.baja') }}">
                                <i class="bi bi-arrow-down"></i>
                                <span>
                                    Baja Empleados
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.empleados.historial') }}">
                                <i class="bi bi-clock-history"></i>
                                <span>
                                    Historial Empleados
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
