<div class="container">

    @if (count($lista_notificaciones) > 0)
        <button class="btn btn-sm btn-primary" style="margin: 20px 0 10px 0" wire:click="markAllAsRead()">
            Marcar todas como leídas
        </button>
        @foreach ($lista_notificaciones as $notificacion)
            @includeIf('items-notificaciones.item-'.$notificacion->data['tabla'],[
            'last_unread_notification' => $notificacion,
            'place' => 'notificaciones-page',
            'readed' => false,
            ])
        @endforeach
        <br>
        {{ $lista_notificaciones->links() }}
    @else
        <br>
        <div class="alert alert-primary">
            <h4 class="alert-heading">Sin Novedades!</h4>
            <hr>
            <p>No hay nuevas notificaciones</p>
        </div>
    @endif
</div>
