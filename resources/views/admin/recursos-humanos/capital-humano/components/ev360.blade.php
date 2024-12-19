<ul class="menu-modulos">
    <li>
        <a href="#" data-bs-toggle="modal" data-bs-target="#evaluaciones-periodo">
            <i class="bi bi-patch-check"></i>
            <span>
                Evaluaciones por Periodo
            </span>
        </a>
    </li>

    <li>
        <a href="#" data-bs-toggle="modal" data-bs-target="#evaluaciones-secc">
            <i class="bi bi-patch-check"></i>
            <span>
                Evaluaciones 360
            </span>
        </a>
    </li>

</ul>

<div class="modal fade modal-menu-modulo" id="evaluaciones-periodo" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div>
                    <h4 class="text-center"><strong>Evaluaciones por Periodo</strong></h4>
                    <ul class="menu-modulos">
                        <li>
                            <a href="{{ route('admin.rh.evaluaciones-desempeno.dashboard-general') }}">
                                <i class="bi bi-clipboard-check"></i>
                                <span>
                                    Crear Evaluación
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.ev360-objetivos-periodo.config') }}">
                                <i class="bi bi-patch-check"></i>
                                <span>
                                    Configurar Evaluación
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-menu-modulo" id="evaluaciones-secc" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div>
                    <h4 class="text-center"><strong>Evaluaciones 360</strong></h4>
                    <ul class="menu-modulos">
                        @can('crear_evaluacion_acceder')
                            <li>
                                <a href="{{ route('admin.ev360-evaluaciones.create') }}">
                                    <i class="bi bi-clipboard-check"></i>
                                    <span>
                                        Crear Evaluaciones
                                    </span>
                                </a>
                            </li>
                        @endcan
                        @can('seguimiento_evaluaciones_acceder')
                            <li>
                                <a href="{{ route('admin.ev360-evaluaciones.index') }}">
                                    <i class="bi bi-patch-check"></i>
                                    <span>
                                        Seguimiento de
                                        Evaluaciones
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
