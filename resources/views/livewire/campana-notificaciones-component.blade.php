<ul class="ml-auto c-header-nav">
    <li class="c-header-nav-item dropdown notifications-menu">
        <a href="#" class="c-header-nav-link" data-toggle="dropdown">
            <span class="material-symbols-outlined">notifications</span>
            <small>
                @if ($notificaciones_sin_leer <= 10)
                    <span class="badge badge-warning navbar-badge" style="background-color: #ffaa00;">
                        {{ $notificaciones_sin_leer }}
                    </span>
                @else
                    <span class="badge badge-danger navbar-badge">
                        {{ $notificaciones_sin_leer }}
                    </span>
                @endif
            </small>
        </a>
        @livewire('lista-campana-notificaciones-component', ['notificaciones_sin_leer' => $notificaciones_sin_leer])
    </li>
</ul>
