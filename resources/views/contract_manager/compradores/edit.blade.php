
@extends('layouts.admin')
@section('content')
<h5 class="col-12 titulo_general_funcion">Actualizar:  Producto</h5>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" action="{{ route('contract_manager.compradores.update', [$compradores->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="form-group col-md-12 col-sm-12 anima-focus">
                        <select class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" required name="nombre">
                            <option value="{{ old("nombre", $compradores->nombre) }}" selected>{{ old("nombre", $compradores->nombre) }}</option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        {!! Form::label('nombre', 'Nombre*', ['class' => 'asterisco']) !!}
                    @if ($errors->has('nombre'))
                        <div class="invalid-feedback red-text">
                            {{ $errors->first('nombre') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-12 col-sm-12 anima-focus">
                    <input value="{{ old("estado", $compradores->estado) }}"  class="form-control {{ $errors->has('estado') ? 'is-invalid' : '' }}" type="text"  name="estado" id="estado" required>
                    {!! Form::label('descripcion', 'Descripción*', ['class' => 'asterisco']) !!}
                    @if($errors->has('estado'))
                        <div class="invalid-feedback">
                            {{ $errors->first('estado') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
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
