<div class="container">
    <br>
    @if (count($lista_notificaciones) > 0)
        @foreach ($lista_notificaciones as $notificacion)
            @includeIf('items-notificaciones.item-' . $notificacion->data['tabla'], [
                'last_unread_notification' => $notificacion,
                'place' => 'notificaciones-page',
                'readed' => true,
            ])
        @endforeach
        <br>
        <div wire:loading>
            <div class="spinner-grow text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="spinner-grow text-secondary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="spinner-grow text-success" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="spinner-grow text-danger" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="spinner-grow text-warning" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="spinner-grow text-info" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="spinner-grow text-light" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="spinner-grow text-dark" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div wire:loading.remove>
            {{ $lista_notificaciones->links() }}
        </div>
    @else
        <br>
        <div class="alert alert-primary">
            <h4 class="alert-heading">Sin Novedades!</h4>
            <hr>
            <p>No hay nuevas notificaciones</p>
        </div>
    @endif
</div>
