<div class="container">
    <br>
    @if (count($lista_tareas) > 0)
        @foreach ($lista_tareas as $tarea)
            @includeIf('items-tareas.item-'.$tarea->data['tabla'],[
            'last_unread_notification' => $tarea,
            'place' => 'tareas-page',
            'readed' => false,
            ])
        @endforeach
        <br>
        {{ $lista_tareas->links() }}
    @else
        <br>
        <div class="alert alert-primary">
            <h4 class="alert-heading">Sin Novedades!</h4>
            <hr>
            <p>No hay nuevas tareas</p>
        </div>
    @endif
</div>
