@extends('layouts.admin')
@section('content')

    <style>
        .dotverde {
            height: 15px;
            width: 15px;
            background-color: green;
            border-radius: 50%;
            display: inline-block;
        }

        .dotyellow {
            height: 15px;
            width: 15px;
            background-color: yellow;
            border-radius: 50%;
            display: inline-block;
        }

        .dotred {
            height: 15px;
            width: 15px;
            background-color: red;
            border-radius: 50%;
            display: inline-block;
        }

    </style>

    {{ Breadcrumbs::render('admin.indicadores-sgsis.create') }}

    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong>Indicadores SGSI</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="required" for="nombre"><i class="fas fa-building iconos-crear"></i>Nombre del
                        indicador</label>
                    <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre"
                        id="nombre" value="{{ old('nombre', '') }}" required>
                    @if ($errors->has('nombre'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombre') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>

                <div class="form-group col-sm-6">
                    <div class="form-group">
                        <label for="id_proceso"><i class="fas fa-building iconos-crear"></i>Proceso</label>
                        <select class="form-control select2 {{ $errors->has('id_proceso') ? 'is-invalid' : '' }}"
                            name="id_proceso" id="id_proceso">
                            <option value="">Seleccione un proceso</option>
                            @foreach ($procesos as $proceso)
                                <option value="{{ $proceso->id }}">
                                    {{ $proceso->codigo }}/{{ $proceso->nombre }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('organizacion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('organizacion') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.sede.fields.organizacion_helper') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="descripcion"><i
                        class="fas fa-file-signature iconos-crear"></i>{{ trans('cruds.sede.fields.descripcion') }}</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"
                    id="descripcion">{{ old('descripcion') }}</textarea>
                @if ($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sede.fields.descripcion_helper') }}</span>
            </div>
            <p class="gray-text">Rangos</p>
            <hr>
            <div class="row">
                <div class="form-group col-sm-4">
                    <div class="form-group">
                        <label class="required" for="rojo"><span class="dotred"></span> De 0 a <span
                                id="textorojo"></span></label>
                        <input class="form-control {{ $errors->has('rojo') ? 'is-invalid' : '' }}" type="number"
                            name="rojo" id="rojo" value="{{ old('rojo', '') }}" min="0" required>
                        @if ($errors->has('rojo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('rojo') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="form-group col-sm-4">
                    <div class="form-group">
                        <label class="required" for="amarillo"><span class="dotyellow"></span> De <span
                                id="textorojo2"></span> a <span id="textoamarillo"></span>:</label>
                        <input class="form-control {{ $errors->has('amarillo') ? 'is-invalid' : '' }}" type="number"
                            name="amarillo" id="amarillo" value="{{ old('amarillo', '') }}" min="" required>
                        @if ($errors->has('amarillo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('amarillo') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="form-group col-sm-4">
                    <label class="required" for="verde">
                        <span class="dotverde"></span>
                        De <span id="textoamarillo2"></span> a <span id="textoverde"></span>:</label>
                    <input class="form-control {{ $errors->has('verde') ? 'is-invalid' : '' }}" type="number"
                        name="verde" id="verde" value="{{ old('verde', '') }}" placeholder="" min="" required>
                    @if ($errors->has('verde'))
                        <div class="invalid-feedback">
                            {{ $errors->first('verde') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-3">
                    <label class="required" for="unidad"><i class="fas fa-building iconos-crear"></i>Unidad</label>
                    <input class="form-control {{ $errors->has('unidadmedida') ? 'is-invalid' : '' }}" type="text"
                        name="unidadmedida" id="unidadmedida" value="{{ old('unidadmedida', '') }}" required>
                    @if ($errors->has('unidadmedida'))
                        <div class="invalid-feedback">
                            {{ $errors->first('unidadmedida') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>

                <div class="form-group col-sm-3">
                    <div class="form-group">
                        <label class="required" for="meta"><i class="fas fa-building iconos-crear"></i>Meta</label>
                        <input class="form-control {{ $errors->has('meta') ? 'is-invalid' : '' }}" type="text"
                            name="meta" id="meta" value="{{ old('meta', '') }}" required>
                        @if ($errors->has('meta'))
                            <div class="invalid-feedback">
                                {{ $errors->first('meta') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="form-group col-sm-3">
                    <div class="form-group">
                        <label class="required" for="frecuencia"><i
                                class="fas fa-building iconos-crear"></i>Frecuencia</label>
                        <input class="form-control {{ $errors->has('frecuencia') ? 'is-invalid' : '' }}" type="text"
                            name="frecuencia" id="frecuencia" value="{{ old('frecuencia', '') }}" required>
                        @if ($errors->has('frecuencia'))
                            <div class="invalid-feedback">
                                {{ $errors->first('frecuencia') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="form-group col-sm-3">
                    <div class="form-group">
                        <label class="required" for="no_revisiones"><i
                                class="fas fa-building iconos-crear"></i>Revisiones</label>
                        <input class="form-control {{ $errors->has('no_revisiones') ? 'is-invalid' : '' }}" type="number"
                            name="no_revisiones" id="no_revisiones" min="0" value="{{ old('no_revisiones', '') }}"
                            required>
                        @if ($errors->has('no_revisiones'))
                            <div class="invalid-feedback">
                                {{ $errors->first('no_revisiones') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>
                    <h5 id=""></h5>
                </div>

            </div>

            <div class="row">
                <div class="form-group col-sm-6">
                    <div class="form-group">
                        <label for='id_empleado'><i class="fas fa-building iconos-crear"></i>Responsable</label>
                        <select class="form-control select2 {{ $errors->has('id_empleado') ? 'is-invalid' : '' }}"
                            name='id_empleado' id='id_empleado'>
                            <option value="">Seleccione un responsable</option>
                            @foreach ($responsables as $responsable)
                                <option value="{{ $responsable->id }}">
                                    {{ $responsable->name }} </option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_empleado'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_empleado') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>


        </div>

        <div class="form-group">
            <div class="text-center form-group col-12" style="margin-left:15px;">
                <button class="btn btn-info" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </div>
        </form>
    </div>

    <script>
        var n = document.getElementById("rojo");
        var m = document.getElementById("amarillo");
        var o = document.getElementById("verde");

        n.addEventListener("keyup", function(e) {
            rojo = document.getElementById("rojo").value;
            document.getElementById("textorojo").innerHTML = rojo
            document.getElementById("textorojo2").innerHTML = parseInt(rojo) + 1
            document.getElementById("amarillo").min = parseInt(rojo) + 1;
        });

        m.addEventListener("keyup", function(e) {
            amarillo = document.getElementById("amarillo").value;
            document.getElementById("textoamarillo").innerHTML = amarillo
            document.getElementById("textoamarillo2").innerHTML = parseInt(amarillo) + 1
        });

        o.addEventListener("keyup", function(e) {
            verde = document.getElementById("verde").value;
            document.getElementById("textoverde").innerHTML = verde
            document.getElementById("verde").min = parseInt(amarillo) + 1;
        });
    </script>

@endsection
