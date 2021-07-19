<div>
    <style>
        .dotverde {
            height: 15px;
            width: 15px;
            background-color: green;
            border-radius: 50%;
            display: inline-block;
        }

        .dotyellow {
            height: 15px;
            width: 15px;
            background-color: yellow;
            border-radius: 50%;
            display: inline-block;
        }

        .dotred {
            height: 15px;
            width: 15px;
            background-color: red;
            border-radius: 50%;
            display: inline-block;
        }

    </style>

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

        <div class="form-group col-sm-6">
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
    </div>

    <div class="row">
        <div class="form-group col-sm-8">
            <label class="required" for="formula"><i class="fas fa-building iconos-crear"></i>Formúla</label>
            <input class="form-control {{ $errors->has('formula') ? 'is-invalid' : '' }}" type="text" name="formula"
                id="formula" value="{{ old('formula', $indicadoresSgsis->formula) }}" disabled>
            @if ($errors->has('formula'))
                <div class="invalid-feedback">
                    {{ $errors->first('formula') }}
                </div>
            @endif
            <span class="help-block"></span>
        </div>

        <div class="form-group col-sm-4">
            <div class="form-group">
                <label for="meta"><i class="fas fa-building iconos-crear"></i>Meta</label>
                <input class="form-control {{ $errors->has('meta') ? 'is-invalid' : '' }}" type="text" name="meta"
                    id="meta" value="{{ old('meta', $indicadoresSgsis->meta . $indicadoresSgsis->unidadmedida) }}"
                    disabled>
                @if ($errors->has('meta'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meta') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
        </div>
    </div>

    @include('livewire.evaluaciones.table')

    <hr>
    <form wire:submit.prevent="store" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-sm-2">
                <div class="form-group">
                    <label for="evaluacion"><i class="fas fa-building iconos-crear"></i>Evaluación</label>
                    <input class="form-control {{ $errors->has('evaluacion') ? 'is-invalid' : '' }}" type="text"
                        name="evaluacion" wire:model="evaluacion" id="evaluacion">
                    @if ($errors->has('evaluacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('evaluacion') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group col-md-2 col-sm-2">
                <label for="fecha"><i class="far fa-calendar-alt iconos-crear"></i>Fecha</label>
                <input class="form-control date {{ $errors->has('fecha') ? 'is-invalid' : '' }}" type="text"
                    name="fecha" id="fecha" value="{{ old('fecha') }}" wire:model="fecha">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
                @if ($errors->has('fecha'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.planBaseActividade.fields.fecha_inicio_helper') }}</span>
            </div>
            @foreach ($customFields as $key => $customField)
                <div class="form-group col-sm-2">
                    <div class="form-group">
                        <label for="formSlugs.{{ $key }}.{{ $customField->variable }}"><i
                                class="fab fa-diaspora iconos-crear"></i>{{ ucfirst(substr($customField->variable, 1)) }}</label>
                        <input class="form-control slugs-inputs {{ $errors->has('') ? 'is-invalid' : '' }}"
                            type="number" wire:model="formSlugs.{{ $key }}.{{ $customField->variable }}"
                            id="formSlugs.{{ $key }}.{{ $customField->variable }}" value="" required>
                    </div>
                </div>
            @endforeach
            <div class="form-group col-sm-4 py-4">
                <button type="button" wire:click.prevent="store()" class="btn btn-success btn-sm">Enviar</button>
            </div>
        </div>
    </form>

</div>

<script>
    //listen render event receive id from product
    var text1 = document.querySelector('.slugs-inputs');

    Livewire.on('contentChanged', function(e) {
        console.log("Evento1");
        text1.value = '';
    });

    window.addEventListener('contentChanged', event => {
        console.log("Evento2");
    });

    document.querySelectorAll("button.btnAñadir").forEach(function(elem) {
        elem.addEventListener('click', agregarTexto, false);
    });

    function agregarTexto() {
        var btnValor = this.value;
        var elInput = document.getElementById("formula");
        elInput.value += btnValor;
    }

    $('#fecha_inicio').datepicker({
        format: "dd-mm-yyyy",
        todayBtn: true,
        orientation: "bottom right",
        autoclose: true,
        autoHide: true,
        beforeShowDay: function(date) {
            if (date.getMonth() == (new Date()).getMonth())
                switch (date.getDate()) {
                    case 4:
                        return {
                            tooltip: 'Example tooltip',
                                classes: 'active'
                        };
                    case 8:
                        return false;
                    case 12:
                        return "blue";
                }
        }
    });
</script>
