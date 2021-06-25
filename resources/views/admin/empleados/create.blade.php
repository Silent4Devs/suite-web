@extends('layouts.admin')
@section('content')

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Empleado </strong></h3>
        </div>
        @if (!$ceo_exists)
            <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 3px #3B82F6;">
                <div class="row w-100">
                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                        <div class="w-100">
                            <i class="fas fa-info-circle" style="color: #3B82F6; font-size: 22px"></i>
                        </div>
                    </div>
                    <div class="col-11">
                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Atención</p>
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">No se ha definido el nodo raíz (CEO) de la
                            organización, es recomendable que se defina al inicio de la carga de empleados</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('admin.empleados.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="required" for="name"><i class="fas fa-street-view iconos-crear"></i>Nombre</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                            id="name" value="{{ old('name', '') }}" required>
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="foto"><i class="fas fa-id-card-alt iconos-crear"></i> Foto </label>
                        <div class="mb-3 input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" class="needsclick dropzone" name="foto"
                                    id="foto" class="form-control {{ $errors->has('foto') ? 'is-invalid' : '' }}"
                                    id="foto-dropzone" accept="image/*" value="{{ old('foto', '') }}">
                                <label class="custom-file-label" for="inputGroupFile02"></label>

                            </div>
                        </div>
                        @if ($errors->has('foto'))
                            <div class="invalid-feedback">
                                {{ $errors->first('foto') }}
                            </div>
                        @endif

                    </div>


                </div>


                <div class="row">


                    <div class="form-group col-sm-6">
                        <label class="required" for="n_empleado"><i class="fas fa-street-view iconos-crear"></i>N° de
                            empleado</label>
                        <input class="form-control {{ $errors->has('n_empleado') ? 'is-invalid' : '' }}" type="text"
                            name="n_empleado" id="n_empleado" value="{{ old('n_empleado', '') }}" required>
                        @error('n_empleado')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <div class="form-group col-sm-6">
                        <label class="required" for="area"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                        <select class="custom-select areas" id="inputGroupSelect01" name="area_id">
                            <option selected value="" disabled>-- Selecciona un área --</option>
                            @forelse ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->area }}</option>
                            @empty
                                <option value="" disabled>Sin registros de áreas</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="required" for="jefe"><i class="fas fa-user iconos-crear"></i>Jefe Inmediato</label>
                        <div class="mb-3 input-group">
                            <select class="custom-select supervisor" id="inputGroupSelect01" name="supervisor_id">
                                <option selected value="" disabled>-- Selecciona supervisor --</option>
                                @if (!$ceo_exists)
                                    <option value="">CEO</option>
                                @endif
                                @forelse ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                                @empty
                                    <option value="" disabled>Sin Datos</option>
                                @endforelse
                            </select>
                        </div>
                        {{-- <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                            name="jefe" id="jefe" value="{{ old('jefe', '') }}" required> --}}
                        @if ($errors->has('jesupervisor_idfe'))
                            <div class="invalid-feedback">
                                {{ $errors->first('supervisor_id') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label class="required" for="puesto"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                        <input class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}" type="text"
                            name="puesto" id="puesto" value="{{ old('puesto', '') }}" required>
                        @if ($errors->has('puesto'))
                            <div class="invalid-feedback">
                                {{ $errors->first('puesto') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="required" for="estatus"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha de
                            ingreso</label>
                        <input class="form-control {{ $errors->has('antiguedad') ? 'is-invalid' : '' }}" type="date"
                            name="antiguedad" id="antiguedad" value="{{ old('antiguedad', '') }}" required>
                        @if ($errors->has('antiguedad'))
                            <div class="invalid-feedback">
                                {{ $errors->first('antiguedad') }}
                            </div>
                        @endif

                    </div>


                    <div class="form-group col-sm-6">
                        <label class="required" for="estatus"><i
                                class="fas fa-business-time iconos-crear"></i>Estatus</label>
                        <select class="form-control" class="validate" required="" name="estatus">
                            <option value="" disabled selected>Escoga una opción</option>
                            <option value="alta">Alta</option>
                            <option value="baja">Baja</option>
                        </select>
                        @if ($errors->has('estatus'))
                            <div class="invalid-feedback">
                                {{ $errors->first('estatus') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="required" for="email"><i class="far fa-envelope iconos-crear"></i>Correo
                            Electronico</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                            name="email" id="email" value="{{ old('email', '') }}" required>
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="telefono"><i class="far fa-envelope iconos-crear"></i>Teléfono</label>
                        <input class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}" type="text"
                            name="telefono" id="telefono" value="{{ old('telefono', '') }}">
                        @if ($errors->has('telefono'))
                            <div class="invalid-feedback">
                                {{ $errors->first('telefono') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="required" for="genero"><i class="fas fa-user iconos-crear"></i>Género</label>
                        <div class="mb-3 input-group">
                            <select class="custom-select genero" id="genero" name="genero">
                                <option selected value="" disabled>-- Selecciona Género --</option>
                                <option value="H" {{ old('genero') == 'H' ? 'selected' : '' }}>Hombre</option>
                                <option value="M" {{ old('genero') == 'M' ? 'selected' : '' }}>Mujer</option>
                                <option value="X" {{ old('genero') == 'X' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>
                        @if ($errors->has('genero'))
                            <div class="invalid-feedback">
                                {{ $errors->first('genero') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="sede_id"><i class="fas fa-building iconos-crear"></i>Sede</label>
                    <select class="form-control select2 {{ $errors->has('sede') ? 'is-invalid' : '' }}" name="sede_id" id="sede_id">
                        @foreach($sedes as $sede)
                            <option value="{{ $sede->id }}" {{ old('sede_id') == $sede->id ? 'selected' : '' }}>{{ $sede->sede }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('sede_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('sede_id') }}
                        </div>
                    @endif
                </div>

                <div class="text-right form-group col-12">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
        </div>
    </div>



@endsection

@section('scripts')

    <script>
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var fileName = document.getElementById("foto").files[0].name;
            var nextSibling = e.target.nextElementSibling
            nextSibling.innerText = fileName
        })
        $(document).ready(function() {
            $('.areas').select2({
                theme: 'bootstrap4',
            });
            $('.supervisor').select2({
                theme: 'bootstrap4',
            });
        });

    </script>

@endsection
