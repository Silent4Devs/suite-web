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
<div class="pr-0 row">
    <div class="col-12">
        <div class="px-1 py-2 mb-3 rounded" style="background-color: #DBEAFE; border-top:solid 3px #3B82F6;">
            <div class="row w-100">
                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                    <div class="w-100">
                        <i class="fas fa-info-circle" style="color: #3B82F6; font-size: 22px"></i>
                    </div>
                </div>
                <div class="col-11">
                    <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                    </p>
                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Empieza creando la competencia
                        definiendo su
                        nombre, tipo y descripción</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6 col-md-6 col-12">
        <div class="form-group">
            <label for="nombre">
                <i class="fas fa-star iconos-crear"></i> Nombre<span class="text-danger">*</span>
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
                <i class="fas fa-layer-group iconos-crear"></i> Tipo <span class="text-danger">*</span>
            </label>
            {{-- Modulo para tipo de competencia --}}
            <div class="row align-items-center">
                <div class="col-11" style=" margin-top:-9px">
                    @livewire('tipo-competencia-select',['tipo_seleccionado'=>$tipo_seleccionado])
                </div>
                <div class="pl-0 col" style="text-align: center;
                margin-top: -22px;
                margin-left: inherit">
                    <button id=" btnAgregarTipo" class="text-white btn btn-sm" style="background:#3eb2ad;height: 34px;"
                        data-toggle="modal" data-target="#tipoCompetenciaModal" title="Agregar Tipo"><i
                            class="fas fa-plus"></i></button>
                </div>
            </div>
            @livewire('tipo-competencia-create')
            {{-- Fin Modulo para tipo de competencia --}}
        </div>
    </div>
    <div class="col-sm-12 col-lg-12 col-md-12 col-12">
        <div class="form-group">
            <label for="descripcion">
                <i class="fas fa-pencil-alt iconos-crear"></i></i> Descripción
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
