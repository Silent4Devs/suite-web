<div>

    <div class="row">
        <div class="form-group col-sm-6">
            <label class="required" for="nombre"><i class="fas fa-building iconos-crear"></i>Nombre del
                indicador</label>
            <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre"
                id="nombre" value="{{ old('nombre', $indicadoresSgsis->nombre) }}" disabled>
            @if ($errors->has('nombre'))
                <div class="invalid-feedback">
                    {{ $errors->first('nombre') }}
                </div>
            @endif
            <span class="help-block"></span>
        </div>

        <div class="form-group col-sm-4">
            <div class="form-group">
                <label for="id_proceso"><i class="fas fa-building iconos-crear"></i>Proceso</label>
                <select class="form-control select2 {{ $errors->has('id_proceso') ? 'is-invalid' : '' }}"
                    name="id_proceso" id="id_proceso" disabled>
                    @foreach ($procesos as $proceso)
                        <option {{ $proceso->id == $indicadoresSgsis->id_proceso ? 'selected' : '' }}>
                            {{ $proceso->codigo }}/{{ $proceso->nombre }}</option>
                    @endforeach
                </select>
                @if ($errors->has('organizacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('organizacion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sede.fields.organizacion_helper') }}</span>
            </div>
        </div>

        <div class="form-group col-sm-2">
            <div class="form-group">
                <label for="meta"><i class="fas fa-building iconos-crear"></i>Meta</label>
                <input class="form-control {{ $errors->has('meta') ? 'is-invalid' : '' }}" type="text" name="meta"
                    id="meta" value="{{ old('meta', $indicadoresSgsis->meta) }}" disabled>
                @if ($errors->has('meta'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meta') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Variable</th>
            <th>Valor</th>
            <th>Acciones</th>
        </tr>

        @foreach ($variables as $key => $value)
            <tr>
                <td>{{ $value->variable }}</td>
                <td>{{ $value->valor }}</td>
                <td>
                    <button class="btn btn-primary btn-sm btnAñadir" value="{{ $value->valor }}">
                        Usar variable
                    </button>
                    <button class="btn btn-danger btn-sm">
                        Eliminar variable
                    </button>
                </td>
            </tr>
        @endforeach

    </table>

    <form>
        <div class="row">

            <div class="form-group col-sm-8">
                <label class="required" for="formula"><i class="fas fa-building iconos-crear"></i>Formúla</label>
                <input class="form-control {{ $errors->has('formula') ? 'is-invalid' : '' }}" type="text"
                    name="formula" id="formula" value="{{ old('formula', $indicadoresSgsis->formula) }}"
                    wire:model="formula">
                @if ($errors->has('formula'))
                    <div class="invalid-feedback">
                        {{ $errors->first('formula') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>

            <div class="form-group col-sm-2">
                <label class="required" for="formula"><i class="fas fa-building iconos-crear"></i>Resultado</label>
                <input class="form-control {{ $errors->has('formula') ? 'is-invalid' : '' }}" type="text"
                    name="formula" id="formula" value="{{ old('formula', $indicadoresSgsis->formula) }}"
                    wire:model="formula">
                @if ($errors->has('formula'))
                    <div class="invalid-feedback">
                        {{ $errors->first('formula') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>

            <div class="form-group col-sm-2 py-4">
                <button type="button" wire:click.prevent="calculo()"
                    class="btn btn-secondary btn-sm form-control float-right">Generar
                    calcúlo</button>
            </div>

        </div>


        <div class=" add-input">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Ingresa una variable"
                            wire:model="variable.0">
                        @error('variable.0') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <input type="number" class="form-control" wire:model="valor.0"
                            placeholder="Ingresa el valor de la variable">
                        @error('valor.0') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn text-white btn-primary btn-sm"
                        wire:click.prevent="add({{ $i }})">Añadir variable</button>
                </div>
            </div>
        </div>

        @foreach ($vars as $key => $value)
            <div class=" add-input">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Ingresa una variable"
                                wire:model="variable.{{ $value }}">
                            @error('variable.' . $value) <span
                                class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="number" class="form-control" wire:model="valor.{{ $value }}"
                                placeholder="Ingresa el valor de la variable">
                            @error('valor.' . $value) <span
                                class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-danger btn-sm" wire:click.prevent="remove({{ $key }})">Remover
                            variable</button>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row">
            <div class="col-md-12">
                <button type="button" wire:click.prevent="enviarVars" class="btn btn-success btn-sm">Enviar
                    variables</button>
            </div>
        </div>
    </form>

</div>

<script>
    document.querySelectorAll("button.btnAñadir").forEach(function(elem) {
        elem.addEventListener('click', agregarTexto, false);
    });

    function agregarTexto() {
        var btnValor = this.value;
        var elInput = document.getElementById("formula");
        elInput.value += btnValor;
    }
</script>
