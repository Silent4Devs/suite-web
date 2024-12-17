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
                                    <a class="dropdown-item" onclick="confirmarRestauracion({{ $obj->id }})">
                                        <i class="fa-solid fa-pencil"></i>&nbsp;Restaurar</a>
                                    <a class="dropdown-item delete-item" onclick="confirmarEliminacion({{ $obj->id }})">
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
    @livewireStyles
    @livewireScripts

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.confirmarRestauracion = function(objetivoId) {
                window.dispatchEvent(new CustomEvent('confirmarRestauracion', {
                    detail: {
                        objetivoId
                    }
                }));
            };

            window.addEventListener('confirmarRestauracion', event => {
                console.log(1);
                Swal.fire({
                    title: 'Restaurar Objetivo',
                    text: "¿Esta seguro que desea restaurar este objetivo?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, restaurar.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log(2);
                        Livewire.dispatch('restaurarPapelera', [event.detail.objetivoId]);
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.confirmarEliminacion = function(objetivoId) {
                window.dispatchEvent(new CustomEvent('confirmarEliminacion', {
                    detail: {
                        objetivoId
                    }
                }));
            };

            window.addEventListener('confirmarEliminacion', event => {
                console.log(1);
                Swal.fire({
                    title: 'Eliminar Objetivo',
                    text: "¿Esta seguro que desea Eliminar este objetivo?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, Eliminar.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log(2);
                        Livewire.dispatch('eliminarObjetivo', [event.detail.objetivoId]);
                    }
                });
            });
        });
    </script>
</div>
