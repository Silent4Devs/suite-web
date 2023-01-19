<style>
    .select2-selection--multiple {
        overflow: hidden !important;
        height: auto !important;
        padding: 0 5px 5px 5px !important;
    }

    .select2-container {
        margin-top: 10px !important;
    }

</style>
<div class="container row">
    <div class="col-12">
        <p class="text-muted"><i class="fas fa-info-circle"></i> Empieza configurando la competencia definiendo el
            nombre y la descripción</p>
    </div>
    <div class="col-sm-12 col-lg-6 col-md-6 col-12">
        <div class="form-group">
            <label for="nombre">
                <i class="fab fa-discourse iconos-crear"></i> Nombre de la competencia <span
                    class="text-danger">*</span>
            </label>
            <input type="text" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" id="nombre"
                aria-describedby="nombreHelp" name="nombre" value="{{ old('nombre', $competencia->nombre) }}">
            <small id="nombreHelp" class="form-text text-muted">Ingresa el nombre de la competencia</small>
            @if ($errors->has('nombre'))
                <div class="invalid-feedback">
                    {{ $errors->first('nombre') }}
                </div>
            @endif
            <span class="errors nombre_error text-danger"></span>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6 col-md-6 col-12">
        <div class="form-group">
            <label for="tipo_id">
                <i class="fab fa-discourse iconos-crear"></i> Tipo de competencia <span class="text-danger">*</span>
            </label>
            {{-- Modulo para tipo de competencia --}}
            <div class="row align-items-center">
                <div class="col-10" style="margin-top:-9px">
                    @livewire('tipo-competencia-select',['tipo_seleccionado'=>$tipo_seleccionado])
                </div>
                <div class="p-0 col-2" style="margin-top:-20px">
                    <button id="btnAgregarTipo" class="btn btn-sm" style="background:#3eb2ad" data-toggle="modal"
                        data-target="#tipoCompetenciaModal" title="Agregar Tipo"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            @livewire('tipo-competencia-create')
            {{-- Fin Modulo para tipo de competencia --}}
        </div>
    </div>
    <div class="col-sm-12 col-lg-12 col-md-12 col-12">
        <div class="form-group">
            <label for="descripcion">
                <i class="fab fa-discourse iconos-crear"></i> Descripción de la competencia
            </label>
            <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"
                id="" cols="30" rows="10">{{ old('descripcion', $competencia->descripcion) }}</textarea>
            <small id="descripcionHelp" class="form-text text-muted">Ingresa la Descripción la competencia</small>
            @if ($errors->has('descripcion'))
                <div class="invalid-feedback">
                    {{ $errors->first('descripcion') }}
                </div>
            @endif
            <span class="errors descripcion_error text-danger"></span>
        </div>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btnAgregarTipo').addEventListener('click', function(e) {
            e.preventDefault();
        })
    })
</script>
