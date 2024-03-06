<div>
    <div class="card card-body">
        <form wire:submit.prevent="submitForm(Object.fromEntries(new FormData($event.target)))">

            <div class="info-first-config">
                <h4 class="title-config">Escalas de medición</h4>
                <p>Define los Valores y Escalas con los que se medirán los objetivos.</p>
                <hr class="my-4">
            </div>

            <p>
                Rango <br>
                Especifica el valor mínimo y máximo que tendrá la escala de medición
            </p>

            <div class="d-flex" style="gap: 10px;">
                <div class="form-group anima-focus" style="width: 100px;">
                    <input type="text" class="form-control" placeholder="" wire:model.defer="minimo" name="minimo"
                        wire:change="definirLimite('minimo', $event.target.value)">
                    <label for="">Mínimo*</label>
                </div>
                <div class="form-group anima-focus" style="width: 100px;">
                    <input type="text" class="form-control" placeholder="" wire:model.defer="maximo" name="maximo"
                        wire:change="definirLimite('maximo', $event.target.value)">
                    <label for="">Máximo*</label>
                </div>
            </div>

            <div class="col-12">
                <p class="mt-4">
                    Escalas <br>
                    Define las escalas de medición y asigna su Valor y Nombre
                </p>
                <div class="form-row">
                    <div class="col-4">
                        <div class="anima-focus mb-3 ">
                            <input type="number" id="valor_estatus_1" name="valor_estatus_1"
                                wire:model.defer="valor_estatus_1" class="form-control" placeholder=""
                                min="{{ $minimo }}" max="{{ $maximo }}" required>
                            <label for="valor_estatus_1">Valor<sup>*</sup></label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="anima-focus mb-3 ">
                            <input type="text" id="estatus_1" name="estatus_1" wire:model.defer="estatus_1"
                                class="form-control" placeholder="" maxlength="120" required>
                            <label for="estatus_1">Nombre de la escala*<sup>*</sup></label>
                        </div>
                    </div>
                    <div class="col-2 color-picker">
                        <input type="color" id="color_estatus_1" name="color_estatus_1"
                            wire:model.defer="color_estatus_1" class="color-input form-control"
                            title="Seleccione un color">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-row">
                    <div class="col-4">
                        <div class="anima-focus mb-3 ">
                            <input type="number" id="valor_estatus_2" name="valor_estatus_2"
                                wire:model.defer="valor_estatus_2" class="form-control" placeholder=""
                                min="{{ $minimo }}" max="{{ $maximo }}" required>
                            <label for="valor_estatus_2">Valor <sup>*</sup></label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="anima-focus mb-3 ">
                            <input type="text" id="estatus_2" name="estatus_2" wire:model.defer="estatus_2"
                                class="form-control" placeholder="" maxlength="120" required>
                            <label for="estatus_2">Nombre de la escala* <sup>*</sup></label>
                        </div>
                    </div>
                    <div class="col-2 color-picker">
                        <input type="color" id="color_estatus_2" name="color_estatus_2"
                            wire:model.defer="color_estatus_2" class="color-input form-control"
                            title="Seleccione un color">
                    </div>
                </div>
            </div>
            @foreach ($parametros as $key => $p)
                <div class="col-12">
                    <div class="form-row">
                        <div class="col-4">
                            <div class="anima-focus mb-3 ">
                                <input type="number" id="valor_estatus_arreglo_{{ $key }}"
                                    name="valor_estatus_arreglo_{{ $key }}" class="form-control" placeholder=""
                                    min="{{ $minimo }}" max="{{ $maximo }}">
                                <label for="valor_estatus_arreglo_{{ $key }}">Valor</label>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="anima-focus mb-3 ">
                                <input type="text" id="estatus_arreglo_{{ $key }}"
                                    name="estatus_arreglo_{{ $key }}" class="form-control" placeholder=""
                                    maxlength="120">
                                <label for="estatus_arreglo_{{ $key }}">Nombre de la escala*</label>
                            </div>
                        </div>
                        <div class="col-2 color-picker">
                            <input type="color" id="color_estatus_arreglo_{{ $key }}"
                                name="color_estatus_arreglo_{{ $key }}" class="color-input form-control"
                                title="Seleccione un color">
                        </div>
                        <div class="col-1">
                            {{-- Cada pregunta agregada cuenta con boton de eliminacion, el key indica cual posicion tiene
                                en el arreglo y la elimina  --}}
                            <div style="text-align: end;">
                                <button class="btn trash-button"
                                    wire:click.prevent="removeParametro1({{ $key }})">
                                    <i class="fa-regular fa-trash-can" style="color: rgb(0, 0, 0); font-size: 15pt;"
                                        title="Eliminar"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-3" style="justify-content: right;">
                <button class="btn btn-link" wire:click.prevent="addParametro1">
                    Añadir Escala
                    <i class="bi bi-plus-circle"></i>
                </button>
            </div>

            <div class="row">
                <div class="col-6">
                </div>
                <div class="col-3">
                    <a href="{{ route('admin.rangos.index') }}"
                        class="btn btn-outline-primary btn-block">Cancelar</a>
                </div>
                <div class="col-3">
                    <button class="btn btn-primary btn-block" type="submit">Generar Catalogo</button>
                </div>
        </form>
    </div>

</div>
{{-- <div class="card card-body">
    <div class="info-first-config">
        <h4 class="title-config">Escalas de medición</h4>
        <p>Define los Valores y Escalas con los que se medirán los objetivos.</p>
        <hr class="my-4">
    </div>

    <p>
        Rango <br>
        Especifica el valor mínimo y máximo que tendrá la escala de medición
    </p>

    <div class="d-flex" style="gap: 10px;">
        <div class="form-group anima-focus" style="width: 100px;">
            <input type="text" class="form-control" placeholder="">
            <label for="">Mínimo*</label>
        </div>
        <div class="form-group anima-focus" style="width: 100px;">
            <input type="text" class="form-control" placeholder="">
            <label for="">Máximo*</label>
        </div>
    </div>

    <p class="mt-4">
        Escalas <br>
        Define las escalas de medición y asigna su Valor y Nombre
    </p>
    <div class="caja-items-config-escalas">
        <div class="item-config-escala">
            <div class="d-flex align-items-center" style="gap: 10px;">
                <div class="form-group anima-focus" style="width: 100px;">
                    <input type="text" class="form-control" placeholder="">
                    <label for="">Valor*</label>
                </div>
                <div class="form-group anima-focus" style="width: 300px;">
                    <input type="text" class="form-control" placeholder="">
                    <label for="">Nombre de la escala*</label>
                </div>
                <div class="form-group anima-focus" style="width: 100px;">
                    <input type="color" class="form-control" placeholder="">
                    <label for="">Color</label>
                </div>
                <div class="btn-delete-escala">
                    <i class="material-symbols-outlined" title="Eliminar"
                        onclick="deleteItem('item-config-escala')">delete</i>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center mt-4" style="color: #006DDB; gap: 10px; cursor: pointer;"
            onclick="addItem('item-config-escala', 'caja-items-config-escalas')">
            <span class="material-symbols-outlined">add_circle</span>
            Agregar Categoría
        </div>

        <button class="btn btn-primary">
            GUARDAR
        </button>
    </div>
</div> --}}
