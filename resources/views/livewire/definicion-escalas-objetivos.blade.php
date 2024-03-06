<div class="col-12">
    <form wire:submit.prevent="submitForm(Object.fromEntries(new FormData($event.target)))">

        <div class="col-12">
            <p class="mt-4">
                Escalas <br>
                Define las escalas de medición y asigna su Valor y Nombre
            </p>
            <div class="form-row">
                <div class="col-4">
                    <div class="anima-focus mb-3 ">
                        <input type="number" id="valor_estatus_1" name="valor_estatus_1"
                            wire:model.defer="valor_estatus_1" class="form-control" placeholder="" required>
                        <label for="valor_estatus_1">Valor<sup>*</sup></label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="anima-focus mb-3 ">
                        <input type="text" id="estatus_1" name="estatus_1" wire:model.defer="estatus_1"
                            class="form-control" placeholder="" maxlength="120" required>
                        <label for="estatus_1">Estatus<sup>*</sup></label>
                    </div>
                </div>
                <div class="col-2 color-picker">
                    <input type="color" id="color_estatus_1" name="color_estatus_1" wire:model.defer="color_estatus_1"
                        class="color-input form-control" title="Seleccione un color">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-row">
                <div class="col-4">
                    <div class="anima-focus mb-3 ">
                        <input type="number" id="valor_estatus_2" name="valor_estatus_2"
                            wire:model.defer="valor_estatus_2" class="form-control" placeholder="" required>
                        <label for="valor_estatus_2">Valor <sup>*</sup></label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="anima-focus mb-3 ">
                        <input type="text" id="estatus_2" name="estatus_2" wire:model.defer="estatus_2"
                            class="form-control" placeholder="" maxlength="120" required>
                        <label for="estatus_2">Estatus <sup>*</sup></label>
                    </div>
                </div>
                <div class="col-2 color-picker">
                    <input type="color" id="color_estatus_2" name="color_estatus_2" wire:model.defer="color_estatus_2"
                        class="color-input form-control" title="Seleccione un color">
                </div>
            </div>
        </div>
        @foreach ($parametros as $key => $p)
            <div class="col-12">
                <div class="form-row">
                    <div class="col-4">
                        <div class="anima-focus mb-3 ">
                            <input type="number" id="valor_estatus_arreglo_{{ $key }}"
                                name="valor_estatus_arreglo_{{ $key }}" class="form-control" placeholder="">
                            <label for="valor_estatus_arreglo_{{ $key }}">Valor</label>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="anima-focus mb-3 ">
                            <input type="text" id="estatus_arreglo_{{ $key }}"
                                name="estatus_arreglo_{{ $key }}" class="form-control" placeholder=""
                                maxlength="120">
                            <label for="estatus_arreglo_{{ $key }}">Estatus</label>
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
                            <button class="btn trash-button" wire:click.prevent="removeParametro1({{ $key }})">
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
                <a href="{{ route('admin.rangos.index') }}" class="btn btn-outline-primary btn-block">Cancelar</a>
            </div>
            <div class="col-3">
                <button class="btn btn-primary btn-block" type="submit">Generar Catalogo</button>
            </div>
    </form>
</div>

@livewireScripts()
