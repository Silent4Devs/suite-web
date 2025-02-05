<div>
    <div class="card">
        <div class="card-body">
            <h5 class="color-tbj">Capacitaciones</h5>
            <hr>
            <form wire:submit="{{ $status === 'create' ? 'save' : 'edit' }}">
                <div class="form-group pl-0 anima-focus">
                    <input id="inputName" class="form-control" placeholder="" name="name" type="text"
                        wire:model.live="form.name" required>
                    <label for="name">Nombre de la Capacitación*</label>
                </div>
                <div class="form-group pl-0 anima-focus">
                    <select class="form-control" name="type" wire:model.live="form.type_id" required>
                        <option value="" selected>
                            -- Selecciona una opción --
                        </option>
                        @foreach ($typesCatalogue as $typeCatalogue)
                            <option value="{{ $typeCatalogue->id }}">
                                {{ $typeCatalogue->name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="type">Tipo de capacitación*</label>
                </div>
                <div class="form-group pl-0 anima-focus">
                    <input id="inputName" class="form-control" placeholder="" name="name" type="text"
                        wire:model.live="form.issuing_company" required>
                    <label for="name">Empresa emisora*</label>
                </div>
                <div class="form-group pl-0 anima-focus">
                    <input id="inputName" class="form-control" placeholder="" name="name" type="text"
                        wire:model.live="form.mark">
                    <label for="name">Marca</label>
                </div>
                <div class="form-group pl-0 anima-focus">
                    <input id="inputName" class="form-control" placeholder="" name="name" type="text"
                        wire:model.live="form.manufacturer">
                    <label for="name">Fabricante</label>
                </div>
                <div class="form-group pl-0 anima-focus">
                    <input id="inputName" class="form-control" placeholder="" name="name" type="text"
                        wire:model.live="form.norma">
                    <label for="name">Norma</label>
                </div>
                <div class="text-end">
                    <button class="btn btn-primary"
                        type="submit">{{ $status === 'create' ? 'Agregar a capacitación' : 'Editar capacitación' }}</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5>Catálogo de Capacitaciones</h5>
            <hr>
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <span>Mostrando</span>
                            <select name="" id="" class="form-control ml-2" wire:model.live="perPage">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>

                        </div>
                        <input type="text" class="form-control" placeholder="Buscar..." wire:model.live="search"
                            style="max-width: 150px;">
                    </div>
                </div>
            </div>
            <table class="table table-bordered w-100 tblCSV">
                <thead class="thead-dark">
                    <tr>
                        <th style="min-width: 75px;">
                            Id
                        </th>
                        <th style="min-width: 100px;">
                            Nombre de Capacitación
                        </th>
                        <th style="min-width: 75px;">
                            Tipo
                        </th>
                        <th style="min-width: 100px;">
                            Empresa emisora
                        </th>
                        <th style="min-width: 100px;">
                            Marca
                        </th>
                        <th style="min-width: 100px;">
                            Fabricante
                        </th>
                        <th style="min-width: 100px;">
                            Norma
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
                                {{ $register->category->name }}
                            </td>
                            <td>
                                {{ $register->issuing_company }}
                            </td>
                            <td>
                                {{ $register->mark }}
                            </td>
                            <td>
                                {{ $register->manufacturer }}
                            </td>
                            <td>
                                {{ $register->norma }}
                            </td>
                            <td>
                                <div class="btn-group dropleft">
                                    <button class="btn p-0 m-0" type="button" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" wire:click="getRegister({{ $register->id }})">
                                            <div class="d-flex align-items-center">
                                                <i class="material-icons-outlined"
                                                    style="width: 24px;font-size:18px;">edit_outline</i>
                                                Editar
                                            </div>
                                        </a>
                                        <a class="dropdown-item" wire:click="deleteMessage({{ $register->id }})">
                                            <div class="d-flex align-items-center">
                                                <i class="material-symbols-outlined"
                                                    style="width: 24px;font-size:18px;">delete</i>
                                                Eliminar
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div >
                {{ $registers->links('pagination::TbPagination') }}
            </div>
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

                }
            });
        });

        document.addEventListener('livewire:init', () => {
            Livewire.on('useRegister', () => {

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
