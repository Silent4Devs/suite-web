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
                                            <div class="d-flex align-items-start">
                                                <i class="material-icons-outlined"
                                                    style="width: 24px;font-size:18px;">edit_outline</i>
                                                Editar
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
