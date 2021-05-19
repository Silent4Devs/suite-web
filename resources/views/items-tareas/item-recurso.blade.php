<div class="row">
    <div class="col-{{ $place == 'tareas-page' ? '11' : '12' }}">
        <a class="dropdown-item text-secondary" href="#">
            <div class="d-flex align-items-center justify-content-start">
                <i class="pr-2 fab fa-discourse text-primary"></i>
                <p class="p-0 m-0">{{ $last_unread_notification->data['mensaje'] }}</p>
            </div>
        </a>
    </div>
    @if ($place == 'tareas-page')
        @if (!$readed)
            <div class="col">
                <span class="btn-read" data-toggle="tooltip" data-placement="top" title="Marcar como realizada"
                    wire:click="markTaskAsRead('{{ $last_unread_notification->id }}')">
                    <i class="fas fa-check"></i>
                </span>
            </div>
        @endif
    @endif

</div>
