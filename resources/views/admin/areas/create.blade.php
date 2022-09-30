@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Registrar: Área</h5>
    <div class="mt-4 card">
        <div class="card-body">
            @if (!$direccion_exists)
                <div class="px-1 py-2 mx-3 mb-3 rounded shadow"
                    style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                    <div class="row w-100">
                        <div class="text-center col-1 align-items-center d-flex justify-content-center">
                            <div class="w-100">
                                <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                            </div>
                        </div>
                        <div class="col-11">
                            <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Atención</p>
                            <p class="m-0" style="font-size: 14px; color:#1E3A8A ">
                                No se ha definido el área de <strong>Dirección General</strong>
                            </p>
                            <p class="m-0">
                                Cree el listado de áreas, comenzando por los de más alta jerarquía
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            <form method="POST" action="{{ route('admin.areas.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row col-12">
                    <div class="form-group col-sm-4">
                        <label class="required" for="area"><i
                                class="fab fa-adn iconos-crear"></i>{{ trans('cruds.area.fields.area') }}</label>
                        <input class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}" type="text"
                            name="area" id="area" value="{{ old('area', '') }}">
                        @if ($errors->has('area'))
                            <div class="invalid-feedback">
                                {{ $errors->first('area') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.area.fields.area_helper') }}</span>
                    </div>


                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label for="empleados_id"><i class="fas fa-user-tie iconos-crear"></i>Responsable</label>
                        <select class="form-control {{ $errors->has('empleados_id') ? 'is-invalid' : '' }}"
                            name="empleados_id" id="nombre_contacto_puesto">
                            <option value="">
                                -- Selecciona el responsable --
                            </option>
                            @foreach ($empleados as $empleado)
                                <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                    data-area="{{ $empleado->area->area }}">
                                    {{ $empleado->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('reporta'))
                            <div class="invalid-feedback">
                                {{ $errors->first('empleados_id') }}
                            </div>
                        @endif
                    </div>



                    <div class="form-group col-md-4">
                        <label for="puesto"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                        <div class="form-control" id="contacto_puesto"></div>
                    </div>


                </div>

                <div class="row col-12">
                    @if ($direccion_exists)
                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                            <label class="required" for="jefe"><i class="fas fa-user iconos-crear"></i>Área a la que
                                reporta</label>
                            <div class="mb-3 input-group">
                                <select class="custom-select supervisor" id="inputGroupSelect01" name="id_reporta">
                                    <option selected value="" disabled>-- Selecciona area --</option>

                                    @forelse ($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->area }}</option>
                                    @empty
                                        <option value="" disabled>Sin Datos</option>
                                    @endforelse
                                </select>
                            </div>

                            @if ($errors->has('id_reporta'))
                                <span class="text-danger">
                                    {{ $errors->first('id_reporta') }}
                                </span>
                            @endif
                        </div>
                    @endif


                    <div class="form-group col-sm-4">
                        <label for="grupo_id"><i class="fas fa-users iconos-crear"></i>Grupo</label>
                        <select class="form-control select2 {{ $errors->has('grupo') ? 'is-invalid' : '' }}"
                            name="id_grupo" id="id_grupo">
                            <option selected value="" disabled>-- Selecciona el grupo --</option>
                            @foreach ($grupoareas as $grupo)
                                <option value="{{ $grupo->id }}">
                                    {{ $grupo->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('grupo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('area') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.sede.fields.organizacion_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="foto_area"> <i class="fas fa-images iconos-crear"></i>Fotografía del área</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="foto_area" id="foto_area" accept="image/*"
                                value="{{ $area->foto_area }}" readonly>
                            <label class="custom-file-label" for="inputGroupFile02"></label>
                        </div>

                        @if ($errors->has('foto_area'))
                            <div class="invalid-feedback">
                                {{ $errors->first('foto_area') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row col-12">
                    <div class="form-group col-sm-{{ $direccion_exists ? '12' : '12' }}">
                        <label for="descripcion"><i class="fas fa-pencil-alt iconos-crear"></i>Descripción</label>
                        <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text" name="descripcion"
                            id="descripcion">{{ old('descripcion', '') }}</textarea>
                        @if ($errors->has('descripcion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('descripcion') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.area.fields.area_helper') }}</span>
                    </div>
                </div>

                <div class="text-right form-group col-12" style="margin-left:15px;">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>



    @endsection

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let contacto = document.querySelector('#nombre_contacto_puesto');
            let puesto_init = contacto.options[contacto.selectedIndex].getAttribute('data-puesto');

            document.getElementById('contacto_puesto').innerHTML = puesto_init;
            contacto.addEventListener('change', function(e) {
                e.preventDefault();
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('contacto_puesto').innerHTML = puesto;
            })

            document.querySelector('.custom-file-input').addEventListener('change', function(e) {
                var fileName = document.getElementById("foto_area").files[0].name;
                var nextSibling = e.target.nextElementSibling
                nextSibling.innerText = fileName
            })
        })
    </script>
