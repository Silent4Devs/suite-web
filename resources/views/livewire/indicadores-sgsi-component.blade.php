<div>

    <form wire:submit.prevent="store" enctype="multipart/form-data">

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


</div>
