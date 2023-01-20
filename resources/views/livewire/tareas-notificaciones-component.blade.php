<ul class="ml-auto c-header-nav">
    <li class="mx-2 c-header-nav-item dropdown d-md-down-none"><a class="c-header-nav-link" data-toggle="dropdown"
            href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-tasks iconos_cabecera"></i>
            <span class="badge badge-pill badge-danger">{{ $notificaciones_sin_leer }}</span></a>
        {{-- <div class="pt-0 dropdown-menu dropdown-menu-right dropdown-menu-lg">
            <div class="dropdown-header bg-light"><strong>You have 5 pending tasks</strong></div><a
                class="dropdown-item d-block" href="#">
                <div class="mb-1 small">Upgrade NPM &amp; Bower<span class="float-right"><strong>0%</strong></span>
                </div>
                <span class="progress progress-xs">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </span>
            </a><a class="dropdown-item d-block" href="#">
                <div class="mb-1 small">ReactJS Version<span class="float-right"><strong>25%</strong></span></div><span
                    class="progress progress-xs">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </span>
            </a><a class="dropdown-item d-block" href="#">
                <div class="mb-1 small">VueJS Version<span class="float-right"><strong>50%</strong></span></div><span
                    class="progress progress-xs">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </span>
            </a><a class="dropdown-item d-block" href="#">
                <div class="mb-1 small">Add new layouts<span class="float-right"><strong>75%</strong></span></div><span
                    class="progress progress-xs">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </span>
            </a><a class="dropdown-item d-block" href="#">
                <div class="mb-1 small">Angular 8 Version<span class="float-right"><strong>100%</strong></span></div>
                <span class="progress progress-xs">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </span>
            </a><a class="text-center dropdown-item border-top" href="#"><strong>View all tasks</strong></a>
        </div> --}}
        @livewire('lista-tareas-notificaciones-component',['notificaciones_sin_leer' => $notificaciones_sin_leer])
    </li>
</ul>
