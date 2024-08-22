<div>
    <div class="datatable-fix">
        <table class="table datatable">
            <thead>
                <tr>
                    <th>Categoría</th>
                    <th>Objetivos Estratégicos</th>
                    <th>Descripción</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($objetivos as $obj)
                    <tr>
                        <td>{{ $obj->objetivo->tipo->nombre }}</td>
                        <td>{{ $obj->objetivo->nombre }}</td>
                        <td>{{ $obj->objetivo->descripcion_meta }}</td>
                        <td>
                            <div class="dropdown btn-options-foda-card">
                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" wire:click.prevent="restaurarPapelera({{ $obj->id }})">
                                        <i class="fa-solid fa-pencil"></i>&nbsp;Restaurar</a>
                                    <a class="dropdown-item delete-item"
                                        wire:click.prevent="eliminarObjetivo({{ $obj->id }})">
                                        <i class="fa-solid fa-trash"></i>&nbsp;Eliminar</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- The whole world belongs to you. --}}
</div>
