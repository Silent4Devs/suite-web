<ul class="mt-4">
    <li>
        <a href="#" data-ventana="evaluaciones-periodo" class="btn_ventana_menu">
            <div>
                <i class="bi bi-patch-check"></i><br>
                <p class="m-0 mt-2">
                    Evaluaciones por Periodo
                    <br>
                </p>
            </div>
        </a>
    </li>
    <div class="ventana_menu" id="evaluaciones-periodo" style="color:#008186 !important">
        <i class="fas fa-arrow-circle-left iconos_menu text-align:left btn_cerrar_ventana" data-ventana="puestos"
            style="font-size:20pt; position: absolute; left:60px; cursor:pointer"></i>
        <h3 class="text-center"><strong>Evaluaciones por Periodo</strong></h3>
        <ul>
            <li>
                <a href="{{ route('admin.rh.evaluaciones-desempeno.dashboard-general') }}">
                    <div style="text-transform: capitalize">
                        <i class="bi bi-clipboard-check"></i><br>
                        <p class="m-0 mt-2">
                            Crear
                            <br>
                            Evaluación
                        </p>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.ev360-objetivos-periodo.config') }}">
                    <div>
                        <i class="bi bi-patch-check"></i><br>
                        <p class="m-0 mt-2">
                            Configurar Evaluación
                            <br>
                        </p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <li>
        <a href="#" data-ventana="evaluaciones-secc" class="btn_ventana_menu">
            <div>
                <i class="bi bi-patch-check"></i><br>
                <p class="m-0 mt-2">
                    Evaluaciones 360
                    <br>
                </p>
            </div>
        </a>
    </li>
    <div class="ventana_menu" id="evaluaciones-secc" style="color:#008186 !important">
        <i class="fas fa-arrow-circle-left iconos_menu text-align:left btn_cerrar_ventana" data-ventana="puestos"
            style="font-size:20pt; position: absolute; left:60px; cursor:pointer"></i>
        <h3 class="text-center"><strong>Evaluaciones 360</strong></h3>
        <ul>
            @can('crear_evaluacion_acceder')
                <li>
                    <a href="{{ route('admin.ev360-evaluaciones.create') }}">
                        <div style="text-transform: capitalize">
                            <i class="bi bi-clipboard-check"></i><br>
                            <p class="m-0 mt-2">
                                Crear
                                <br>
                                Evaluaciones
                            </p>
                        </div>
                    </a>
                </li>
            @endcan
            @can('seguimiento_evaluaciones_acceder')
                <li>
                    <a href="{{ route('admin.ev360-evaluaciones.index') }}">
                        <div>
                            <i class="bi bi-patch-check"></i><br>
                            <p class="m-0 mt-2">
                                Seguimiento de
                                Evaluaciones
                                <br>
                            </p>
                        </div>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</ul>
