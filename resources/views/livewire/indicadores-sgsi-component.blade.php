<div>
    <style>
        .dotverde {
            height: 15px;
            width: 15px;
            background-color: #38c172;
            border-radius: 50%;
            display: inline-block;
        }

        .dotyellow {
            height: 15px;
            width: 15px;
            background-color: orange;
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
            <label class="required" for="nombre"><i class="fas fa-id-card iconos-crear"></i>Nombre del
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
                <label for="id_proceso"><i class="fas fa-cogs iconos-crear"></i>Proceso</label>
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
            <label class="required" for="formula"><i
                    class="fas fa-square-root-alt iconos-crear"></i></i>Formúla</label>
            <input class="form-control {{ $errors->has('formula') ? 'is-invalid' : '' }}" type="text"
                name="formula" id="formula" value="{{ old('formula', $indicadoresSgsis->formula) }}" disabled>
            @if ($errors->has('formula'))
                <div class="invalid-feedback">
                    {{ $errors->first('formula') }}
                </div>
            @endif
            <span class="help-block"></span>
        </div>

        <div class="form-group col-sm-4">
            <div class="form-group">
                <label for="meta"><i class="fas fa-flag-checkered iconos-crear"></i></i>Meta</label>
                <input class="form-control {{ $errors->has('meta') ? 'is-invalid' : '' }}" type="text"
                    name="meta" id="meta"
                    value="{{ old('meta', $indicadoresSgsis->meta . $indicadoresSgsis->unidadmedida) }}" disabled>
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
    @include("livewire.evaluaciones.$view")
</div>

<script>
    window.addEventListener('contentChanged', event => {
        var inputArray = document.querySelectorAll('.slugs-inputs');
        inputArray.forEach(function(input) {
            input.value = "";
        });
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
