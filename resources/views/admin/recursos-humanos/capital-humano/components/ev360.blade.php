<ul class="mt-4">
    <li>
        <a href="{{ route('admin.ev360-competencias.index') }}">
            <div style="text-transform: capitalize">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                    class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path
                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                </svg>
                <p class="m-0 mt-2">
                    Definir Competencias
                </p>
            </div>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.ev360-competencias-por-puesto.index') }}">
            <div style="text-transform: capitalize">
                <i class="m-0 fas fa-user-tag" style="font-size:40px"></i>
                <p class="m-0 mt-2">
                    Competencias Por Puesto
                </p>
            </div>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.ev360-objetivos.index') }}">
            <div style="text-transform: capitalize">
                <i class="m-0 fas fa-bullseye" style="font-size:40px;"></i>
                <p class="m-0 mt-2">
                    Asignar
                    Objetivos Estratégicos
                </p>
            </div>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.ev360-evaluaciones.create') }}">
            <div style="text-transform: capitalize">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path
                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd"
                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                </svg>
                <p class="m-0 mt-2">
                    Crear
                    <br>
                    Evaluaciones
                </p>
            </div>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.ev360-evaluaciones.index') }}">
            <div style="text-transform: capitalize">
                <i class="fas fa-clone"></i>
                <p class="m-0 mt-2">
                    Evaluaciones
                    <br>
                    Creadas
                </p>
            </div>
        </a>
    </li>
</ul>
