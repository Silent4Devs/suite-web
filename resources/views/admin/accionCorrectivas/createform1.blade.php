<form method="POST" action="{{ route("admin.accion-correctivas.store") }}" enctype="multipart/form-data" class="row" id="formulario">
    @csrf

    {{ Form::hidden('pdf-value', 'accioncorrectiva')}}

    <div class="form-group col-12">
        <label for="fecharegistro"><i class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.fecharegistro') }}
        </label>

        <input class="form-control date {{ $errors->has('fecharegistro') ? 'is-invalid' : '' }}" type="text" name="fecharegistro" id="fecharegistro" value="{{ old('fecharegistro') }}" required>
        @if($errors->has('fecharegistro'))
        <div class="invalid-feedback">
            {{ $errors->first('fecharegistro') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.fecharegistro_helper') }}</span>
    </div>
    <div class="form-group col-md-6">
        <label for="nombrereporta_id"><i class="fas fa-user-tag iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.nombrereporta') }}
        </label>
        <select class="form-control select2 {{ $errors->has('nombrereporta') ? 'is-invalid' : '' }}" name="nombrereporta_id" id="nombrereporta_id" required>
            <option></option>
            @foreach($nombrereportas as $id => $nombrereporta)
            <option value="{{ $id }}" {{ old('nombrereporta_id') == $id ? 'selected' : '' }}>{{ $nombrereporta }}</option>
            @endforeach
        </select>
        @if($errors->has('nombrereporta'))
        <div class="invalid-feedback">
            {{ $errors->first('nombrereporta') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.nombrereporta_helper') }}</span>
    </div>
    <div class="form-group col-md-6">
        <label for="puestoreporta_id"><i class="fas fa-user-tag iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.puestoreporta') }}
        </label>
        <select class="form-control select2 {{ $errors->has('puestoreporta') ? 'is-invalid' : '' }}" name="puestoreporta_id" id="puestoreporta_id" required>
            <option></option>
            @foreach($puestoreportas as $id => $puestoreporta)
            <option value="{{ $id }}" {{ old('puestoreporta_id') == $id ? 'selected' : '' }}>{{ $puestoreporta }}</option>
            @endforeach
        </select>
        @if($errors->has('puestoreporta'))
        <div class="invalid-feedback">
            {{ $errors->first('puestoreporta') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.puestoreporta_helper') }}</span>
    </div>
    <div class="form-group col-md-6">
        <label for="nombreregistra_id"><i class="fas fa-user-tag iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.nombreregistra') }}
        </label>
        <select class="form-control select2 {{ $errors->has('nombreregistra') ? 'is-invalid' : '' }}" name="nombreregistra_id" id="nombreregistra_id" required>
            <option></option>
            @foreach($nombreregistras as $id => $nombreregistra)
            <option value="{{ $id }}" {{ old('nombreregistra_id') == $id ? 'selected' : '' }}>{{ $nombreregistra }}</option>
            @endforeach
        </select>
        @if($errors->has('nombreregistra'))
        <div class="invalid-feedback">
            {{ $errors->first('nombreregistra') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.nombreregistra_helper') }}</span>
    </div>
    <div class="form-group col-md-6">
        <label for="puestoregistra_id"><i class="fas fa-user-tag iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.puestoregistra') }}
        </label>
        <select class="form-control select2 {{ $errors->has('puestoregistra') ? 'is-invalid' : '' }}" name="puestoregistra_id" id="puestoregistra_id" required>
            <option></option>
            @foreach($puestoregistras as $id => $puestoregistra)
            <option value="{{ $id }}" {{ old('puestoregistra_id') == $id ? 'selected' : '' }}>{{ $puestoregistra }}</option>
            @endforeach
        </select>
        @if($errors->has('puestoregistra'))
        <div class="invalid-feedback">
            {{ $errors->first('puestoregistra') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.puestoregistra_helper') }}</span>
    </div>
    <div class="form-group col-12">
        <label for="tema"><i class="far fa-file-alt iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.tema') }}
        </label>
        <textarea class="form-control {{ $errors->has('tema') ? 'is-invalid' : '' }}" name="tema" id="tema" required>{{ old('tema') }}</textarea>
        @if($errors->has('tema'))
        <div class="invalid-feedback">
            {{ $errors->first('tema') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.tema_helper') }}</span>
    </div>
    <div class="form-group col-12">
        <label><i class="fas fa-project-diagram iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.causaorigen') }}
        </label>
        <select class="form-control {{ $errors->has('causaorigen') ? 'is-invalid' : '' }}" name="causaorigen" id="causaorigen" required>
            <option></option>
            <option value disabled {{ old('causaorigen', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
            @foreach(App\Models\AccionCorrectiva::CAUSAORIGEN_SELECT as $key => $label)
            <option value="{{ $key }}" {{ old('causaorigen', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @if($errors->has('causaorigen'))
        <div class="invalid-feedback">
            {{ $errors->first('causaorigen') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.causaorigen_helper') }}</span>
    </div>
    <div class="form-group col-12">
        <label for="descripcion"><i class="far fa-file-alt iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.descripcion') }}
        </label>
        <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" id="descripcion" required>{{ old('descripcion') }}</textarea>
        @if($errors->has('descripcion'))
        <div class="invalid-feedback">
            {{ $errors->first('descripcion') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.descripcion_helper') }}</span>
    </div>


    <div class="form-group col-12 text-right">
        <button id="form-siguienteaccion" data-toggle="collapse" onclick="closetabcollanext2()" data-target="#collapseplan" class="btn btn-primary">Siguiente</button>
    </div>