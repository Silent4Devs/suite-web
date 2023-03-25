@extends('layouts.admin')
@section('content')

    <h5 class="col-12 titulo_general_funcion">Registrar: Plan de Trabajo Base</h5>
    <div class="mt-4 card">
        <div class="card-body">
            @can('planes_de_accion_agregar')
                <form method="POST" action="{{ route('admin.planes-de-accion.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="es_plan_trabajo_base" value="true">
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label for="parent" class="required">Nombre:</label>
                                <input type="text" class="form-control {{ $errors->has('parent') ? 'is-invalid' : '' }}"
                                    id="parent" aria-describedby="parent" name="parent"
                                    value="{{ $referencia ? $referencia : old('parent', $planImplementacion->parent) }}"
                                    autocomplete="off" required>
                                @if ($errors->has('parent'))
                                    <span class="invalid-feedback">{{ $errors->first('parent') }}</span>
                                @endif
                                <span class="text-danger parent_error error-ajax"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label for="norma" class="required">Norma:</label>
                                <select class="custom-select {{ $errors->has('norma') ? 'is-invalid' : '' }}" id="norma"
                                    name="norma" required>
                                    <option selected disabled value="">-- Selecciona una Norma --</option>
                                    @foreach (\App\Models\PlanImplementacion::NORMAS as $norma)
                                        <option value="{{ $norma }}"
                                            {{ $norma == $planImplementacion->norma ? 'selected' : '' }}>{{ $norma }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('norma'))
                                    <div class="invalid-feedback">{{ $errors->first('norma') }}</div>
                                @endif
                                <span class="text-danger norma_error error-ajax"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label for="objetivo" class="required">Objetivo:</label>
                                <textarea class="form-control {{ $errors->has('objetivo') ? 'is-invalid' : '' }}" id="objetivo" name="objetivo"
                                    required>{{ old('objetivo', $planImplementacion->objetivo) }}</textarea>
                                @if ($errors->has('objetivo'))
                                    <div class="invalid-feedback">{{ $errors->first('objetivo') }}</div>
                                @endif
                                <span class="text-danger norma_error error-ajax"></span>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="text-right form-group col-12" style="margin-left:-5px;">
                <a href="{{ route('admin.planTrabajoBase.index') }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
            </form>
        @endcan
    </div>
    </div>

@endsection
