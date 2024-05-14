<div class="form-group anima-focus">
    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="" type="text" name="name" id="name"
        value="{{ old('name', $tipoContratoEmpleado->name) }}" required>
        {!! Form::label('name', 'Nombre*', ['class' => 'asterisco']) !!}
    @if ($errors->has('name'))
        <div class="invalid-feedback">
            {{ $errors->first('name') }}
        </div>
    @endif
</div>
<div class="form-group anima-focus">
    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="" name="description"
        id="description">{{ old('description', $tipoContratoEmpleado->description) }}</textarea>
        {!! Form::label('description', 'Descripción*', ['class' => 'asterisco']) !!}
    @if ($errors->has('description'))
        <div class="invalid-feedback">
            {{ $errors->first('description') }}
        </div>
    @endif
</div>
<div class="text-right form-group col-12" style="margin-left:15px;">
    <a href="{{ route('admin.tipos-contratos-empleados.index') }}" class="btn" id="btn_cancelar" style="color:#057BE2;">Cancelar</a>
    <button class="btn btn-primary" type="submit">
        Guardar
    </button>
</div>

<style>

    #btn_cancelar{
            background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
            border: 1px solid var(--unnamed-color-057be2);
            background: #FFFFFF 0% 0% no-repeat padding-box;
            border: 1px solid #057BE2;
            border-radius: 4px;
            opacity: 1;
            }
    </style>
