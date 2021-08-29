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
            <label class="required" for="formula"><i class="fas fa-square-root-alt iconos-crear"></i></i>Formúla</label>
            <input class="form-control {{ $errors->has('formula') ? 'is-invalid' : '' }}" type="text" name="formula"
                id="formula" value="{{ old('formula', $objetivos->formula) }}" disabled>
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
                <input class="form-control {{ $errors->has('meta') ? 'is-invalid' : '' }}" type="text" name="meta"
                    id="meta" value="{{ old('meta', $objetivos->meta . $objetivos->unidadmedida) }}"
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

    @include('livewire.evaluacionobjetivos.table')

    <hr>

    @include("livewire.evaluaciones.$view")

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
