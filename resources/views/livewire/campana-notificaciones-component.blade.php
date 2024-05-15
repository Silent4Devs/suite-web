<ul class="ml-auto c-header-nav">
    <li class="c-header-nav-item dropdown notifications-menu">
        <a href="#" class="c-header-nav-link" data-toggle="dropdown">
            <i class="fas fa-bell iconos_cabecera"></i>
            @if ($notificaciones_sin_leer <= 10)
                <span class="badge badge-warning navbar-badge">
                    {{ $notificaciones_sin_leer }}
                </span>
            @else
                <span class="badge badge-danger navbar-badge">
                    {{ $notificaciones_sin_leer }}
                </span>
            @endif
            //asdasd
        </a>
        @livewire('lista-campana-notificaciones-component', ['notificaciones_sin_leer' => $notificaciones_sin_leer])
    </li>
</ul>
