
@extends('layouts.admin')
@section('content')
<h5 class="col-12 titulo_general_funcion">Actualizar:  Razón Social</h5>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" action="{{ route('contract_manager.sucursales.update', [$sucursales->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
          <div class="row">
            <div class="form-group col-md-6 col-sm-6 anima-focus">
                <input  value="{{ old("clave", $sucursales->clave) }}" class="form-control  {{ $errors->has('clave') ? 'is-invalid' : '' }}" type="number" name="clave" id="clave" value="{{ old('clave') }}" required>
                {!! Form::label('clave', 'Clave*', ['class' => 'asterisco']) !!}
                @if($errors->has('clave'))
                    <div class="invalid-feedback">
                        {{ $errors->first('clave') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6 anima-focus">
                <input value="{{old("descripcion",  $sucursales->descripcion)}}"  class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text" name="descripcion" id="descripcion" required>
                {!! Form::label('descripcion', 'Descripción*', ['class' => 'asterisco']) !!}
                @if($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6 anima-focus">
                <input value="{{old("rfc",  $sucursales->rfc)}}"  class="form-control {{ $errors->has('rfc') ? 'is-invalid' : '' }}" type="text" name="rfc" id="rfc" required>
                {!! Form::label('rfc', 'RFC*', ['class' => 'asterisco']) !!}
                @if($errors->has('rfc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rfc') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6 anima-focus">
                <input value="{{old("empresa",  $sucursales->empresa)}}"  class="form-control {{ $errors->has('empresa') ? 'is-invalid' : '' }}" type="text" name="empresa" id="empresa" required>
                {!! Form::label('empresa', 'Empresa*', ['class' => 'asterisco']) !!}
                @if($errors->has('empresa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('empresa') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6 anima-focus">
                <input value="{{old("cuenta_contable",  $sucursales->cuenta_contable)}}"  class="form-control {{ $errors->has('cuenta_contable') ? 'is-invalid' : '' }}" type="number" name="cuenta_contable" id="cuenta_contable" required>
                {!! Form::label('cuenta_contable', 'Cuenta Contable*', ['class' => 'asterisco']) !!}
                @if($errors->has('cuenta_contable'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cuenta_contable') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6 anima-focus">
                <input value="{{old("zona",  $sucursales->zona)}}"  class="form-control {{ $errors->has('zona') ? 'is-invalid' : '' }}" type="text" name="zona" id="zona" required>
                {!! Form::label('zona', 'Zona*', ['class' => 'asterisco']) !!}
                @if($errors->has('zona'))
                    <div class="invalid-feedback">
                        {{ $errors->first('zona') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6 anima-focus">
                <input value="{{old("direccion",  $sucursales->direccion)}}"  class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}" type="text" name="direccion" id="direccion" required>
                {!! Form::label('direccion', 'Dirección*', ['class' => 'asterisco']) !!}
                @if($errors->has('direccion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('direccion') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="col s12 l6 distancia anima-focus">
                <input type="file" id="myfile" class="form-control" name="mylogo" required  accept="image/png,image/jpeg"  >
                {!! Form::label('myfile', 'Selecciona el logotipo*', ['class' => 'asterisco']) !!}
                @if ($errors->has('mylogo'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('mylogo') }}
                    </div>
                @endif

            </div>
          </div>

            <div class="text-right form-group col-12" style="margin-left:15px;">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" type="submit">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
@section('scripts')
<script>
        $(document).ready(function() {
        $("#roles").select2({
            theme: "bootstrap4",
        });
    });
</script>
@endsection
