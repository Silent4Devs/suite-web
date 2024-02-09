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

@if (!$editar)
    <div class="mt-3 col-12">
        <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
            CREACIÓN DE OBJETIVOS ESTRATÉGICOS
        </div>
    </div>
@endif
<div class="col-sm-12 col-lg-12 col-md-12 col-12">
    <div class="form-group">
        <label for="nombre">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-pen-fill iconos-crear" viewBox="0 0 16 16">
                <path
                    d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
            </svg> Objetivo Estratégico <span class="text-danger">*</span>
        </label>
        <input type="text" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" id="nombre"
            aria-describedby="nombreHelp" name="nombre" value="{{ old('nombre', $objetivo->nombre) }}">
        <small id="nombreHelp" class="form-text text-muted">Ingresa el nombre del objetivo estratégico</small>
        @if ($errors->has('nombre'))
            <div class="invalid-feedback">
                {{ $errors->first('nombre') }}
            </div>
        @endif
        <span class="errors nombre_error{{ $editar ? '_edit' : '' }} text-danger"></span>
    </div>
</div>
<div class="col-sm-12 col-lg-6 col-md-6 col-12">
    <div class="form-group">
        <label for="tipo_id">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-puzzle-fill iconos-crear" viewBox="0 0 16 16">
                <path
                    d="M3.112 3.645A1.5 1.5 0 0 1 4.605 2H7a.5.5 0 0 1 .5.5v.382c0 .696-.497 1.182-.872 1.469a.459.459 0 0 0-.115.118.113.113 0 0 0-.012.025L6.5 4.5v.003l.003.01c.004.01.014.028.036.053a.86.86 0 0 0 .27.194C7.09 4.9 7.51 5 8 5c.492 0 .912-.1 1.19-.24a.86.86 0 0 0 .271-.194.213.213 0 0 0 .036-.054l.003-.01v-.008a.112.112 0 0 0-.012-.025.459.459 0 0 0-.115-.118c-.375-.287-.872-.773-.872-1.469V2.5A.5.5 0 0 1 9 2h2.395a1.5 1.5 0 0 1 1.493 1.645L12.645 6.5h.237c.195 0 .42-.147.675-.48.21-.274.528-.52.943-.52.568 0 .947.447 1.154.862C15.877 6.807 16 7.387 16 8s-.123 1.193-.346 1.638c-.207.415-.586.862-1.154.862-.415 0-.733-.246-.943-.52-.255-.333-.48-.48-.675-.48h-.237l.243 2.855A1.5 1.5 0 0 1 11.395 14H9a.5.5 0 0 1-.5-.5v-.382c0-.696.497-1.182.872-1.469a.459.459 0 0 0 .115-.118.113.113 0 0 0 .012-.025L9.5 11.5v-.003l-.003-.01a.214.214 0 0 0-.036-.053.859.859 0 0 0-.27-.194C8.91 11.1 8.49 11 8 11c-.491 0-.912.1-1.19.24a.859.859 0 0 0-.271.194.214.214 0 0 0-.036.054l-.003.01v.002l.001.006a.113.113 0 0 0 .012.025c.016.027.05.068.115.118.375.287.872.773.872 1.469v.382a.5.5 0 0 1-.5.5H4.605a1.5 1.5 0 0 1-1.493-1.645L3.356 9.5h-.238c-.195 0-.42.147-.675.48-.21.274-.528.52-.943.52-.568 0-.947-.447-1.154-.862C.123 9.193 0 8.613 0 8s.123-1.193.346-1.638C.553 5.947.932 5.5 1.5 5.5c.415 0 .733.246.943.52.255.333.48.48.675.48h.238l-.244-2.855z" />
            </svg> Perspectiva <span class="text-danger">*</span>
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
<div class="col-sm-12 col-lg-6 col-md-6 col-12">
    <div class="form-group">
        <label for="KPI">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-lightning-fill iconos-crear" viewBox="0 0 16 16">
                <path
                    d="M5.52.359A.5.5 0 0 1 6 0h4a.5.5 0 0 1 .474.658L8.694 6H12.5a.5.5 0 0 1 .395.807l-7 9a.5.5 0 0 1-.873-.454L6.823 9.5H3.5a.5.5 0 0 1-.48-.641l2.5-8.5z" />
            </svg>KPI <span class="text-danger">*</span>
        </label>
        <input class="form-control {{ $errors->has('KPI') ? 'is-invalid' : '' }}" type="text" name="KPI"
            value="{{ old('KPI', $objetivo->KPI) }}">
        <small id="KPIHelp" class="form-text text-muted">Ingresa el KPI del objetivo estratégico </small>
        @if ($errors->has('KPI'))
            <div class="invalid-feedback">
                {{ $errors->first('KPI') }}
            </div>
        @endif
        <span class="errors KPI_error{{ $editar ? '_edit' : '' }} text-danger"></span>
    </div>
</div>
<div class="col-sm-12 col-lg-6 col-md-6 col-12">
    <div class="form-group">
        <label for="meta">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-bullseye iconos-crear" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path d="M8 13A5 5 0 1 1 8 3a5 5 0 0 1 0 10zm0 1A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" />
                <path d="M9.5 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
            </svg>Meta a alcanzar <span class="text-danger">*</span>
        </label>
        <input type="number" class="form-control {{ $errors->has('meta') ? 'is-invalid' : '' }}" id="meta"
            aria-describedby="metaHelp" name="meta" value="{{ old('meta', $objetivo->meta) }}">
        <small id="metaHelp" class="form-text text-muted">Ingresa la Meta del objetivo estratégico </small>
        @if ($errors->has('meta'))
            <div class="invalid-feedback">
                {{ $errors->first('meta') }}
            </div>
        @endif
        <span class="errors meta_error{{ $editar ? '_edit' : '' }} text-danger"></span>
    </div>
</div>
<div class="col-sm-12 col-lg-6 col-md-6 col-12">
    <div class="form-group">
        <label for="metrica_id">
            <i class="fas fa-ruler-combined iconos-crear"></i> Unidad de medida <span class="text-danger">*</span>
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
<div class="col-sm-12 col-lg-12 col-md-12 col-12">
    <div class="form-group">
        <label for="descripcion_meta">
            <i class="fas fa-pencil-alt iconos-crear"></i>Descripción
        </label>
        {{-- <input class="form-control {{ $errors->has('descripcion_meta') ? 'is-invalid' : '' }}" type="text"
            name="descripcion_meta" value="{{ old('descripcion_meta', $objetivo->descripcion_meta) }}"> --}}
        <textarea class="form-control {{ $errors->has('descripcion_meta') ? 'is-invalid' : '' }}" name="descripcion_meta"
            id="" cols="30" rows="1">{{ old('descripcion_meta', $objetivo->descripcion_meta) }}</textarea>
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
    <div class="col-12">
        <button id="BtnAgregarObjetivo" class="btn btn-success" style="float: right" title="Agregar objetivo"><i
                class="mr-2 fas fa-plus-circle"></i>Agregar</button>
    </div>
    <div class="card-body datatable-fix">
        <div class="mt-3">
            <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                OBJETIVOS ESTRATÉGICOS ASIGNADOS
            </div>
        </div>
        <div style="text-align: right">
            <button class="btn btn-success" id="copiarObjetivos"><i class="fas fa-copy mr-2"></i>Importar
                Objetivos</button>
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
