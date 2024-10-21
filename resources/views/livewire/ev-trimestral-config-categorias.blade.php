<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="card card-body">
        <div class="info-first-config">
            <h4 class="title-config">Categorías</h4>
            <p>Da de alta los grupos en los que clasificaras los objetivos.</p>
            <hr class="my-4">
        </div>

        <div class="row">
            @foreach ($categoria as $key => $p)
                {{-- <div class="row"> --}}
                <div class="col-6">
                    <div class="form-row">
                        <div class="col-11">
                            <div class="anima-focus mb-3 ">
                                <input type="text" id="categoria_arreglo_{{ $key }}"
                                    name="categoria_arreglo_{{ $key }}" class="form-control" placeholder=""
                                    maxlength="120" wire:model.live="categoria.{{ $key }}.nombre"
                                    wire:change="agregarCategoria({{ $key }})">
                                <label for="categoria_arreglo_{{ $key }}">Categoría</label>
                            </div>
                        </div>
                        {{-- Cada pregunta agregada cuenta con boton de eliminacion, el key indica cual posicion tiene en el arreglo y la elimina  --}}
                        @if (!$p['ocupado'])
                            <div class="col-1">
                                <div style="text-align: end;">
                                    <button class="btn trash-button"
                                        wire:click.prevent="removeCategoria({{ $key }}, {{ $p['id'] }})">
                                        <i class="fa-regular fa-trash-can" style="color: rgb(0, 0, 0); font-size: 15pt;"
                                            title="Eliminar"></i>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <div class="col-11">
                            <div class="anima-focus mb-3 ">
                                <textarea id="descripcion_categoria_arreglo_{{ $key }}"
                                    name="descripcion_categoria_arreglo_{{ $key }}" class="form-control" placeholder=""
                                    wire:model.live="categoria.{{ $key }}.descripcion" style="height: 150px !important;"
                                    wire:change="agregarCategoria({{ $key }})" @if ($p['nombre'] == null || $p['id'] == null) disabled @endif>{{ $p['descripcion'] ?? '' }}</textarea>
                                <label for="descripcion_categoria_arreglo_{{ $key }}">Descripción</label>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
            @endforeach
        </div>
        <div class="col-3" style="justify-content: right;">
            <button class="btn btn-link" wire:click.prevent="addCategoria">
                Añadir Categoría
                <i class="bi bi-plus-circle"></i>
            </button>
        </div>
    </div>
</div>
