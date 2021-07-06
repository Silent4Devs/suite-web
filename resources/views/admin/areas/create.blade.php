@extends('layouts.admin')
@section('content')

<div class="mt-4 card">
    <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Área </h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.areas.store") }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="area"><i class="fab fa-adn iconos-crear"></i>{{ trans('cruds.area.fields.area') }}</label>
                    <input class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}" type="text" name="area" id="area" value="{{ old('area', '') }}">
                    @if($errors->has('area'))
                        <div class="invalid-feedback">
                            {{ $errors->first('area') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.area.fields.area_helper') }}</span>
                </div>
                <div class="form-group col-sm-6">
                    <label for="grupo_id"><i class="fas fa-users iconos-crear"></i>Grupo</label>
                    <select class="form-control select2 {{ $errors->has('grupo') ? 'is-invalid' : '' }}" name="id_grupo" id="id_grupo">
                        @foreach ($grupoareas as $grupo)
                                <option value="{{ $grupo->id }}">
                                    {{ $grupo->nombre }}
                                </option>

                            @endforeach
                    </select>
                    @if($errors->has('grupo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('area') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.sede.fields.organizacion_helper') }}</span>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="required" for="jefe"><i class="fas fa-user iconos-crear"></i>Reporta a</label>
                    <div class="mb-3 input-group">
                        <select class="custom-select supervisor" id="inputGroupSelect01" name="id_reporta">
                            <option selected value="" disabled>-- Selecciona area --</option>
                            @if (!$direccion_exists)
                                <option value="">Dirección General</option>
                            @endif
                            @forelse ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->area }}</option>
                            @empty
                                <option value="" disabled>Sin Datos</option>
                            @endforelse
                        </select>
                    </div>
                    {{-- <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                        name="jefe" id="jefe" value="{{ old('jefe', '') }}" required> --}}
                    @if ($errors->has('id_reporta'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_reporta') }}
                        </div>
                    @endif
                </div>


                <div class="form-group col-sm-6">
                    <label for="descripcion"><i class="fas fa-pencil-alt iconos-crear"></i>Descripción</label>
                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text" name="descripcion" id="descripcion">{{ old('descripcion', '') }}</textarea>
                    @if($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.area.fields.area_helper') }}</span>
                </div>
            </div>

            <div class="text-right form-group col-12" style="margin-left:15px;">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
