
@extends('layouts.admin')
@section('content')
<h5 class="col-12 titulo_general_funcion">Actualizar:  Centro de Costos</h5>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" action="{{ route('contract_manager.centro-costos.update', [$centros->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
          <div class="row">
            <div class="form-group col-md-6 col-sm-6">
                <label class="required" for="clave"><i class="fa-solid fa-key fa-lg"></i>&nbsp;&nbsp;Clave</label>
                <input  value="{{ old("clave", $centros->clave) }}" class="form-control  {{ $errors->has('clave') ? 'is-invalid' : '' }}" type="clave" name="clave" id="clave" value="{{ old('clave') }}" required>
                @if($errors->has('clave'))
                    <div class="invalid-feedback">
                        {{ $errors->first('clave') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <label class="required" for="descripcion"><i class="fa-solid fa-file-lines fa-lg"></i>&nbsp;&nbsp;Descripción</label>
                <input value="{{old("descripcion",  $centros->descripcion)}}"  class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="descripcion" name="descripcion" id="descripcion" required>
                @if($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
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
