@extends('layouts.admin')
@section('content')

<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong> Riesgo</h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.matriz-riesgos.store") }}" enctype="multipart/form-data">
            @csrf
          <div class="row">
            <div class="form-group col-md-6 col-sm-6">
                <label for="proceso"><i class="fas fa-cog iconos-crear"></i>Nombre del Proceso</label>
                <input class="form-control {{ $errors->has('proceso') ? 'is-invalid' : '' }}" type="text" name="proceso" id="proceso" value="{{ old('proceso', '') }}">
                @if($errors->has('proceso'))
                    <div class="invalid-feedback">
                        {{ $errors->first('proceso') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.proceso_helper') }}</span>
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <label for="activo_id"><i class="fas fa-atom iconos-crear"></i>Tipo de Activo</label>
                <select class="form-control select2 {{ $errors->has('activo') ? 'is-invalid' : '' }}" name="activo_id" id="activo_id">
                    @foreach($activos as $id => $activo)
                        <option value="{{ $id }}" {{ old('activo_id') == $id ? 'selected' : '' }}>{{ $activo }}</option>
                    @endforeach
                </select>
                @if($errors->has('activo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('activo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.activo_helper') }}</span>
            </div>
          </div>

            <div class="form-group">
                <label for="responsableproceso"><i class="fas fa-user-alt iconos-crear"></i>{{ trans('cruds.matrizRiesgo.fields.responsableproceso') }}</label>
                <input class="form-control {{ $errors->has('responsableproceso') ? 'is-invalid' : '' }}" type="text" name="responsableproceso" id="responsableproceso" value="{{ old('responsableproceso', '') }}">
                @if($errors->has('responsableproceso'))
                    <div class="invalid-feedback">
                        {{ $errors->first('responsableproceso') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.responsableproceso_helper') }}</span>
            </div>

          <div class="row">
            <div class="form-group col-sm-6">
                <label for="amenaza"><i class="fas fa-radiation iconos-crear"></i>{{ trans('cruds.matrizRiesgo.fields.amenaza') }}</label>
                <input class="form-control {{ $errors->has('amenaza') ? 'is-invalid' : '' }}" type="text" name="amenaza" id="amenaza" value="{{ old('amenaza', '') }}">
                @if($errors->has('amenaza'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amenaza') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
            </div>


            <div class="form-group col-sm-6">
                <label for="vulnerabilidad"><i class="fas fa-shield-alt iconos-crear"></i>{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad') }}</label>
                <input class="form-control {{ $errors->has('vulnerabilidad') ? 'is-invalid' : '' }}" type="text" name="vulnerabilidad" id="vulnerabilidad" value="{{ old('vulnerabilidad', '') }}">
                @if($errors->has('vulnerabilidad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vulnerabilidad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-sm-6">
                <label for="descripcionriesgo"><i class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.matrizRiesgo.fields.descripcionriesgo') }}</label>
                <input class="form-control {{ $errors->has('descripcionriesgo') ? 'is-invalid' : '' }}" type="text" name="descripcionriesgo" id="descripcionriesgo" value="{{ old('descripcionriesgo', '') }}">
                @if($errors->has('descripcionriesgo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcionriesgo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.descripcionriesgo_helper') }}</span>
            </div>



            <div class="form-group col-sm-6">
                <label><i class="fas fa-exclamation-triangle iconos-crear"></i>{{ trans('cruds.matrizRiesgo.fields.tipo_riesgo') }}</label>
                <select class="form-control {{ $errors->has('tipo_riesgo') ? 'is-invalid' : '' }}" name="tipo_riesgo" id="tipo_riesgo">
                    <option value disabled {{ old('tipo_riesgo', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\MatrizRiesgo::TIPO_RIESGO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('tipo_riesgo', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('tipo_riesgo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipo_riesgo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.tipo_riesgo_helper') }}</span>
            </div>
          </div>

          <div class="form-group" style="margin-top:15px; width:1000px; height:25px; background-color:#1BB0B0"  >
            <p class"text-center text-light" style="font-size:11pt; margin-left:280px; color:#ffffff;">Indique en que aspecto de la triada de seguridad impacta el riesgo:</p>
          </div>

          <div class="row">
            <div class="form-group col-sm-4 ">
                <label for="confidencialidad"><i class="fas fa-lock iconos-crear"></i>{{ trans('cruds.matrizRiesgo.fields.confidencialidad') }}</label>
                <input class="form-control {{ $errors->has('confidencialidad') ? 'is-invalid' : '' }}" type="number" name="confidencialidad" id="confidencialidad" value="{{ old('confidencialidad', '') }}" step="0.01">
                @if($errors->has('confidencialidad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('confidencialidad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.confidencialidad_helper') }}</span>
            </div>


            <div class="form-group col-sm-4">
                <label for="integridad"><i class="fas fa-puzzle-piece iconos-crear"></i>{{ trans('cruds.matrizRiesgo.fields.integridad') }}</label>
                <input class="form-control {{ $errors->has('integridad') ? 'is-invalid' : '' }}" type="number" name="integridad" id="integridad" value="{{ old('integridad', '') }}" step="0.01">
                @if($errors->has('integridad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('integridad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.integridad_helper') }}</span>
            </div>
            <div class="form-group col-sm-4">
                <label for="disponibilidad"><i class="fas fa-eye iconos-crear"></i>{{ trans('cruds.matrizRiesgo.fields.disponibilidad') }}</label>
                <input class="form-control {{ $errors->has('disponibilidad') ? 'is-invalid' : '' }}" type="number" name="disponibilidad" id="disponibilidad" value="{{ old('disponibilidad', '') }}" step="0.01">
                @if($errors->has('disponibilidad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('disponibilidad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.disponibilidad_helper') }}</span>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-sm-6">
                <label><i class="fas fa-dice iconos-crear"></i>{{ trans('cruds.matrizRiesgo.fields.probabilidad') }}</label>
                <select class="form-control {{ $errors->has('probabilidad') ? 'is-invalid' : '' }}" name="probabilidad" id="probabilidad">
                    <option value disabled {{ old('probabilidad', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\MatrizRiesgo::PROBABILIDAD_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('probabilidad', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('probabilidad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('probabilidad') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.probabilidad_helper') }}</span>
            </div>
            <div class="form-group col-sm-6">
                <label><i class="fas fa-bullseye iconos-crear"></i>{{ trans('cruds.matrizRiesgo.fields.impacto') }}</label>
                <select class="form-control {{ $errors->has('impacto') ? 'is-invalid' : '' }}" name="impacto" id="impacto">
                    <option value disabled {{ old('impacto', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\MatrizRiesgo::IMPACTO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('impacto', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('impacto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('impacto') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.impacto_helper') }}</span>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-sm-6">
                <label for="nivelriesgo"><i class="fas fa-chart-bar iconos-crear"></i>{{ trans('cruds.matrizRiesgo.fields.nivelriesgo') }}</label>
                <input class="form-control {{ $errors->has('nivelriesgo') ? 'is-invalid' : '' }}" type="number" name="nivelriesgo" id="nivelriesgo" value="{{ old('nivelriesgo', '') }}" step="0.01">
                @if($errors->has('nivelriesgo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nivelriesgo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.nivelriesgo_helper') }}</span>
            </div>
            <div class="form-group col-sm-6">
                <label for="riesgototal"><i class="fas fa-times-circle iconos-crear"></i>{{ trans('cruds.matrizRiesgo.fields.riesgototal') }}</label>
                <input class="form-control {{ $errors->has('riesgototal') ? 'is-invalid' : '' }}" type="number" name="riesgototal" id="riesgototal" value="{{ old('riesgototal', '') }}" step="0.01">
                @if($errors->has('riesgototal'))
                    <div class="invalid-feedback">
                        {{ $errors->first('riesgototal') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.riesgototal_helper') }}</span>
            </div>
          </div>


            <div class="form-group">
                <label for="resultadoponderacion"><i class="fas fa-file-signature iconos-crear"></i>{{ trans('cruds.matrizRiesgo.fields.resultadoponderacion') }}</label>
                <input class="form-control {{ $errors->has('resultadoponderacion') ? 'is-invalid' : '' }}" type="number" name="resultadoponderacion" id="resultadoponderacion" value="{{ old('resultadoponderacion', '') }}" step="0.01">
                @if($errors->has('resultadoponderacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('resultadoponderacion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.resultadoponderacion_helper') }}</span>
            </div>


          <div class="row">
            <div class="form-group col-sm-6">
                <label for="riesgoresidual"><i class="fas fa-tachometer-alt iconos-crear"></i>{{ trans('cruds.matrizRiesgo.fields.riesgoresidual') }}</label>
                <input class="form-control {{ $errors->has('riesgoresidual') ? 'is-invalid' : '' }}" type="number" name="riesgoresidual" id="riesgoresidual" value="{{ old('riesgoresidual', '') }}" step="0.01">
                @if($errors->has('riesgoresidual'))
                    <div class="invalid-feedback">
                        {{ $errors->first('riesgoresidual') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.riesgoresidual_helper') }}</span>
            </div>



            <div class="form-group col-sm-6">
                <label for="controles_id"><i class="fas fa-broadcast-tower iconos-crear"></i>{{ trans('cruds.matrizRiesgo.fields.controles') }}</label>
                <select class="form-control select2 {{ $errors->has('controles') ? 'is-invalid' : '' }}" name="controles_id" id="controles_id">
                    @foreach($controles as $id => $controles)
                        <option value="{{ $id }}" {{ old('controles_id') == $id ? 'selected' : '' }}>{{ $controles }}</option>
                    @endforeach
                </select>
                @if($errors->has('controles'))
                    <div class="invalid-feedback">
                        {{ $errors->first('controles') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.controles_helper') }}</span>
            </div>
          </div>



            <div class="form-group">
                <label for="justificacion"> <i class="fas fa-file-alt iconos-crear"></i>{{ trans('cruds.matrizRiesgo.fields.justificacion') }}</label>
                <input class="form-control {{ $errors->has('justificacion') ? 'is-invalid' : '' }}" type="text" name="justificacion" id="justificacion" value="{{ old('justificacion', '') }}">
                @if($errors->has('justificacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('justificacion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.justificacion_helper') }}</span>
            </div>
          </div>
            <div class="form-group col-12 text-right">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
