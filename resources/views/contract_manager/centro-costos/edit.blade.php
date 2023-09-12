
@extends('layouts.admin')
@section('content')
<h5 class="col-12 titulo_general_funcion">Actualizar:  Centro de Costos</h5>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" action="{{ route('contract_manager.centro-costos.update', [$centros->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="form-group col-md-12 col-sm-12">
                    <label class="required" for="id">&nbsp;&nbsp;Clave</label>
                    <input class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" value="{{ old("id", $centros->id) }}" type="number" name="id" id="id" value="{{ old('id') }}" required>
                    @if($errors->has('id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id') }}
                        </div>
                    @endif
                    <span class="help-block"></span>
                </div>
                <div class="form-group col-md-12 col-sm-12">
                    <label class="required" for="descripcion">&nbsp;&nbsp;Descripción</label>
                    <input class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" value="{{ old("descripcion", $centros->descripcion) }}"  type="text"  pattern="[A-z]{4,100}" name="descripcion" id="descripcion" required>
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
