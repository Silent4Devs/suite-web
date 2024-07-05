<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div>
        <div class="card card-body">
            <form wire:submit.prevent="submitForm(Object.fromEntries(new FormData($event.target)))">

                <div class="info-first-config">
                    <h4 class="title-config">Unidades de medida</h4>
                    {{-- <p>Define los Valores y Escalas con los que se medirán los objetivos.</p> --}}
                    <p>Define las unidades de medida de los objetivos.</p>
                    <hr class="my-4">
                </div>

                {{-- <p>
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
                </div> --}}

                <div class="col-12">
                    <div class="form-row mt-3">
                        {{-- <div class="col-1">
                            <div class="anima-focus mb-3 ">
                                <input type="number" id="valor_estatus_1" name="valor_estatus_1"
                                    wire:model.defer="valor_estatus_1" class="form-control" placeholder=""
                                    min="{{ $minimo }}" max="{{ $maximo }}" required>
                                <label for="valor_estatus_1">Valor<sup>*</sup></label>
                            </div>
                        </div> --}}
                        <div class="col-4">
                            <div class="anima-focus mb-3 ">
                                <input type="text" id="definicion_1" name="definicion_1"
                                    wire:model.defer="definicion_1" class="form-control" placeholder="" maxlength="120"
                                    required>
                                <label for="definicion_1">Nombre de la Unidad*<sup>*</sup></label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="anima-focus mb-3 ">
                                <input type="number" id="valor_minimo_1" name="valor_minimo_1"
                                    wire:model.defer="valor_minimo_1" class="form-control" placeholder="">
                                <label for="valor_minimo_1">Valor Minimo*<sup>*</sup></label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="anima-focus mb-3 ">
                                <input type="text" id="valor_maximo_1" name="valor_maximo_1"
                                    wire:model.defer="valor_maximo_1" class="form-control" placeholder="">
                                <label for="valor_maximo_1">Valor Maximo*<sup>*</sup></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-row">
                        {{-- <div class="col-1">
                            <div class="anima-focus mb-3 ">
                                <input type="number" id="valor_estatus_2" name="valor_estatus_2"
                                    wire:model.defer="valor_estatus_2" class="form-control" placeholder=""
                                    min="{{ $minimo }}" max="{{ $maximo }}" required>
                                <label for="valor_estatus_2">Valor <sup>*</sup></label>
                            </div>
                        </div> --}}
                    </div>
                </div>
                @foreach ($parametros as $key => $p)
                    <div class="col-12">
                        <div class="form-row  mt-3 mb-3">
                            {{-- <div class="col-1">
                                <div class="anima-focus mb-3 ">
                                    <input type="number" id="valor_estatus_arreglo_{{ $key }}"
                                        name="valor_estatus_arreglo_{{ $key }}" class="form-control" placeholder=""
                                        min="{{ $minimo }}" max="{{ $maximo }}">
                                    <label for="valor_estatus_arreglo_{{ $key }}">Valor</label>
                                </div>
                            </div> --}}
                            <div class="col-4">
                                <div class="anima-focus mb-3 ">
                                    <input type="text" id="estatus_arreglo_{{ $key }}"
                                        name="estatus_arreglo_{{ $key }}" class="form-control" placeholder=""
                                        maxlength="120" wire:model="parametros.{{ $key }}.definicion">
                                    <label for="estatus_arreglo_{{ $key }}">Nombre de la Unidad*</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="anima-focus mb-3 ">
                                    <input type="number" id="maximo_{{ $key }}"
                                        name="minimo_{{ $key }}"
                                        wire:model.defer="parametros.{{ $key }}.minimo" class="form-control"
                                        placeholder="">
                                    <label for="maximo_{{ $key }}">Valor Minimo*<sup>*</sup></label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="anima-focus mb-3 ">
                                    <input type="number" id="maximo_{{ $key }}"
                                        name="maximo_{{ $key }}"
                                        wire:model.defer="parametros.{{ $key }}.maximo" class="form-control"
                                        placeholder="">
                                    <label for="maximo_{{ $key }}">Valor Maximo*<sup>*</sup></label>
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
                        <button class="btn btn-primary btn-block" type="submit">Generar Unidades</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
