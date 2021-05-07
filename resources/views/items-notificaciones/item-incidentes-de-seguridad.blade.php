<a class="dropdown-item text-secondary"
    href="{{ route('admin.incidentes-de-seguridads.show', $last_unread_notification->data['id']) }}">
    @switch(" ".$last_unread_notification->data['type']) {{-- Se concatena un espacio porque el autoformateado lo agrega en el case --}}
        @case(" create")
            <div class="d-flex align-items-center justify-content-start">
                <i class="pr-2 fas fa-shield-alt text-success"></i>
                <p class="p-0 m-0">Nuevo {{ $last_unread_notification->data['slug'] }} creado</p>
            </div>
        @break
        @case(" update")
            <div class="d-flex align-items-center justify-content-start">
                <i class="pr-2 fas fa-shield-alt text-info"></i>
                <p class="p-0 m-0">
                    El {{ $last_unread_notification->data['slug'] }} con folio
                    {{ $last_unread_notification->data['folio'] }} ha
                    sido actualizado
                </p>
            </div>
        @break
        @case(" delete")
            <div class="d-flex align-items-center justify-content-start">
                <i class="pr-2 fas fa-shield-alt text-danger"></i>
                <p class="p-0 m-0">
                    El {{ $last_unread_notification->data['slug'] }} con folio
                    {{ $last_unread_notification->data['folio'] }} ha
                    sido eliminado
                </p>
            </div>
        @break
        @default
    @endswitch
</a>
