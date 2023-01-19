@extends('layouts.admin')
@section('content')
{{-- <h5 class="col-12 titulo_general_funcion">Registrar: </strong>Contenedores Matriz Octave</h5> --}}
<div class="mt-5 card">
    <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong>Contenedor</h3>
    </div>
    <div class="card-body">

        <form method="POST" action="{{ route("admin.contenedores.store") }}" enctype="multipart/form-data">
            @csrf

            <div class="mt-2">
                @include('admin.OCTAVE.menu')
            </div>
            <div class="py-1 text-center form-group col-12" style="background-color:#345183; border-radius:100px; color: white;">REGISTRO DE CONTENEDORES</div>

            {{-- <div class="form-group">
                <p class="font-weight-bold" style="font-size:11pt;">Llene los siguientes campos según corresponda:</p>
            </div> --}}


            <input type="hidden" name="matriz_id" value="{{$matriz}}"/>
            <div class="row">
                <div class="form-group col-md-2 col-lg-2 col-sm-12">
                    <label for="identificador_contenedor"><i class="fas fa-barcode iconos-crear"></i>ID</label>
                    <input class="form-control {{ $errors->has('identificador_contenedor') ? 'is-invalid' : '' }}" type="text"
                        name="identificador_contenedor" id="identificador_contenedor" value="{{ old('identificador_contenedor', '') }}">
                    @if ($errors->has('identificador_contenedor'))
                        <div class="invalid-feedback">
                            {{ $errors->first('identificador_contenedor') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-10 col-lg-10 col-sm-12">
                    <label for="nom_contenedor"><i class="fas fa-box-open iconos-crear"></i>Nombre del Contenedor</label>
                    <input class="form-control {{ $errors->has('nom_contenedor') ? 'is-invalid' : '' }}" type="text"
                        name="nom_contenedor" id="nom_contenedor" value="{{ old('nom_contenedor', '') }}">
                    @if ($errors->has('nom_contenedor'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nom_contenedor') }}
                        </div>
                    @endif
                </div>

                {{-- <div class="form-group col-md-2 col-lg-2 col-sm-12">
                    <label for="riesgo"><i class="fas fa-table iconos-crear"></i>Riesgo</label>
                    <input class="form-control {{ $errors->has('riesgo') ? 'is-invalid' : '' }}" type="text"
                        name="riesgo" id="riesgo" value="{{ old('riesgo', '') }}">
                    @if ($errors->has('riesgo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('riesgo') }}
                        </div>
                    @endif
                </div> --}}

                {{-- <div class="form-group col-md-3 col-lg-3 col-sm-12">
                    <label for="vinculado_ai"><i class="fas fa-table iconos-crear"></i>Vinculado al AI</label>
                    <input class="form-control {{ $errors->has('vinculado_ai') ? 'is-invalid' : '' }}" type="text"
                        name="vinculado_ai" id="vinculado_ai" value="{{ old('vinculado_ai', '') }}">
                    @if ($errors->has('vinculado_ai'))
                        <div class="invalid-feedback">
                            {{ $errors->first('vinculado_ai') }}
                        </div>
                    @endif
                </div> --}}

                <div class="form-group col-md-12 col-lg-12 col-sm-12">
                    <label for="descripcion"><i class="far fa-file-alt iconos-crear"></i>Descripción</label>
                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                        name="descripcion" id="descripcion" required>{{ old('descripcion') }}</textarea>
                    @if ($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                </div>
            </div>
            {{-- <div class="py-1 text-center form-group col-12" style="background-color:#345183; border-radius:100px; color: white;">ESCENARIOS</div> --}}

            {{-- <div class="row">
                <div class="form-group col-md-2 col-lg-2 col-sm-12">
                    <label for="identificador_escenario"><i class="fas fa-table iconos-crear"></i>ID</label>
                    <input class="form-control {{ $errors->has('identificador_escenario') ? 'is-invalid' : '' }}" type="text"
                        name="identificador_escenario" id="identificador_escenario" value="{{ old('identificador_escenario', '') }}">
                    @if ($errors->has('identificador_escenario'))
                        <div class="invalid-feedback">
                            {{ $errors->first('identificador_escenario') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-10 col-lg-10 col-sm-12">
                    <label for="nom_escenario"><i class="fas fa-table iconos-crear"></i>Nombre del Escenario</label>
                    <input class="form-control {{ $errors->has('nom_escenario') ? 'is-invalid' : '' }}" type="text"
                        name="nom_escenario" id="nom_escenario" value="{{ old('nom_escenario', '') }}">
                    @if ($errors->has('nom_escenario'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nom_escenario') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-12 col-lg-12 col-sm-12">
                    <label for="descripcion"><i class="fas fa-table iconos-crear"></i>Descripción</label>
                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                        name="descripcion" id="descripcion" required>{{ old('descripcion') }}</textarea>
                    @if ($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-4 col-lg-4 col-sm-12">
                    <label for="confidencialidad"><i class="fas fa-table iconos-crear"></i>Confidencialidad</label>
                    <input class="form-control {{ $errors->has('confidencialidad') ? 'is-invalid' : '' }}" type="text"
                        name="confidencialidad" id="confidencialidad" value="{{ old('confidencialidad', '') }}">
                    @if ($errors->has('confidencialidad'))
                        <div class="invalid-feedback">
                            {{ $errors->first('confidencialidad') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-4 col-lg-4 col-sm-12">
                    <label for="integridad"><i class="fas fa-table iconos-crear"></i>Integridad</label>
                    <input class="form-control {{ $errors->has('integridad') ? 'is-invalid' : '' }}" type="text"
                        name="integridad" id="integridad" value="{{ old('integridad', '') }}">
                    @if ($errors->has('integridad'))
                        <div class="invalid-feedback">
                            {{ $errors->first('integridad') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-4 col-lg-4 col-sm-12">
                    <label for="disponibilidad"><i class="fas fa-table iconos-crear"></i>Disponibilidad</label>
                    <input class="form-control {{ $errors->has('disponibilidad') ? 'is-invalid' : '' }}" type="text"
                        name="disponibilidad" id="disponibilidad" value="{{ old('disponibilidad', '') }}">
                    @if ($errors->has('disponibilidad'))
                        <div class="invalid-feedback">
                            {{ $errors->first('disponibilidad') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-12 col-lg-12 col-sm-12">
                    <label><i class="fas fa-user iconos-crear"></i>Controles Aplicables</label>
                    <select class="form-control {{ $errors->has('controles') ? 'is-invalid' : '' }}" name="controles" id="controles">
                        <option value disabled {{ old('controles', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\ConcientizacionSgi::PERSONALOBJETIVO_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('controles', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('controles'))
                        <div class="invalid-feedback">
                            {{ $errors->first('controles') }}
                        </div>
                    @endif
                </div>
            </div> --}}
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
