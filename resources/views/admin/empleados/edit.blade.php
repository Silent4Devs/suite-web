@extends('layouts.admin')
@section('content')

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Editar: </strong>Empleado </h3>
        </div>


        <div class="card-body">
            <form method="POST" action="{{ route('admin.empleados.update', [$empleado->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="mb-3 text-center row justify-content-center">
                    <div class="text-center col-sm-2 w-50 text-light card-title" style="background-color:#1BB0B0">
                        Imágen Actual
                    </div>
                    <div class="col-sm-12"><img class="ml-3"
                            src="{{ asset('storage/empleados/imagenes/' . $empleado->foto) }}" style="width:80px "></div>

                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="required" for="name"><i
                                class="fas fa-user iconos-crear"></i>{{ trans('cruds.user.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                            id="name" value="{{ old('name', $empleado->name) }}" required>
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif

                    </div>


                    <div class="form-group col-sm-6">
                        <label for="foto"><i class="fas fa-id-card-alt iconos-crear"></i>Foto</label>
                        <div class="mb-3 input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="foto" id="foto" accept="image/*"
                                    value="{{ $empleado->foto }}" readonly>
                                <label class="custom-file-label"
                                    for="inputGroupFile02">{{ $empleado->foto != null ? $empleado->foto : '' }}</label>
                            </div>

                        </div>
                    </div>

                </div>


                <div class="row">


                    <div class="form-group col-sm-6">
                        <label class="required" for="n_empleado"><i class="fas fa-street-view iconos-crear"></i>N° de
                            empleado</label>
                        <input class="form-control {{ $errors->has('n_empleado') ? 'is-invalid' : '' }}" type="text"
                            name="n_empleado" id="n_empleado" value="{{ old('n_empleado', $empleado->n_empleado) }}"
                            disabled>
                        @if ($errors->has('n_empleado'))
                            <div class="invalid-feedback">
                                {{ $errors->first('n_empleado') }}
                            </div>
                        @endif

                    </div>
                    <div class="form-group col-sm-6">
                        <label class="required" for="area"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                        <div class="mb-3 input-group">
                            <select class="custom-select areas" id="inputGroupSelect01" name="area_id">
                                <option selected disabled value="null">-- Seleccion un área --</option>
                                @forelse ($areas as $area_n)
                                    <option value="{{ $area_n->id }}"
                                        {{ old('area_id', $area_n->id) == $area->id ? 'selected active' : '' }}>
                                        {{ $area_n->area }}</option>
                                @empty
                                    <option value="" disabled>Sin Datos</option>
                                @endforelse
                            </select>
                        </div>
                        @if ($errors->has('area_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('area_id') }}
                            </div>
                        @endif
                    </div>
                </div>


                <div class="row">

                    <div class="form-group col-sm-6">
                        <label class="required" for="puesto"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                        <input class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}" type="text"
                            name="puesto" id="puesto" value="{{ old('puesto', $empleado->puesto) }}" required>
                        @if ($errors->has('puesto'))
                            <div class="invalid-feedback">
                                {{ $errors->first('puesto') }}
                            </div>
                        @endif

                    </div>

                    <div class="form-group col-sm-6">
                        <label class="required" for="jefe"><i class="fas fa-user iconos-crear"></i>Jefe Inmediato</label>
                        <div class="mb-3 input-group">
                            <select class="custom-select supervisor" id="inputGroupSelect01" name="supervisor_id">
                                <option selected disabled value="null">-- Selecciona supervisor --</option>
                                @if (!$ceo_exists)
                                    <option value="">CEO</option>
                                @endif
                                @forelse ($empleados as $empleado_r)
                                    @if ($empleado_r->id != $empleado->id)
                                        <option value="{{ $empleado_r->id }}"
                                            {{ old('supervisor_id', $empleado_r->id) == $empleado->supervisor_id ? 'selected' : '' }}>
                                            {{ $empleado_r->name }}</option>
                                    @endif
                                @empty
                                    <option value="" disabled>Sin Datos</option>
                                @endforelse
                            </select>
                        </div>
                        {{-- <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                            name="jefe" id="jefe" value="{{ old('jefe', '') }}" required> --}}
                        @if ($errors->has('supervisor_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('supervisor_id') }}
                            </div>
                        @endif

                    </div>



                </div>


                <div class="row">

                    <div class="form-group col-sm-6">
                        <label class="required" for="antiguedad"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha de
                            ingreso</label>
                        <input class="form-control {{ $errors->has('antiguedad') ? 'is-invalid' : '' }}" type="date"
                            name="antiguedad" id="antiguedad" value="{{ old('antiguedad', $empleado->antiguedad) }}"
                            required>
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
                            <option {{ old('estatus', $empleado->estatus) == 'alta' ? 'selected' : '' }} value="alta">
                                Alta
                            </option>
                            <option {{ old('estatus', $empleado->estatus) == 'baja' ? 'selected' : '' }} value="baja">
                                Baja
                            </option>
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
                        <label for="telefono"><i class="far fa-envelope iconos-crear"></i>Telefono</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                            name="telefono" id="telefono" value="{{ old('telefono', $empleado->telefono) }}">
                        @if ($errors->has('telefono'))
                            <div class="invalid-feedback">
                                {{ $errors->first('telefono') }}
                            </div>
                        @endif

                    </div>

                    <div class="form-group col-sm-6">
                        <label class="required" for="email"><i class="far fa-envelope iconos-crear"></i>Correo
                            Electronico</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                            name="email" id="email" value="{{ old('email', $empleado->email) }}" required>
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
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
                                <option value="H" {{ old('genero', $empleado->genero) == 'H' ? 'selected' : '' }}>Hombre
                                </option>
                                <option value="M" {{ old('genero', $empleado->genero) == 'M' ? 'selected' : '' }}>Mujer
                                </option>
                                <option value="X" {{ old('genero', $empleado->genero) == 'X' ? 'selected' : '' }}>Otro
                                </option>
                            </select>
                        </div>
                        @if ($errors->has('genero'))
                            <div class="invalid-feedback">
                                {{ $errors->first('genero') }}
                            </div>
                        @endif
                    </div>
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
