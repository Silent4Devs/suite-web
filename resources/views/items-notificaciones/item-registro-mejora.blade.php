<a class="dropdown-item text-secondary"
    href="{{ route('admin.registromejoras.show', $last_unread_notification->data['id']) }}">
    @switch(" ".$last_unread_notification->data['type']) {{-- Se concatena un espacio porque el autoformateado lo agrega en el case --}}
        @case(" create")
            <div class="d-flex align-items-center justify-content-start">
                <i class="pr-2 fas fa-tools text-success"></i>
                <p class="p-0 m-0">Nuevo {{ $last_unread_notification->data['slug'] }} creado</p>
            </div>
        @break
        @case(" update")
            <div class="d-flex align-items-center justify-content-start">
                <i class="pr-2 fas fa-tools text-info"></i>
                <p class="p-0 m-0">
                    El {{ $last_unread_notification->data['slug'] }} con nombre
                    {{ $last_unread_notification->data['nombre'] }} ha
                    sido actualizado
                </p>
            </div>
        @break
        @case(" delete")
            <div class="d-flex align-items-center justify-content-start">
                <i class="pr-2 fas fa-tools text-danger"></i>
                <p class="p-0 m-0">
                    El {{ $last_unread_notification->data['slug'] }} con nombre
                    {{ $last_unread_notification->data['nombre'] }} ha
                    sido eliminado
                </p>
            </div>
        @break
        @default
    @endswitch
</a>
