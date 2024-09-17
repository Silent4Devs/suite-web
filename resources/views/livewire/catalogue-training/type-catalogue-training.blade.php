<div>
    <div class="card">
        <div class="card-body">
            <h4 class="color-tbj">Agregar tipo de Capacitación</h4>
            <form class="row mt-4" wire:submit="form">
                <div class="col-12 col-sm-6 ">
                    <div class="form-group pl-0 anima-focus">
                        <input id="inputName" class="form-control" placeholder="" style="min-width:200px;" name="name"
                            type="text" wire:model="name" required>
                        <label for="name">Agregar nombre de la Capacitación*</label>
                    </div>
                </div>
                <div class="col-12 col-sm-6 ">
                    @if ($status)
                        <button class="btn btn-secondary " type="submit">Agregar a catalogo</button>
                    @else
                        <button class="btn btn-secondary " type="submit">Editar registro</button>
                    @endif
                    <button class="btn btn-secondary " type="button" wire:click="registersRestore">Recuperar
                        registros</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4>Catálogo de Capacitaciones</h4>
            <table class="table w-100 tblCSV mt-4">
                <thead class="">
                    <tr>
                        <th style="min-width: 110px;">
                            Id
                        </th>
                        <th style="min-width: 80px;">
                            Nombre de Capacitación
                        </th>
                        <th style="min-width: 75px;">
                            Fecha de creación
                        </th>
                        <th style="min-width: 100px;">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registers as $register)
                        <tr>
                            <td>
                                {{ $register->id }}
                            </td>
                            <td>
                                {{ $register->name }}
                            </td>
                            <td>
                                {{ $register->date }}
                            </td>
                            <td>
                                <div class="btn-group dropleft">
                                    <button class="btn p-0 m-0" type="button" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" wire:click="edit({{ $register->id }})">
                                            <div class="d-flex align-items-start">
                                                <i class="btn-top material-icons-outlined"
                                                    style="width: 24px;font-size:18px;">edit_outline</i>
                                                Editar
                                            </div>
                                        </a>
                                        {{-- @if (!$register->default) --}}
                                        <a class="dropdown-item" wire:click="deleteMessage({{ $register->id }})">
                                            <div class="d-flex align-items-start">
                                                <i class="material-symbols-outlined"
                                                    style="width: 24px;font-size:18px;">delete</i>
                                                Eliminar
                                            </div>
                                        </a>
                                        {{-- @endif --}}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener('deleteMessage', event => {
            Swal.fire({
                title: "Eliminar este elemento",
                text: "¿Estás seguro de querer eliminar este registro?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí",
                cancelButtonText: "No"
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('delete');
                    // Swal.fire({
                    // title: "Eliminado",
                    // text: "El registro se eliminó exitosamente",
                    // icon: "success"
                    // });
                }
            });
        });

        document.addEventListener('livewire:init', () => {
            Livewire.on('useRegister', () => {
                // Swal.fire(
                //     'Error',
                //     'Este registro está en uso y no puede ser eliminado.',
                //     'error'
                // );
                Swal.fire({
                    title: "Error",
                    text: "Este registro está en uso y no puede ser eliminado.",
                    icon: "error"
                });
            });
            Livewire.on('registerDelete', () => {
                Swal.fire({
                    title: "Eliminado",
                    text: "El registro se eliminó exitosamente",
                    icon: "success"
                });
            });
        });
    </script>
</div>
