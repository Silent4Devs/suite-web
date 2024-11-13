<div>
    <style>
        .containerFile {
            height: 100px;
            width: 100%;
            border-radius: 6px;
            border: 1px dashed #999;
        }
    </style>
    <div class="card">
        <div class="card-body">
            <h4 class="color-tbj">Capacitaciones</h4>
            <hr>
            <form wire:submit="{{ $status === 'create' ? 'save' : 'edit' }}">
                <div class="row" style="padding-left: 14px;">
                    <div class="col-12 col-sm-6 form-group  pl-0 anima-focus">
                        <select id="type" style="max-width:614px; width:100%;" class="form-control" name="type"
                            wire:model.live="form.type_id" wire:change="getCatalogueName" required>
                            <option value="" selected>
                                -- Selecciona una opción --
                            </option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="type">Tipo de capacitación*</label>
                    </div>
                    <div class="col-12 col-sm-6 form-group pl-0 anima-focus">
                        <select id="name" style="max-width:614px; width:auto;" class="form-control" name="name"
                            wire:model.live="form.name_id" required>
                            <option value="" selected>
                                -- Selecciona una opción --
                            </option>
                            @if ($names->isNotEmpty())
                                @foreach ($names as $name)
                                    <option value="{{ $name->id }}">
                                        {{ $name->name }}
                                    </option>
                                @endforeach
                            @else
                                <option value="" disabled>
                                    -- Sin opciones --
                                </option>
                            @endif
                        </select>
                        <label for="name">Nombre de la capacitación*</label>
                    </div>
                    @if ($form->type_id === '1')
                        <div class=" col-12 col-sm-6 form-group pl-0 anima-focus">
                            <input id="credential_id" class="form-control" placeholder="" name="credential_id"
                                type="text" wire:model.live="form.credential_id" required>
                            <label for="credential_id">ID de la credencial*</label>
                        </div>
                        <div class=" col-12 col-sm-6 form-group pl-0 anima-focus">
                            <input id="credential_url" class="form-control" placeholder="" name="credential_url"
                                type="text" wire:model.live="form.credential_url" required>
                            <label for="credential_url">URL de la credencial*</label>
                        </div>
                        <div class="d-flex align-items-center col-12 col-sm-2 " style="margin-bottom: 25px;">
                            <input class="form-control mr-3" style="height: 18px; width:18px;" type="checkbox"
                                value="" id="flexCheckDefault" {{ $form->isChecked ? 'checked' : null }}
                                wire:change='chanceChecked'>
                            <label class="form-check-label" for="flexCheckDefault">
                                ¿Aplica vigencia?
                            </label>
                        </div>
                        <div class="col-6 col-sm-3 form-group pl-0 anima-focus">
                            <input id="validity" type='date' class="form-control" placeholder="" name="validity"
                                type="text" wire:model.live="form.validity"
                                {{ $form->isChecked ? null : 'disabled' }} wire:change='verifyStatus'>
                            <label for="validity">Vigencia</label>
                        </div>
                        <div class="col-6 col-sm-3 form-group pl-0 anima-focus">
                            <input id="validityStatus" type='text' class="form-control" placeholder=""
                                name="validityStatus" type="text" wire:model.live="form.validityStatus"
                                {{ $form->isChecked ? null : 'disabled' }}
                                style="{{ $form->isChecked ? null : 'background-color:white;' }}" readonly>
                            <label for="validityStatus">Estatus</label>
                        </div>
                    @else
                        <div class="col-6 col-sm-3 form-group pl-0 anima-focus">
                            <input id="dateStart" type='date' class="form-control" placeholder="" name="dateStart"
                                wire:model.live="form.startDate" required>
                            <label for="dateStart">Fecha inicio*</label>
                        </div>
                        <div class="col-6 col-sm-3 form-group pl-0 anima-focus">
                            <input id="endDate" type='date' class="form-control" placeholder="" name="endDate"
                                wire:model.live="form.endDate" required>
                            <label for="endDate">Fecha Fin*</label>
                        </div>
                    @endif
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalTraining"
                        style="height: 45px; background-color: #E2E2E2 ; border: 1px solid #707070; border-radius: 4px; color:#575757;">Dar
                        de alta capacitación</button>
                </div>
                <div>
                    <label class="containerFile d-flex align-items-center pl-3" for="pdf">
                        <input type="file" id="pdf" wire:model.live="form.document"
                            {{ $status === 'edit' ? 'required' : null }}>
                    </label>
                </div>

                <div class="col-12 d-flex justify-content-end mt-3">
                    <button class="btn btn-primary"
                        style="height: 45px; background-color: #057BE2; color:#FFFFFF; border: 1px solid #707070; border-radius: 4px;"
                        type="submit"> {{ $status === 'create' ? 'Agregar' : 'Editar' }}</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
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
                        <th>
                            Fecha Inicio
                        </th>
                        <th>
                            Fecha Fin
                        </th>
                        <th>
                            Vigencia
                        </th>
                        <th>
                            Archivo
                        </th>
                        <th>
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
                                {{ $register->getName->name }}
                            </td>
                            <td>
                                {{ $register->category->name }}
                            </td>
                            <td>
                                {{ $register->start_date }}
                            </td>
                            <td>
                                {{ $register->end_date }}
                            </td>
                            <td>
                                {{ $register->validity ? $register->validity : 'sin datos registrados' }}
                            </td>
                            <td>
                                @if ($register->evidence_id)
                                    <button class="btn btn-primary"
                                        style="height: 45px; background-color: #E2E2E2 ; border: 1px solid #707070; border-radius: 4px; color:#575757;"
                                        type="button" wire:click="downloadEvidencie({{ $register->evidence_id }})">
                                        Descargar Archivo</button>
                                @else
                                    Sin evidencia
                                @endif
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

    <!-- Modal -->
    <div class="modal fade" id="modalTraining" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                {{-- <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
                <div class="modal-body">
                    <h5 style="color:var(--color-tbj);">Agregar tipo de Capacitación</h5>
                    <hr>
                    <form wire:submit="saveModal">
                        <div class="form-group pl-0 anima-focus">
                            <input id="nameModal" class="form-control" placeholder="" name="name" type="text"
                                wire:model.live="modalForm.name" required>
                            <label for="name">Nombre de la Capacitación*</label>
                        </div>
                        <div class="form-group pl-0 anima-focus">
                            <select id="typeModal" class="form-control" name="type"
                                wire:model.live="modalForm.type_id" required>
                                <option value="" selected>
                                    -- Selecciona una opción --
                                </option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="type">Tipo de capacitación*</label>
                        </div>
                        <div class="form-group pl-0 anima-focus">
                            <input id="issuing_company" class="form-control" placeholder="" name="issuing_company"
                                type="text" wire:model.live="modalForm.issuing_company" required>
                            <label for="issuing_company">Empresa emisora*</label>
                        </div>
                        <div class="form-group pl-0 anima-focus">
                            <input id="mark" class="form-control" placeholder="" name="mark" type="text"
                                wire:model.live="modalForm.mark" required>
                            <label for="mark">Marca</label>
                        </div>
                        <div class="form-group pl-0 anima-focus">
                            <input id="manufacturer" class="form-control" placeholder="" name="manufacturer"
                                type="text" wire:model.live="modalForm.manufacturer" required>
                            <label for="manufacturer">Fabricante</label>
                        </div>
                        <div class="form-group pl-0 anima-focus">
                            <input id="norma" class="form-control" placeholder="" name="norma" type="text"
                                wire:model.live="modalForm.norma" required>
                            <label for="norma">Norma</label>
                        </div>
                        <button class="btn btn-primary"
                            style="height: 45px; background-color: #E2E2E2 ; border: 1px solid #707070; border-radius: 4px; color:#575757;"
                            type="submit">ENVIAR A APROBACIÓN</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
