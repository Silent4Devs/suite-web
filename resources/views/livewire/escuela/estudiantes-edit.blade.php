<div>
    <button  type="submit"><i style="font-size:12pt; color:red" class="ml-2 fas fa-trash"
            data-toggle="tooltip" data-placement="top" title="Eliminar"
            wire:click.prevent="destroy({{ $student->id }})"></i></button>

    @section('js')
        @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    @stop
</div>
