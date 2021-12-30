@extends('layouts.admin')
@section('content')

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Editar: </strong> Registro de Área </h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.areas.update', [$area->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="area"><i
                                class="fab fa-adn iconos-crear"></i>{{ trans('cruds.area.fields.area') }}</label>
                        <input class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}" type="text" name="area"
                            id="area" value="{{ old('area', $area->area) }}">
                        @if ($errors->has('area'))
                            <div class="invalid-feedback">
                                {{ $errors->first('area') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.area.fields.area_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="id_grupo"><i class="fas fa-users iconos-crear"></i>Grupo </label>
                        <select class="form-control select2 {{ $errors->has('id_grupo') ? 'is-invalid' : '' }}"
                            name="id_grupo" id="id_grupo" required>
                            <option value="">
                                Escoja un grupo
                            </option>
                            @if ($grupoareas)
                                @foreach ($grupoareas as $grupo)
                                    <option value="{{ $grupo->id }}"
                                        {{ $area->grupo ? ($grupo->id == $area->grupo->id ? 'selected' : '') : '' }}>
                                        {{ $grupo->nombre }}</option>
                                @endforeach
                            @else
                                <option value="">No hay proveedores registrados</option>
                            @endif
                        </select>
                        @if ($errors->has('id_grupo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_grupo') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>



                </div>

                <div class="row">

                    <div class="form-group col-sm-6">
                        <label class="required" for="id_reporta"><i class="fas fa-user iconos-crear"></i>Reporta
                            a</label>
                        <div class="mb-3 input-group">
                            <select class="custom-select supervisor" id="inputGroupSelect01" name="id_reporta">
                                <option selected disabled value="null">-- Selecciona area --</option>
                                @if (!$direccion_exists)
                                    <option value="">Dirección General</option>
                                @endif
                                @forelse ( $areas as $area_actual)
                                    @if ($area_actual->id != $area->id)
                                        <option value="{{ $area_actual->id }}"
                                            {{ old('id_reporta', $area->id_reporta) == $area_actual->id ? 'selected' : '' }}>
                                            {{ $area_actual->area }}</option>
                                    @endif
                                @empty
                                    <option value="" disabled>Sin Datos</option>
                                @endforelse
                            </select>
                        </div>
                        @if ($errors->has('id_reporta'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_reporta') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="foto_area"><i class="fas fa-images iconos-crear"></i>Fotografía del área</label>
                        <div class="mb-3 input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="foto_area" id="foto_area" accept="image/*"
                                    value="{{ $area->foto_area }}" readonly>
                                <label class="custom-file-label"
                                    for="inputGroupFile02">{{ $area->foto_area != null ? $area->foto_area : '' }}</label>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="descripcion"><i class="fas fa-pencil-alt iconos-crear"></i>Descripción</label>
                        <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text"
                            name="descripcion" id="descripcion">{{ old('descripcion', $area->descripcion) }}</textarea>
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
    </div>



@endsection
