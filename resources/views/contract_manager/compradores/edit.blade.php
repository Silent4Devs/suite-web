
@extends('layouts.admin')
@section('content')
<h5 class="col-12 titulo_general_funcion">Actualizar:  Producto</h5>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" action="{{ route('contract_manager.compradores.update', [$compradores->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                {{-- <div class="form-group col-md-12 col-sm-12">
                    <label class="required" for="id">&nbsp;&nbsp;Clave</label>
                    <input class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" type="number" name="id" id="id" value="{{ old('id') }}" required>
                    @if($errors->has('id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div> --}}
                <div class="form-group col-md-12 col-sm-12">
                    <label for="nombre" class="txt-tamaño">
                        Nombre<font class="asterisco">*</font></label>
                        <select class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" required name="nombre">
                            <option value="{{ old("nombre", $compradores->nombre) }}" selected>{{ old("nombre", $compradores->nombre) }}</option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    @if ($errors->has('nombre'))
                        <div class="invalid-feedback red-text">
                            {{ $errors->first('nombre') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-12 col-sm-12">
                    <label class="required" for="estado">&nbsp;&nbsp;Descripción</label>
                    <input value="{{ old("estado", $compradores->estado) }}"  class="form-control {{ $errors->has('estado') ? 'is-invalid' : '' }}" type="text" pattern="[A-z]{4,100}" name="estado" id="estado" required>
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
