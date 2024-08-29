<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div>
        <div class="card card-body">
            <form wire:submit="submitForm(Object.fromEntries(new FormData($event.target)))">

                <div class="info-first-config">
                    <h4 class="title-config">Unidades de medida</h4>
                    {{-- <p>Define los Valores y Escalas con los que se medirán los objetivos.</p> --}}
                    <p>Define las unidades de medida de los objetivos.</p>
                    <hr class="my-4">
                </div>

                @foreach ($parametros as $key => $p)
                    <div class="col-12">
                        <div class="form-row  mt-3 mb-3">
                            <div class="col-4">
                                <div class="anima-focus mb-3 ">
                                    <input type="text" id="estatus_arreglo_{{ $key }}"
                                        name="estatus_arreglo_{{ $key }}" class="form-control" placeholder=""
                                        maxlength="120" wire:model.live="parametros.{{ $key }}.definicion"
                                        wire:change="agregarUnidad({{ $key }})">
                                    <label for="estatus_arreglo_{{ $key }}">Nombre de la Unidad*</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="anima-focus mb-3 ">
                                    <input type="number" id="maximo_{{ $key }}"
                                        name="minimo_{{ $key }}"
                                        wire:model="parametros.{{ $key }}.minimo" class="form-control"
                                        placeholder="" wire:change="agregarUnidad({{ $key }})"
                                        @if ($parametros[$key]['definicion'] == null || $parametros[$key]['id'] == null) disabled @endif>
                                    <label for="maximo_{{ $key }}">Valor Minimo*<sup>*</sup></label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="anima-focus mb-3 ">
                                    <input type="number" id="maximo_{{ $key }}"
                                        name="maximo_{{ $key }}"
                                        wire:model="parametros.{{ $key }}.maximo" class="form-control"
                                        placeholder="" wire:change="agregarUnidad({{ $key }})"
                                        @if ($parametros[$key]['definicion'] == null || $parametros[$key]['id'] == null) disabled @endif>
                                    <label for="maximo_{{ $key }}">Valor Maximo*<sup>*</sup></label>
                                </div>
                            </div>
                            @if (!$parametros[$key]['utilizado'])
                                <div class="col-1">
                                    {{-- Cada pregunta agregada cuenta con boton de eliminacion, el key indica cual posicion tiene
                                    en el arreglo y la elimina  --}}
                                    <div style="text-align: end;">
                                        <button class="btn trash-button"
                                            wire:click.prevent="removeUnidad({{ $key }})">
                                            <i class="fa-regular fa-trash-can"
                                                style="color: rgb(0, 0, 0); font-size: 15pt;" title="Eliminar"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
                <div class="col-3" style="justify-content: right;">
                    <button class="btn btn-link" wire:click.prevent="addUnidad">
                        Añadir Unidad
                        <i class="bi bi-plus-circle"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
