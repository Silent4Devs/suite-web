@extends('layouts.admin')
@section('content')

    <h5 class="col-12 titulo_general_funcion">Registrar: Plan de Acción</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.planes-de-accion.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label for="parent">Nombre:</label>
                            <input type="text" class="form-control {{ $errors->has('parent') ? 'is-invalid' : '' }}" id="parent"aria-describedby="parent" name="parent"
                                value="{{ $referencia ? $referencia : old('parent', $planImplementacion->parent) }}" autocomplete="off" required>
                                @if ($errors->has('parent'))
                                    <span class="invalid-feedback">{{ $errors->first('parent') }}</span>
                                @endif
                            <span class="text-danger parent_error error-ajax"></span>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label for="norma">Norma:</label>
                            <select class="custom-select {{ $errors->has('norma') ? 'is-invalid' : '' }}" id="norma" name="norma"
                                required>
                                <option selected>-Selecciona una Norma--</option>
                                <option value="ISO 27001"
                                    {{ old('norma', $planImplementacion->norma) == 'ISO 27001' ? 'selected' : '' }}>ISO 27001</option>
                            </select>
                            @if ($errors->has('norma'))
                                <div class="invalid-feedback">{{ $errors->first('norma') }}</div>
                            @endif
                            <span class="text-danger norma_error error-ajax"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label for="modulo_origen">Modulo de Origen:</label>
                            <input type="text" class="form-control {{ $errors->has('modulo_origen') ? 'is-invalid' : '' }}"
                                id="modulo_origen" aria-describedby="modulo_origen" name="modulo_origen"
                                value="{{$planImplementacion->modulo_origen}}"
                                autocomplete="off" required readonly>
                            @if ($errors->has('modulo_origen'))
                                <span class="invalid-feedback">{{ $errors->first('modulo_origen') }}</span>
                            @endif
                            <span class="text-danger modulo_origen_error error-ajax"></span>
                        </div>
                    </div> --}}
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label for="objetivo">Objetivo:</label>
                            <textarea class="form-control {{ $errors->has('objetivo') ? 'is-invalid' : '' }}" id="objetivo"
                                name="objetivo" required>{{ old('objetivo', $planImplementacion->objetivo) }}</textarea>
                                @if ($errors->has('objetivo'))
                                <div class="invalid-feedback">{{ $errors->first('objetivo') }}</div>
                                    @endif
                                    <span class="text-danger norma_error error-ajax"></span>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="text-right form-group col-12" style="margin-left:-5px;">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
