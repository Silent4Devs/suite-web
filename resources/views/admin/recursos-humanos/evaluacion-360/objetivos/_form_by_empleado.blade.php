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
<div class="row">
    <div class="col-12">
        <div class="info-first-config">
            <h4 class="title-config">Nuevo Objetivo</h4>
            <p>
                Define los Valores y Escalas con los que se medirán los objetivos.
            </p>
            <hr class="my-4">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="form-group anima-focus">
            <input type="text" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" id="nombre"
            aria-describedby="nombreHelp" name="nombre" value="{{ old('nombre', $objetivo->nombre) }}" placeholder="">
            <label for="nombre">
                Objetivo Estratégico
            </label>
            <small id="nombreHelp" class="form-text text-muted">Ingresa el nombre del objetivo estratégico</small>
            @if ($errors->has('nombre'))
                <div class="invalid-feedback">
                    {{ $errors->first('nombre') }}
                </div>
            @endif
            <span class="errors nombre_error{{ $editar ? '_edit' : '' }} text-danger"></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 form-group anima-focus">
        <textarea class="form-control {{ $errors->has('descripcion_meta') ? 'is-invalid' : '' }}" name="descripcion_meta"
            id="" cols="30" rows="1" placeholder="">{{ old('descripcion_meta', $objetivo->descripcion_meta) }}</textarea>
        <label for="descripcion_meta">
            Descripción
        </label>
        {{-- <input class="form-control {{ $errors->has('descripcion_meta') ? 'is-invalid' : '' }}" type="text"
            name="descripcion_meta" value="{{ old('descripcion_meta', $objetivo->descripcion_meta) }}"> --}}
        <small id="descripcion_metaHelp" class="form-text text-muted">Ingresa una breve descripción del objetivo
            estratégico</small>
        @if ($errors->has('descripcion_meta'))
            <div class="invalid-feedback">
                {{ $errors->first('descripcion_meta') }}
            </div>
        @endif
        <span class="errors descripcion_meta_error{{ $editar ? '_edit' : '' }} text-danger"></span>
    </div>
</div>
<div class="row">
    <div class="col-md-3 form-group">
        <label for="tipo_id">
            Perspectiva <span class="text-danger">*</span>
        </label>
        {{-- Modulo para tipo de objetivo --}}
        <div class="row align-items-center">
            <div class="col-10" style="margin-top:-9px">
                @livewire('tipo-objetivos-select', ['tipo_seleccionado' => $tipo_seleccionado])
            </div>
            @if (!$editar)
                <div class="p-0 col" style="margin-top: -26px;height: 28px;margin-left: -10px;">
                    <button id="btnAgregarTipo" class="text-white btn btn-sm" style="background:#3eb2ad;height: 32px;"
                        data-toggle="modal" data-target="#tipoObjetivoModal" title="Agregar Tipo"><i
                            class="fas fa-plus"></i></button>
                    {{-- <button type="button" class="text-white btn btn-sm" style="background:#3eb2ad;height: 32px;"><i class="fas fa-edit"></i></button> --}}
                    {{-- <a href="{{ route('admin.glosarios.edit',$perspectiva->id )}}"><i class="fas fa-edit"></i></a> --}}
                    <a href="{{ route('admin.Perspectiva.index') }}" class="text-white btn btn-sm"
                        style="background:#3eb2ad;height: 32px;"><i class="fas fa-edit"></i></a>
                </div>
            @endif
        </div>

        @livewire('tipo-objetivos-create')
        {{-- Fin Modulo para tipo de competencia --}}

    </div>
</div>












<div class="row">
    <div class="col-sm-12 col-lg-6 col-md-6 col-12">
        <div class="form-group anima-focus">
            <input class="form-control {{ $errors->has('KPI') ? 'is-invalid' : '' }}" type="text" name="KPI"
                value="{{ old('KPI', $objetivo->KPI) }}" placeholder="">
            <label for="KPI">
                KPIs
            </label>
            <small id="KPIHelp" class="form-text text-muted">Ingresa el KPI del objetivo estratégico </small>
            @if ($errors->has('KPI'))
                <div class="invalid-feedback">
                    {{ $errors->first('KPI') }}
                </div>
            @endif
            <span class="errors KPI_error{{ $editar ? '_edit' : '' }} text-danger"></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-lg-6 col-md-6 col-12">
        <div class="form-group anima-focus">
            <input type="number" class="form-control {{ $errors->has('meta') ? 'is-invalid' : '' }}" id="meta"
            aria-describedby="metaHelp" name="meta" value="{{ old('meta', $objetivo->meta) }}" placeholder="">
            <label for="meta">
                Meta a alcanzar
            </label>
            <small id="metaHelp" class="form-text text-muted">Ingresa la Meta del objetivo estratégico </small>
            @if ($errors->has('meta'))
                <div class="invalid-feedback">
                    {{ $errors->first('meta') }}
                </div>
            @endif
            <span class="errors meta_error{{ $editar ? '_edit' : '' }} text-danger"></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-lg-6 col-md-6 col-12">
        <div class="form-group">
            <label for="metrica_id">
                Unidad de medida <span class="text-danger">*</span>
            </label>
            {{-- Modulo para metrica de objetivo --}}
            <div class="row align-items-center">
                <div class="col-10" style="margin-top:-11px">
                    @livewire('metrica-objetivo-select', ['metrica_seleccionada' => $metrica_seleccionada])
                </div>
                @if (!$editar)
                    <div class="p-1 col" style="margin-top:-28px;height: 38px;margin-left: -12px;">
                        <button id="btnAgregarMetrica" class="text-white btn btn-sm"
                            style="background:#3eb2ad;height: 32px;" data-toggle="modal"
                            data-target="#metricaObjetivoModal" title="Agregar unidad"><i
                                class="fas fa-plus"></i></button>
                        <a href="{{ route('admin.Metrica.index') }}" class="text-white btn btn-sm"
                            style="background:#3eb2ad;height: 32px;"><i class="fas fa-edit"></i></a>
                    </div>
                @endif
            </div>
            @livewire('metrica-objetivo-create')
            {{-- Fin Modulo para tipo de competencia --}}
        </div>
    </div>
</div>

{{-- <div class="col-sm-12 col-lg-12 col-md-12 col-12">
    <div class="input-group is-invalid">
        <div class="form-group" style="width: 100%;border: solid 1px #cecece;">
            <div class="row align-items-center" style="padding: 20px 0;">
                <div class="col-md-6 col-sm-6 col-12 d-flex justify-content-center">
                    <label style="cursor: pointer" for="foto{{ $editar ? 'Edit' : '' }}">
                        <div class="d-flex align-items-center">
                            <h5>
                                <i class="fas fa-image iconos-crear"
                                    style="font-size: 20pt;position: relative;top: 4px;"></i>
                                <span id="texto-imagen{{ $editar ? 'Edit' : '' }}" class="pl-2">
                                    Subir imágen
                                    <small class="text-danger" style="font-size: 10px">
                                        (Opcional)</small>
                                </span>
                            </h5>
                        </div>
                    </label>
                </div>
                <div class="text-center col-6">
                    <img id="uploadPreview{{ $editar ? 'Edit' : '' }}" class="imagen-preview"
                        src="{{ asset('img/not-available.png') }}" width="150" height="150"
                        accept="image/png, image/gif, image/jpeg" style="clip-path: circle(60px at 50% 50%);
                        height: 120px;" />
                </div>
            </div>
            <input name="foto" type="file" accept="image/png, image/jpeg" class="form-control-file"
                id="foto{{ $editar ? 'Edit' : '' }}" hidden="">
        </div>
    </div>
</div> --}}
@if (!$editar)
    <div class="row">
        <div class="col-12">
            <button id="BtnAgregarObjetivo" class="btn btn-success" style="float: right" title="Agregar objetivo"><i
                    class="mr-2 fas fa-plus-circle"></i>Agregar</button>
        </div>
    </div>
    <div class="card-body datatable-fix">
        <div class="row">
            <div class="col-12">
                <h4 class="title-card-evaluaciones">Objetivos Estratégicos Asignados</h4>
            </div>
        </div>
        <div style="text-align: right">
            <button class="btn btn-success" id="copiarObjetivos"><i class="fas fa-copy mr-2"></i>Importar Objetivos</button>
        </div>
        <table class="table table-bordered w-100 tblObjetivos">
            <thead class="thead-dark">
                <tr>
                    <th style="vertical-align: top">
                        Perspectiva
                    </th>
                    <th style="vertical-align: top">
                        Objetivos Estratégicos
                    </th>
                    {{-- <th style="vertical-align: top">
                        Evaluación Asignada
                    </th> --}}
                    <th style="vertical-align: top">
                        KPI
                    </th>
                    <th style="vertical-align: top">
                        Meta
                    </th>
                    <th style="vertical-align: top">
                        Estatus
                    </th>
                    <th style="vertical-align: top">
                        Descripción
                    </th>
                    <th style="vertical-align: top">
                        Opciones
                    </th>
                </tr>
            </thead>
        </table>
        <div class="modal fade" id="modalCopiarObjetivos" data-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="modalCopiarObjetivosLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background: #345183;color: white;">
                        <h5 class="modal-title" id="modalCopiarObjetivosLabel"><i class="mr-2 fas fa-copy"></i>Copiar
                            Objetivos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="contenidoModal"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn_cancelar" data-dismiss="modal">Cerrar</button>
                        <button type="button" id="btnGuardarCopiaObjs" class="btn btn-success">Guardar</button>
                    </div>
                    @include('layouts.loader')
                </div>
            </div>
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btnAgregarTipo').addEventListener('click', function(e) {
            e.preventDefault();
        });
        document.getElementById('btnAgregarMetrica').addEventListener('click', function(e) {
            e.preventDefault();
        });
    })
</script>
