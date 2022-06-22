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
        <div class="form-group col-sm-12">
            <label class="required" for="nombre"><i class="fas fa-id-card iconos-crear"></i>Nombre del
                indicador</label>
            <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre"
                id="nombre" value="{{ old('nombre', $objetivos->indicador) }}" disabled>
            @if ($errors->has('nombre'))
                <div class="invalid-feedback">
                    {{ $errors->first('nombre') }}
                </div>
            @endif
            <span class="help-block"></span>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-8">
            <label class="required" for="formula"><i
                    class="fas fa-square-root-alt iconos-crear"></i></i>Formúla</label>
            <input class="form-control {{ $errors->has('formula') ? 'is-invalid' : '' }}" type="text"
                name="formula" id="formula" value="{{ old('formula', $objetivos->formula) }}" disabled>
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
                    value="{{ old('meta', $objetivos->meta . ' ' . $objetivos->unidadmedida) }}" disabled>
                @if ($errors->has('meta'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meta') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
        </div>
    </div>

    @include('livewire.evaluacionobjetivos.table')

    <hr>

    @include("livewire.evaluacionobjetivos.$view")

</div>

<script>
    window.addEventListener('contentChanged', event => {
        var inputArray = document.querySelectorAll('.slugs-inputs');
        inputArray.forEach(function(input) {
            input.value = "";
        });
    });

    document.querySelectorAll("button.btnAñadir").forEach(function(elem) {
        elem.addEventListener('click', agregarTexto, false);
    });

    function agregarTexto() {
        var btnValor = this.value;
        var elInput = document.getElementById("formula");
        elInput.value += btnValor;
    }
</script>
