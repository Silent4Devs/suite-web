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
        <p class="text-muted"><i class="fas fa-info-circle"></i> Define el nombre del tipo del objetivo</p>
    </div>
    <div class="col-sm-12 col-lg-6 col-md-6 col-12">
        <div class="form-group">
            <label for="nombre">
                <i class="fab fa-discourse iconos-crear"></i> Nombre del objetivo <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" id="nombre"
                aria-describedby="nombreHelp" name="nombre" value="{{ old('nombre', $objetivo->nombre) }}">
            <small id="nombreHelp" class="form-text text-muted">Ingresa el nombre del objetivo</small>
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
                <i class="fab fa-discourse iconos-crear"></i> Perspectiva <span class="text-danger">*</span>
            </label>
            {{-- Modulo para tipo de objetivo --}}
            <div class="row align-items-center">
                <div class="col-10" style="margin-top:-9px">
                    @livewire('tipo-objetivos-select',['tipo_seleccionado'=>$tipo_seleccionado])
                </div>
                <div class="p-0 col-2" style="margin-top:-20px">
                    <button id="btnAgregarTipo" class="btn btn-sm" style="background:#3eb2ad" data-toggle="modal"
                        data-target="#tipoObjetivoModal" title="Agregar Tipo"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            @livewire('tipo-objetivos-create')
            {{-- Fin Modulo para tipo de competencia --}}
        </div>
    </div>
    <div class="col-sm-12 col-lg-12 col-md-12 col-12">
        <div class="form-group">
            <label for="KPI">
                <i class="fab fa-discourse iconos-crear"></i>KPI <span class="text-danger">*</span>
            </label>
            <input class="form-control {{ $errors->has('KPI') ? 'is-invalid' : '' }}" type="text" name="KPI"
                value="{{ old('KPI', $objetivo->KPI) }}">
            <small id="KPIHelp" class="form-text text-muted">Ingresa el KPI del objetivo</small>
            @if ($errors->has('KPI'))
                <div class="invalid-feedback">
                    {{ $errors->first('KPI') }}
                </div>
            @endif
            <span class="errors KPI_error text-danger"></span>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6 col-md-6 col-12">
        <div class="form-group">
            <label for="meta">
                <i class="fab fa-discourse iconos-crear"></i> Meta del objetivo <span class="text-danger">*</span>
            </label>
            <input type="number" class="form-control {{ $errors->has('meta') ? 'is-invalid' : '' }}" id="meta"
                aria-describedby="metaHelp" name="meta" value="{{ old('meta', $objetivo->meta) }}">
            <small id="metaHelp" class="form-text text-muted">Ingresa la Meta del objetivo</small>
            @if ($errors->has('meta'))
                <div class="invalid-feedback">
                    {{ $errors->first('meta') }}
                </div>
            @endif
            <span class="errors meta_error text-danger"></span>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6 col-md-6 col-12">
        <div class="form-group">
            <label for="metrica_id">
                <i class="fab fa-discourse iconos-crear"></i> Métrica del objetivo <span class="text-danger">*</span>
            </label>
            {{-- Modulo para metrica de objetivo --}}
            <div class="row align-items-center">
                <div class="col-10" style="margin-top:-9px">
                    @livewire('metrica-objetivo-select',['metrica_seleccionada'=>$metrica_seleccionada])
                </div>
                <div class="p-0 col-2" style="margin-top:-20px">
                    <button id="btnAgregarMetrica" class="btn btn-sm" style="background:#3eb2ad" data-toggle="modal"
                        data-target="#metricaObjetivoModal" title="Agregar Métrica"><i
                            class="fas fa-plus"></i></button>
                </div>
            </div>
            @livewire('metrica-objetivo-create')
            {{-- Fin Modulo para tipo de competencia --}}
        </div>
    </div>
    <div class="col-sm-12 col-lg-12 col-md-12 col-12">
        <div class="form-group">
            <label for="descripcion_meta">
                <i class="fab fa-discourse iconos-crear"></i>Ingresa la descripción de la meta
            </label>
            <textarea class="form-control {{ $errors->has('descripcion_meta') ? 'is-invalid' : '' }}"
                name="descripcion_meta" id="" cols="30"
                rows="10">{{ old('descripcion_meta', $objetivo->descripcion_meta) }}</textarea>
            <small id="descripcion_metaHelp" class="form-text text-muted">Ingresa la descripción de la meta</small>
            @if ($errors->has('descripcion_meta'))
                <div class="invalid-feedback">
                    {{ $errors->first('descripcion_meta') }}
                </div>
            @endif
            <span class="errors descripcion_meta_error text-danger"></span>
        </div>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btnAgregarTipo').addEventListener('click', function(e) {
            e.preventDefault();
        })
        document.getElementById('btnAgregarMetrica').addEventListener('click', function(e) {
            e.preventDefault();
        })
    })
</script>
