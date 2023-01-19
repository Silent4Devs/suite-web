@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.revision-direccions.create') }}
<h5 class="col-12 titulo_general_funcion">Editar: Revisión por Dirección</h5>
<div class="card mt-4">
    <div class="card-body">
        <form method="POST" class="row" action="{{ route("admin.revision-direccions.update",$revisionDireccion) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group col-md-6">
                <label for="estadorevisionesprevias"><i class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.revisionDireccion.fields.estadorevisionesprevias') }}</label>
                <input class="form-control {{ $errors->has('estadorevisionesprevias') ? 'is-invalid' : '' }}" type="text" name="estadorevisionesprevias" id="estadorevisionesprevias" value="{{ old('estadorevisionesprevias', $revisionDireccion->estadorevisionesprevias) }}">
                @if($errors->has('estadorevisionesprevias'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estadorevisionesprevias') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.revisionDireccion.fields.estadorevisionesprevias_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="cambiosinternosexternos"><i class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.revisionDireccion.fields.cambiosinternosexternos') }}</label>
                <input class="form-control {{ $errors->has('cambiosinternosexternos') ? 'is-invalid' : '' }}" type="text" name="cambiosinternosexternos" id="cambiosinternosexternos" value="{{ old('cambiosinternosexternos',$revisionDireccion->cambiosinternosexternos) }}">
                @if($errors->has('cambiosinternosexternos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cambiosinternosexternos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.revisionDireccion.fields.cambiosinternosexternos_helper') }}</span>
            </div>
            <div class="form-group col-md-12">
                <label for="retroalimentaciondesempeno"><i class="fas fa-shield-alt iconos-crear"></i>{{ trans('cruds.revisionDireccion.fields.retroalimentaciondesempeno') }}</label>
                <textarea class="form-control {{ $errors->has('retroalimentaciondesempeno') ? 'is-invalid' : '' }}" name="retroalimentaciondesempeno" id="retroalimentaciondesempeno">{{ old('retroalimentaciondesempeno', $revisionDireccion->retroalimentaciondesempeno) }}</textarea>
                @if($errors->has('retroalimentaciondesempeno'))
                    <div class="invalid-feedback">
                        {{ $errors->first('retroalimentaciondesempeno') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.revisionDireccion.fields.retroalimentaciondesempeno_helper') }}</span>
            </div>
            <div class="form-group col-md-12">
                <label for="retroalimentacionpartesinteresadas"><i class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.revisionDireccion.fields.retroalimentacionpartesinteresadas') }}</label>
                <textarea class="form-control {{ $errors->has('retroalimentacionpartesinteresadas') ? 'is-invalid' : '' }}" type="text" name="retroalimentacionpartesinteresadas" id="retroalimentacionpartesinteresadas">{{ old('retroalimentacionpartesinteresadas', $revisionDireccion->retroalimentacionpartesinteresadas) }}</textarea>
                @if($errors->has('retroalimentacionpartesinteresadas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('retroalimentacionpartesinteresadas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.revisionDireccion.fields.retroalimentacionpartesinteresadas_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="resultadosriesgos"><i class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.revisionDireccion.fields.resultadosriesgos') }}</label>
                <input class="form-control {{ $errors->has('resultadosriesgos') ? 'is-invalid' : '' }}" type="text" name="resultadosriesgos" id="resultadosriesgos" value="{{ old('resultadosriesgos',$revisionDireccion->resultadosriesgos) }}">
                @if($errors->has('resultadosriesgos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('resultadosriesgos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.revisionDireccion.fields.resultadosriesgos_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="oportunidadesmejoracontinua"><i class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.revisionDireccion.fields.oportunidadesmejoracontinua') }}</label>
                <input class="form-control {{ $errors->has('oportunidadesmejoracontinua') ? 'is-invalid' : '' }}" type="text" name="oportunidadesmejoracontinua" id="oportunidadesmejoracontinua" value="{{ old('oportunidadesmejoracontinua', $revisionDireccion->oportunidadesmejoracontinua) }}">
                @if($errors->has('oportunidadesmejoracontinua'))
                    <div class="invalid-feedback">
                        {{ $errors->first('oportunidadesmejoracontinua') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.revisionDireccion.fields.oportunidadesmejoracontinua_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="acuerdoscambios"><i class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.revisionDireccion.fields.acuerdoscambios') }}</label>
                <textarea class="form-control {{ $errors->has('acuerdoscambios') ? 'is-invalid' : '' }}" name="acuerdoscambios" id="acuerdoscambios">{{ old('acuerdoscambios', $revisionDireccion->acuerdoscambios) }}</textarea>
                @if($errors->has('acuerdoscambios'))
                    <div class="invalid-feedback">
                        {{ $errors->first('acuerdoscambios') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.revisionDireccion.fields.acuerdoscambios_helper') }}</span>
            </div>
            <div class="form-group col-12 text-right">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
