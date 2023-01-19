@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Registrar: Acción Correctiva</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <div class="container">
                <div class="row">

                    <div class="mt-5 col-md-12">
                        <a class="btn btn-primary" data-toggle="collapse" onclick="closetabcollap1()"
                           id="acollapseExample" href="" role="button" aria-expanded="false"
                           aria-controls="collapseExample">
                            Acción Correctiva
                        </a>
                        <a class="btn btn-primary" data-toggle="collapse" onclick="closetabcollap2()" id="acollapseplan"
                           href="" role="button" aria-expanded="false" aria-controls="collapseplan">
                            Análisis de causa raíz
                        </a>
                        <a class="btn btn-danger" data-toggle="collapse" onclick="closetabcollap3()"
                           id="acollapseactividad" href="#collapseactividad" role="button" aria-expanded="false"
                           aria-controls="collapseactividad">
                            Plan de acción
                        </a>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <div id="test-nl-1" class="content">


                                </div>
                            </div>
                        </div>
                        <div class="collapse" id="collapseplan">
                            <div class="card card-body">

                            </div>
                        </div>
                        <div class="collapse show" id="collapseactividad">
                            <div class="card card-body">

                                <form method="POST" action="{{ route("admin.planaccion-correctivas.store") }}"
                                      enctype="multipart/form-data" class="row">
                                @csrf
                                <!--
                <div class="form-group col-md-6">
                    <label for="accioncorrectiva_id"><i class="fas fa-exclamation-triangle iconos-crear"></i>{{ trans('cruds.planaccionCorrectiva.fields.accioncorrectiva') }}</label>
                    <select class="form-control select2 {{ $errors->has('accioncorrectiva') ? 'is-invalid' : '' }}" name="accioncorrectiva_id" id="accioncorrectiva_id">
                        <option></option>
                    </select>
                    @if($errors->has('accioncorrectiva'))
                                    <div class="invalid-feedback">
{{ $errors->first('accioncorrectiva') }}
                                        </div>
@endif
                                    <span class="help-block">{{ trans('cruds.planaccionCorrectiva.fields.accioncorrectiva_helper') }}</span>
                </div>
            -->
                                    <div class="form-group col-12">
                                        {!! Html::decode(Form::label('id', '<i class="fas fa-file iconos-crear"></i>No. Acción Correctiva:', ['class' => 'required'])) !!}
                                        {!! Html::decode(Form::text('accioncorrectivaid', $ids, ['id' => 'accioncorrectivaid', 'disabled'], ['class' => 'form-control mx-auto'])) !!}
                                        {{ Form::hidden('accioncorrectiva_id', $ids, ['id' => 'accioncorrectiva_id']) }}
                                    </div>
                                    <div class="form-group col-12">
                                        <label class="required" for="actividad"><i
                                                class="fas fa-bullseye iconos-crear"></i>{{ trans('cruds.planaccionCorrectiva.fields.actividad') }}
                                        </label>
                                        <input class="form-control {{ $errors->has('actividad') ? 'is-invalid' : '' }}"
                                               type="text" name="actividad" id="actividad"
                                               value="{{ old('actividad', '') }}" required>
                                        @if($errors->has('actividad'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('actividad') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.planaccionCorrectiva.fields.actividad_helper') }}</span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="responsable_id"><i
                                                class="fas fa-user-tag iconos-crear"></i>{{ trans('cruds.planaccionCorrectiva.fields.responsable') }}
                                        </label>
                                        <select
                                            class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}"
                                            name="responsable_id" id="responsable_id">
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('responsable'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('responsable') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.planaccionCorrectiva.fields.responsable_helper') }}</span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="fechacompromiso"><i
                                                class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.planaccionCorrectiva.fields.fechacompromiso') }}
                                        </label>
                                        <input
                                            class="form-control date {{ $errors->has('fechacompromiso') ? 'is-invalid' : '' }}"
                                            type="text" name="fechacompromiso" id="fechacompromiso"
                                            value="{{ old('fechacompromiso') }}">
                                        @if($errors->has('fechacompromiso'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('fechacompromiso') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.planaccionCorrectiva.fields.fechacompromiso_helper') }}</span>
                                    </div>
                                    <div class="form-group col-12">
                                        <label><i
                                                class="fas fa-signal iconos-crear"></i>{{ trans('cruds.planaccionCorrectiva.fields.estatus') }}
                                        </label>
                                        <select class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}"
                                                name="estatus" id="estatus">
                                            <option value
                                                    disabled {{ old('estatus', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                            @foreach(App\Models\PlanaccionCorrectiva::ESTATUS_SELECT as $key => $label)
                                                <option
                                                    value="{{ $key }}" {{ old('estatus', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('estatus'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('estatus') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.planaccionCorrectiva.fields.estatus_helper') }}</span>
                                    </div>
                                    <div class="text-right form-group col-12">

                                        <a class="btn btn-danger" href="{{ route("admin.accion-correctivas.index") }}">Cancelar</a>
                                        <button class="btn btn-success " type="submit">
                                            {{ trans('global.save') }}
                                        </button>

                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>


                <div id="test-nl-1" class="content">
                    @include('admin.accionCorrectivas.tabla_planaccion')

                </div>
            </div>
        </div>
    </div>

@endsection
