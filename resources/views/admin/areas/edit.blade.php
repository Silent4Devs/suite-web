@extends('layouts.admin')
@section('content')

<div class="mt-4 card">
    <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1 text-center text-white"><strong> Editar: </strong> Registro de Área </h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.areas.update", [$area->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

        <div class="row">
            <div class="form-group col-sm-6">
                <label for="area"><i class="fab fa-adn iconos-crear"></i>{{ trans('cruds.area.fields.area') }}</label>
                <input class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}" type="text" name="area" id="area" value="{{ old('area', $area->area) }}">
                @if($errors->has('area'))
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
                                {{ $grupo->id == $area->grupo->id ? 'selected' : '' }}>
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

            <div class="form-group col-sm-6">
                <label class="required" for="id_reporta"><i class="fas fa-user iconos-crear"></i>Reporta a</label>
                <div class="mb-3 input-group">
                    <select class="custom-select supervisor" id="inputGroupSelect01" name="supervisor_id">
                        <option selected disabled value="null">-- Selecciona area --</option>
                        @if (!$direccion_exists)
                            <option value="">Dirección General</option>
                        @endif
                        @forelse ( $areas as $area)
                            @if ($area->id != $area->id)
                                <option value="{{ $area->id }}"
                                    {{ old('id_reporta', $area->id) == $area->id_reporta ? 'selected' : '' }}>
                                    {{ $empleado_r->name }}</option>
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



        </div>

        <div class="row">

            <div class="form-group col-sm-6">
                <label for="area"><i class="fas fa-pencil-alt iconos-crear"></i>Descripción</label>
                <textarea class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}" type="text" name="area" id="area">{{ old('area', $area->area) }}</textarea>
                @if($errors->has('area'))
                    <div class="invalid-feedback">
                        {{ $errors->first('area') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.area.fields.area_helper') }}</span>
            </div>

        </div>



            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
