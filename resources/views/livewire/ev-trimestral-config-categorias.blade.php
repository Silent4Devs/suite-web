<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="card card-body">
        <div class="info-first-config">
            <h4 class="title-config">Categorias</h4>
            <p>Da de alta los grupos en los que clasificaras los objetivos.</p>
            <hr class="my-4">
        </div>

        <form wire:submit.prevent="submitForm(Object.fromEntries(new FormData($event.target)))">
            <div class="row">
                @foreach ($categoria as $key => $p)
                    {{-- <div class="row"> --}}
                    <div class="col-6">
                        <div class="form-row">
                            <div class="col-11">
                                <div class="anima-focus mb-3 ">
                                    <input type="text" id="categoria_arreglo_{{ $key }}"
                                        name="categoria_arreglo_{{ $key }}" class="form-control" placeholder=""
                                        maxlength="120" value="{{ $p['nombre'] ?? '' }}"
                                        wire:change="editRegistro($event.target.value, 'nombre', {{ $p['id'] ?? 'null' }}, {{ $key }})">
                                    <label for="categoria_arreglo_{{ $key }}">Categoria</label>
                                </div>
                            </div>
                            {{-- Cada pregunta agregada cuenta con boton de eliminacion, el key indica cual posicion tiene en el arreglo y la elimina  --}}
                            @if (!$p['ocupado'])
                                <div class="col-1">
                                    <div style="text-align: end;">
                                        <button class="btn trash-button"
                                            wire:click.prevent="removeCategoria({{ $key }}, {{ $p['id'] }})">
                                            <i class="fa-regular fa-trash-can"
                                                style="color: rgb(0, 0, 0); font-size: 15pt;" title="Eliminar"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                            <div class="col-11">
                                <div class="anima-focus mb-3 ">
                                    <textarea id="descripcion_categoria_arreglo_{{ $key }}"
                                        name="descripcion_categoria_arreglo_{{ $key }}" class="form-control" placeholder=""
                                        style="height: 150px !important;"
                                        wire:change="editRegistro($event.target.value, 'descripcion', {{ $p['id'] ?? 'null' }}, {{ $key }})">{{ $p['descripcion'] ?? '' }}</textarea>
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
                    Añadir Criterio
                    <i class="bi bi-plus-circle"></i>
                </button>
            </div>

            {{-- <div class="grid-config-categorias mt-4">

            <div class="item-config-cat">
                <div class="d-flex align-items-center" style="gap: 10px;">
                    <div class="form-group anima-focus" style="width: 85%;">
                        <input type="text" class="form-control anima-focus" placeholder="">
                        <label for="">Categoría</label>
                    </div>
                    <div class="btn-delete-cat">
                        <i class="material-symbols-outlined" title="Eliminar"
                            onclick="deleteItem('item-config-cat')">delete</i>
                    </div>
                </div>
                <div class="form-group anima-focus" style="width: 85%;">
                    <textarea name="" id="" class="form-control" placeholder=""></textarea>
                    <label for="">Descripción</label>
                </div>
            </div>
        </div> --}}

            <div class="d-flex justify-content-between align-items-center">
                {{-- <div class="d-flex align-items-center mt-4" style="color: #006DDB; gap: 10px; cursor: pointer;"
                onclick="addItem('item-config-cat', 'grid-config-categorias')">
                <span class="material-symbols-outlined">add_circle</span>
                Agregar Categoría
            </div> --}}
                {{-- <button class="btn btn-primary" type="submit">
                    GUARDAR
                </button> --}}
            </div>
        </form>
    </div>
</div>
