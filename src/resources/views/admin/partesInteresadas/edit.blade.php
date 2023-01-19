@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.partes-interesadas.create') }}
    <h5 class="col-12 titulo_general_funcion">Editar: Partes Interesadas</h5>
    <div class="mt-4 card">

        <div class="card-body">
            <form method="POST" class="row"
                action="{{ route('admin.partes-interesadas.update', ['id' => $partesInteresada]) }}"
                enctype="multipart/form-data" id="formParteInteresada">
                {{-- @method('PUT') --}}
                @csrf
                <div class="form-group col-md-12">
                    <label class="required" for="parteinteresada"><i
                            class="fas fa-user-tie iconos-crear"></i>{{ trans('cruds.partesInteresada.fields.parteinteresada') }}</label>
                    <input class="form-control {{ $errors->has('parteinteresada') ? 'is-invalid' : '' }}" type="text"
                        name="parteinteresada" id="parteinteresada"
                        value="{{ old('parteinteresada', $partesInteresada->parteinteresada) }}" required>
                    @if ($errors->has('parteinteresada'))
                        <div class="invalid-feedback">
                            {{ $errors->first('parteinteresada') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.partesInteresada.fields.parteinteresada_helper') }}</span>
                </div>

                @livewire('show-partes-interesadas',['id_interesado'=>$partesInteresada->id])

                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.partes-interesadas.index') }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" id="btnActualizarParteInteresada" type="submit">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            document.getElementById('btnActualizarParteInteresada').addEventListener('click', function() {
                document.getElementById('formParteInteresada').submit();
            });


            $("#clausala").select2({
                theme: "bootstrap4",
            });
        });
    </script>
@endsection
