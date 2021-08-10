@extends('layouts.admin')
@section('content')

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body azul_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Editar: </strong> Matriz de Riesgo </h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.matriz-riesgos.update', [$matrizRiesgo->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="form-group col-md-6 col-sm-6">
                        <label for="proceso">{{ trans('cruds.matrizRiesgo.fields.proceso') }}</label>
                        <input class="form-control {{ $errors->has('proceso') ? 'is-invalid' : '' }}" type="text"
                            name="proceso" id="proceso" value="{{ old('proceso', $matrizRiesgo->proceso) }}">
                        @if ($errors->has('proceso'))
                            <div class="invalid-feedback">
                                {{ $errors->first('proceso') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.proceso_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                        <label for="tipoactivo_id"><i class="fas fa-chart-line iconos-crear"></i>Tipo de Activo </label>
                        <select class="form-control select2 {{ $errors->has('tipoactivo') ? 'is-invalid' : '' }}"
                            name="tipoactivo_id" id="tipoactivo_id">
                            @foreach ($tipoactivos as $id => $tipoactivo)
                                <option value="{{ $id }}" {{ old('tipoactivo_id') == $id ? 'selected' : '' }}>
                                    {{ $tipoactivo }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('tipoactivo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('tipoactivo') }}
                            </div>
                        @endif
                        {{-- <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.tipoactivo_helper') }}</span> --}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="responsableproceso">{{ trans('cruds.matrizRiesgo.fields.responsableproceso') }}</label>
                    <input class="form-control {{ $errors->has('responsableproceso') ? 'is-invalid' : '' }}" type="text"
                        name="responsableproceso" id="responsableproceso"
                        value="{{ old('responsableproceso', $matrizRiesgo->responsableproceso) }}">
                    @if ($errors->has('responsableproceso'))
                        <div class="invalid-feedback">
                            {{ $errors->first('responsableproceso') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.responsableproceso_helper') }}</span>
                </div>


                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="amenaza">{{ trans('cruds.matrizRiesgo.fields.amenaza') }}</label>
                        <input class="form-control {{ $errors->has('amenaza') ? 'is-invalid' : '' }}" type="text"
                            name="amenaza" id="amenaza" value="{{ old('amenaza', $matrizRiesgo->amenaza) }}">
                        @if ($errors->has('amenaza'))
                            <div class="invalid-feedback">
                                {{ $errors->first('amenaza') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
                    </div>


                    <div class="form-group col-sm-6">
                        <label for="vulnerabilidad">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad') }}</label>
                        <input class="form-control {{ $errors->has('vulnerabilidad') ? 'is-invalid' : '' }}" type="text"
                            name="vulnerabilidad" id="vulnerabilidad"
                            value="{{ old('vulnerabilidad', $matrizRiesgo->vulnerabilidad) }}">
                        @if ($errors->has('vulnerabilidad'))
                            <div class="invalid-feedback">
                                {{ $errors->first('vulnerabilidad') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.vulnerabilidad_helper') }}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="descripcionriesgo">{{ trans('cruds.matrizRiesgo.fields.descripcionriesgo') }}</label>
                        <input class="form-control {{ $errors->has('descripcionriesgo') ? 'is-invalid' : '' }}"
                            type="text" name="descripcionriesgo" id="descripcionriesgo"
                            value="{{ old('descripcionriesgo', $matrizRiesgo->descripcionriesgo) }}">
                        @if ($errors->has('descripcionriesgo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('descripcionriesgo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.descripcionriesgo_helper') }}</span>
                    </div>


                    <div class="form-group col-sm-6">
                        <label>{{ trans('cruds.matrizRiesgo.fields.tipo_riesgo') }}</label>
                        <select class="form-control {{ $errors->has('tipo_riesgo') ? 'is-invalid' : '' }}"
                            name="tipo_riesgo" id="tipo_riesgo">
                            <option value disabled {{ old('tipo_riesgo', null) === null ? 'selected' : '' }}>
                                {{ trans('global.pleaseSelect') }}</option>
                            @foreach (App\Models\MatrizRiesgo::TIPO_RIESGO_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('tipo_riesgo', $matrizRiesgo->tipo_riesgo) === (string) $key ? 'selected' : '' }}>
                                    {{ $label }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('tipo_riesgo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('tipo_riesgo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.tipo_riesgo_helper') }}</span>
                    </div>
                </div>


                <div class="form-group" style="margin-top:15px; width:1000px; height:25px; background-color:#1BB0B0">
                    <p class"text-center text-light" style="font-size:11pt; margin-left:280px; color:#ffffff;">Indique en
                        que aspecto de la triada de seguridad impacta el riesgo:</p>
                </div>


                <div class="row">
                    <div class="form-group col-sm-4 ">
                        <label for="confidencialidad">{{ trans('cruds.matrizRiesgo.fields.confidencialidad') }}</label>
                        <select class="form-control" class="validate" required="" aria-required="true"
                            name="confidencialidad">
                            <option value="{{ $confidencialidad }}" selected='selected'>{{ $confidencialidad }}
                            </option>
                            @if ($confidencialidad == 'No')
                                <option value="Si">Si</option>
                            @else
                                <option value="No">No</option>
                            @endif
                        </select>

                        <div class="invalid-feedback">
                            {{ $errors->first('confidencialidad') }}
                        </div>

                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.confidencialidad_helper') }}</span>
                    </div>


                    <div class="form-group col-sm-4">
                        <label for="integridad">{{ trans('cruds.matrizRiesgo.fields.integridad') }}</label>
                        <select class="form-control" class="validate" required="" aria-required="true" name="integridad">
                            <option value="{{ $integridad }}" selected='selected'>{{ $integridad }}</option>
                            @if ($integridad == 'No')
                                <option value="Si">Si</option>
                            @else
                                <option value="No">No</option>
                            @endif
                        </select>

                        <div class="invalid-feedback">
                            {{ $errors->first('integridad') }}
                        </div>

                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.integridad_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="disponibilidad">{{ trans('cruds.matrizRiesgo.fields.disponibilidad') }}</label>
                        <select class="form-control" class="validate" required="" aria-required="true"
                            name="disponibilidad">
                            <option value="{{ $disponibilidad }}" selected='selected'>{{ $disponibilidad }}</option>
                            @if ($disponibilidad == 'No')
                                <option value="Si">Si</option>
                            @else
                                <option value="No">No</option>
                            @endif
                        </select>

                        <div class="invalid-feedback">
                            {{ $errors->first('disponibilidad') }}
                        </div>
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.disponibilidad_helper') }}</span>
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-sm-6">
                        <label>{{ trans('cruds.matrizRiesgo.fields.probabilidad') }}</label>
                        <select class="form-control {{ $errors->has('probabilidad') ? 'is-invalid' : '' }}"
                            name="probabilidad" id="probabilidad">
                            <option value disabled {{ old('probabilidad', null) === null ? 'selected' : '' }}>
                                {{ trans('global.pleaseSelect') }}</option>
                            @foreach (App\Models\MatrizRiesgo::PROBABILIDAD_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('probabilidad', $matrizRiesgo->probabilidad) === (string) $key ? 'selected' : '' }}>
                                    {{ $label }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('probabilidad'))
                            <div class="invalid-feedback">
                                {{ $errors->first('probabilidad') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.probabilidad_helper') }}</span>
                    </div>


                    <div class="form-group col-sm-6">
                        <label>{{ trans('cruds.matrizRiesgo.fields.impacto') }}</label>
                        <select class="form-control {{ $errors->has('impacto') ? 'is-invalid' : '' }}" name="impacto"
                            id="impacto">
                            <option value disabled {{ old('impacto', null) === null ? 'selected' : '' }}>
                                {{ trans('global.pleaseSelect') }}</option>
                            @foreach (App\Models\MatrizRiesgo::IMPACTO_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('impacto', $matrizRiesgo->impacto) === (string) $key ? 'selected' : '' }}>
                                    {{ $label }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('impacto'))
                            <div class="invalid-feedback">
                                {{ $errors->first('impacto') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.impacto_helper') }}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="nivelriesgo">{{ trans('cruds.matrizRiesgo.fields.nivelriesgo') }}</label>
                        <input class="form-control {{ $errors->has('nivelriesgo') ? 'is-invalid' : '' }}" type="number"
                            name="nivelriesgo" id="nivelriesgo"
                            value="{{ old('nivelriesgo', $matrizRiesgo->nivelriesgo) }}" step="0.01">
                        @if ($errors->has('nivelriesgo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nivelriesgo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.nivelriesgo_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="riesgototal">{{ trans('cruds.matrizRiesgo.fields.riesgototal') }}</label>
                        <input class="form-control {{ $errors->has('riesgototal') ? 'is-invalid' : '' }}" type="number"
                            name="riesgototal" id="riesgototal"
                            value="{{ old('riesgototal', $matrizRiesgo->riesgototal) }}" step="0.01">
                        @if ($errors->has('riesgototal'))
                            <div class="invalid-feedback">
                                {{ $errors->first('riesgototal') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.riesgototal_helper') }}</span>
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="riesgoresidual">{{ trans('cruds.matrizRiesgo.fields.riesgoresidual') }}</label>
                        <input class="form-control {{ $errors->has('riesgoresidual') ? 'is-invalid' : '' }}"
                            type="number" name="riesgoresidual" id="riesgoresidual"
                            value="{{ old('riesgoresidual', $matrizRiesgo->riesgoresidual) }}" step="0.01">
                        @if ($errors->has('riesgoresidual'))
                            <div class="invalid-feedback">
                                {{ $errors->first('riesgoresidual') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.riesgoresidual_helper') }}</span>
                    </div>



                    <!--  <div class="form-group">
                                        <label for="resultadoponderacion">{{ trans('cruds.matrizRiesgo.fields.resultadoponderacion') }}</label>
                                        <input class="form-control {{ $errors->has('resultadoponderacion') ? 'is-invalid' : '' }}" type="number" name="resultadoponderacion" id="resultadoponderacion" value="{{ old('resultadoponderacion', $matrizRiesgo->resultadoponderacion) }}" step="0.01">
                                        @if ($errors->has('resultadoponderacion'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('resultadoponderacion') }}
                                            </div>
                                        @endif
                                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.resultadoponderacion_helper') }}</span>
                                    </div>-->

                    <div class="form-group col-sm-6">
                        <label for="controles_id">{{ trans('cruds.matrizRiesgo.fields.controles') }}</label>
                        <select class="form-control select2 {{ $errors->has('controles') ? 'is-invalid' : '' }}"
                            name="controles_id" id="controles_id">
                            @foreach ($controles as $id => $controles)
                                <option value="{{ $id }}"
                                    {{ (old('controles_id') ? old('controles_id') : $matrizRiesgo->controles->id ?? '') == $id ? 'selected' : '' }}>
                                    {{ $controles }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('controles'))
                            <div class="invalid-feedback">
                                {{ $errors->first('controles') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.controles_helper') }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="justificacion">{{ trans('cruds.matrizRiesgo.fields.justificacion') }}</label>
                    <input class="form-control {{ $errors->has('justificacion') ? 'is-invalid' : '' }}" type="text"
                        name="justificacion" id="justificacion"
                        value="{{ old('justificacion', $matrizRiesgo->justificacion) }}">
                    @if ($errors->has('justificacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('justificacion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.justificacion_helper') }}</span>
                </div>
                <div class="text-right form-group col-12">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection
