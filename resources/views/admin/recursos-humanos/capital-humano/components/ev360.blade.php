<ul class="mt-4">
    @can('evaluacion_360_access')
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
    @can('evaluacion_360_seguimiento_access')
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
