<div class="container">
    <br>
    @if (count($lista_notificaciones) > 0)
        @foreach ($lista_notificaciones as $notificacion)
            @includeIf('items-notificaciones.item-'.$notificacion->data['tabla'],[
            'last_unread_notification' => $notificacion,
            'place' => 'notificaciones-page',
            'readed' => true,
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
