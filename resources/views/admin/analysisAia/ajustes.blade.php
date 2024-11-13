@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.analisis-aia.matriz') }}">Matriz AIA</a>
        </li>
        <li class="breadcrumb-item active">Ajustar</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Ajustar: Priorización de impactos</h5>

    <div class="px-1 py-2 mb-4 rounded" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
        <div class="row w-100">
            <div class="text-center col-1 align-items-center d-flex justify-content-center">
                <div class="w-100">
                    <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                </div>
            </div>
            <div class="col-11">
                <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                <p class="m-0" style="font-size: 14px; color:#1E3A8A">En esta sección podrá ajustar los valores de
                    priorización de impactos.</p>
            </div>
        </div>
    </div>

    <div class="mt-4 card">
        <div class="card-body">
            <form action="{{ route('admin.analisis-aia.updateAjustesAIA', $cuestionario->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="form-group col-sm-6">
                        <i class="fas fa-id-card iconos-crear"></i>
                        <label for="impacto_operativo" class="required">Impacto Operativo:</label>
                        <input type="number" name="impacto_operativo" id="impacto_operativo" class="form-control"
                            placeholder="..." value="{{ old('impacto_operativo', $cuestionario->impacto_operativo) }}"
                            max="5" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <i class="fas fa-id-card iconos-crear"></i>
                        <label for="impacto_regulatorio" class="required">Impacto Regulatorio:</label>
                        <input type="number" name="impacto_regulatorio" id="impacto_regulatorio" class="form-control"
                            placeholder="..." value="{{ old('impacto_regulatorio', $cuestionario->impacto_regulatorio) }}"
                            max="5" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <i class="fas fa-id-card iconos-crear"></i>
                        <label for="impacto_reputacion" class="required">Impacto en la Reputación / Imagen Pública o
                            Política:</label>
                        <input type="number" name="impacto_reputacion" id="impacto_reputacion" class="form-control"
                            placeholder="..." value="{{ old('impacto_reputacion', $cuestionario->impacto_reputacion) }}"
                            max="5" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <i class="fas fa-id-card iconos-crear"></i>
                        <label for="impacto_social" class="required">Impacto Social:</label>
                        <input type="number" name="impacto_social" id="impacto_social" class="form-control"
                            placeholder="..." value="{{ old('impacto_social', $cuestionario->impacto_social) }}"
                            max="5" required>
                    </div>
                </div>
                <!-- Submit Field -->
                <div class="row">
                    <div class="text-right form-group col-12">
                        <a href="{{ redirect()->getUrlGenerator()->previous() }}"
                            class="btn btn-outline-primary">Cancelar</a>
                        <button class="btn btn-primary" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
