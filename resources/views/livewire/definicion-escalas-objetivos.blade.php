<div>
    <div class="card card-body">
        <form wire:submit="submitForm(Object.fromEntries(new FormData($event.target)))">

            <div class="info-first-config">
                <h4 class="title-config">Escalas de medición</h4>
                <p>Define las Escalas con las que se calificaran los objetivos.</p>
                <hr class="my-4">
            </div>

            <div class="col-12">
                <div class="form-row">
                    <div class="col-1">
                        <div class="anima-focus mb-3 ">
                            <input type="number" id="valor_estatus_1" name="valor_estatus_1"
                                wire:model="valor_estatus_1" class="form-control" placeholder="" required>
                            <label for="valor_estatus_1">Valor<sup>*</sup></label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="anima-focus mb-3 ">
                            <input type="text" id="estatus_1" name="estatus_1" wire:model="estatus_1"
                                class="form-control" placeholder="" maxlength="120" required>
                            <label for="estatus_1">Nombre de la escala*<sup>*</sup></label>
                        </div>
                    </div>
                    <div class="col-1 color-picker">
                        <div class="anima-focus">
                            <input type="color" id="color_estatus_1" name="color_estatus_1"
                                wire:model="color_estatus_1" class="color-input form-control"
                                title="Seleccione un color" placeholder="">
                            <label for="color_estatus_1">Color*</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-row">
                    <div class="col-1">
                        <div class="anima-focus mb-3 ">
                            <input type="number" id="valor_estatus_2" name="valor_estatus_2"
                                wire:model="valor_estatus_2" class="form-control" placeholder="" required>
                            <label for="valor_estatus_2">Valor <sup>*</sup></label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="anima-focus mb-3 ">
                            <input type="text" id="estatus_2" name="estatus_2" wire:model="estatus_2"
                                class="form-control" placeholder="" maxlength="120" required>
                            <label for="estatus_2">Nombre de la escala* <sup>*</sup></label>
                        </div>
                    </div>
                    <div class="col-1 color-picker">
                        <div class="anima-focus">
                            <input type="color" id="color_estatus_2" name="color_estatus_2"
                                wire:model="color_estatus_2" class="color-input form-control"
                                title="Seleccione un color" placeholder="">
                            <label for="color_estatus_2">Color*</label>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($parametros as $key => $p)
                <div class="col-12">
                    <div class="form-row">
                        <div class="col-1">
                            <div class="anima-focus mb-3 ">
                                <input type="number" id="valor_estatus_arreglo_{{ $key }}"
                                    name="valor_estatus_arreglo_{{ $key }}" class="form-control" placeholder=""
                                    wire:model.live="parametros.{{ $key }}.valor">
                                <label for="valor_estatus_arreglo_{{ $key }}">Valor</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="anima-focus mb-3 ">
                                <input type="text" id="estatus_arreglo_{{ $key }}"
                                    name="estatus_arreglo_{{ $key }}" class="form-control" placeholder=""
                                    maxlength="120" wire:model.live="parametros.{{ $key }}.parametro">
                                <label for="estatus_arreglo_{{ $key }}">Nombre de la escala*</label>
                            </div>
                        </div>
                        <div class="col-1 color-picker">
                            <div class="anima-focus">
                                <input type="color" id="color_estatus_arreglo_{{ $key }}"
                                    name="color_estatus_arreglo_{{ $key }}" class="color-input form-control"
                                    title="Seleccione un color" placeholder=""
                                    wire:model.live="parametros.{{ $key }}.color_estatus">
                                <label for="color_estatus_{{ $key }}">Color*</label>
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
                    <button class="btn btn-primary btn-block" type="submit">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
