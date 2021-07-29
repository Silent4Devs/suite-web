@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.revision-direccions.create') }}

<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong> Revisión por Dirección  </h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.revision-direccions.store") }}" enctype="multipart/form-data" class="row">
            @csrf
            <div class="form-group col-md-6">
                <label for="estadorevisionesprevias"><i class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.revisionDireccion.fields.estadorevisionesprevias') }}</label>
                <input class="form-control {{ $errors->has('estadorevisionesprevias') ? 'is-invalid' : '' }}" type="text" name="estadorevisionesprevias" id="estadorevisionesprevias" value="{{ old('estadorevisionesprevias', '') }}">
                @if($errors->has('estadorevisionesprevias'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estadorevisionesprevias') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.revisionDireccion.fields.estadorevisionesprevias_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="cambiosinternosexternos"><i class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.revisionDireccion.fields.cambiosinternosexternos') }}</label>
                <input class="form-control {{ $errors->has('cambiosinternosexternos') ? 'is-invalid' : '' }}" type="text" name="cambiosinternosexternos" id="cambiosinternosexternos" value="{{ old('cambiosinternosexternos', '') }}">
                @if($errors->has('cambiosinternosexternos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cambiosinternosexternos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.revisionDireccion.fields.cambiosinternosexternos_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="retroalimentaciondesempeno"><i class="fas fa-shield-alt iconos-crear"></i>{{ trans('cruds.revisionDireccion.fields.retroalimentaciondesempeno') }}</label>
                <input class="form-control {{ $errors->has('retroalimentaciondesempeno') ? 'is-invalid' : '' }}" type="text" name="retroalimentaciondesempeno" id="retroalimentaciondesempeno" value="{{ old('retroalimentaciondesempeno', '') }}">
                @if($errors->has('retroalimentaciondesempeno'))
                    <div class="invalid-feedback">
                        {{ $errors->first('retroalimentaciondesempeno') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.revisionDireccion.fields.retroalimentaciondesempeno_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="retroalimentacionpartesinteresadas"><i class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.revisionDireccion.fields.retroalimentacionpartesinteresadas') }}</label>
                <input class="form-control {{ $errors->has('retroalimentacionpartesinteresadas') ? 'is-invalid' : '' }}" type="text" name="retroalimentacionpartesinteresadas" id="retroalimentacionpartesinteresadas" value="{{ old('retroalimentacionpartesinteresadas', '') }}">
                @if($errors->has('retroalimentacionpartesinteresadas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('retroalimentacionpartesinteresadas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.revisionDireccion.fields.retroalimentacionpartesinteresadas_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="resultadosriesgos"><i class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.revisionDireccion.fields.resultadosriesgos') }}</label>
                <input class="form-control {{ $errors->has('resultadosriesgos') ? 'is-invalid' : '' }}" type="text" name="resultadosriesgos" id="resultadosriesgos" value="{{ old('resultadosriesgos', '') }}">
                @if($errors->has('resultadosriesgos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('resultadosriesgos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.revisionDireccion.fields.resultadosriesgos_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="oportunidadesmejoracontinua"><i class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.revisionDireccion.fields.oportunidadesmejoracontinua') }}</label>
                <input class="form-control {{ $errors->has('oportunidadesmejoracontinua') ? 'is-invalid' : '' }}" type="text" name="oportunidadesmejoracontinua" id="oportunidadesmejoracontinua" value="{{ old('oportunidadesmejoracontinua', '') }}">
                @if($errors->has('oportunidadesmejoracontinua'))
                    <div class="invalid-feedback">
                        {{ $errors->first('oportunidadesmejoracontinua') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.revisionDireccion.fields.oportunidadesmejoracontinua_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="acuerdoscambios"><i class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.revisionDireccion.fields.acuerdoscambios') }}</label>
                <textarea class="form-control {{ $errors->has('acuerdoscambios') ? 'is-invalid' : '' }}" name="acuerdoscambios" id="acuerdoscambios">{{ old('acuerdoscambios') }}</textarea>
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