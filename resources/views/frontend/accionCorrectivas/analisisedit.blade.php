<div class="row">
    <div class="form-group col-12">
        <label><i
                class="fas fa-list-ul iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.metodo_causa') }}</label>
        <select class="form-control {{ $errors->has('metodo_causa') ? 'is-invalid' : '' }}" name="metodo_causa"
            id="metodo_causa">
            <option value disabled {{ old('metodo_causa', null) === null ? 'selected' : '' }}>
                {{ trans('global.pleaseSelect') }}</option>
            @foreach (App\Models\AccionCorrectiva::METODO_CAUSA_SELECT as $key => $label)
                <option value="{{ $key }}"
                    {{ old('metodo_causa', $accionCorrectiva->metodo_causa) === (string) $key ? 'selected' : '' }}>
                    {{ $label }}</option>
            @endforeach
        </select>
        @if ($errors->has('metodo_causa'))
            <div class="invalid-feedback">
                {{ $errors->first('metodo_causa') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.metodo_causa_helper') }}</span>
    </div>

    <div class="form-group col-md-6">
        <label for="solucion"><i
                class="fas fa-file-signature iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.solucion') }}</label>
        <textarea class="form-control {{ $errors->has('solucion') ? 'is-invalid' : '' }}" name="solucion"
            id="solucion">{{ old('solucion', $accionCorrectiva->solucion) }}</textarea>

        @if ($errors->has('solucion'))
            <div class="invalid-feedback">
                {{ $errors->first('solucion') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.solucion_helper') }}</span>
    </div>
    <div class="form-group col-md-6">
        <label for="cierre_accion"><i
                class="fas fa-file-signature iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.cierre_accion') }}</label>
        <textarea class="form-control {{ $errors->has('cierre_accion') ? 'is-invalid' : '' }}" name="cierre_accion"
            id="cierre_accion">{{ old('cierre_accion', $accionCorrectiva->cierre_accion) }}</textarea>

        @if ($errors->has('cierre_accion'))
            <div class="invalid-feedback">
                {{ $errors->first('cierre_accion') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.cierre_accion_helper') }}</span>
    </div>
    <div class="form-group col-md-4">
        <label><i class="fas fa-signal iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.estatus') }}</label>
        <select class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}" name="estatus" id="estatus">

            <option value disabled {{ old('estatus', null) === null ? 'selected' : '' }}>
                {{ trans('global.pleaseSelect') }}</option>
            @foreach (App\Models\AccionCorrectiva::ESTATUS_SELECT as $key => $label)
                <option value="{{ $key }}"
                    {{ old('estatus', $accionCorrectiva->estatus) === (string) $key ? 'selected' : '' }}>
                    {{ $label }}</option>
            @endforeach
        </select>
        @if ($errors->has('estatus'))
            <div class="invalid-feedback">
                {{ $errors->first('estatus') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.estatus_helper') }}</span>
    </div>

    <div class="form-group col-md-4">
        <label for="fecha_compromiso"><i
                class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.fecha_compromiso') }}</label>
        <input class="form-control date {{ $errors->has('fecha_compromiso') ? 'is-invalid' : '' }}" type="text"
            name="fecha_compromiso" id="fecha_compromiso"
            value="{{ old('fecha_compromiso', $accionCorrectiva->fecha_compromiso) }}">

        @if ($errors->has('fecha_compromiso'))
            <div class="invalid-feedback">
                {{ $errors->first('fecha_compromiso') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.fecha_compromiso_helper') }}</span>
    </div>
    <div class="form-group col-md-4">
        <label for="fecha_verificacion"><i
                class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.fecha_verificacion') }}</label>
        <input class="form-control date {{ $errors->has('fecha_verificacion') ? 'is-invalid' : '' }}" type="text"
            name="fecha_verificacion" id="fecha_verificacion"
            value="{{ old('fecha_verificacion', $accionCorrectiva->fecha_verificacion) }}">

        @if ($errors->has('fecha_verificacion'))
            <div class="invalid-feedback">
                {{ $errors->first('fecha_verificacion') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.fecha_verificacion_helper') }}</span>
    </div>

    <div class="form-group col-md-6">
        <label for="responsable_accion_id"><i
                class="fas fa-user-tag iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.responsable_accion') }}</label>
        <select class="form-control select2 {{ $errors->has('responsable_accion') ? 'is-invalid' : '' }}"
            name="responsable_accion_id" id="responsable_accion_id">

            @foreach ($responsable_accions as $id => $responsable_accion)
                <option value="{{ $id }}"
                    {{ (old('responsable_accion_id') ? old('responsable_accion_id') : $accionCorrectiva->responsable_accion->id ?? '') == $id ? 'selected' : '' }}>
                    {{ $responsable_accion }}</option>
            @endforeach
        </select>
        @if ($errors->has('responsable_accion'))
            <div class="invalid-feedback">
                {{ $errors->first('responsable_accion') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.responsable_accion_helper') }}</span>
    </div>

    <div class="form-group col-md-6">
        <label for="nombre_autoriza_id"><i
                class="fas fa-user-tag iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.nombre_autoriza') }}</label>
        <select class="form-control select2 {{ $errors->has('nombre_autoriza') ? 'is-invalid' : '' }}"
            name="nombre_autoriza_id" id="nombre_autoriza_id">

            @foreach ($nombre_autorizas as $id => $nombre_autoriza)
                <option value="{{ $id }}"
                    {{ (old('nombre_autoriza_id') ? old('nombre_autoriza_id') : $accionCorrectiva->nombre_autoriza->id ?? '') == $id ? 'selected' : '' }}>
                    {{ $nombre_autoriza }}</option>
            @endforeach
        </select>
        @if ($errors->has('nombre_autoriza'))
            <div class="invalid-feedback">
                {{ $errors->first('nombre_autoriza') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.nombre_autoriza_helper') }}</span>
    </div>

    <div class="form-group col-12">
        <label for="documentometodo"><i
                class="fas fa-file iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.documentometodo') }}</label>
        <div class="needsclick dropzone {{ $errors->has('documentometodo') ? 'is-invalid' : '' }}"
            id="documentometodo-dropzone">

        </div>
        @if ($errors->has('documentometodo'))
            <div class="invalid-feedback">
                {{ $errors->first('documentometodo') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.documentometodo_helper') }}</span>
    </div>

    <div class="text-right form-group col-12">
        <button class="btn btn-danger" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>
</div>
</form>
