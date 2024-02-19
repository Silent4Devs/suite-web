<div>
    <form wire:submit.prevent="submitForm(Object.fromEntries(new FormData($event.target)))">
        <div class="card card-body mt-5">
            <div style="color:#306BA9; font-size:16px;">Datos Generales</div>
            <hr style="">
            <div class="row">
                <div class="col-md-6">
                    <div class="anima-focus mb-3 ">
                        <input type="text" class="form-control" placeholder="" id="nombre" name="nombre"
                            wire:model.defer="nombre" maxlength="120" required>
                        <label for="nombre">Nombre del Catalogo <sup>*</sup></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="anima-focus mb-3">
                        <textarea class="form-control" id="descripcion" name="descripcion" wire:model.defer="descripcion" placeholder=""
                            style="height: 150px !important;"></textarea>
                        <label for="">Descripción</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-body mt-5">
            <div class="col-m-12" style="color:#306BA9; font-size:16px;">
                Define el valor de los parámetros con los que se evaluará tu cuestionario
            </div>
            <div class="col-m-12 mt-3" style="font: italic 14px Roboto;">
                Estatus: Define el nombre de tu parámetro
            </div>
            <div class="col-m-12 mt-3" style="font: italic 14px Roboto;">
                Valor: Agrega el valor de tu parámetro con los que se evaluará tu cuestionario
            </div>
            <br>
            <div class="row">
                <div class="form-row">
                    <div class="col-1 color-picker">
                        <input type="color" id="color_estatus_1" name="color_estatus_1"
                            wire:model.defer="color_estatus_1" class="color-input form-control"
                            title="Seleccione un color">
                    </div>
                    <div class="col-3">
                        <div class="anima-focus mb-3 ">
                            <input type="text" id="estatus_1" name="estatus_1" wire:model.defer="estatus_1"
                                class="form-control" placeholder="" maxlength="120" required>
                            <label for="estatus_1">Estatus<sup>*</sup></label>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="anima-focus mb-3 ">
                            <input type="number" id="valor_estatus_1" name="valor_estatus_1"
                                wire:model.defer="valor_estatus_1" class="form-control" placeholder="" required>
                            <label for="valor_estatus_1">Valor<sup>*</sup></label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="anima-focus mb-3 ">
                            <input type="text" id="descripcion_parametros_1" name="descripcion_parametros_1"
                                wire:model.defer="descripcion_parametros_1" class="form-control" placeholder="">
                            <label for="descripcion_parametros_1">Descripción</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-row">
                    <div class="col-1 color-picker">
                        <input type="color" id="color_estatus_2" name="color_estatus_2"
                            wire:model.defer="color_estatus_2" class="color-input form-control"
                            title="Seleccione un color">
                    </div>
                    <div class="col-3">
                        <div class="anima-focus mb-3 ">
                            <input type="text" id="estatus_2" name="estatus_2" wire:model.defer="estatus_2"
                                class="form-control" placeholder="" maxlength="120" required>
                            <label for="estatus_2">Estatus <sup>*</sup></label>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="anima-focus mb-3 ">
                            <input type="number" id="valor_estatus_2" name="valor_estatus_2"
                                wire:model.defer="valor_estatus_2" class="form-control" placeholder="" required>
                            <label for="valor_estatus_2">Valor <sup>*</sup></label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="anima-focus mb-3 ">
                            <input type="text" id="descripcion_parametros_2" name="descripcion_parametros_2"
                                wire:model.defer="descripcion_parametros_2" class="form-control" placeholder="">
                            <label for="descripcion_parametros_2">Descripción</label>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($parametros as $key => $p)
                <div class="row">
                    <div class="form-row">
                        <div class="col-1 color-picker">
                            <input type="color" id="color_estatus_arreglo_{{ $key }}"
                                name="color_estatus_arreglo_{{ $key }}" class="color-input form-control"
                                title="Seleccione un color">
                        </div>
                        <div class="col-3">
                            <div class="anima-focus mb-3 ">
                                <input type="text" id="estatus_arreglo_{{ $key }}"
                                    name="estatus_arreglo_{{ $key }}" class="form-control" placeholder=""
                                    maxlength="120">
                                <label for="estatus_arreglo_{{ $key }}">Estatus</label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="anima-focus mb-3 ">
                                <input type="number" id="valor_estatus_arreglo_{{ $key }}"
                                    name="valor_estatus_arreglo_{{ $key }}" class="form-control"
                                    placeholder="">
                                <label for="valor_estatus_arreglo_{{ $key }}">Valor</label>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="anima-focus mb-3 ">
                                <input type="text" id="descripcion_parametros_arreglo_{{ $key }}"
                                    name="descripcion_parametros_arreglo_{{ $key }}" class="form-control"
                                    placeholder="">
                                <label for="descripcion_parametros_arreglo_{{ $key }}">Descripción</label>
                            </div>
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
                    Añadir Criterio
                    <i class="bi bi-plus-circle"></i>
                </button>
            </div>
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
